# Pipedrive\BillingApi

All URIs are relative to https://api.pipedrive.com/v1.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getCompanyAddons()**](BillingApi.md#getCompanyAddons) | **GET** /billing/subscriptions/addons | Get all add-ons for a single company


## `getCompanyAddons()`

```php
getCompanyAddons(): \Pipedrive\Model\SubscriptionAddonsResponse
```

Get all add-ons for a single company

Returns the add-ons for a single company.

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


$apiInstance = new Pipedrive\Api\BillingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getCompanyAddons();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BillingApi->getCompanyAddons: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Pipedrive\Model\SubscriptionAddonsResponse**](../Model/SubscriptionAddonsResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
