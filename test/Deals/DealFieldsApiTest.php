<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Pipedrive\Api\DealFieldsApi;
use Pipedrive\Api\DealsApi;
use Pipedrive\Configuration;
use Pipedrive\Tests\Unit\TestCase;

uses(TestCase::class)->group('unit');

it('lists deal fields', function () {
    $config = new Configuration();

    $mock = $this->httpMock();
    $mock->append(
        new Response(200, [], json_encode([
            'data' => [
                [
                    'id' => 0,
                    'field_type' => 'int',
                    'key' => 'id',
                    'name' => 'ID',
                    'order_nr' => 0
                ],
                [
                    'id' => 1,
                    'field_type' => 'varchar',
                    'key' => 'title',
                    'name' => 'Title',
                    'order_nr' => 1
                ],
                [
                    'id' => 2,
                    'field_type' => 'status',
                    'key' => 'status',
                    'name' => 'Status',
                    'order_nr' => 2
                ],
                [
                    'id' => 3,
                    'field_type' => 'stage',
                    'key' => 'stage_id',
                    'name' => 'Stage',
                    'order_nr' => 3
                ],
                [
                    'id' => 4,
                    'field_type' => 'varchar_options',
                    'key' => 'lost_reason',
                    'name' => 'Lost Reason',
                    'order_nr' => 4
                ],
            ],
        ])),
    );

    $handlerStack = HandlerStack::create($mock);

    $apiInstance = new DealFieldsApi(
        new Client(['handler' => $handlerStack]),
        $config,
    );
    $result = $apiInstance->getDealFields(0, 10);

    expect($mock->getLastRequest()->getUri()->getQuery())->toEqual('start=0&limit=10')
    ->and($result->getData())->toHaveLength(5);
});