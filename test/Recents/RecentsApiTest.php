<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Pipedrive\Api\RecentsApi;
use Pipedrive\Configuration;
use Pipedrive\Tests\Unit\TestCase;

uses(TestCase::class)->group('unit');

it('lists recents', function () {
    $config = new Configuration();

    $mock = $this->httpMock();
    $mock->append(
        new Response(200, [], json_encode([
            'data' => [
                [
                    'id' => 1,
                    'item' => 'activity',
                    'data' => [
                        'id' => 1,
                        'attendees' => [[ 'name' => 'First' ]]
                    ]
                ],
                [
                    'id' => 2,
                    'item' => 'deal',
                    'data' => [
                        'id' => 2,
                        'attendees' => [[ 'name' => 'Second' ]]
                    ]
                ],
            ],
        ])),
    );

    $handlerStack = HandlerStack::create($mock);

    $apiInstance = new RecentsApi(
        new Client(['handler' => $handlerStack]),
        $config,
    );
    $result = $apiInstance->getRecents('2023-06-12 12:13:14');

    expect($mock->getLastRequest()->getUri())->toEqual('https://api.pipedrive.com/v1/recents?since_timestamp=2023-06-12%2012%3A13%3A14&start=0')
        ->and($result->getData()[0]->getId())->toEqual(1)
        ->and($result->getData()[0]->getItem())->toEqual('activity')
        ->and($result->getData()[0]->getData())->toHaveKey('id')
        ->and($result->getData()[0]->getData()['id'])->toEqual(1)
        ->and($result->getData()[0]->getData()['attendees'])->toHaveLength(1);
});
