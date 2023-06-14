# Pipedrive\LeadSourcesApi

All URIs are relative to https://api.pipedrive.com/v1.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getLeadSources()**](LeadSourcesApi.md#getLeadSources) | **GET** /leadSources | Get all lead sources


## `getLeadSources()`

```php
getLeadSources(): \Pipedrive\Model\GetLeadSourcesResponse200
```

Get all lead sources

Returns all lead sources. Please note that the list of lead sources is fixed, it cannot be modified. All leads created through the Pipedrive API will have a lead source `API` assigned.

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


$apiInstance = new Pipedrive\Api\LeadSourcesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getLeadSources();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LeadSourcesApi->getLeadSources: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Pipedrive\Model\GetLeadSourcesResponse200**](../Model/GetLeadSourcesResponse200.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
