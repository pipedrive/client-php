# Pipedrive\PersonsApi

All URIs are relative to https://api.pipedrive.com/v1.

Method | HTTP request | Description
------------- | ------------- | -------------
[**addPerson()**](PersonsApi.md#addPerson) | **POST** /persons | Add a person
[**addPersonFollower()**](PersonsApi.md#addPersonFollower) | **POST** /persons/{id}/followers | Add a follower to a person
[**addPersonPicture()**](PersonsApi.md#addPersonPicture) | **POST** /persons/{id}/picture | Add person picture
[**deletePerson()**](PersonsApi.md#deletePerson) | **DELETE** /persons/{id} | Delete a person
[**deletePersonFollower()**](PersonsApi.md#deletePersonFollower) | **DELETE** /persons/{id}/followers/{follower_id} | Delete a follower from a person
[**deletePersonPicture()**](PersonsApi.md#deletePersonPicture) | **DELETE** /persons/{id}/picture | Delete person picture
[**deletePersons()**](PersonsApi.md#deletePersons) | **DELETE** /persons | Delete multiple persons in bulk
[**getPerson()**](PersonsApi.md#getPerson) | **GET** /persons/{id} | Get details of a person
[**getPersonActivities()**](PersonsApi.md#getPersonActivities) | **GET** /persons/{id}/activities | List activities associated with a person
[**getPersonDeals()**](PersonsApi.md#getPersonDeals) | **GET** /persons/{id}/deals | List deals associated with a person
[**getPersonFiles()**](PersonsApi.md#getPersonFiles) | **GET** /persons/{id}/files | List files attached to a person
[**getPersonFollowers()**](PersonsApi.md#getPersonFollowers) | **GET** /persons/{id}/followers | List followers of a person
[**getPersonMailMessages()**](PersonsApi.md#getPersonMailMessages) | **GET** /persons/{id}/mailMessages | List mail messages associated with a person
[**getPersonProducts()**](PersonsApi.md#getPersonProducts) | **GET** /persons/{id}/products | List products associated with a person
[**getPersonUpdates()**](PersonsApi.md#getPersonUpdates) | **GET** /persons/{id}/flow | List updates about a person
[**getPersonUsers()**](PersonsApi.md#getPersonUsers) | **GET** /persons/{id}/permittedUsers | List permitted users
[**getPersons()**](PersonsApi.md#getPersons) | **GET** /persons | Get all persons
[**getPersonsCollection()**](PersonsApi.md#getPersonsCollection) | **GET** /persons/collection | Get all persons (BETA)
[**mergePersons()**](PersonsApi.md#mergePersons) | **PUT** /persons/{id}/merge | Merge two persons
[**searchPersons()**](PersonsApi.md#searchPersons) | **GET** /persons/search | Search persons
[**updatePerson()**](PersonsApi.md#updatePerson) | **PUT** /persons/{id} | Update a person


## `addPerson()`

```php
addPerson($new_person): \Pipedrive\Model\AddPersonResponse
```

Add a person

Adds a new person. Note that you can supply additional custom fields along with the request that are not described here. These custom fields are different for each Pipedrive account and can be recognized by long hashes as keys. To determine which custom fields exists, fetch the personFields and look for `key` values.<br>If a company uses the [Campaigns product](https://pipedrive.readme.io/docs/campaigns-in-pipedrive-api), then this endpoint will also accept and return the `data.marketing_status` field.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$new_person = new \Pipedrive\Model\NewPerson(); // \Pipedrive\Model\NewPerson

try {
    $result = $apiInstance->addPerson($new_person);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->addPerson: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **new_person** | [**\Pipedrive\Model\NewPerson**](../Model/NewPerson.md)|  | [optional]

### Return type

[**\Pipedrive\Model\AddPersonResponse**](../Model/AddPersonResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `addPersonFollower()`

```php
addPersonFollower($id, $add_person_follower_request): \Pipedrive\Model\AddFollowerToPersonResponse
```

Add a follower to a person

Adds a follower to a person.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the person
$add_person_follower_request = new \Pipedrive\Model\AddPersonFollowerRequest(); // \Pipedrive\Model\AddPersonFollowerRequest

try {
    $result = $apiInstance->addPersonFollower($id, $add_person_follower_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->addPersonFollower: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the person |
 **add_person_follower_request** | [**\Pipedrive\Model\AddPersonFollowerRequest**](../Model/AddPersonFollowerRequest.md)|  | [optional]

### Return type

[**\Pipedrive\Model\AddFollowerToPersonResponse**](../Model/AddFollowerToPersonResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `addPersonPicture()`

```php
addPersonPicture($id, $file, $crop_x, $crop_y, $crop_width, $crop_height): \Pipedrive\Model\AddPersonPictureResponse
```

Add person picture

Adds a picture to a person. If a picture is already set, the old picture will be replaced. Added image (or the cropping parameters supplied with the request) should have an equal width and height and should be at least 128 pixels. GIF, JPG and PNG are accepted. All added images will be resized to 128 and 512 pixel wide squares.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the person
$file = "/path/to/file.txt"; // \SplFileObject | One image supplied in the multipart/form-data encoding
$crop_x = 56; // int | X coordinate to where start cropping form (in pixels)
$crop_y = 56; // int | Y coordinate to where start cropping form (in pixels)
$crop_width = 56; // int | The width of the cropping area (in pixels)
$crop_height = 56; // int | The height of the cropping area (in pixels)

try {
    $result = $apiInstance->addPersonPicture($id, $file, $crop_x, $crop_y, $crop_width, $crop_height);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->addPersonPicture: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the person |
 **file** | **\SplFileObject****\SplFileObject**| One image supplied in the multipart/form-data encoding |
 **crop_x** | **int**| X coordinate to where start cropping form (in pixels) | [optional]
 **crop_y** | **int**| Y coordinate to where start cropping form (in pixels) | [optional]
 **crop_width** | **int**| The width of the cropping area (in pixels) | [optional]
 **crop_height** | **int**| The height of the cropping area (in pixels) | [optional]

### Return type

[**\Pipedrive\Model\AddPersonPictureResponse**](../Model/AddPersonPictureResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deletePerson()`

```php
deletePerson($id): \Pipedrive\Model\DeletePersonResponse
```

Delete a person

Marks a person as deleted. After 30 days, the person will be permanently deleted.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the person

try {
    $result = $apiInstance->deletePerson($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->deletePerson: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the person |

### Return type

[**\Pipedrive\Model\DeletePersonResponse**](../Model/DeletePersonResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deletePersonFollower()`

```php
deletePersonFollower($id, $follower_id): \Pipedrive\Model\DeletePersonResponse
```

Delete a follower from a person

Deletes a follower from a person.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the person
$follower_id = 56; // int | The ID of the follower

try {
    $result = $apiInstance->deletePersonFollower($id, $follower_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->deletePersonFollower: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the person |
 **follower_id** | **int**| The ID of the follower |

### Return type

[**\Pipedrive\Model\DeletePersonResponse**](../Model/DeletePersonResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deletePersonPicture()`

```php
deletePersonPicture($id): \Pipedrive\Model\DeletePersonResponse
```

Delete person picture

Deletes a person’s picture.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the person

try {
    $result = $apiInstance->deletePersonPicture($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->deletePersonPicture: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the person |

### Return type

[**\Pipedrive\Model\DeletePersonResponse**](../Model/DeletePersonResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deletePersons()`

```php
deletePersons($ids): \Pipedrive\Model\DeletePersonsInBulkResponse
```

Delete multiple persons in bulk

Marks multiple persons as deleted. After 30 days, the persons will be permanently deleted.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ids = 'ids_example'; // string | The comma-separated IDs that will be deleted

try {
    $result = $apiInstance->deletePersons($ids);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->deletePersons: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ids** | **string**| The comma-separated IDs that will be deleted |

### Return type

[**\Pipedrive\Model\DeletePersonsInBulkResponse**](../Model/DeletePersonsInBulkResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPerson()`

```php
getPerson($id): \Pipedrive\Model\GetPersonDetailsResponse
```

Get details of a person

Returns the details of a person. Note that this also returns some additional fields which are not present when asking for all persons. Also note that custom fields appear as long hashes in the resulting data. These hashes can be mapped against the `key` value of personFields.<br>If a company uses the [Campaigns product](https://pipedrive.readme.io/docs/campaigns-in-pipedrive-api), then this endpoint will also return the `data.marketing_status` field.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the person

try {
    $result = $apiInstance->getPerson($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->getPerson: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the person |

### Return type

[**\Pipedrive\Model\GetPersonDetailsResponse**](../Model/GetPersonDetailsResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPersonActivities()`

```php
getPersonActivities($id, $start, $limit, $done, $exclude): \Pipedrive\Model\ListActivitiesResponse
```

List activities associated with a person

Lists activities associated with a person.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the person
$start = 0; // int | Pagination start
$limit = 56; // int | Items shown per page
$done = new \Pipedrive\Model\\Pipedrive\Model\NumberBoolean(); // \Pipedrive\Model\NumberBoolean | Whether the activity is done or not. 0 = Not done, 1 = Done. If omitted, returns both Done and Not done activities.
$exclude = 'exclude_example'; // string | A comma-separated string of activity IDs to exclude from result

try {
    $result = $apiInstance->getPersonActivities($id, $start, $limit, $done, $exclude);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->getPersonActivities: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the person |
 **start** | **int**| Pagination start | [optional] [default to 0]
 **limit** | **int**| Items shown per page | [optional]
 **done** | [**\Pipedrive\Model\NumberBoolean**](../Model/.md)| Whether the activity is done or not. 0 &#x3D; Not done, 1 &#x3D; Done. If omitted, returns both Done and Not done activities. | [optional]
 **exclude** | **string**| A comma-separated string of activity IDs to exclude from result | [optional]

### Return type

[**\Pipedrive\Model\ListActivitiesResponse**](../Model/ListActivitiesResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPersonDeals()`

```php
getPersonDeals($id, $start, $limit, $status, $sort): \Pipedrive\Model\ListDealsResponse
```

List deals associated with a person

Lists deals associated with a person.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the person
$start = 0; // int | Pagination start
$limit = 56; // int | Items shown per page
$status = 'all_not_deleted'; // string | Only fetch deals with a specific status. If omitted, all not deleted deals are returned. If set to deleted, deals that have been deleted up to 30 days ago will be included.
$sort = 'sort_example'; // string | The field names and sorting mode separated by a comma (`field_name_1 ASC`, `field_name_2 DESC`). Only first-level field keys are supported (no nested keys).

try {
    $result = $apiInstance->getPersonDeals($id, $start, $limit, $status, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->getPersonDeals: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the person |
 **start** | **int**| Pagination start | [optional] [default to 0]
 **limit** | **int**| Items shown per page | [optional]
 **status** | **string**| Only fetch deals with a specific status. If omitted, all not deleted deals are returned. If set to deleted, deals that have been deleted up to 30 days ago will be included. | [optional] [default to &#39;all_not_deleted&#39;]
 **sort** | **string**| The field names and sorting mode separated by a comma (&#x60;field_name_1 ASC&#x60;, &#x60;field_name_2 DESC&#x60;). Only first-level field keys are supported (no nested keys). | [optional]

### Return type

[**\Pipedrive\Model\ListDealsResponse**](../Model/ListDealsResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPersonFiles()`

```php
getPersonFiles($id, $start, $limit, $sort): \Pipedrive\Model\ListFilesResponse
```

List files attached to a person

Lists files associated with a person.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the person
$start = 0; // int | Pagination start
$limit = 56; // int | Items shown per page
$sort = 'sort_example'; // string | The field names and sorting mode separated by a comma (`field_name_1 ASC`, `field_name_2 DESC`). Only first-level field keys are supported (no nested keys). Supported fields: `id`, `user_id`, `deal_id`, `person_id`, `org_id`, `product_id`, `add_time`, `update_time`, `file_name`, `file_type`, `file_size`, `comment`.

try {
    $result = $apiInstance->getPersonFiles($id, $start, $limit, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->getPersonFiles: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the person |
 **start** | **int**| Pagination start | [optional] [default to 0]
 **limit** | **int**| Items shown per page | [optional]
 **sort** | **string**| The field names and sorting mode separated by a comma (&#x60;field_name_1 ASC&#x60;, &#x60;field_name_2 DESC&#x60;). Only first-level field keys are supported (no nested keys). Supported fields: &#x60;id&#x60;, &#x60;user_id&#x60;, &#x60;deal_id&#x60;, &#x60;person_id&#x60;, &#x60;org_id&#x60;, &#x60;product_id&#x60;, &#x60;add_time&#x60;, &#x60;update_time&#x60;, &#x60;file_name&#x60;, &#x60;file_type&#x60;, &#x60;file_size&#x60;, &#x60;comment&#x60;. | [optional]

### Return type

[**\Pipedrive\Model\ListFilesResponse**](../Model/ListFilesResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPersonFollowers()`

```php
getPersonFollowers($id): \Pipedrive\Model\ListFollowersResponse
```

List followers of a person

Lists the followers of a person.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the person

try {
    $result = $apiInstance->getPersonFollowers($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->getPersonFollowers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the person |

### Return type

[**\Pipedrive\Model\ListFollowersResponse**](../Model/ListFollowersResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPersonMailMessages()`

```php
getPersonMailMessages($id, $start, $limit): \Pipedrive\Model\ListMailMessagesResponse
```

List mail messages associated with a person

Lists mail messages associated with a person.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the person
$start = 0; // int | Pagination start
$limit = 56; // int | Items shown per page

try {
    $result = $apiInstance->getPersonMailMessages($id, $start, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->getPersonMailMessages: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the person |
 **start** | **int**| Pagination start | [optional] [default to 0]
 **limit** | **int**| Items shown per page | [optional]

### Return type

[**\Pipedrive\Model\ListMailMessagesResponse**](../Model/ListMailMessagesResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPersonProducts()`

```php
getPersonProducts($id, $start, $limit): \Pipedrive\Model\ListPersonProductsResponse
```

List products associated with a person

Lists products associated with a person.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the person
$start = 0; // int | Pagination start
$limit = 56; // int | Items shown per page

try {
    $result = $apiInstance->getPersonProducts($id, $start, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->getPersonProducts: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the person |
 **start** | **int**| Pagination start | [optional] [default to 0]
 **limit** | **int**| Items shown per page | [optional]

### Return type

[**\Pipedrive\Model\ListPersonProductsResponse**](../Model/ListPersonProductsResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPersonUpdates()`

```php
getPersonUpdates($id, $start, $limit, $all_changes, $items): \Pipedrive\Model\PersonFlowResponse
```

List updates about a person

Lists updates about a person.<br>If a company uses the [Campaigns product](https://pipedrive.readme.io/docs/campaigns-in-pipedrive-api), then this endpoint's response will also include updates for the `marketing_status` field.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the person
$start = 0; // int | Pagination start
$limit = 56; // int | Items shown per page
$all_changes = 'all_changes_example'; // string | Whether to show custom field updates or not. 1 = Include custom field changes. If omitted returns changes without custom field updates.
$items = 'items_example'; // string | A comma-separated string for filtering out item specific updates. (Possible values - call, activity, plannedActivity, change, note, deal, file, dealChange, personChange, organizationChange, follower, dealFollower, personFollower, organizationFollower, participant, comment, mailMessage, mailMessageWithAttachment, invoice, document, marketing_campaign_stat, marketing_status_change).

try {
    $result = $apiInstance->getPersonUpdates($id, $start, $limit, $all_changes, $items);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->getPersonUpdates: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the person |
 **start** | **int**| Pagination start | [optional] [default to 0]
 **limit** | **int**| Items shown per page | [optional]
 **all_changes** | **string**| Whether to show custom field updates or not. 1 &#x3D; Include custom field changes. If omitted returns changes without custom field updates. | [optional]
 **items** | **string**| A comma-separated string for filtering out item specific updates. (Possible values - call, activity, plannedActivity, change, note, deal, file, dealChange, personChange, organizationChange, follower, dealFollower, personFollower, organizationFollower, participant, comment, mailMessage, mailMessageWithAttachment, invoice, document, marketing_campaign_stat, marketing_status_change). | [optional]

### Return type

[**\Pipedrive\Model\PersonFlowResponse**](../Model/PersonFlowResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPersonUsers()`

```php
getPersonUsers($id): \Pipedrive\Model\ListPermittedUsersResponse1
```

List permitted users

List users permitted to access a person.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the person

try {
    $result = $apiInstance->getPersonUsers($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->getPersonUsers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the person |

### Return type

[**\Pipedrive\Model\ListPermittedUsersResponse1**](../Model/ListPermittedUsersResponse1.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPersons()`

```php
getPersons($user_id, $filter_id, $first_char, $start, $limit, $sort): \Pipedrive\Model\GetAllPersonsResponse
```

Get all persons

Returns all persons.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = 56; // int | If supplied, only persons owned by the given user will be returned. However, `filter_id` takes precedence over `user_id` when both are supplied.
$filter_id = 56; // int | The ID of the filter to use
$first_char = 'first_char_example'; // string | If supplied, only persons whose name starts with the specified letter will be returned (case-insensitive)
$start = 0; // int | Pagination start
$limit = 56; // int | Items shown per page
$sort = 'sort_example'; // string | The field names and sorting mode separated by a comma (`field_name_1 ASC`, `field_name_2 DESC`). Only first-level field keys are supported (no nested keys).

try {
    $result = $apiInstance->getPersons($user_id, $filter_id, $first_char, $start, $limit, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->getPersons: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **int**| If supplied, only persons owned by the given user will be returned. However, &#x60;filter_id&#x60; takes precedence over &#x60;user_id&#x60; when both are supplied. | [optional]
 **filter_id** | **int**| The ID of the filter to use | [optional]
 **first_char** | **string**| If supplied, only persons whose name starts with the specified letter will be returned (case-insensitive) | [optional]
 **start** | **int**| Pagination start | [optional] [default to 0]
 **limit** | **int**| Items shown per page | [optional]
 **sort** | **string**| The field names and sorting mode separated by a comma (&#x60;field_name_1 ASC&#x60;, &#x60;field_name_2 DESC&#x60;). Only first-level field keys are supported (no nested keys). | [optional]

### Return type

[**\Pipedrive\Model\GetAllPersonsResponse**](../Model/GetAllPersonsResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPersonsCollection()`

```php
getPersonsCollection($cursor, $limit, $since, $until, $owner_id, $first_char): \Pipedrive\Model\InlineResponse2002
```

Get all persons (BETA)

Returns all persons. This is a cursor-paginated endpoint that is currently in BETA. For more information, please refer to our documentation on <a href=\"https://pipedrive.readme.io/docs/core-api-concepts-pagination\" target=\"_blank\" rel=\"noopener noreferrer\">pagination</a>. Please note that only global admins (those with global permissions) can access these endpoints. Users with regular permissions will receive a 403 response. Read more about global permissions <a href=\"https://support.pipedrive.com/en/article/global-user-management\" target=\"_blank\" rel=\"noopener noreferrer\">here</a>.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cursor = 'cursor_example'; // string | For pagination, the marker (an opaque string value) representing the first item on the next page
$limit = 100; // int | For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.
$since = 'since_example'; // string | The time boundary that points to the start of the range of data. Datetime in ISO 8601 format. E.g. 2022-11-01 08:55:59. Operates on the `update_time` field.
$until = 'until_example'; // string | The time boundary that points to the end of the range of data. Datetime in ISO 8601 format. E.g. 2022-11-01 08:55:59. Operates on the `update_time` field.
$owner_id = 56; // int | If supplied, only persons owned by the given user will be returned
$first_char = 'first_char_example'; // string | If supplied, only persons whose name starts with the specified letter will be returned (case-insensitive)

try {
    $result = $apiInstance->getPersonsCollection($cursor, $limit, $since, $until, $owner_id, $first_char);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->getPersonsCollection: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cursor** | **string**| For pagination, the marker (an opaque string value) representing the first item on the next page | [optional]
 **limit** | **int**| For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed. | [optional]
 **since** | **string**| The time boundary that points to the start of the range of data. Datetime in ISO 8601 format. E.g. 2022-11-01 08:55:59. Operates on the &#x60;update_time&#x60; field. | [optional]
 **until** | **string**| The time boundary that points to the end of the range of data. Datetime in ISO 8601 format. E.g. 2022-11-01 08:55:59. Operates on the &#x60;update_time&#x60; field. | [optional]
 **owner_id** | **int**| If supplied, only persons owned by the given user will be returned | [optional]
 **first_char** | **string**| If supplied, only persons whose name starts with the specified letter will be returned (case-insensitive) | [optional]

### Return type

[**\Pipedrive\Model\InlineResponse2002**](../Model/InlineResponse2002.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `mergePersons()`

```php
mergePersons($id, $merge_persons_request): \Pipedrive\Model\MergePersonsResponse
```

Merge two persons

Merges a person with another person. For more information, see the tutorial for <a href=\"https://pipedrive.readme.io/docs/merging-two-persons\" target=\"_blank\" rel=\"noopener noreferrer\">merging two persons</a>.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the person
$merge_persons_request = new \Pipedrive\Model\MergePersonsRequest(); // \Pipedrive\Model\MergePersonsRequest

try {
    $result = $apiInstance->mergePersons($id, $merge_persons_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->mergePersons: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the person |
 **merge_persons_request** | [**\Pipedrive\Model\MergePersonsRequest**](../Model/MergePersonsRequest.md)|  | [optional]

### Return type

[**\Pipedrive\Model\MergePersonsResponse**](../Model/MergePersonsResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `searchPersons()`

```php
searchPersons($term, $fields, $exact_match, $organization_id, $include_fields, $start, $limit): \Pipedrive\Model\PersonSearchResponse
```

Search persons

Searches all persons by name, email, phone, notes and/or custom fields. This endpoint is a wrapper of <a href=\"https://developers.pipedrive.com/docs/api/v1/ItemSearch#searchItem\">/v1/itemSearch</a> with a narrower OAuth scope. Found persons can be filtered by organization ID.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term = 'term_example'; // string | The search term to look for. Minimum 2 characters (or 1 if using `exact_match`). Please note that the search term has to be URL encoded.
$fields = 'fields_example'; // string | A comma-separated string array. The fields to perform the search from. Defaults to all of them. Only the following custom field types are searchable: `address`, `varchar`, `text`, `varchar_auto`, `double`, `monetary` and `phone`. Read more about searching by custom fields <a href=\"https://support.pipedrive.com/en/article/search-finding-what-you-need#searching-by-custom-fields\" target=\"_blank\" rel=\"noopener noreferrer\">here</a>.
$exact_match = True; // bool | When enabled, only full exact matches against the given term are returned. It is <b>not</b> case sensitive.
$organization_id = 56; // int | Will filter persons by the provided organization ID. The upper limit of found persons associated with the organization is 2000.
$include_fields = 'include_fields_example'; // string | Supports including optional fields in the results which are not provided by default
$start = 0; // int | Pagination start. Note that the pagination is based on main results and does not include related items when using `search_for_related_items` parameter.
$limit = 56; // int | Items shown per page

try {
    $result = $apiInstance->searchPersons($term, $fields, $exact_match, $organization_id, $include_fields, $start, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->searchPersons: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **term** | **string**| The search term to look for. Minimum 2 characters (or 1 if using &#x60;exact_match&#x60;). Please note that the search term has to be URL encoded. |
 **fields** | **string**| A comma-separated string array. The fields to perform the search from. Defaults to all of them. Only the following custom field types are searchable: &#x60;address&#x60;, &#x60;varchar&#x60;, &#x60;text&#x60;, &#x60;varchar_auto&#x60;, &#x60;double&#x60;, &#x60;monetary&#x60; and &#x60;phone&#x60;. Read more about searching by custom fields &lt;a href&#x3D;\&quot;https://support.pipedrive.com/en/article/search-finding-what-you-need#searching-by-custom-fields\&quot; target&#x3D;\&quot;_blank\&quot; rel&#x3D;\&quot;noopener noreferrer\&quot;&gt;here&lt;/a&gt;. | [optional]
 **exact_match** | **bool**| When enabled, only full exact matches against the given term are returned. It is &lt;b&gt;not&lt;/b&gt; case sensitive. | [optional]
 **organization_id** | **int**| Will filter persons by the provided organization ID. The upper limit of found persons associated with the organization is 2000. | [optional]
 **include_fields** | **string**| Supports including optional fields in the results which are not provided by default | [optional]
 **start** | **int**| Pagination start. Note that the pagination is based on main results and does not include related items when using &#x60;search_for_related_items&#x60; parameter. | [optional] [default to 0]
 **limit** | **int**| Items shown per page | [optional]

### Return type

[**\Pipedrive\Model\PersonSearchResponse**](../Model/PersonSearchResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updatePerson()`

```php
updatePerson($id, $update_person): \Pipedrive\Model\UpdatePersonResponse
```

Update a person

Updates the properties of a person. For more information, see the tutorial for <a href=\"https://pipedrive.readme.io/docs/updating-a-person\" target=\"_blank\" rel=\"noopener noreferrer\">updating a person</a>.<br>If a company uses the [Campaigns product](https://pipedrive.readme.io/docs/campaigns-in-pipedrive-api), then this endpoint will also accept and return the `data.marketing_status` field.

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


$apiInstance = new Pipedrive\Api\PersonsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the person
$update_person = new \Pipedrive\Model\UpdatePerson(); // \Pipedrive\Model\UpdatePerson

try {
    $result = $apiInstance->updatePerson($id, $update_person);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PersonsApi->updatePerson: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the person |
 **update_person** | [**\Pipedrive\Model\UpdatePerson**](../Model/UpdatePerson.md)|  | [optional]

### Return type

[**\Pipedrive\Model\UpdatePersonResponse**](../Model/UpdatePersonResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
