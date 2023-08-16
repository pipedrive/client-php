<?php

namespace Pipedrive\Tests\Unit;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function httpMock(): MockHandler
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], null),
            new Response(202, ['Content-Length' => 0]),
            new RequestException('Error Communicating with Server', new Request('GET', '/mock'))
        ]);

        $mock->reset();

        return $mock;
    }

}
