<?php

require_once __DIR__ . '/../../.github/scripts/release/src/autoload.php';

use Pipedrive\Release\ReleaseError;
use Pipedrive\Release\UserAgent;

uses()->group('unit', 'release');

it('bumps every user agent occurrence', function () {
    $bumped = UserAgent::bump(file_get_contents(__DIR__ . '/fixtures/Configuration.php'), 19, 20);

    expect(substr_count($bumped, 'Pipedrive-SDK-PHP-20.x'))->toBe(2)
        ->and($bumped)->not->toContain('Pipedrive-SDK-PHP-19.x');
});

it('leaves an already bumped file unchanged', function () {
    $content = "protected string \$userAgent = 'Pipedrive-SDK-PHP-20.x';";

    expect(UserAgent::bump($content, 19, 20))->toBe($content);
});

it('fails when the file has neither user agent', function () {
    UserAgent::bump("protected string \$userAgent = 'Pipedrive-SDK-PHP-18.x';", 19, 20);
})->throws(ReleaseError::class, 'contains neither Pipedrive-SDK-PHP-19.x nor Pipedrive-SDK-PHP-20.x');
