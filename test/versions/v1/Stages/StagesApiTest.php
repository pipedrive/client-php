<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Pipedrive\versions\v1\Api\StagesApi;
use Pipedrive\versions\v1\Configuration;
use Pipedrive\Tests\Unit\TestCase;

uses(TestCase::class)->group('unit');

test('get stage details with correct type casting', function () {
    $config = new Configuration();

    $mock = $this->httpMock();
    $mock->append(
        new Response(200, [], json_encode([
            'data' => [
                'id' => '1',
                'rotten_flag' => 0,
                'active_flag' => 1,
                'rotten_days' => null,
                'update_time' => null,
                'name' => 'Qualified',
                'pipeline_name' => 'Pipeline',
            ],
        ])),
    );

    $handlerStack = HandlerStack::create($mock);

    $apiInstance = new StagesApi(
        new Client(['handler' => $handlerStack]),
        $config
    );

    $result = $apiInstance->getStage(1)->getData();

    expect($mock->getLastRequest()->getUri())->toEqual('https://api.pipedrive.com/v1/stages/1')
        ->and($result->getId())->toBe(1)
        ->and($result->getRottenFlag())->toBe(false)
        ->and($result->getActiveFlag())->toBe(true)
        ->and($result->getRottenDays())->toBe(null)
        ->and($result->getUpdateTime())->toBe(null);
});