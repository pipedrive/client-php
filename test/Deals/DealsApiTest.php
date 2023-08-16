<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Pipedrive\Api\DealsApi;
use Pipedrive\Configuration;
use Pipedrive\Tests\Unit\TestCase;

uses(TestCase::class)->group('unit');

it('lists deals', function () {
    $config = new Configuration();

    $mock = $this->httpMock();
    $mock->append(
        new Response(200, [], json_encode([
            'data' => [
                [
                    'id' => 1,
                ],
            ],
        ])),
    );

    $handlerStack = HandlerStack::create($mock);

    $apiInstance = new DealsApi(
        new Client(['handler' => $handlerStack]),
        $config,
    );
    $result = $apiInstance->getDeals(42, 100, 1, 'open');

    expect($mock->getLastRequest()->getUri()->getQuery())->toEqual('user_id=42&filter_id=100&stage_id=1&status=open&start=0')
        ->and($result->getData())->toHaveLength(1);
});

it('fetches one deal', function () {
    $config = new Configuration();

    $mock = $this->httpMock();
    $mock->append(
        new Response(200, [], json_encode([
            'data' => [
                'id' => 1,
            ],
        ])),
    );

    $handlerStack = HandlerStack::create($mock);

    $client = new Client(['handler' => $handlerStack]);

    $apiInstance = new DealsApi(
        $client,
        $config,
    );
    $result = $apiInstance->getDeal(1);

    expect($mock->getLastRequest()->getUri())->toEqual('https://api.pipedrive.com/v1/deals/1')
        ->and($result->getData()->getId())->toBe(1);
});
