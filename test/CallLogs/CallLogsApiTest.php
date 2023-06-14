<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Pipedrive\Api\CallLogsApi;
use Pipedrive\Configuration;
use Pipedrive\Tests\Unit\TestCase;

uses(TestCase::class)->group('unit');

test('get call log by id', function () {
    $config = new Configuration();

    $callLogId = 'logId';
    $phoneNumber = '+37255123456';
    $mock = $this->httpMock();
    $mock->append(
        new Response(200, [], json_encode([
            'success' => true,
            'data' => [
                'id' => $callLogId,
                'to_phone_number' => $phoneNumber,
            ],
        ])),
    );

    $handlerStack = HandlerStack::create($mock);

    $apiInstance = new CallLogsApi(
        new Client(['handler' => $handlerStack]),
        $config
    );

    $result = $apiInstance->getCallLog($callLogId);

    expect($result->getSuccess())->toBe(true);
    expect($result->getData()->getId())->toBe($callLogId);
    expect($result->getData()->getToPhoneNumber())->toBe($phoneNumber);
});

test('get all call logs assigned to a user', function () {
    $config = new Configuration();

    $mock = $this->httpMock();
    $mock->append(
        new Response(200, [], json_encode([
            'success' => true,
            'data' => [
                [
                    'id' => 'first',
                ],
                [
                    'id' => 'second',
                ],

            ],
            'additional_data' => [
                'pagination' => [
                    'start' => 0,
                    'limit' => 5,
                    'more_items_in_collection' => false,
                ]
            ]
        ])),
    );

    $handlerStack = HandlerStack::create($mock);

    $apiInstance = new CallLogsApi(
        new Client(['handler' => $handlerStack]),
        $config
    );

    $result = $apiInstance->getUserCallLogs();

    expect($result->getSuccess())->toBe(true);
    expect($result->getData()[0]->getId())->toBe('first');
    expect($result->getData()[1]->getId())->toBe('second');
    expect($result->getAdditionalData()->getPagination()->getStart())->toBe(0);
});

test('add a call log', function () {
    $config = new Configuration();

    $outcome = 'connected';
    $toPhoneNumber = '+37255345678';
    $mock = $this->httpMock();
    $mock->append(
        new Response(200, [], json_encode([
            'success' => true,
            'data' => [
                'outcome' => $outcome,
                'to_phone_number' => $toPhoneNumber,
            ],
        ])),
    );

    $handlerStack = HandlerStack::create($mock);

    $apiInstance = new CallLogsApi(
        new Client(['handler' => $handlerStack]),
        $config
    );

    $result = $apiInstance->addCallLog();

    expect($result->getSuccess())->toBe(true);
    expect($result->getData()->getOutcome())->toBe($outcome);
    expect($result->getData()->getToPhoneNumber())->toBe($toPhoneNumber);
});

test('delete a call log', function () {
    $config = new Configuration();

    $mock = $this->httpMock();
    $mock->append(
        new Response(200, [], json_encode([
            'success' => true,
        ])),
    );

    $handlerStack = HandlerStack::create($mock);

    $apiInstance = new CallLogsApi(
        new Client(['handler' => $handlerStack]),
        $config
    );

    $result = $apiInstance->deleteCallLog('mockId');

    expect(json_decode($result))->toMatchObject(['success' => true]);
});