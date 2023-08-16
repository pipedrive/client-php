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
