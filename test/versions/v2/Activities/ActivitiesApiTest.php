<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Pipedrive\versions\v2\Api\ActivitiesApi;
use Pipedrive\versions\v2\Configuration;
use Pipedrive\Tests\Unit\TestCase;
use Pipedrive\versions\v2\Model\ActivityRequestBody;

uses(TestCase::class)->group('unit');

it('lists activities', function () {
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

    $apiInstance = new ActivitiesApi(
        new Client(['handler' => $handlerStack]),
        $config,
    );
    $result = $apiInstance->getActivities(1, '1,2,3', 1);

    expect($mock->getLastRequest()->getUri()->getQuery())->toEqual('filter_id=1&ids=1%2C2%2C3&owner_id=1&sort_by=id&sort_direction=asc')
        ->and($result->getData())->toHaveLength(1);

    expect($result->getRawData()[0]->{$customFieldKey})->toEqual('custom');
});

it('fetches one activity', function () {
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

    $apiInstance = new ActivitiesApi(
        $client,
        $config,
    );
    $result = $apiInstance->getActivity(1);

    expect($mock->getLastRequest()->getUri())->toEqual('https://api.pipedrive.com/api/v2/activities/1')
        ->and($result->getData()->getId())->toBe(1);
});

it('creates an activity', function () {
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

    $apiInstance = new ActivitiesApi(
        $client,
        $config,
    );
    $result = $apiInstance->addActivity(new ActivityRequestBody([
        'subject' => 'Test Activity',
    ]));

    expect($mock->getLastRequest()->getUri())->toEqual('https://api.pipedrive.com/api/v2/activities')
        ->and($result->getData()->getId())->toBe(1);

    expect($mock->getLastRequest()->getBody()->getContents())->toEqual('{"subject":"Test Activity"}');
});

it('updates an activity', function () {
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

    $apiInstance = new ActivitiesApi(
        $client,
        $config,
    );

    $updatedActivityBody = [
        'subject' => 'Updated activity title',
        'custom_fields' => [
            '6504f7b19e743082034fe9b8661383ea6d7cc941' => 'custom'
        ]
    ];

    $result = $apiInstance->updateActivity(1, $updatedActivityBody);

    expect($mock->getLastRequest()->getUri())->toEqual('https://api.pipedrive.com/api/v2/activities/1')
        ->and($result->getData()->getId())->toBe(1);

    expect($mock->getLastRequest()->getBody()->getContents())->toEqual('{"subject":"Updated activity title","custom_fields":{"6504f7b19e743082034fe9b8661383ea6d7cc941":"custom"}}');
});