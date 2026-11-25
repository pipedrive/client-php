<?php

declare(strict_types=1);

namespace Pipedrive\Release;

/**
 * Works out a release from the current files, without touching the disk:
 * the next version, the CHANGELOG heading and, on a major, the user agent bump.
 */
final class Release
{
    public const REPO_URL = 'https://github.com/pipedrive/client-php';

    /**
     * @param string $changelog  contents of CHANGELOG.md
     * @param string $latestTag  newest X.Y.Z tag
     * @param string $bump       patch, minor or major
     * @param string $date       release date, YYYY-MM-DD
     * @param array<string, string> $configFiles path => contents of the files holding the user agent
     */
    public static function prepare(
        string $changelog,
        string $latestTag,
        string $bump,
        string $date,
        array $configFiles,
        string $repoUrl = self::REPO_URL
    ): PreparedRelease {
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date) !== 1) {
            throw new ReleaseError("Date '{$date}' is not YYYY-MM-DD");
        }
        if (!Version::isValid($latestTag)) {
            throw new ReleaseError("Latest tag '{$latestTag}' is not X.Y.Z (are tags fetched? git fetch --tags)");
        }

        $release = new PreparedRelease();
        $release->previous = Version::parse($latestTag);
        $release->version = $release->previous->bump($bump);
        $release->changelog = $changelog;

        self::addChangelogHeading($release, new Changelog($changelog), $date, $repoUrl);

        if ($release->isMajor()) {
            foreach ($configFiles as $path => $contents) {
                $release->files[$path] = self::bumpUserAgent($path, $contents, $release->previous->major, $release->version->major);
                $release->messages[] = $release->files[$path] === $contents
                    ? "{$path}: already uses " . UserAgent::for($release->version->major)
                    : "{$path}: user agent " . UserAgent::for($release->previous->major) . ' -> ' . UserAgent::for($release->version->major);
            }
        }

        return $release;
    }

    public static function bumpUserAgent(string $path, string $contents, int $from, int $to): string
    {
        try {
            return UserAgent::bump($contents, $from, $to);
        } catch (ReleaseError $error) {
            throw new ReleaseError("{$path} {$error->getMessage()}");
        }
    }

    private static function addChangelogHeading(PreparedRelease $release, Changelog $changelog, string $date, string $repoUrl): void
    {
        if (!$changelog->hasUnreleasedSection()) {
            throw new ReleaseError("CHANGELOG.md has no '## [Unreleased]' heading");
        }
        $top = $changelog->latestVersion();
        if ($top === null) {
            throw new ReleaseError('CHANGELOG.md has no released version heading (## [X.Y.Z])');
        }
        $release->messages[] = "Latest tag: {$release->previous}, newest CHANGELOG version: {$top}, next version: {$release->version}";

        if ($top->equals($release->version)) {
            // Already prepared, e.g. a re-run, or a developer added the heading by hand
            $release->messages[] = "CHANGELOG.md already has a heading for {$release->version}, leaving it unchanged";
            if ($changelog->hasUnreleasedEntries()) {
                $release->warnings[] = "'## [Unreleased]' still has entries above the {$release->version} heading, check CHANGELOG.md";
            }
            return;
        }

        if (!$top->equals($release->previous)) {
            throw new ReleaseError(
                "Newest CHANGELOG.md version ({$top}) does not match the latest tag ({$release->previous}): "
                . "expected {$release->previous}, or {$release->version} if the heading was already added. "
                . 'Fix CHANGELOG.md or the tags, then re-run.'
            );
        }
        if (!$changelog->hasUnreleasedEntries()) {
            throw new ReleaseError("Nothing to release: '## [Unreleased]' in CHANGELOG.md has no entries");
        }
        $repeated = $changelog->repeatedEntries();
        if ($repeated !== []) {
            throw ReleaseError::needsDeveloper(
                "'## [Unreleased]' in CHANGELOG.md repeats entries of an already released version. "
                . "Remove them on the PR branch and push to retry:\n" . implode("\n", $repeated)
            );
        }

        $release->changelog = $changelog->withReleaseHeading($release->version, $release->previous, $date, $repoUrl);
        $release->messages[] = 'CHANGELOG.md: added heading: ' . Changelog::heading($release->version, $release->previous, $date, $repoUrl);
    }
}
