<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Pipedrive\Api\LeadsApi;
use Pipedrive\Configuration;
use Pipedrive\Tests\Unit\TestCase;

uses(TestCase::class)->group('unit');

it('lists leads', function () {
    $config = new Configuration();

    $mock = $this->httpMock();
    $mock->append(
        new Response(200, [], json_encode([
            'data' => [
                [
                    'id' => 42,
                    'visible_to' => '7',
                ],
            ],
        ])),
    );

    $handlerStack = HandlerStack::create($mock);

    $apiInstance = new LeadsApi(
        new Client(['handler' => $handlerStack]),
        $config,
    );
    $result = $apiInstance->getLeads(
        10,
        0,
        null,
        null,
        null,
        null,
        null,
        null,
    );

    expect($mock->getLastRequest()->getUri()->getQuery())->toEqual('limit=10&start=0')
        ->and($result->getData())->toHaveLength(1)
        ->and($result->getData()[0]->getId())->toEqual(42)
        ->and($result->getData()[0]->getVisibleTo())->toEqual('7');
});

it('lists leads with raw data', function () {
    $config = new Configuration();

    $mock = $this->httpMock();
    $mock->append(
        new Response(200, [], json_encode([
            'data' => [
                [
                    'id' => 42,
                    'visible_to' => '7',
                    '6504f7b19e74a082034fe9b8662383ea6d7cc941' => 'custom'
                ],
            ],
        ])),
    );

    $handlerStack = HandlerStack::create($mock);

    $apiInstance = new LeadsApi(
        new Client(['handler' => $handlerStack]),
        $config,
    );
    $result = $apiInstance->getLeads(
        10,
        0,
    );

    $rawData = $result->getRawData();

    expect($rawData)->toBeArray()
        ->and($rawData[0])->toHaveProperty('id')
        ->and($rawData[0]->id)->toEqual(42)
        ->and($rawData[0])->toHaveProperty('6504f7b19e74a082034fe9b8662383ea6d7cc941')
        ->and($rawData[0]->{'6504f7b19e74a082034fe9b8662383ea6d7cc941'})->toEqual('custom');
});
