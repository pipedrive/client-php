<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Pipedrive\Api\MailboxApi;
use Pipedrive\Configuration;
use Pipedrive\Tests\Unit\TestCase;

uses(TestCase::class)->group('unit');

test('get mail threads', function () {
    $config = new Configuration();

    $mock = $this->httpMock();
    $mock->append(
        new Response(200, [], json_encode([
            'data' => [
                ['id' => 42, 'archived_flag' => 0]
            ],
        ])),
    );

    $handlerStack = HandlerStack::create($mock);

    $apiInstance = new MailboxApi(
        new Client(['handler' => $handlerStack]),
        $config
    );

    $result = $apiInstance->getMailThreads('home')->getData();

    expect($mock->getLastRequest()->getUri())->toEqual('https://api.pipedrive.com/v1/mailbox/mailThreads?folder=home&start=0')
        ->and($result)->toHaveLength(1)
        ->and($result[0]->getId())->toBe(42)
        ->and($result[0]->getArchivedFlag())->toBe(0);
});

test('put mail threads', function () {
    $config = new Configuration();

    $mock = $this->httpMock();
    $mock->append(
        new Response(200, [], json_encode([
            'data' =>[
                'id' => 42,
                'archived_flag' => 1
            ],
        ])),
    );

    $handlerStack = HandlerStack::create($mock);

    $apiInstance = new MailboxApi(
        new Client(['handler' => $handlerStack]),
        $config
    );

    $result = $apiInstance->updateMailThreadDetails(42, ['archived_flag' => '1'])->getData();

    expect($mock->getLastRequest()->getUri())->toEqual('https://api.pipedrive.com/v1/mailbox/mailThreads/42')
        ->and($result->getArchivedFlag())->toBe(1);
});