<?php

uses()->group('unit', 'release');

/**
 * Runs release.php in a copy of the fixtures, the way the workflow does.
 *
 * @return array{int, string, string, string} exit code, stdout, stderr, working directory
 */
function runRelease(string $args, string $stdin = '', ?string $changelog = null): array
{
    $dir = sys_get_temp_dir() . '/release-cli-' . uniqid();
    mkdir("{$dir}/lib/versions/v1", 0777, true);
    mkdir("{$dir}/lib/versions/v2", 0777, true);
    file_put_contents("{$dir}/CHANGELOG.md", $changelog ?? file_get_contents(__DIR__ . '/fixtures/CHANGELOG.md'));
    foreach (['v1', 'v2'] as $version) {
        copy(__DIR__ . '/fixtures/Configuration.php', "{$dir}/lib/versions/{$version}/Configuration.php");
    }

    $script = escapeshellarg(realpath(__DIR__ . '/../../.github/scripts/release/release.php'));
    $process = proc_open(
        escapeshellarg(PHP_BINARY) . " {$script} {$args}",
        [['pipe', 'r'], ['pipe', 'w'], ['pipe', 'w']],
        $pipes,
        $dir,
        ['PATH' => getenv('PATH')]
    );
    fwrite($pipes[0], $stdin);
    fclose($pipes[0]);
    $stdout = stream_get_contents($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);

    return [proc_close($process), $stdout, $stderr, $dir];
}

it('prepares a release on disk and prints the step outputs', function () {
    [$code, $stdout, , $dir] = runRelease('prepare major --latest-tag 19.2.1 --date 2026-11-25');

    expect($code)->toBe(0)
        ->and($stdout)->toContain("version=20.0.0\nprevious=19.2.1\n")
        ->and(file_get_contents("{$dir}/CHANGELOG.md"))->toContain("## [Unreleased]\n\n## [20.0.0](")
        ->and(file_get_contents("{$dir}/lib/versions/v2/Configuration.php"))->toContain("'Pipedrive-SDK-PHP-20.x'");
});

it('exits 3 with a warning when Unreleased repeats released entries', function () {
    $changelog = "## [Unreleased]\n- Added A\n\n## [19.3.0](x) (2026-11-25)\n- Added A\n";
    [$code, , $stderr] = runRelease('prepare major --latest-tag 19.3.0', '', $changelog);

    expect($code)->toBe(3)->and($stderr)->toContain('::warning::');
});

it('exits 1 with an error on a CHANGELOG and tag mismatch', function () {
    [$code, , $stderr] = runRelease('prepare patch --latest-tag 19.1.0');

    expect($code)->toBe(1)->and($stderr)->toContain('::error::Newest CHANGELOG.md version (19.2.1)');
});

it('exits 2 with the usage on an unknown command', function () {
    [$code, , $stderr] = runRelease('release-everything');

    expect($code)->toBe(2)->and($stderr)->toContain('prepare <patch|minor|major>');
});

it('checks a PR from the GitHub API JSON on stdin', function () {
    $pr = ['number' => 332, 'state' => 'open', 'base' => ['ref' => 'master'], 'head' => ['sha' => 'abc', 'ref' => '364'],
        'labels' => [['name' => 'php-version-major']], 'mergeable' => false, 'mergeable_state' => 'dirty'];
    [$code, $stdout, $stderr] = runRelease('check-pr master', json_encode($pr));

    expect($code)->toBe(0)
        ->and($stdout)->toContain("bump=major\naction=conflict\n")
        ->and($stderr)->toContain('::warning::PR #332 has merge conflicts');
});
