# Pipedrive\SubscriptionsApi

All URIs are relative to https://api.pipedrive.com/v1.

Method | HTTP request | Description
------------- | ------------- | -------------
[**addRecurringSubscription()**](SubscriptionsApi.md#addRecurringSubscription) | **POST** /subscriptions/recurring | Add a recurring subscription
[**addSubscriptionInstallment()**](SubscriptionsApi.md#addSubscriptionInstallment) | **POST** /subscriptions/installment | Add an installment subscription
[**cancelRecurringSubscription()**](SubscriptionsApi.md#cancelRecurringSubscription) | **PUT** /subscriptions/recurring/{id}/cancel | Cancel a recurring subscription
[**deleteSubscription()**](SubscriptionsApi.md#deleteSubscription) | **DELETE** /subscriptions/{id} | Delete a subscription
[**findSubscriptionByDeal()**](SubscriptionsApi.md#findSubscriptionByDeal) | **GET** /subscriptions/find/{dealId} | Find subscription by deal
[**getSubscription()**](SubscriptionsApi.md#getSubscription) | **GET** /subscriptions/{id} | Get details of a subscription
[**getSubscriptionPayments()**](SubscriptionsApi.md#getSubscriptionPayments) | **GET** /subscriptions/{id}/payments | Get all payments of a subscription
[**updateRecurringSubscription()**](SubscriptionsApi.md#updateRecurringSubscription) | **PUT** /subscriptions/recurring/{id} | Update a recurring subscription
[**updateSubscriptionInstallment()**](SubscriptionsApi.md#updateSubscriptionInstallment) | **PUT** /subscriptions/installment/{id} | Update an installment subscription


## `addRecurringSubscription()`

```php
addRecurringSubscription($subscription_recurring_create_request): \Pipedrive\Model\SubscriptionsIdResponse
```

Add a recurring subscription

Adds a new recurring subscription.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: api_key
$config = (new Pipedrive\Configuration())->setApiKey('api_token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = (new Pipedrive\Configuration())->setApiKeyPrefix('api_token', 'Bearer');

// Configure OAuth2 access token for authorization: oauth2
$config = (new Pipedrive\Configuration())->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Pipedrive\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$subscription_recurring_create_request = new \Pipedrive\Model\SubscriptionRecurringCreateRequest(); // \Pipedrive\Model\SubscriptionRecurringCreateRequest

try {
    $result = $apiInstance->addRecurringSubscription($subscription_recurring_create_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->addRecurringSubscription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **subscription_recurring_create_request** | [**\Pipedrive\Model\SubscriptionRecurringCreateRequest**](../Model/SubscriptionRecurringCreateRequest.md)|  | [optional]

### Return type

[**\Pipedrive\Model\SubscriptionsIdResponse**](../Model/SubscriptionsIdResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `addSubscriptionInstallment()`

```php
addSubscriptionInstallment($subscription_installment_create_request): \Pipedrive\Model\SubscriptionsIdResponse
```

Add an installment subscription

Adds a new installment subscription.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: api_key
$config = (new Pipedrive\Configuration())->setApiKey('api_token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = (new Pipedrive\Configuration())->setApiKeyPrefix('api_token', 'Bearer');

// Configure OAuth2 access token for authorization: oauth2
$config = (new Pipedrive\Configuration())->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Pipedrive\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$subscription_installment_create_request = new \Pipedrive\Model\SubscriptionInstallmentCreateRequest(); // \Pipedrive\Model\SubscriptionInstallmentCreateRequest

try {
    $result = $apiInstance->addSubscriptionInstallment($subscription_installment_create_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->addSubscriptionInstallment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **subscription_installment_create_request** | [**\Pipedrive\Model\SubscriptionInstallmentCreateRequest**](../Model/SubscriptionInstallmentCreateRequest.md)|  | [optional]

### Return type

[**\Pipedrive\Model\SubscriptionsIdResponse**](../Model/SubscriptionsIdResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `cancelRecurringSubscription()`

```php
cancelRecurringSubscription($id, $subscription_recurring_cancel_request): \Pipedrive\Model\SubscriptionsIdResponse
```

Cancel a recurring subscription

Cancels a recurring subscription.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: api_key
$config = (new Pipedrive\Configuration())->setApiKey('api_token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = (new Pipedrive\Configuration())->setApiKeyPrefix('api_token', 'Bearer');

// Configure OAuth2 access token for authorization: oauth2
$config = (new Pipedrive\Configuration())->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Pipedrive\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the subscription
$subscription_recurring_cancel_request = new \Pipedrive\Model\SubscriptionRecurringCancelRequest(); // \Pipedrive\Model\SubscriptionRecurringCancelRequest

try {
    $result = $apiInstance->cancelRecurringSubscription($id, $subscription_recurring_cancel_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->cancelRecurringSubscription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the subscription |
 **subscription_recurring_cancel_request** | [**\Pipedrive\Model\SubscriptionRecurringCancelRequest**](../Model/SubscriptionRecurringCancelRequest.md)|  | [optional]

### Return type

[**\Pipedrive\Model\SubscriptionsIdResponse**](../Model/SubscriptionsIdResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteSubscription()`

```php
deleteSubscription($id): \Pipedrive\Model\SubscriptionsIdResponse
```

Delete a subscription

Marks an installment or a recurring subscription as deleted.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: api_key
$config = (new Pipedrive\Configuration())->setApiKey('api_token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = (new Pipedrive\Configuration())->setApiKeyPrefix('api_token', 'Bearer');

// Configure OAuth2 access token for authorization: oauth2
$config = (new Pipedrive\Configuration())->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Pipedrive\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the subscription

try {
    $result = $apiInstance->deleteSubscription($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->deleteSubscription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the subscription |

### Return type

[**\Pipedrive\Model\SubscriptionsIdResponse**](../Model/SubscriptionsIdResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `findSubscriptionByDeal()`

```php
findSubscriptionByDeal($deal_id): \Pipedrive\Model\SubscriptionsIdResponse
```

Find subscription by deal

Returns details of an installment or a recurring subscription by the deal ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: api_key
$config = (new Pipedrive\Configuration())->setApiKey('api_token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = (new Pipedrive\Configuration())->setApiKeyPrefix('api_token', 'Bearer');

// Configure OAuth2 access token for authorization: oauth2
$config = (new Pipedrive\Configuration())->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Pipedrive\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$deal_id = 56; // int | The ID of the deal

try {
    $result = $apiInstance->findSubscriptionByDeal($deal_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->findSubscriptionByDeal: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **deal_id** | **int**| The ID of the deal |

### Return type

[**\Pipedrive\Model\SubscriptionsIdResponse**](../Model/SubscriptionsIdResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getSubscription()`

```php
getSubscription($id): \Pipedrive\Model\SubscriptionsIdResponse
```

Get details of a subscription

Returns details of an installment or a recurring subscription.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: api_key
$config = (new Pipedrive\Configuration())->setApiKey('api_token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = (new Pipedrive\Configuration())->setApiKeyPrefix('api_token', 'Bearer');

// Configure OAuth2 access token for authorization: oauth2
$config = (new Pipedrive\Configuration())->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Pipedrive\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the subscription

try {
    $result = $apiInstance->getSubscription($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->getSubscription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the subscription |

### Return type

[**\Pipedrive\Model\SubscriptionsIdResponse**](../Model/SubscriptionsIdResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getSubscriptionPayments()`

```php
getSubscriptionPayments($id): \Pipedrive\Model\PaymentsResponse
```

Get all payments of a subscription

Returns all payments of an installment or recurring subscription.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: api_key
$config = (new Pipedrive\Configuration())->setApiKey('api_token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = (new Pipedrive\Configuration())->setApiKeyPrefix('api_token', 'Bearer');

// Configure OAuth2 access token for authorization: oauth2
$config = (new Pipedrive\Configuration())->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Pipedrive\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the subscription

try {
    $result = $apiInstance->getSubscriptionPayments($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->getSubscriptionPayments: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the subscription |

### Return type

[**\Pipedrive\Model\PaymentsResponse**](../Model/PaymentsResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateRecurringSubscription()`

```php
updateRecurringSubscription($id, $subscription_recurring_update_request): \Pipedrive\Model\SubscriptionsIdResponse
```

Update a recurring subscription

Updates a recurring subscription.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: api_key
$config = (new Pipedrive\Configuration())->setApiKey('api_token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = (new Pipedrive\Configuration())->setApiKeyPrefix('api_token', 'Bearer');

// Configure OAuth2 access token for authorization: oauth2
$config = (new Pipedrive\Configuration())->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Pipedrive\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the subscription
$subscription_recurring_update_request = new \Pipedrive\Model\SubscriptionRecurringUpdateRequest(); // \Pipedrive\Model\SubscriptionRecurringUpdateRequest

try {
    $result = $apiInstance->updateRecurringSubscription($id, $subscription_recurring_update_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->updateRecurringSubscription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the subscription |
 **subscription_recurring_update_request** | [**\Pipedrive\Model\SubscriptionRecurringUpdateRequest**](../Model/SubscriptionRecurringUpdateRequest.md)|  | [optional]

### Return type

[**\Pipedrive\Model\SubscriptionsIdResponse**](../Model/SubscriptionsIdResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateSubscriptionInstallment()`

```php
updateSubscriptionInstallment($id, $subscription_installment_update_request): \Pipedrive\Model\SubscriptionsIdResponse
```

Update an installment subscription

Updates an installment subscription.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: api_key
$config = (new Pipedrive\Configuration())->setApiKey('api_token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = (new Pipedrive\Configuration())->setApiKeyPrefix('api_token', 'Bearer');

// Configure OAuth2 access token for authorization: oauth2
$config = (new Pipedrive\Configuration())->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Pipedrive\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the subscription
$subscription_installment_update_request = new \Pipedrive\Model\SubscriptionInstallmentUpdateRequest(); // \Pipedrive\Model\SubscriptionInstallmentUpdateRequest

try {
    $result = $apiInstance->updateSubscriptionInstallment($id, $subscription_installment_update_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->updateSubscriptionInstallment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the subscription |
 **subscription_installment_update_request** | [**\Pipedrive\Model\SubscriptionInstallmentUpdateRequest**](../Model/SubscriptionInstallmentUpdateRequest.md)|  | [optional]

### Return type

[**\Pipedrive\Model\SubscriptionsIdResponse**](../Model/SubscriptionsIdResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
