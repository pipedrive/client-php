<?php

require_once __DIR__ . '/../../.github/scripts/release/src/autoload.php';

use Pipedrive\Release\Changelog;
use Pipedrive\Release\Release;
use Pipedrive\Release\Version;

uses()->group('unit', 'release');


it('reads the newest released version', function () {
    $changelog = new Changelog(file_get_contents(__DIR__ . '/fixtures/CHANGELOG.md'));

    expect((string) $changelog->latestVersion())->toBe('19.2.1')
        ->and($changelog->hasUnreleasedSection())->toBeTrue()
        ->and($changelog->hasUnreleasedEntries())->toBeTrue();
});

it('sees an empty Unreleased section', function () {
    $changelog = new Changelog("## [Unreleased]\n\n## [19.2.1](x) (2026-11-06)\n- Fixed\n");

    expect($changelog->hasUnreleasedEntries())->toBeFalse();
});

it('adds the heading like the 19.2.1 manual release did', function () {
    // Release v19.2.1 (6d2b3fc): the only change was these two lines under Unreleased
    $before = "## [Unreleased]\n### Fixed\n- Corrected the `is_deleted` field\n\n## [19.2.0](x) (2026-11-06)\n";
    $after = "## [Unreleased]\n\n"
        . "## [19.2.1](https://github.com/pipedrive/client-php/compare/19.2.0...19.2.1) (2026-11-06)\n"
        . "### Fixed\n- Corrected the `is_deleted` field\n\n## [19.2.0](x) (2026-11-06)\n";

    $result = (new Changelog($before))
        ->withReleaseHeading(Version::parse('19.2.1'), Version::parse('19.2.0'), '2026-11-06', Release::REPO_URL);

    expect($result)->toBe($after);
});

it('drops blank lines between Unreleased and its first entry', function () {
    $result = (new Changelog("## [Unreleased]\n\n\n### Added\n- New\n"))
        ->withReleaseHeading(Version::parse('1.1.0'), Version::parse('1.0.0'), '2026-11-25', Release::REPO_URL);

    expect($result)->toBe("## [Unreleased]\n\n## [1.1.0](" . Release::REPO_URL . "/compare/1.0.0...1.1.0) (2026-11-25)\n### Added\n- New\n");
});

it('finds Unreleased entries that were already released, ignoring sub-bullets', function () {
    $text = "## [Unreleased]\n- Added A\n- Added B\n  - `deal-fields:full`\n\n"
        . "## [1.1.0](x) (2026-11-25)\n- Added A\n  - `deal-fields:full`\n";

    expect((new Changelog($text))->repeatedEntries())->toBe(['- Added A']);
});

it('finds no repeated entries in a normal CHANGELOG', function () {
    $changelog = new Changelog(file_get_contents(__DIR__ . '/fixtures/CHANGELOG.md'));

    expect($changelog->repeatedEntries())->toBe([]);
});
