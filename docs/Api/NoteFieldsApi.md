# Pipedrive\NoteFieldsApi

All URIs are relative to https://api.pipedrive.com/v1.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getNoteFields()**](NoteFieldsApi.md#getNoteFields) | **GET** /noteFields | Get all note fields


## `getNoteFields()`

```php
getNoteFields(): \Pipedrive\Model\NoteFieldsResponse
```

Get all note fields

Returns data about all note fields.

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


$apiInstance = new Pipedrive\Api\NoteFieldsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getNoteFields();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NoteFieldsApi->getNoteFields: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Pipedrive\Model\NoteFieldsResponse**](../Model/NoteFieldsResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
