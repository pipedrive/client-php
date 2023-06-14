# Pipedrive\StagesApi

All URIs are relative to https://api.pipedrive.com/v1.

Method | HTTP request | Description
------------- | ------------- | -------------
[**addStage()**](StagesApi.md#addStage) | **POST** /stages | Add a new stage
[**deleteStage()**](StagesApi.md#deleteStage) | **DELETE** /stages/{id} | Delete a stage
[**deleteStages()**](StagesApi.md#deleteStages) | **DELETE** /stages | Delete multiple stages in bulk
[**getStage()**](StagesApi.md#getStage) | **GET** /stages/{id} | Get one stage
[**getStageDeals()**](StagesApi.md#getStageDeals) | **GET** /stages/{id}/deals | Get deals in a stage
[**getStages()**](StagesApi.md#getStages) | **GET** /stages | Get all stages
[**updateStage()**](StagesApi.md#updateStage) | **PUT** /stages/{id} | Update stage details


## `addStage()`

```php
addStage($stage): \Pipedrive\Model\GetAddUpdateStage
```

Add a new stage

Adds a new stage, returns the ID upon success.

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


$apiInstance = new Pipedrive\Api\StagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$stage = new \Pipedrive\Model\Stage(); // \Pipedrive\Model\Stage

try {
    $result = $apiInstance->addStage($stage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StagesApi->addStage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **stage** | [**\Pipedrive\Model\Stage**](../Model/Stage.md)|  | [optional]

### Return type

[**\Pipedrive\Model\GetAddUpdateStage**](../Model/GetAddUpdateStage.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteStage()`

```php
deleteStage($id): \Pipedrive\Model\DeleteStageResponse200
```

Delete a stage

Marks a stage as deleted.

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


$apiInstance = new Pipedrive\Api\StagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the stage

try {
    $result = $apiInstance->deleteStage($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StagesApi->deleteStage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the stage |

### Return type

[**\Pipedrive\Model\DeleteStageResponse200**](../Model/DeleteStageResponse200.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteStages()`

```php
deleteStages($ids): \Pipedrive\Model\DeleteStagesResponse200
```

Delete multiple stages in bulk

Marks multiple stages as deleted.

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


$apiInstance = new Pipedrive\Api\StagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ids = 'ids_example'; // string | The comma-separated stage IDs to delete

try {
    $result = $apiInstance->deleteStages($ids);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StagesApi->deleteStages: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ids** | **string**| The comma-separated stage IDs to delete |

### Return type

[**\Pipedrive\Model\DeleteStagesResponse200**](../Model/DeleteStagesResponse200.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getStage()`

```php
getStage($id, $everyone): \Pipedrive\Model\GetOneStage
```

Get one stage

Returns data about a specific stage.

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


$apiInstance = new Pipedrive\Api\StagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the stage
$everyone = new \Pipedrive\Model\\Pipedrive\Model\NumberBoolean(); // \Pipedrive\Model\NumberBoolean | If `everyone=1` is provided, deals summary will return deals owned by every user

try {
    $result = $apiInstance->getStage($id, $everyone);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StagesApi->getStage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the stage |
 **everyone** | [**\Pipedrive\Model\NumberBoolean**](../Model/.md)| If &#x60;everyone&#x3D;1&#x60; is provided, deals summary will return deals owned by every user | [optional]

### Return type

[**\Pipedrive\Model\GetOneStage**](../Model/GetOneStage.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getStageDeals()`

```php
getStageDeals($id, $filter_id, $user_id, $everyone, $start, $limit): \Pipedrive\Model\GetStageDeals
```

Get deals in a stage

Lists deals in a specific stage.

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


$apiInstance = new Pipedrive\Api\StagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the stage
$filter_id = 56; // int | If supplied, only deals matching the given filter will be returned
$user_id = 56; // int | If supplied, `filter_id` will not be considered and only deals owned by the given user will be returned. If omitted, deals owned by the authorized user will be returned.
$everyone = new \Pipedrive\Model\\Pipedrive\Model\NumberBoolean(); // \Pipedrive\Model\NumberBoolean | If supplied, `filter_id` and `user_id` will not be considered – instead, deals owned by everyone will be returned
$start = 0; // int | Pagination start
$limit = 56; // int | Items shown per page

try {
    $result = $apiInstance->getStageDeals($id, $filter_id, $user_id, $everyone, $start, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StagesApi->getStageDeals: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the stage |
 **filter_id** | **int**| If supplied, only deals matching the given filter will be returned | [optional]
 **user_id** | **int**| If supplied, &#x60;filter_id&#x60; will not be considered and only deals owned by the given user will be returned. If omitted, deals owned by the authorized user will be returned. | [optional]
 **everyone** | [**\Pipedrive\Model\NumberBoolean**](../Model/.md)| If supplied, &#x60;filter_id&#x60; and &#x60;user_id&#x60; will not be considered – instead, deals owned by everyone will be returned | [optional]
 **start** | **int**| Pagination start | [optional] [default to 0]
 **limit** | **int**| Items shown per page | [optional]

### Return type

[**\Pipedrive\Model\GetStageDeals**](../Model/GetStageDeals.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getStages()`

```php
getStages($pipeline_id, $start, $limit): \Pipedrive\Model\GetStages
```

Get all stages

Returns data about all stages.

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


$apiInstance = new Pipedrive\Api\StagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$pipeline_id = 56; // int | The ID of the pipeline to fetch stages for. If omitted, stages for all pipelines will be fetched.
$start = 0; // int | Pagination start
$limit = 56; // int | Items shown per page

try {
    $result = $apiInstance->getStages($pipeline_id, $start, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StagesApi->getStages: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **pipeline_id** | **int**| The ID of the pipeline to fetch stages for. If omitted, stages for all pipelines will be fetched. | [optional]
 **start** | **int**| Pagination start | [optional] [default to 0]
 **limit** | **int**| Items shown per page | [optional]

### Return type

[**\Pipedrive\Model\GetStages**](../Model/GetStages.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateStage()`

```php
updateStage($id, $update_stage_request): \Pipedrive\Model\GetAddUpdateStage
```

Update stage details

Updates the properties of a stage.

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


$apiInstance = new Pipedrive\Api\StagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the stage
$update_stage_request = new \Pipedrive\Model\UpdateStageRequest(); // \Pipedrive\Model\UpdateStageRequest

try {
    $result = $apiInstance->updateStage($id, $update_stage_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StagesApi->updateStage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the stage |
 **update_stage_request** | [**\Pipedrive\Model\UpdateStageRequest**](../Model/UpdateStageRequest.md)|  | [optional]

### Return type

[**\Pipedrive\Model\GetAddUpdateStage**](../Model/GetAddUpdateStage.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
