<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Pipedrive\versions\v2\Api\StagesApi;
use Pipedrive\versions\v2\Configuration;
use Pipedrive\Tests\Unit\TestCase;

uses(TestCase::class)->group('unit');

test('get stage details with correct type casting', function () {
    $config = new Configuration();

    $mock = $this->httpMock();
    $mock->append(
        new Response(200, [], json_encode([
            'data' => [
                'id' => '1',
                'is_deal_rot_enabled' => false,
                'is_deleted' => false,
                'days_to_rotten' => null,
                'update_time' => null,
                'name' => 'Qualified',
            ],
        ])),
    );

    $handlerStack = HandlerStack::create($mock);

    $apiInstance = new StagesApi(
        new Client(['handler' => $handlerStack]),
        $config
    );

    $result = $apiInstance->getStage(1)->getData();

    expect($mock->getLastRequest()->getUri())->toEqual('https://api.pipedrive.com/api/v2/stages/1')
        ->and($result->getId())->toBe(1)
        ->and($result->getIsDealRotEnabled())->toBe(false)
        ->and($result->getIsDeleted())->toBe(false)
        ->and($result->getDaysToRotten())->toBe(null)
        ->and($result->getUpdateTime())->toBe(null);
});
