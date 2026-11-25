<?php

require_once __DIR__ . '/../../.github/scripts/release/src/autoload.php';

use Pipedrive\Release\ReleaseError;
use Pipedrive\Release\Version;

uses()->group('unit', 'release');

it('bumps the version by label', function (string $bump, string $expected) {
    expect((string) Version::parse('19.2.1')->bump($bump))->toBe($expected);
})->with([
    'patch' => ['patch', '19.2.2'],
    'minor' => ['minor', '19.3.0'],
    'major' => ['major', '20.0.0'],
]);

it('rejects an unknown bump', function () {
    Version::parse('19.2.1')->bump('huge');
})->throws(ReleaseError::class, "Unknown version bump 'huge'");

it('rejects versions that are not X.Y.Z', function (string $version) {
    Version::parse($version);
})->throws(ReleaseError::class)->with(['v19.2.1', '19.2', '5.0.0-beta.1', '']);

it('finds the latest X.Y.Z tag, comparing numerically and ignoring pre-releases', function () {
    $tags = ['5.0.0-beta.1', '19.9.0', '19.10.0', '2.0.0', 'not-a-version'];

    expect((string) Version::latest($tags))->toBe('19.10.0')
        ->and(Version::latest(['5.0.0-beta.1']))->toBeNull();
});
