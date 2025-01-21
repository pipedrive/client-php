<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Pipedrive\versions\v1\Api\ActivitiesApi;
use Pipedrive\versions\v1\Configuration;
use Pipedrive\Tests\Unit\TestCase;

uses(TestCase::class)->group('unit');

test('list activities', function () {
    $config = new Configuration();

    $mock = $this->httpMock();
    $mock->append(
        new Response(200, [], json_encode([
            'data' => [
                [
                    'id' => 1,
                    'busy_flag' => true,
                ],
            ],
        ])),
    );

    $handlerStack = HandlerStack::create($mock);

    $apiInstance = new ActivitiesApi(
        new Client(['handler' => $handlerStack]),
        $config
    );

    $result = $apiInstance->getActivities()->getData();

    expect($result[0]->getBusyFlag())->toBe(true);
});

test('set correct activity busy_flag type', function (array $dataset) {
    $config = new Configuration();

    $mock = $this->httpMock();
    $mock->append(
        new Response(200, [], json_encode([
            'data' => [
                [
                    'id' => 1,
                    'busy_flag' => $dataset['busy_flag'],
                ],
            ],
        ])),
    );

    $handlerStack = HandlerStack::create($mock);

    $apiInstance = new ActivitiesApi(
        new Client(['handler' => $handlerStack]),
        $config
    );

    $result = $apiInstance->getActivities()->getData();

    expect($mock->getLastRequest()->getUri())->toEqual('https://api.pipedrive.com/v1/activities')
        ->and($result[0]->getBusyFlag())->toBe($dataset['expected']);
    })->with([
    'boolean (false)' => fn() => ['busy_flag' => false, 'expected' => false],
    'boolean (true)' => fn() => ['busy_flag' => true, 'expected' => true],
    'number (0)' => fn() => ['busy_flag' => 0, 'expected' => false],
    'number (1)' => fn() => ['busy_flag' => 1, 'expected' => true],
    'null' => fn() => ['busy_flag' => null, 'expected' => null],
]);