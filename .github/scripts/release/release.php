<?php

/**
 * Release tools for the PHP SDK, used by .github/workflows/release-bot-pr.yml.
 * Run from the repository root. Safe to run locally: it only edits files, it never
 * commits, tags or pushes (git and gh calls stay in the workflow).
 *
 *   php .github/scripts/release/release.php prepare <patch|minor|major> [--latest-tag X.Y.Z] [--date YYYY-MM-DD]
 *       Next version from the latest X.Y.Z tag (default: git tag --list), CHANGELOG heading
 *       under "## [Unreleased]" and, on a major, the user agent in both Configuration.php
 *       files. Re-running it after a successful run is a no-op.
 *
 *   php .github/scripts/release/release.php bump-user-agent <from-major> <to-major> <file>...
 *       Pipedrive-SDK-PHP-<from>.x -> Pipedrive-SDK-PHP-<to>.x (also for the sdk-manager template).
 *
 *   gh api repos/OWNER/REPO/pulls/N | php .github/scripts/release/release.php check-pr <base-branch>
 *       Whether the PR can be released now: action=release or action=conflict.
 *
 * Exit codes: 0 done, 1 failed, 2 usage, 3 the PR needs a developer (the workflow warns and waits).
 * Results are printed as key=value and also appended to $GITHUB_OUTPUT when it is set.
 */

declare(strict_types=1);

require __DIR__ . '/src/autoload.php';

use Pipedrive\Release\PullRequest;
use Pipedrive\Release\Release;
use Pipedrive\Release\ReleaseError;
use Pipedrive\Release\UserAgent;
use Pipedrive\Release\Version;

const CHANGELOG = 'CHANGELOG.md';
const CONFIG_FILES = ['lib/versions/v1/Configuration.php', 'lib/versions/v2/Configuration.php'];
const USAGE = 2;

/** @param string[] $args */
function prepare(array $args): void
{
    $bump = array_shift($args) ?? throw new ReleaseError('Usage: prepare <patch|minor|major> [--latest-tag X.Y.Z] [--date YYYY-MM-DD]');
    $options = options($args, ['--latest-tag', '--date']);

    $configFiles = [];
    foreach (CONFIG_FILES as $path) {
        $configFiles[$path] = read($path);
    }
    $release = Release::prepare(
        read(CHANGELOG),
        $options['--latest-tag'] ?? latestTag(),
        $bump,
        $options['--date'] ?? gmdate('Y-m-d'),
        $configFiles
    );

    file_put_contents(CHANGELOG, $release->changelog);
    foreach ($release->files as $path => $contents) {
        file_put_contents($path, $contents);
    }
    array_map('info', $release->messages);
    array_map(static fn (string $warning) => info("::warning::{$warning}"), $release->warnings);
    output($release->outputs());
}

/** @param string[] $args */
function bumpUserAgent(array $args): void
{
    if (count($args) < 3 || !ctype_digit($args[0]) || !ctype_digit($args[1])) {
        throw new ReleaseError('Usage: bump-user-agent <from-major> <to-major> <file>...');
    }
    [$from, $to] = [(int) array_shift($args), (int) array_shift($args)];
    foreach ($args as $path) {
        $contents = read($path);
        $bumped = Release::bumpUserAgent($path, $contents, $from, $to);
        file_put_contents($path, $bumped);
        info($bumped === $contents
            ? "{$path}: already uses " . UserAgent::for($to)
            : "{$path}: user agent " . UserAgent::for($from) . ' -> ' . UserAgent::for($to));
    }
}

/** @param string[] $args */
function checkPr(array $args): void
{
    $base = $args[0] ?? throw new ReleaseError('Usage: check-pr <base-branch> < pr.json');
    $pr = json_decode((string) stream_get_contents(STDIN), true);
    if (!is_array($pr)) {
        throw new ReleaseError('check-pr expects the PR JSON from the GitHub API on stdin');
    }
    $result = PullRequest::check($pr, $base);
    info("PR #{$result['number']}: bump={$result['bump']}, mergeable=" . json_encode($pr['mergeable'] ?? null)
        . ', mergeable_state=' . ($pr['mergeable_state'] ?? 'unknown'));
    if ($result['action'] === PullRequest::CONFLICT) {
        info("::warning::PR #{$result['number']} has merge conflicts, it will not be released automatically. Resolve them and push to the PR branch to retry.");
        summary("PR #{$result['number']} has merge conflicts and was not released. Resolve them and push to the PR branch to retry; later release PRs wait behind it.");
    }
    output($result);
}

function latestTag(): string
{
    exec('git tag --list', $tags, $status);
    if ($status !== 0) {
        throw new ReleaseError('git tag --list failed, pass --latest-tag');
    }

    return (string) Version::latest($tags);
}

/**
 * @param string[] $args
 * @param string[] $allowed
 * @return array<string, string>
 */
function options(array $args, array $allowed): array
{
    $options = [];
    while ($args !== []) {
        $name = array_shift($args);
        if (!in_array($name, $allowed, true) || $args === []) {
            throw new ReleaseError("Unknown option or missing value: {$name}");
        }
        $options[$name] = array_shift($args);
    }

    return $options;
}

function read(string $path): string
{
    $contents = is_file($path) ? file_get_contents($path) : false;
    if ($contents === false) {
        throw new ReleaseError("{$path} not found, run from the repository root");
    }

    return $contents;
}

function info(string $message): void
{
    fwrite(STDERR, $message . PHP_EOL);
}

/** @param array<string, string> $values */
function output(array $values): void
{
    $lines = '';
    foreach ($values as $key => $value) {
        $lines .= "{$key}={$value}" . PHP_EOL;
    }
    echo $lines;
    if (getenv('GITHUB_OUTPUT')) {
        file_put_contents((string) getenv('GITHUB_OUTPUT'), $lines, FILE_APPEND);
    }
}

function summary(string $line): void
{
    if (getenv('GITHUB_STEP_SUMMARY')) {
        file_put_contents((string) getenv('GITHUB_STEP_SUMMARY'), $line . PHP_EOL, FILE_APPEND);
    }
}

/** @param string[] $argv */
function main(array $argv): int
{
    $commands = ['prepare' => 'prepare', 'bump-user-agent' => 'bumpUserAgent', 'check-pr' => 'checkPr'];
    $command = $commands[$argv[1] ?? ''] ?? null;
    if ($command === null) {
        preg_match('#/\*\*(.*?)\*/#s', (string) file_get_contents(__FILE__), $doc);
        info(preg_replace('/^ \* ?/m', '', $doc[1] ?? 'See release.php'));
        return USAGE;
    }
    try {
        $command(array_slice($argv, 2));
        return 0;
    } catch (ReleaseError $error) {
        $prefix = $error->getCode() === ReleaseError::NEEDS_DEVELOPER ? '::warning::' : '::error::';
        info($prefix . $error->getMessage());
        return $error->getCode();
    }
}

exit(main($argv));
