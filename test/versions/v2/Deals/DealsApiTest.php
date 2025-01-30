<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Pipedrive\versions\v2\Api\DealsApi;
use Pipedrive\versions\v2\Configuration;
use Pipedrive\Tests\Unit\TestCase;
use Pipedrive\versions\v2\Model\DealRequestBody;

uses(TestCase::class)->group('unit');

it('lists deals', function () {
    $config = new Configuration();
    $customFieldKey = '6504f7b19e743082034fe9b8661383ea6d7cc941';

    $mock = $this->httpMock();
    $mock->append(
        new Response(200, [], json_encode([
            'data' => [
                [
                    'id' => 1,
                    $customFieldKey => 'custom'
                ],
            ],
        ])),
    );

    $handlerStack = HandlerStack::create($mock);

    $apiInstance = new DealsApi(
        new Client(['handler' => $handlerStack]),
        $config,
    );
    $result = $apiInstance->getDeals(1, '1,2', 1, 1, 1);

    expect($mock->getLastRequest()->getUri()->getQuery())->toEqual('filter_id=1&ids=1%2C2&owner_id=1&person_id=1&org_id=1&sort_by=id&sort_direction=asc')
        ->and($result->getData())->toHaveLength(1);

    expect($result->getRawData()[0]->{$customFieldKey})->toEqual('custom');
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

    expect($mock->getLastRequest()->getUri())->toEqual('https://api.pipedrive.com/api/v2/deals/1')
        ->and($result->getData()->getId())->toBe(1);
});

it('creates a deal', function () {
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
    $result = $apiInstance->addDeal(new DealRequestBody([
        'title' => 'Test Deal',
        'value' => 100,
        'currency' => 'USD',
    ]));

    expect($mock->getLastRequest()->getUri())->toEqual('https://api.pipedrive.com/api/v2/deals')
        ->and($result->getData()->getId())->toBe(1);

    expect($mock->getLastRequest()->getBody()->getContents())->toEqual('{"title":"Test Deal","value":100,"currency":"USD"}');
});

it('updates a deal', function () {
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
    $result = $apiInstance->updateDeal(1, new DealRequestBody([
        'title' => 'Updated deal title',
    ]));

    expect($mock->getLastRequest()->getUri())->toEqual('https://api.pipedrive.com/api/v2/deals/1')
        ->and($result->getData()->getId())->toBe(1);

    expect($mock->getLastRequest()->getBody()->getContents())->toEqual('{"title":"Updated deal title"}');
});