<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Pipedrive\versions\v1\Api\DealsApi;
use Pipedrive\versions\v1\Model\NewDealProduct;
use Pipedrive\versions\v1\Model\UpdateDealProduct;
use Pipedrive\versions\v1\Configuration;
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
                    '6504f7b19e743082034fe9b8661383ea6d7cc941' => 'custom'
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

it('attach a product to a deal', function () {
    $config = new Configuration();

    $mock = $this->httpMock();
    $mock->append(
        new Response(200, [], json_encode([
            'data' => [
                'id' => 777,
                'product_id' => 1,
                'quantity' => 1,
                'discount' => 1,
                'discount_type' => 'percentage',
                'duration' => 1,
                'tax' => 0,
                'tax_method' => 'inclusive',
                'enabled_flag' => true,
                'company_id' => 1,
                'deal_id' => 1,
                'sum' => 1,
                'currency' => 'USD',
                'add_time' => '2023-09-05 06:22:06',
                'last_edit' => '2023-09-05 06:22:06',
                'active_flag' => true,
                'name' => 'Paper Rocket'
            ],
        ])),
    );

    $new_deal_product = new NewDealProduct();

    $new_deal_product->setProductId(1);
    $new_deal_product->setItemPrice(1);
    $new_deal_product->setQuantity(1);

    $handlerStack = HandlerStack::create($mock);

    $client = new Client(['handler' => $handlerStack]);

    $apiInstance = new DealsApi(
        $client,
        $config,
    );
    $result = $apiInstance->addDealProduct(1, $new_deal_product);

    expect($mock->getLastRequest()->getUri())->toEqual('https://api.pipedrive.com/v1/deals/1/products')
        ->and($result->getData()->getId())->toBe(777);
});

it('update a product attached to a deal', function () {
    $config = new Configuration();

    $mock = $this->httpMock();
    $mock->append(
        new Response(200, [], json_encode([
            'data' => [
                'id' => 777,
                'product_id' => 1,
                'quantity' => 1,
                'discount' => 1,
                'product_id' => 1,
                'discount_type' => 'percentage',
                'duration' => 1,
                'tax' => 0,
                'tax_method' => 'inclusive',
                'enabled_flag' => true,
                'company_id' => 1,
                'deal_id' => 1,
                'sum' => 1,
                'currency' => 'USD',
                'add_time' => '2023-09-05 06:22:06',
                'last_edit' => '2023-09-05 06:22:06',
                'active_flag' => true,
                'name' => 'Paper Rocket'
            ],
        ])),
    );

    $update_deal_product = new UpdateDealProduct();

    $update_deal_product->setProductId(1);
    $update_deal_product->setItemPrice(100);
    $update_deal_product->setQuantity(1);

    $encoded_deal_product = rawurlencode(json_encode($update_deal_product, JSON_PRETTY_PRINT));

    $handlerStack = HandlerStack::create($mock);

    $client = new Client(['handler' => $handlerStack]);

    $apiInstance = new DealsApi(
        $client,
        $config,
    );
    $result = $apiInstance->updateDealProduct(1, 1, $update_deal_product);

    expect($mock->getLastRequest()->getUri())->toEqual("https://api.pipedrive.com/v1/deals/1/products/1")
        ->and($result->getData()->getId())->toBe(777);

    expect($mock->getLastRequest()->getBody()->getContents())->toEqual(json_encode($update_deal_product));
});


it('lists deals with raw data', function () {
    $config = new Configuration();

    $mock = $this->httpMock();
    $mock->append(
        new Response(200, [], json_encode([
            'data' => [
                [
                    'id' => 42,
                    '65d4f7b19e743082034fe9b866138uea6d7cc941' => 'custom'
                ],
            ],
        ])),
    );

    $handlerStack = HandlerStack::create($mock);

    $apiInstance = new DealsApi(
        new Client(['handler' => $handlerStack]),
        $config,
    );
    $result = $apiInstance->getDeals(42);

    $rawData = $result->getRawData();

    expect($rawData)->toBeArray()
        ->and($rawData[0])->toHaveProperty('id')
        ->and($rawData[0]->id)->toEqual(42)
        ->and($rawData[0])->toHaveProperty('65d4f7b19e743082034fe9b866138uea6d7cc941')
        ->and($rawData[0]->{'65d4f7b19e743082034fe9b866138uea6d7cc941'})->toEqual('custom');
});
