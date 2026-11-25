#!/usr/bin/env bash
#
# Release helpers for the PHP SDK, used by .github/workflows/release-bot-pr.yml.
# Run from the repository root. Safe to run locally: it only edits files, it never
# commits, tags or pushes.
#
#   release.sh prepare <patch|minor|major> [--latest-tag X.Y.Z] [--date YYYY-MM-DD]
#       Computes the next version from the latest X.Y.Z tag, checks that the newest
#       version in CHANGELOG.md matches that tag, adds the version heading under
#       "## [Unreleased]" and, on a major, bumps the user agent in both
#       Configuration.php files. Prints version=, previous=, major_changed= (also
#       to $GITHUB_OUTPUT when set). Re-running it after a successful run is a no-op.
#       Exits 3 when Unreleased repeats notes of a released version (needs a developer).
#
#   release.sh bump-user-agent <from-major> <to-major> <file>...
#       Replaces Pipedrive-SDK-PHP-<from>.x with Pipedrive-SDK-PHP-<to>.x.
#       Also used for kits/php/templates/Configuration.mustache in sdk-manager.
#
set -euo pipefail

CHANGELOG=${CHANGELOG:-CHANGELOG.md}
REPO_URL=${REPO_URL:-https://github.com/pipedrive/client-php}
CONFIG_FILES=(lib/versions/v1/Configuration.php lib/versions/v2/Configuration.php)
SEMVER_RE='^[0-9]+\.[0-9]+\.[0-9]+$'

log() { echo "$*" >&2; }
die() {
  echo "::error::$*" >&2
  exit 1
}

output() {
  echo "$1=$2"
  if [ -n "${GITHUB_OUTPUT:-}" ]; then
    echo "$1=$2" >>"$GITHUB_OUTPUT"
  fi
}

bump_version() { # <X.Y.Z> <patch|minor|major>
  local major minor patch
  IFS=. read -r major minor patch <<<"$1"
  case "$2" in
    major) echo "$((major + 1)).0.0" ;;
    minor) echo "${major}.$((minor + 1)).0" ;;
    patch) echo "${major}.${minor}.$((patch + 1))" ;;
    *) die "Unknown version bump '$2', expected patch, minor or major" ;;
  esac
}

latest_tag() {
  git tag --list | grep -E "$SEMVER_RE" | sort -V | tail -n 1 || true
}

# Newest released version in CHANGELOG.md ("## [X.Y.Z](...)").
changelog_top_version() {
  sed -nE 's/^## \[([0-9]+\.[0-9]+\.[0-9]+)\].*/\1/p' "$CHANGELOG" | head -n 1
}

# True when "## [Unreleased]" has at least one non-blank line before the next heading.
unreleased_has_entries() {
  awk '
    /^## \[Unreleased\]/ { in_section = 1; next }
    in_section && /^## \[/ { exit }
    in_section && NF { found = 1 }
    END { exit !found }
  ' "$CHANGELOG"
}

# Prints top-level "- " entries under "## [Unreleased]" that already exist under a released version.
# This happens when two bot PRs were generated from the same master: git merges the
# second one cleanly, but its Unreleased section repeats the notes of the first.
duplicated_entries() {
  awk '
    /^## \[Unreleased\]/ { section = "unreleased"; next }
    /^## \[/ { section = "released"; next }
    !/^- / { next }
    section == "unreleased" { unreleased[$0] = 1 }
    section == "released" { released[$0] = 1 }
    END { for (line in unreleased) if (line in released) print line }
  ' "$CHANGELOG"
}

# Same layout as the manual releases: "## [Unreleased]", a blank line, then the new
# heading directly above the entries that were under Unreleased.
insert_heading() { # <version> <previous> <date>
  local heading="## [$1]($REPO_URL/compare/$2...$1) ($3)"
  local tmp
  tmp=$(mktemp)
  awk -v heading="$heading" '
    !done && /^## \[Unreleased\]/ { print; print ""; print heading; done = 1; skip_blank = 1; next }
    skip_blank && NF == 0 { next }
    { skip_blank = 0; print }
  ' "$CHANGELOG" >"$tmp"
  cat "$tmp" >"$CHANGELOG"
  rm -f "$tmp"
  log "CHANGELOG.md: added heading: $heading"
}

bump_user_agent() { # <from-major> <to-major> <file>...
  [ $# -ge 3 ] || die "Usage: release.sh bump-user-agent <from-major> <to-major> <file>..."
  local from=$1 to=$2 file
  shift 2
  [[ $from =~ ^[0-9]+$ && $to =~ ^[0-9]+$ ]] || die "Majors must be integers, got '$from' and '$to'"
  for file in "$@"; do
    [ -f "$file" ] || die "$file not found"
    if grep -q "Pipedrive-SDK-PHP-${from}\.x" "$file"; then
      sed -i.bak "s/Pipedrive-SDK-PHP-${from}\.x/Pipedrive-SDK-PHP-${to}.x/g" "$file"
      rm -f "$file.bak"
      log "$file: user agent Pipedrive-SDK-PHP-${from}.x -> Pipedrive-SDK-PHP-${to}.x"
    elif grep -q "Pipedrive-SDK-PHP-${to}\.x" "$file"; then
      log "$file: already uses Pipedrive-SDK-PHP-${to}.x"
    else
      die "$file contains neither Pipedrive-SDK-PHP-${from}.x nor Pipedrive-SDK-PHP-${to}.x"
    fi
  done
}

prepare() {
  [ $# -ge 1 ] || die "Usage: release.sh prepare <patch|minor|major> [--latest-tag X.Y.Z] [--date YYYY-MM-DD]"
  local bump=$1 tag="" date
  date=$(date -u +%Y-%m-%d)
  shift
  while [ $# -gt 0 ]; do
    case "$1" in
      --latest-tag) tag=${2:-}; shift 2 ;;
      --date) date=${2:-}; shift 2 ;;
      *) die "Unknown option '$1'" ;;
    esac
  done

  [ -f "$CHANGELOG" ] || die "$CHANGELOG not found, run from the repository root"
  grep -q '^## \[Unreleased\]' "$CHANGELOG" || die "$CHANGELOG has no '## [Unreleased]' heading"
  [[ $date =~ ^[0-9]{4}-[0-9]{2}-[0-9]{2}$ ]] || die "Date '$date' is not YYYY-MM-DD"

  [ -n "$tag" ] || tag=$(latest_tag)
  [[ $tag =~ $SEMVER_RE ]] || die "Latest tag '$tag' is not X.Y.Z (are tags fetched? git fetch --tags)"

  local next top
  next=$(bump_version "$tag" "$bump")
  top=$(changelog_top_version)
  [ -n "$top" ] || die "$CHANGELOG has no released version heading (## [X.Y.Z])"
  log "Latest tag: $tag, newest CHANGELOG version: $top, bump: $bump, next version: $next"

  if [ "$top" = "$tag" ]; then
    unreleased_has_entries || die "Nothing to release: '## [Unreleased]' in $CHANGELOG has no entries"
    local duplicates
    duplicates=$(duplicated_entries)
    if [ -n "$duplicates" ]; then
      log "$duplicates"
      echo "::warning::'## [Unreleased]' in $CHANGELOG repeats entries of an already released version (listed above). Remove them on the PR branch and push to retry." >&2
      exit 3
    fi
    insert_heading "$next" "$tag" "$date"
  elif [ "$top" = "$next" ]; then
    log "CHANGELOG.md already has a heading for $next, leaving it unchanged"
    if unreleased_has_entries; then
      echo "::warning::'## [Unreleased]' still has entries above the $next heading, check CHANGELOG.md" >&2
    fi
  else
    die "Newest CHANGELOG.md version ($top) does not match the latest tag ($tag): expected $tag, or $next if the heading was already added. Fix CHANGELOG.md or the tags, then re-run."
  fi

  local major_changed=false
  if [ "${tag%%.*}" != "${next%%.*}" ]; then
    major_changed=true
    bump_user_agent "${tag%%.*}" "${next%%.*}" "${CONFIG_FILES[@]}"
  fi

  output version "$next"
  output previous "$tag"
  output previous_major "${tag%%.*}"
  output major "${next%%.*}"
  output major_changed "$major_changed"
}

main() {
  local cmd=${1:-}
  [ $# -gt 0 ] && shift
  case "$cmd" in
    prepare) prepare "$@" ;;
    bump-user-agent) bump_user_agent "$@" ;;
    *)
      sed -n '3,18p' "$0" | sed 's/^# \{0,1\}//' >&2
      exit 2
      ;;
  esac
}

main "$@"
