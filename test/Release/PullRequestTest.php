<?php

require_once __DIR__ . '/../../.github/scripts/release/src/autoload.php';

use Pipedrive\Release\PullRequest;
use Pipedrive\Release\ReleaseError;

uses()->group('unit', 'release');

function botPr(array $overrides = []): array
{
    return array_replace([
        'number' => 331,
        'state' => 'open',
        'base' => ['ref' => 'master'],
        'head' => ['sha' => 'bf20431', 'ref' => '363'],
        'labels' => [['name' => 'php-version-minor']],
        'mergeable' => true,
        // "blocked" only means branch rules apply, it is not a conflict
        'mergeable_state' => 'blocked',
    ], $overrides);
}

it('releases a conflict-free PR', function () {
    expect(PullRequest::check(botPr(), 'master'))->toBe([
        'number' => '331',
        'head_sha' => 'bf20431',
        'head_ref' => '363',
        'bump' => 'minor',
        'action' => 'release',
    ]);
});

it('reports a PR with merge conflicts', function (array $overrides) {
    expect(PullRequest::check(botPr($overrides), 'master')['action'])->toBe('conflict');
})->with([
    'not mergeable' => [['mergeable' => false, 'mergeable_state' => 'dirty']],
    'dirty' => [['mergeable_state' => 'dirty']],
]);

it('fails when mergeability is not computed yet', function () {
    PullRequest::check(botPr(['mergeable' => null, 'mergeable_state' => 'unknown']), 'master');
})->throws(ReleaseError::class, 'Could not determine mergeability of PR #331');

it('needs exactly one php-version label', function (array $labels, string $message) {
    expect(fn () => PullRequest::check(botPr(['labels' => $labels]), 'master'))
        ->toThrow(ReleaseError::class, $message);
})->with([
    'none' => [[['name' => 'bug']], 'found: none'],
    'two' => [[['name' => 'php-version-minor'], ['name' => 'php-version-major']], 'found: minor, major'],
    'unknown' => [[['name' => 'php-version-huge']], 'Unknown label php-version-huge'],
]);

it('only releases open PRs to the base branch', function (array $overrides) {
    PullRequest::check(botPr($overrides), 'master');
})->throws(ReleaseError::class, 'expected an open PR to master')->with([
    'closed' => [['state' => 'closed']],
    'other base' => [['base' => ['ref' => 'next']]],
]);
