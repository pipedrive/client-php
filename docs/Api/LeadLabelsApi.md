# Pipedrive\LeadLabelsApi

All URIs are relative to https://api.pipedrive.com/v1.

Method | HTTP request | Description
------------- | ------------- | -------------
[**addLeadLabel()**](LeadLabelsApi.md#addLeadLabel) | **POST** /leadLabels | Add a lead label
[**deleteLeadLabel()**](LeadLabelsApi.md#deleteLeadLabel) | **DELETE** /leadLabels/{id} | Delete a lead label
[**getLeadLabels()**](LeadLabelsApi.md#getLeadLabels) | **GET** /leadLabels | Get all lead labels
[**updateLeadLabel()**](LeadLabelsApi.md#updateLeadLabel) | **PATCH** /leadLabels/{id} | Update a lead label


## `addLeadLabel()`

```php
addLeadLabel($add_lead_label_request): \Pipedrive\Model\UpsertLeadLabelResponse
```

Add a lead label

Creates a lead label.

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


$apiInstance = new Pipedrive\Api\LeadLabelsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$add_lead_label_request = new \Pipedrive\Model\AddLeadLabelRequest(); // \Pipedrive\Model\AddLeadLabelRequest

try {
    $result = $apiInstance->addLeadLabel($add_lead_label_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LeadLabelsApi->addLeadLabel: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **add_lead_label_request** | [**\Pipedrive\Model\AddLeadLabelRequest**](../Model/AddLeadLabelRequest.md)|  | [optional]

### Return type

[**\Pipedrive\Model\UpsertLeadLabelResponse**](../Model/UpsertLeadLabelResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteLeadLabel()`

```php
deleteLeadLabel($id): \Pipedrive\Model\DeleteLeadIdResponse
```

Delete a lead label

Deletes a specific lead label.

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


$apiInstance = new Pipedrive\Api\LeadLabelsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | The ID of the lead label

try {
    $result = $apiInstance->deleteLeadLabel($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LeadLabelsApi->deleteLeadLabel: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the lead label |

### Return type

[**\Pipedrive\Model\DeleteLeadIdResponse**](../Model/DeleteLeadIdResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLeadLabels()`

```php
getLeadLabels(): \Pipedrive\Model\GetLeadLabelsResponse
```

Get all lead labels

Returns details of all lead labels. This endpoint does not support pagination and all labels are always returned.

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


$apiInstance = new Pipedrive\Api\LeadLabelsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getLeadLabels();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LeadLabelsApi->getLeadLabels: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Pipedrive\Model\GetLeadLabelsResponse**](../Model/GetLeadLabelsResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateLeadLabel()`

```php
updateLeadLabel($id, $update_lead_label_request): \Pipedrive\Model\UpsertLeadLabelResponse
```

Update a lead label

Updates one or more properties of a lead label. Only properties included in the request will be updated.

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


$apiInstance = new Pipedrive\Api\LeadLabelsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | The ID of the lead label
$update_lead_label_request = new \Pipedrive\Model\UpdateLeadLabelRequest(); // \Pipedrive\Model\UpdateLeadLabelRequest

try {
    $result = $apiInstance->updateLeadLabel($id, $update_lead_label_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LeadLabelsApi->updateLeadLabel: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the lead label |
 **update_lead_label_request** | [**\Pipedrive\Model\UpdateLeadLabelRequest**](../Model/UpdateLeadLabelRequest.md)|  | [optional]

### Return type

[**\Pipedrive\Model\UpsertLeadLabelResponse**](../Model/UpsertLeadLabelResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
