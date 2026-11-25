<?php

require_once __DIR__ . '/../../.github/scripts/release/src/autoload.php';

use Pipedrive\Release\Release;
use Pipedrive\Release\ReleaseError;

uses()->group('unit', 'release');

function releaseFixture(string $name): string
{
    return file_get_contents(__DIR__ . '/fixtures/' . $name);
}

function configFiles(): array
{
    return [
        'lib/versions/v1/Configuration.php' => releaseFixture('Configuration.php'),
        'lib/versions/v2/Configuration.php' => releaseFixture('Configuration.php'),
    ];
}

it('prepares a minor release: one heading and nothing else', function () {
    $release = Release::prepare(releaseFixture('CHANGELOG.md'), '19.2.1', 'minor', '2026-11-25', configFiles());

    $heading = '## [19.3.0](https://github.com/pipedrive/client-php/compare/19.2.1...19.3.0) (2026-11-25)';
    expect($release->outputs())->toBe([
        'version' => '19.3.0',
        'previous' => '19.2.1',
        'previous_major' => '19',
        'major' => '19',
        'major_changed' => 'false',
    ])
        ->and($release->changelog)->toBe(str_replace("## [Unreleased]\n", "## [Unreleased]\n\n{$heading}\n", releaseFixture('CHANGELOG.md')))
        ->and($release->files)->toBe([]);
});

it('prepares a major release and bumps the user agent in both Configuration.php files', function () {
    $release = Release::prepare(releaseFixture('CHANGELOG.md'), '19.2.1', 'major', '2026-11-25', configFiles());

    expect($release->outputs()['version'])->toBe('20.0.0')
        ->and($release->outputs()['major_changed'])->toBe('true')
        ->and(array_keys($release->files))->toBe(array_keys(configFiles()));
    foreach ($release->files as $contents) {
        expect($contents)->toBe(str_replace('Pipedrive-SDK-PHP-19.x', 'Pipedrive-SDK-PHP-20.x', releaseFixture('Configuration.php')));
    }
});

it('is a no-op when re-run on its own result', function (string $bump) {
    $first = Release::prepare(releaseFixture('CHANGELOG.md'), '19.2.1', $bump, '2026-11-25', configFiles());
    $second = Release::prepare($first->changelog, '19.2.1', $bump, '2026-11-26', $first->files ?: configFiles());

    expect($second->changelog)->toBe($first->changelog)
        ->and($second->files)->toBe($first->files)
        ->and($second->outputs())->toBe($first->outputs())
        ->and(substr_count($second->changelog, '## [' . $first->version . ']'))->toBe(1);
})->with(['minor', 'major']);

it('fails when the CHANGELOG does not match the latest tag', function () {
    Release::prepare(releaseFixture('CHANGELOG.md'), '19.1.0', 'patch', '2026-11-25', configFiles());
})->throws(ReleaseError::class, 'Newest CHANGELOG.md version (19.2.1) does not match the latest tag (19.1.0)');

it('fails when there is nothing to release', function () {
    $changelog = "## [Unreleased]\n\n## [19.2.1](x) (2026-11-06)\n- Fixed\n";

    Release::prepare($changelog, '19.2.1', 'patch', '2026-11-25', configFiles());
})->throws(ReleaseError::class, 'Nothing to release');

it('stops with exit code 3 when Unreleased repeats released entries', function () {
    // #332 after #331 was released: git merges it cleanly but repeats the 19.3.0 notes
    $changelog = "## [Unreleased]\n- Added A\n\n## [19.3.0](x) (2026-11-25)\n- Added A\n";

    try {
        Release::prepare($changelog, '19.3.0', 'major', '2026-11-25', configFiles());
        test()->fail('Expected a ReleaseError');
    } catch (ReleaseError $error) {
        expect($error->getCode())->toBe(ReleaseError::NEEDS_DEVELOPER)
            ->and($error->getMessage())->toContain('- Added A');
    }
});

it('rejects a bad latest tag or date', function (string $tag, string $date, string $message) {
    expect(fn () => Release::prepare(releaseFixture('CHANGELOG.md'), $tag, 'patch', $date, configFiles()))
        ->toThrow(ReleaseError::class, $message);
})->with([
    'no tags fetched' => ['', '2026-11-25', "Latest tag '' is not X.Y.Z"],
    'bad date' => ['19.2.1', '25.11.2026', "Date '25.11.2026' is not YYYY-MM-DD"],
]);

it('fails on a major when a Configuration.php has an unexpected user agent', function () {
    $files = ['lib/versions/v1/Configuration.php' => "'Pipedrive-SDK-PHP-18.x'"];

    Release::prepare(releaseFixture('CHANGELOG.md'), '19.2.1', 'major', '2026-11-25', $files);
})->throws(ReleaseError::class, 'lib/versions/v1/Configuration.php contains neither');
