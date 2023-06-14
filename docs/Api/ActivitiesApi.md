# Pipedrive\ActivitiesApi

All URIs are relative to https://api.pipedrive.com/v1.

Method | HTTP request | Description
------------- | ------------- | -------------
[**addActivity()**](ActivitiesApi.md#addActivity) | **POST** /activities | Add an activity
[**deleteActivities()**](ActivitiesApi.md#deleteActivities) | **DELETE** /activities | Delete multiple activities in bulk
[**deleteActivity()**](ActivitiesApi.md#deleteActivity) | **DELETE** /activities/{id} | Delete an activity
[**getActivities()**](ActivitiesApi.md#getActivities) | **GET** /activities | Get all activities assigned to a particular user
[**getActivitiesCollection()**](ActivitiesApi.md#getActivitiesCollection) | **GET** /activities/collection | Get all activities (BETA)
[**getActivity()**](ActivitiesApi.md#getActivity) | **GET** /activities/{id} | Get details of an activity
[**updateActivity()**](ActivitiesApi.md#updateActivity) | **PUT** /activities/{id} | Update an activity


## `addActivity()`

```php
addActivity($activity_post_object): \Pipedrive\Model\AddActivityResponse200
```

Add an activity

Adds a new activity. Includes `more_activities_scheduled_in_context` property in response's `additional_data` which indicates whether there are more undone activities scheduled with the same deal, person or organization (depending on the supplied data). For more information, see the tutorial for <a href=\"https://pipedrive.readme.io/docs/adding-an-activity\" target=\"_blank\" rel=\"noopener noreferrer\">adding an activity</a>.

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


$apiInstance = new Pipedrive\Api\ActivitiesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$activity_post_object = new \Pipedrive\Model\ActivityPostObject(); // \Pipedrive\Model\ActivityPostObject

try {
    $result = $apiInstance->addActivity($activity_post_object);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActivitiesApi->addActivity: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **activity_post_object** | [**\Pipedrive\Model\ActivityPostObject**](../Model/ActivityPostObject.md)|  | [optional]

### Return type

[**\Pipedrive\Model\AddActivityResponse200**](../Model/AddActivityResponse200.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteActivities()`

```php
deleteActivities($ids): \Pipedrive\Model\DeleteActivitiesResponse200
```

Delete multiple activities in bulk

Marks multiple activities as deleted. After 30 days, the activities will be permanently deleted.

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


$apiInstance = new Pipedrive\Api\ActivitiesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ids = 'ids_example'; // string | The comma-separated IDs of activities that will be deleted

try {
    $result = $apiInstance->deleteActivities($ids);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActivitiesApi->deleteActivities: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ids** | **string**| The comma-separated IDs of activities that will be deleted |

### Return type

[**\Pipedrive\Model\DeleteActivitiesResponse200**](../Model/DeleteActivitiesResponse200.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteActivity()`

```php
deleteActivity($id): \Pipedrive\Model\DeleteActivityResponse200
```

Delete an activity

Marks an activity as deleted. After 30 days, the activity will be permanently deleted.

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


$apiInstance = new Pipedrive\Api\ActivitiesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the activity

try {
    $result = $apiInstance->deleteActivity($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActivitiesApi->deleteActivity: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the activity |

### Return type

[**\Pipedrive\Model\DeleteActivityResponse200**](../Model/DeleteActivityResponse200.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getActivities()`

```php
getActivities($user_id, $filter_id, $type, $limit, $start, $start_date, $end_date, $done): \Pipedrive\Model\GetActivitiesResponse200
```

Get all activities assigned to a particular user

Returns all activities assigned to a particular user.

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


$apiInstance = new Pipedrive\Api\ActivitiesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = 56; // int | The ID of the user whose activities will be fetched. If omitted, the user associated with the API token will be used. If 0, activities for all company users will be fetched based on the permission sets.
$filter_id = 56; // int | The ID of the filter to use (will narrow down results if used together with `user_id` parameter)
$type = 'type_example'; // string | The type of the activity, can be one type or multiple types separated by a comma. This is in correlation with the `key_string` parameter of ActivityTypes.
$limit = 100; // int | For pagination, the limit of entries to be returned. If not provided, 100 items will be returned.
$start = 0; // int | For pagination, the position that represents the first result for the page
$start_date = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | Use the activity due date where you wish to begin fetching activities from. Insert due date in YYYY-MM-DD format.
$end_date = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | Use the activity due date where you wish to stop fetching activities from. Insert due date in YYYY-MM-DD format.
$done = new \Pipedrive\Model\\Pipedrive\Model\NumberBoolean(); // \Pipedrive\Model\NumberBoolean | Whether the activity is done or not. 0 = Not done, 1 = Done. If omitted returns both done and not done activities.

try {
    $result = $apiInstance->getActivities($user_id, $filter_id, $type, $limit, $start, $start_date, $end_date, $done);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActivitiesApi->getActivities: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **int**| The ID of the user whose activities will be fetched. If omitted, the user associated with the API token will be used. If 0, activities for all company users will be fetched based on the permission sets. | [optional]
 **filter_id** | **int**| The ID of the filter to use (will narrow down results if used together with &#x60;user_id&#x60; parameter) | [optional]
 **type** | **string**| The type of the activity, can be one type or multiple types separated by a comma. This is in correlation with the &#x60;key_string&#x60; parameter of ActivityTypes. | [optional]
 **limit** | **int**| For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. | [optional]
 **start** | **int**| For pagination, the position that represents the first result for the page | [optional]
 **start_date** | **\DateTime**| Use the activity due date where you wish to begin fetching activities from. Insert due date in YYYY-MM-DD format. | [optional]
 **end_date** | **\DateTime**| Use the activity due date where you wish to stop fetching activities from. Insert due date in YYYY-MM-DD format. | [optional]
 **done** | [**\Pipedrive\Model\NumberBoolean**](../Model/.md)| Whether the activity is done or not. 0 &#x3D; Not done, 1 &#x3D; Done. If omitted returns both done and not done activities. | [optional]

### Return type

[**\Pipedrive\Model\GetActivitiesResponse200**](../Model/GetActivitiesResponse200.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getActivitiesCollection()`

```php
getActivitiesCollection($cursor, $limit, $since, $until, $user_id, $done, $type): \Pipedrive\Model\GetActivitiesCollectionResponse200
```

Get all activities (BETA)

Returns all activities. This is a cursor-paginated endpoint that is currently in BETA. For more information, please refer to our documentation on <a href=\"https://pipedrive.readme.io/docs/core-api-concepts-pagination\" target=\"_blank\" rel=\"noopener noreferrer\">pagination</a>. Please note that only global admins (those with global permissions) can access these endpoints. Users with regular permissions will receive a 403 response. Read more about global permissions <a href=\"https://support.pipedrive.com/en/article/global-user-management\" target=\"_blank\" rel=\"noopener noreferrer\">here</a>.

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


$apiInstance = new Pipedrive\Api\ActivitiesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cursor = 'cursor_example'; // string | For pagination, the marker (an opaque string value) representing the first item on the next page
$limit = 100; // int | For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.
$since = 'since_example'; // string | The time boundary that points to the start of the range of data. Datetime in ISO 8601 format. E.g. 2022-11-01 08:55:59. Operates on the `update_time` field.
$until = 'until_example'; // string | The time boundary that points to the end of the range of data. Datetime in ISO 8601 format. E.g. 2022-11-01 08:55:59. Operates on the `update_time` field.
$user_id = 56; // int | The ID of the user whose activities will be fetched. If omitted, all activities are returned.
$done = new \Pipedrive\Model\\Pipedrive\Model\NumberBoolean(); // \Pipedrive\Model\NumberBoolean | Whether the activity is done or not. 0 = Not done, 1 = Done. If omitted, returns both done and not done activities.
$type = 'type_example'; // string | The type of the activity, can be one type or multiple types separated by a comma. This is in correlation with the `key_string` parameter of ActivityTypes.

try {
    $result = $apiInstance->getActivitiesCollection($cursor, $limit, $since, $until, $user_id, $done, $type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActivitiesApi->getActivitiesCollection: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cursor** | **string**| For pagination, the marker (an opaque string value) representing the first item on the next page | [optional]
 **limit** | **int**| For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed. | [optional]
 **since** | **string**| The time boundary that points to the start of the range of data. Datetime in ISO 8601 format. E.g. 2022-11-01 08:55:59. Operates on the &#x60;update_time&#x60; field. | [optional]
 **until** | **string**| The time boundary that points to the end of the range of data. Datetime in ISO 8601 format. E.g. 2022-11-01 08:55:59. Operates on the &#x60;update_time&#x60; field. | [optional]
 **user_id** | **int**| The ID of the user whose activities will be fetched. If omitted, all activities are returned. | [optional]
 **done** | [**\Pipedrive\Model\NumberBoolean**](../Model/.md)| Whether the activity is done or not. 0 &#x3D; Not done, 1 &#x3D; Done. If omitted, returns both done and not done activities. | [optional]
 **type** | **string**| The type of the activity, can be one type or multiple types separated by a comma. This is in correlation with the &#x60;key_string&#x60; parameter of ActivityTypes. | [optional]

### Return type

[**\Pipedrive\Model\GetActivitiesCollectionResponse200**](../Model/GetActivitiesCollectionResponse200.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getActivity()`

```php
getActivity($id): \Pipedrive\Model\GetActivityResponse200
```

Get details of an activity

Returns the details of a specific activity.

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


$apiInstance = new Pipedrive\Api\ActivitiesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the activity

try {
    $result = $apiInstance->getActivity($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActivitiesApi->getActivity: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the activity |

### Return type

[**\Pipedrive\Model\GetActivityResponse200**](../Model/GetActivityResponse200.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateActivity()`

```php
updateActivity($id, $activity_put_object): \Pipedrive\Model\UpdateActivityResponse200
```

Update an activity

Updates an activity. Includes `more_activities_scheduled_in_context` property in response's `additional_data` which indicates whether there are more undone activities scheduled with the same deal, person or organization (depending on the supplied data).

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


$apiInstance = new Pipedrive\Api\ActivitiesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the activity
$activity_put_object = new \Pipedrive\Model\ActivityPutObject(); // \Pipedrive\Model\ActivityPutObject

try {
    $result = $apiInstance->updateActivity($id, $activity_put_object);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActivitiesApi->updateActivity: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the activity |
 **activity_put_object** | [**\Pipedrive\Model\ActivityPutObject**](../Model/ActivityPutObject.md)|  | [optional]

### Return type

[**\Pipedrive\Model\UpdateActivityResponse200**](../Model/UpdateActivityResponse200.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
