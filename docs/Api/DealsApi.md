# Pipedrive\DealsApi

All URIs are relative to https://api.pipedrive.com/v1.

Method | HTTP request | Description
------------- | ------------- | -------------
[**addDeal()**](DealsApi.md#addDeal) | **POST** /deals | Add a deal
[**addDealFollower()**](DealsApi.md#addDealFollower) | **POST** /deals/{id}/followers | Add a follower to a deal
[**addDealParticipant()**](DealsApi.md#addDealParticipant) | **POST** /deals/{id}/participants | Add a participant to a deal
[**addDealProduct()**](DealsApi.md#addDealProduct) | **POST** /deals/{id}/products | Add a product to a deal
[**deleteDeal()**](DealsApi.md#deleteDeal) | **DELETE** /deals/{id} | Delete a deal
[**deleteDealFollower()**](DealsApi.md#deleteDealFollower) | **DELETE** /deals/{id}/followers/{follower_id} | Delete a follower from a deal
[**deleteDealParticipant()**](DealsApi.md#deleteDealParticipant) | **DELETE** /deals/{id}/participants/{deal_participant_id} | Delete a participant from a deal
[**deleteDealProduct()**](DealsApi.md#deleteDealProduct) | **DELETE** /deals/{id}/products/{product_attachment_id} | Delete an attached product from a deal
[**deleteDeals()**](DealsApi.md#deleteDeals) | **DELETE** /deals | Delete multiple deals in bulk
[**duplicateDeal()**](DealsApi.md#duplicateDeal) | **POST** /deals/{id}/duplicate | Duplicate deal
[**getDeal()**](DealsApi.md#getDeal) | **GET** /deals/{id} | Get details of a deal
[**getDealActivities()**](DealsApi.md#getDealActivities) | **GET** /deals/{id}/activities | List activities associated with a deal
[**getDealFiles()**](DealsApi.md#getDealFiles) | **GET** /deals/{id}/files | List files attached to a deal
[**getDealFollowers()**](DealsApi.md#getDealFollowers) | **GET** /deals/{id}/followers | List followers of a deal
[**getDealMailMessages()**](DealsApi.md#getDealMailMessages) | **GET** /deals/{id}/mailMessages | List mail messages associated with a deal
[**getDealParticipants()**](DealsApi.md#getDealParticipants) | **GET** /deals/{id}/participants | List participants of a deal
[**getDealParticipantsChangelog()**](DealsApi.md#getDealParticipantsChangelog) | **GET** /deals/{id}/participantsChangelog | List updates about participants of a deal
[**getDealPersons()**](DealsApi.md#getDealPersons) | **GET** /deals/{id}/persons | List all persons associated with a deal
[**getDealProducts()**](DealsApi.md#getDealProducts) | **GET** /deals/{id}/products | List products attached to a deal
[**getDealUpdates()**](DealsApi.md#getDealUpdates) | **GET** /deals/{id}/flow | List updates about a deal
[**getDealUsers()**](DealsApi.md#getDealUsers) | **GET** /deals/{id}/permittedUsers | List permitted users
[**getDeals()**](DealsApi.md#getDeals) | **GET** /deals | Get all deals
[**getDealsCollection()**](DealsApi.md#getDealsCollection) | **GET** /deals/collection | Get all deals (BETA)
[**getDealsSummary()**](DealsApi.md#getDealsSummary) | **GET** /deals/summary | Get deals summary
[**getDealsTimeline()**](DealsApi.md#getDealsTimeline) | **GET** /deals/timeline | Get deals timeline
[**mergeDeals()**](DealsApi.md#mergeDeals) | **PUT** /deals/{id}/merge | Merge two deals
[**searchDeals()**](DealsApi.md#searchDeals) | **GET** /deals/search | Search deals
[**updateDeal()**](DealsApi.md#updateDeal) | **PUT** /deals/{id} | Update a deal
[**updateDealProduct()**](DealsApi.md#updateDealProduct) | **PUT** /deals/{id}/products/{product_attachment_id} | Update the product attached to a deal


## `addDeal()`

```php
addDeal($new_deal): \Pipedrive\Model\GetAddedDeal
```

Add a deal

Adds a new deal. Note that you can supply additional custom fields along with the request that are not described here. These custom fields are different for each Pipedrive account and can be recognized by long hashes as keys. To determine which custom fields exists, fetch the dealFields and look for `key` values. For more information, see the tutorial for <a href=\"https://pipedrive.readme.io/docs/creating-a-deal\" target=\"_blank\" rel=\"noopener noreferrer\">adding a deal</a>.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$new_deal = new \Pipedrive\Model\NewDeal(); // \Pipedrive\Model\NewDeal

try {
    $result = $apiInstance->addDeal($new_deal);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->addDeal: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **new_deal** | [**\Pipedrive\Model\NewDeal**](../Model/NewDeal.md)|  | [optional]

### Return type

[**\Pipedrive\Model\GetAddedDeal**](../Model/GetAddedDeal.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `addDealFollower()`

```php
addDealFollower($id, $add_deal_follower_request): \Pipedrive\Model\AddedDealFollower
```

Add a follower to a deal

Adds a follower to a deal.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal
$add_deal_follower_request = new \Pipedrive\Model\AddDealFollowerRequest(); // \Pipedrive\Model\AddDealFollowerRequest

try {
    $result = $apiInstance->addDealFollower($id, $add_deal_follower_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->addDealFollower: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |
 **add_deal_follower_request** | [**\Pipedrive\Model\AddDealFollowerRequest**](../Model/AddDealFollowerRequest.md)|  | [optional]

### Return type

[**\Pipedrive\Model\AddedDealFollower**](../Model/AddedDealFollower.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `addDealParticipant()`

```php
addDealParticipant($id, $add_deal_participant_request): \Pipedrive\Model\PostDealParticipants
```

Add a participant to a deal

Adds a participant to a deal.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal
$add_deal_participant_request = new \Pipedrive\Model\AddDealParticipantRequest(); // \Pipedrive\Model\AddDealParticipantRequest

try {
    $result = $apiInstance->addDealParticipant($id, $add_deal_participant_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->addDealParticipant: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |
 **add_deal_participant_request** | [**\Pipedrive\Model\AddDealParticipantRequest**](../Model/AddDealParticipantRequest.md)|  | [optional]

### Return type

[**\Pipedrive\Model\PostDealParticipants**](../Model/PostDealParticipants.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `addDealProduct()`

```php
addDealProduct($id, $new_deal_product): \Pipedrive\Model\GetAddProductAttachementDetails
```

Add a product to a deal

Adds a product to a deal, creating a new item called a deal-product.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal
$new_deal_product = new \Pipedrive\Model\NewDealProduct(); // \Pipedrive\Model\NewDealProduct

try {
    $result = $apiInstance->addDealProduct($id, $new_deal_product);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->addDealProduct: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |
 **new_deal_product** | [**\Pipedrive\Model\NewDealProduct**](../Model/NewDealProduct.md)|  | [optional]

### Return type

[**\Pipedrive\Model\GetAddProductAttachementDetails**](../Model/GetAddProductAttachementDetails.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteDeal()`

```php
deleteDeal($id): \Pipedrive\Model\DeleteDeal
```

Delete a deal

Marks a deal as deleted. After 30 days, the deal will be permanently deleted.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal

try {
    $result = $apiInstance->deleteDeal($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->deleteDeal: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |

### Return type

[**\Pipedrive\Model\DeleteDeal**](../Model/DeleteDeal.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteDealFollower()`

```php
deleteDealFollower($id, $follower_id): \Pipedrive\Model\DeleteDealFollower
```

Delete a follower from a deal

Deletes a follower from a deal.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal
$follower_id = 56; // int | The ID of the follower

try {
    $result = $apiInstance->deleteDealFollower($id, $follower_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->deleteDealFollower: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |
 **follower_id** | **int**| The ID of the follower |

### Return type

[**\Pipedrive\Model\DeleteDealFollower**](../Model/DeleteDealFollower.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteDealParticipant()`

```php
deleteDealParticipant($id, $deal_participant_id): \Pipedrive\Model\DeleteDealParticipant
```

Delete a participant from a deal

Deletes a participant from a deal.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal
$deal_participant_id = 56; // int | The ID of the participant of the deal

try {
    $result = $apiInstance->deleteDealParticipant($id, $deal_participant_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->deleteDealParticipant: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |
 **deal_participant_id** | **int**| The ID of the participant of the deal |

### Return type

[**\Pipedrive\Model\DeleteDealParticipant**](../Model/DeleteDealParticipant.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteDealProduct()`

```php
deleteDealProduct($id, $product_attachment_id): \Pipedrive\Model\DeleteDealProduct
```

Delete an attached product from a deal

Deletes a product attachment from a deal, using the `product_attachment_id`.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal
$product_attachment_id = 56; // int | The product attachment ID

try {
    $result = $apiInstance->deleteDealProduct($id, $product_attachment_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->deleteDealProduct: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |
 **product_attachment_id** | **int**| The product attachment ID |

### Return type

[**\Pipedrive\Model\DeleteDealProduct**](../Model/DeleteDealProduct.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteDeals()`

```php
deleteDeals($ids): \Pipedrive\Model\DeleteMultipleDeals
```

Delete multiple deals in bulk

Marks multiple deals as deleted. After 30 days, the deals will be permanently deleted.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ids = 'ids_example'; // string | The comma-separated IDs that will be deleted

try {
    $result = $apiInstance->deleteDeals($ids);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->deleteDeals: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ids** | **string**| The comma-separated IDs that will be deleted |

### Return type

[**\Pipedrive\Model\DeleteMultipleDeals**](../Model/DeleteMultipleDeals.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `duplicateDeal()`

```php
duplicateDeal($id): \Pipedrive\Model\GetDuplicatedDeal
```

Duplicate deal

Duplicates a deal.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal

try {
    $result = $apiInstance->duplicateDeal($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->duplicateDeal: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |

### Return type

[**\Pipedrive\Model\GetDuplicatedDeal**](../Model/GetDuplicatedDeal.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getDeal()`

```php
getDeal($id): \Pipedrive\Model\GetDeal
```

Get details of a deal

Returns the details of a specific deal. Note that this also returns some additional fields which are not present when asking for all deals – such as deal age and stay in pipeline stages. Also note that custom fields appear as long hashes in the resulting data. These hashes can be mapped against the `key` value of dealFields. For more information, see the tutorial for <a href=\"https://pipedrive.readme.io/docs/getting-details-of-a-deal\" target=\"_blank\" rel=\"noopener noreferrer\">getting details of a deal</a>.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal

try {
    $result = $apiInstance->getDeal($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->getDeal: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |

### Return type

[**\Pipedrive\Model\GetDeal**](../Model/GetDeal.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getDealActivities()`

```php
getDealActivities($id, $start, $limit, $done, $exclude): \Pipedrive\Model\DealListActivitiesResponse
```

List activities associated with a deal

Lists activities associated with a deal.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal
$start = 0; // int | Pagination start
$limit = 56; // int | Items shown per page
$done = new \Pipedrive\Model\\Pipedrive\Model\NumberBoolean(); // \Pipedrive\Model\NumberBoolean | Whether the activity is done or not. 0 = Not done, 1 = Done. If omitted, returns both Done and Not done activities.
$exclude = 'exclude_example'; // string | A comma-separated string of activity IDs to exclude from result

try {
    $result = $apiInstance->getDealActivities($id, $start, $limit, $done, $exclude);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->getDealActivities: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |
 **start** | **int**| Pagination start | [optional] [default to 0]
 **limit** | **int**| Items shown per page | [optional]
 **done** | [**\Pipedrive\Model\NumberBoolean**](../Model/.md)| Whether the activity is done or not. 0 &#x3D; Not done, 1 &#x3D; Done. If omitted, returns both Done and Not done activities. | [optional]
 **exclude** | **string**| A comma-separated string of activity IDs to exclude from result | [optional]

### Return type

[**\Pipedrive\Model\DealListActivitiesResponse**](../Model/DealListActivitiesResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getDealFiles()`

```php
getDealFiles($id, $start, $limit, $sort): \Pipedrive\Model\ListFilesResponse
```

List files attached to a deal

Lists files associated with a deal.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal
$start = 0; // int | Pagination start
$limit = 56; // int | Items shown per page
$sort = 'sort_example'; // string | The field names and sorting mode separated by a comma (`field_name_1 ASC`, `field_name_2 DESC`). Only first-level field keys are supported (no nested keys). Supported fields: `id`, `user_id`, `deal_id`, `person_id`, `org_id`, `product_id`, `add_time`, `update_time`, `file_name`, `file_type`, `file_size`, `comment`.

try {
    $result = $apiInstance->getDealFiles($id, $start, $limit, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->getDealFiles: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |
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

## `getDealFollowers()`

```php
getDealFollowers($id): \Pipedrive\Model\ListFollowersResponse
```

List followers of a deal

Lists the followers of a deal.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal

try {
    $result = $apiInstance->getDealFollowers($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->getDealFollowers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |

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

## `getDealMailMessages()`

```php
getDealMailMessages($id, $start, $limit): \Pipedrive\Model\ListMailMessagesResponse
```

List mail messages associated with a deal

Lists mail messages associated with a deal.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal
$start = 0; // int | Pagination start
$limit = 56; // int | Items shown per page

try {
    $result = $apiInstance->getDealMailMessages($id, $start, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->getDealMailMessages: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |
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

## `getDealParticipants()`

```php
getDealParticipants($id, $start, $limit): \Pipedrive\Model\DealParticipants
```

List participants of a deal

Lists the participants associated with a deal.<br>If a company uses the [Campaigns product](https://pipedrive.readme.io/docs/campaigns-in-pipedrive-api), then this endpoint will also return the `data.marketing_status` field.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal
$start = 0; // int | Pagination start
$limit = 56; // int | Items shown per page

try {
    $result = $apiInstance->getDealParticipants($id, $start, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->getDealParticipants: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |
 **start** | **int**| Pagination start | [optional] [default to 0]
 **limit** | **int**| Items shown per page | [optional]

### Return type

[**\Pipedrive\Model\DealParticipants**](../Model/DealParticipants.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getDealParticipantsChangelog()`

```php
getDealParticipantsChangelog($id, $limit, $cursor): \Pipedrive\Model\ParticipantsChangelog
```

List updates about participants of a deal

List updates about participants of a deal. This is a cursor-paginated endpoint. For more information, please refer to our documentation on <a href=\"https://pipedrive.readme.io/docs/core-api-concepts-pagination\" target=\"_blank\" rel=\"noopener noreferrer\">pagination</a>.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal
$limit = 56; // int | Items shown per page
$cursor = 'cursor_example'; // string | For pagination, the marker (an opaque string value) representing the first item on the next page

try {
    $result = $apiInstance->getDealParticipantsChangelog($id, $limit, $cursor);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->getDealParticipantsChangelog: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |
 **limit** | **int**| Items shown per page | [optional]
 **cursor** | **string**| For pagination, the marker (an opaque string value) representing the first item on the next page | [optional]

### Return type

[**\Pipedrive\Model\ParticipantsChangelog**](../Model/ParticipantsChangelog.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getDealPersons()`

```php
getDealPersons($id, $start, $limit): \Pipedrive\Model\ListPersonsResponse
```

List all persons associated with a deal

Lists all persons associated with a deal, regardless of whether the person is the primary contact of the deal, or added as a participant.<br>If a company uses the [Campaigns product](https://pipedrive.readme.io/docs/campaigns-in-pipedrive-api), then this endpoint will also return the `data.marketing_status` field.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal
$start = 0; // int | Pagination start
$limit = 56; // int | Items shown per page

try {
    $result = $apiInstance->getDealPersons($id, $start, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->getDealPersons: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |
 **start** | **int**| Pagination start | [optional] [default to 0]
 **limit** | **int**| Items shown per page | [optional]

### Return type

[**\Pipedrive\Model\ListPersonsResponse**](../Model/ListPersonsResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getDealProducts()`

```php
getDealProducts($id, $start, $limit, $include_product_data): \Pipedrive\Model\ListProductsResponse
```

List products attached to a deal

Lists products attached to a deal.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal
$start = 0; // int | Pagination start
$limit = 56; // int | Items shown per page
$include_product_data = new \Pipedrive\Model\\Pipedrive\Model\NumberBoolean(); // \Pipedrive\Model\NumberBoolean | Whether to fetch product data along with each attached product (1) or not (0, default)

try {
    $result = $apiInstance->getDealProducts($id, $start, $limit, $include_product_data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->getDealProducts: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |
 **start** | **int**| Pagination start | [optional] [default to 0]
 **limit** | **int**| Items shown per page | [optional]
 **include_product_data** | [**\Pipedrive\Model\NumberBoolean**](../Model/.md)| Whether to fetch product data along with each attached product (1) or not (0, default) | [optional]

### Return type

[**\Pipedrive\Model\ListProductsResponse**](../Model/ListProductsResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getDealUpdates()`

```php
getDealUpdates($id, $start, $limit, $all_changes, $items): \Pipedrive\Model\DealFlowResponse
```

List updates about a deal

Lists updates about a deal.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal
$start = 0; // int | Pagination start
$limit = 56; // int | Items shown per page
$all_changes = 'all_changes_example'; // string | Whether to show custom field updates or not. 1 = Include custom field changes. If omitted returns changes without custom field updates.
$items = 'items_example'; // string | A comma-separated string for filtering out item specific updates. (Possible values - call, activity, plannedActivity, change, note, deal, file, dealChange, personChange, organizationChange, follower, dealFollower, personFollower, organizationFollower, participant, comment, mailMessage, mailMessageWithAttachment, invoice, document, marketing_campaign_stat, marketing_status_change).

try {
    $result = $apiInstance->getDealUpdates($id, $start, $limit, $all_changes, $items);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->getDealUpdates: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |
 **start** | **int**| Pagination start | [optional] [default to 0]
 **limit** | **int**| Items shown per page | [optional]
 **all_changes** | **string**| Whether to show custom field updates or not. 1 &#x3D; Include custom field changes. If omitted returns changes without custom field updates. | [optional]
 **items** | **string**| A comma-separated string for filtering out item specific updates. (Possible values - call, activity, plannedActivity, change, note, deal, file, dealChange, personChange, organizationChange, follower, dealFollower, personFollower, organizationFollower, participant, comment, mailMessage, mailMessageWithAttachment, invoice, document, marketing_campaign_stat, marketing_status_change). | [optional]

### Return type

[**\Pipedrive\Model\DealFlowResponse**](../Model/DealFlowResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getDealUsers()`

```php
getDealUsers($id): \Pipedrive\Model\ListPermittedUsersResponse
```

List permitted users

Lists the users permitted to access a deal.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal

try {
    $result = $apiInstance->getDealUsers($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->getDealUsers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |

### Return type

[**\Pipedrive\Model\ListPermittedUsersResponse**](../Model/ListPermittedUsersResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getDeals()`

```php
getDeals($user_id, $filter_id, $stage_id, $status, $start, $limit, $sort, $owned_by_you): \Pipedrive\Model\GetDeals
```

Get all deals

Returns all deals. For more information, see the tutorial for <a href=\"https://pipedrive.readme.io/docs/getting-all-deals\" target=\"_blank\" rel=\"noopener noreferrer\">getting all deals</a>.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = 56; // int | If supplied, only deals matching the given user will be returned. However, `filter_id` and `owned_by_you` takes precedence over `user_id` when supplied.
$filter_id = 56; // int | The ID of the filter to use
$stage_id = 56; // int | If supplied, only deals within the given stage will be returned
$status = 'all_not_deleted'; // string | Only fetch deals with a specific status. If omitted, all not deleted deals are returned. If set to deleted, deals that have been deleted up to 30 days ago will be included.
$start = 0; // int | Pagination start
$limit = 56; // int | Items shown per page
$sort = 'sort_example'; // string | The field names and sorting mode separated by a comma (`field_name_1 ASC`, `field_name_2 DESC`). Only first-level field keys are supported (no nested keys).
$owned_by_you = new \Pipedrive\Model\\Pipedrive\Model\NumberBoolean(); // \Pipedrive\Model\NumberBoolean | When supplied, only deals owned by you are returned. However, `filter_id` takes precedence over `owned_by_you` when both are supplied.

try {
    $result = $apiInstance->getDeals($user_id, $filter_id, $stage_id, $status, $start, $limit, $sort, $owned_by_you);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->getDeals: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **int**| If supplied, only deals matching the given user will be returned. However, &#x60;filter_id&#x60; and &#x60;owned_by_you&#x60; takes precedence over &#x60;user_id&#x60; when supplied. | [optional]
 **filter_id** | **int**| The ID of the filter to use | [optional]
 **stage_id** | **int**| If supplied, only deals within the given stage will be returned | [optional]
 **status** | **string**| Only fetch deals with a specific status. If omitted, all not deleted deals are returned. If set to deleted, deals that have been deleted up to 30 days ago will be included. | [optional] [default to &#39;all_not_deleted&#39;]
 **start** | **int**| Pagination start | [optional] [default to 0]
 **limit** | **int**| Items shown per page | [optional]
 **sort** | **string**| The field names and sorting mode separated by a comma (&#x60;field_name_1 ASC&#x60;, &#x60;field_name_2 DESC&#x60;). Only first-level field keys are supported (no nested keys). | [optional]
 **owned_by_you** | [**\Pipedrive\Model\NumberBoolean**](../Model/.md)| When supplied, only deals owned by you are returned. However, &#x60;filter_id&#x60; takes precedence over &#x60;owned_by_you&#x60; when both are supplied. | [optional]

### Return type

[**\Pipedrive\Model\GetDeals**](../Model/GetDeals.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getDealsCollection()`

```php
getDealsCollection($cursor, $limit, $since, $until, $user_id, $stage_id, $status): \Pipedrive\Model\GetDealsCollection
```

Get all deals (BETA)

Returns all deals. This is a cursor-paginated endpoint that is currently in BETA. For more information, please refer to our documentation on <a href=\"https://pipedrive.readme.io/docs/core-api-concepts-pagination\" target=\"_blank\" rel=\"noopener noreferrer\">pagination</a>. Please note that only global admins (those with global permissions) can access these endpoints. Users with regular permissions will receive a 403 response. Read more about global permissions <a href=\"https://support.pipedrive.com/en/article/global-user-management\" target=\"_blank\" rel=\"noopener noreferrer\">here</a>.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cursor = 'cursor_example'; // string | For pagination, the marker (an opaque string value) representing the first item on the next page
$limit = 100; // int | For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.
$since = 'since_example'; // string | The time boundary that points to the start of the range of data. Datetime in ISO 8601 format. E.g. 2022-11-01 08:55:59. Operates on the `update_time` field.
$until = 'until_example'; // string | The time boundary that points to the end of the range of data. Datetime in ISO 8601 format. E.g. 2022-11-01 08:55:59. Operates on the `update_time` field.
$user_id = 56; // int | If supplied, only deals matching the given user will be returned
$stage_id = 56; // int | If supplied, only deals within the given stage will be returned
$status = 'status_example'; // string | Only fetch deals with a specific status. If omitted, all not deleted deals are returned. If set to deleted, deals that have been deleted up to 30 days ago will be included.

try {
    $result = $apiInstance->getDealsCollection($cursor, $limit, $since, $until, $user_id, $stage_id, $status);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->getDealsCollection: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cursor** | **string**| For pagination, the marker (an opaque string value) representing the first item on the next page | [optional]
 **limit** | **int**| For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed. | [optional]
 **since** | **string**| The time boundary that points to the start of the range of data. Datetime in ISO 8601 format. E.g. 2022-11-01 08:55:59. Operates on the &#x60;update_time&#x60; field. | [optional]
 **until** | **string**| The time boundary that points to the end of the range of data. Datetime in ISO 8601 format. E.g. 2022-11-01 08:55:59. Operates on the &#x60;update_time&#x60; field. | [optional]
 **user_id** | **int**| If supplied, only deals matching the given user will be returned | [optional]
 **stage_id** | **int**| If supplied, only deals within the given stage will be returned | [optional]
 **status** | **string**| Only fetch deals with a specific status. If omitted, all not deleted deals are returned. If set to deleted, deals that have been deleted up to 30 days ago will be included. | [optional]

### Return type

[**\Pipedrive\Model\GetDealsCollection**](../Model/GetDealsCollection.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getDealsSummary()`

```php
getDealsSummary($status, $filter_id, $user_id, $stage_id): \Pipedrive\Model\GetDealsSummary
```

Get deals summary

Returns a summary of all the deals.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$status = 'status_example'; // string | Only fetch deals with a specific status. open = Open, won = Won, lost = Lost.
$filter_id = 56; // int | <code>user_id</code> will not be considered. Only deals matching the given filter will be returned.
$user_id = 56; // int | Only deals matching the given user will be returned. `user_id` will not be considered if you use `filter_id`.
$stage_id = 56; // int | Only deals within the given stage will be returned

try {
    $result = $apiInstance->getDealsSummary($status, $filter_id, $user_id, $stage_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->getDealsSummary: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **status** | **string**| Only fetch deals with a specific status. open &#x3D; Open, won &#x3D; Won, lost &#x3D; Lost. | [optional]
 **filter_id** | **int**| &lt;code&gt;user_id&lt;/code&gt; will not be considered. Only deals matching the given filter will be returned. | [optional]
 **user_id** | **int**| Only deals matching the given user will be returned. &#x60;user_id&#x60; will not be considered if you use &#x60;filter_id&#x60;. | [optional]
 **stage_id** | **int**| Only deals within the given stage will be returned | [optional]

### Return type

[**\Pipedrive\Model\GetDealsSummary**](../Model/GetDealsSummary.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getDealsTimeline()`

```php
getDealsTimeline($start_date, $interval, $amount, $field_key, $user_id, $pipeline_id, $filter_id, $exclude_deals, $totals_convert_currency): \Pipedrive\Model\GetDealsTimeline
```

Get deals timeline

Returns open and won deals, grouped by a defined interval of time set in a date-type dealField (`field_key`) — e.g. when month is the chosen interval, and 3 months are asked starting from January 1st, 2012, deals are returned grouped into 3 groups — January, February and March — based on the value of the given `field_key`.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$start_date = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | The date when the first interval starts. Format: YYYY-MM-DD.
$interval = 'interval_example'; // string | The type of the interval<table><tr><th>Value</th><th>Description</th></tr><tr><td>`day`</td><td>Day</td></tr><tr><td>`week`</td><td>A full week (7 days) starting from `start_date`</td></tr><tr><td>`month`</td><td>A full month (depending on the number of days in given month) starting from `start_date`</td></tr><tr><td>`quarter`</td><td>A full quarter (3 months) starting from `start_date`</td></tr></table>
$amount = 56; // int | The number of given intervals, starting from `start_date`, to fetch. E.g. 3 (months).
$field_key = 'field_key_example'; // string | The date field key which deals will be retrieved from
$user_id = 56; // int | If supplied, only deals matching the given user will be returned
$pipeline_id = 56; // int | If supplied, only deals matching the given pipeline will be returned
$filter_id = 56; // int | If supplied, only deals matching the given filter will be returned
$exclude_deals = new \Pipedrive\Model\\Pipedrive\Model\NumberBoolean(); // \Pipedrive\Model\NumberBoolean | Whether to exclude deals list (1) or not (0). Note that when deals are excluded, the timeline summary (counts and values) is still returned.
$totals_convert_currency = 'totals_convert_currency_example'; // string | The 3-letter currency code of any of the supported currencies. When supplied, `totals_converted` is returned per each interval which contains the currency-converted total amounts in the given currency. You may also set this parameter to `default_currency` in which case the user's default currency is used.

try {
    $result = $apiInstance->getDealsTimeline($start_date, $interval, $amount, $field_key, $user_id, $pipeline_id, $filter_id, $exclude_deals, $totals_convert_currency);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->getDealsTimeline: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **start_date** | **\DateTime**| The date when the first interval starts. Format: YYYY-MM-DD. |
 **interval** | **string**| The type of the interval&lt;table&gt;&lt;tr&gt;&lt;th&gt;Value&lt;/th&gt;&lt;th&gt;Description&lt;/th&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;&#x60;day&#x60;&lt;/td&gt;&lt;td&gt;Day&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;&#x60;week&#x60;&lt;/td&gt;&lt;td&gt;A full week (7 days) starting from &#x60;start_date&#x60;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;&#x60;month&#x60;&lt;/td&gt;&lt;td&gt;A full month (depending on the number of days in given month) starting from &#x60;start_date&#x60;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;&#x60;quarter&#x60;&lt;/td&gt;&lt;td&gt;A full quarter (3 months) starting from &#x60;start_date&#x60;&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt; |
 **amount** | **int**| The number of given intervals, starting from &#x60;start_date&#x60;, to fetch. E.g. 3 (months). |
 **field_key** | **string**| The date field key which deals will be retrieved from |
 **user_id** | **int**| If supplied, only deals matching the given user will be returned | [optional]
 **pipeline_id** | **int**| If supplied, only deals matching the given pipeline will be returned | [optional]
 **filter_id** | **int**| If supplied, only deals matching the given filter will be returned | [optional]
 **exclude_deals** | [**\Pipedrive\Model\NumberBoolean**](../Model/.md)| Whether to exclude deals list (1) or not (0). Note that when deals are excluded, the timeline summary (counts and values) is still returned. | [optional]
 **totals_convert_currency** | **string**| The 3-letter currency code of any of the supported currencies. When supplied, &#x60;totals_converted&#x60; is returned per each interval which contains the currency-converted total amounts in the given currency. You may also set this parameter to &#x60;default_currency&#x60; in which case the user&#39;s default currency is used. | [optional]

### Return type

[**\Pipedrive\Model\GetDealsTimeline**](../Model/GetDealsTimeline.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `mergeDeals()`

```php
mergeDeals($id, $merge_deals_request): \Pipedrive\Model\GetMergedDeal
```

Merge two deals

Merges a deal with another deal. For more information, see the tutorial for <a href=\"https://pipedrive.readme.io/docs/merging-two-deals\" target=\"_blank\" rel=\"noopener noreferrer\">merging two deals</a>.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal
$merge_deals_request = new \Pipedrive\Model\MergeDealsRequest(); // \Pipedrive\Model\MergeDealsRequest

try {
    $result = $apiInstance->mergeDeals($id, $merge_deals_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->mergeDeals: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |
 **merge_deals_request** | [**\Pipedrive\Model\MergeDealsRequest**](../Model/MergeDealsRequest.md)|  | [optional]

### Return type

[**\Pipedrive\Model\GetMergedDeal**](../Model/GetMergedDeal.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `searchDeals()`

```php
searchDeals($term, $fields, $exact_match, $person_id, $organization_id, $status, $include_fields, $start, $limit): \Pipedrive\Model\DealSearchResponse
```

Search deals

Searches all deals by title, notes and/or custom fields. This endpoint is a wrapper of <a href=\"https://developers.pipedrive.com/docs/api/v1/ItemSearch#searchItem\">/v1/itemSearch</a> with a narrower OAuth scope. Found deals can be filtered by the person ID and the organization ID.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term = 'term_example'; // string | The search term to look for. Minimum 2 characters (or 1 if using `exact_match`). Please note that the search term has to be URL encoded.
$fields = 'fields_example'; // string | A comma-separated string array. The fields to perform the search from. Defaults to all of them. Only the following custom field types are searchable: `address`, `varchar`, `text`, `varchar_auto`, `double`, `monetary` and `phone`. Read more about searching by custom fields <a href=\"https://support.pipedrive.com/en/article/search-finding-what-you-need#searching-by-custom-fields\" target=\"_blank\" rel=\"noopener noreferrer\">here</a>.
$exact_match = True; // bool | When enabled, only full exact matches against the given term are returned. It is <b>not</b> case sensitive.
$person_id = 56; // int | Will filter deals by the provided person ID. The upper limit of found deals associated with the person is 2000.
$organization_id = 56; // int | Will filter deals by the provided organization ID. The upper limit of found deals associated with the organization is 2000.
$status = 'status_example'; // string | Will filter deals by the provided specific status. open = Open, won = Won, lost = Lost. The upper limit of found deals associated with the status is 2000.
$include_fields = 'include_fields_example'; // string | Supports including optional fields in the results which are not provided by default
$start = 0; // int | Pagination start. Note that the pagination is based on main results and does not include related items when using `search_for_related_items` parameter.
$limit = 56; // int | Items shown per page

try {
    $result = $apiInstance->searchDeals($term, $fields, $exact_match, $person_id, $organization_id, $status, $include_fields, $start, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->searchDeals: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **term** | **string**| The search term to look for. Minimum 2 characters (or 1 if using &#x60;exact_match&#x60;). Please note that the search term has to be URL encoded. |
 **fields** | **string**| A comma-separated string array. The fields to perform the search from. Defaults to all of them. Only the following custom field types are searchable: &#x60;address&#x60;, &#x60;varchar&#x60;, &#x60;text&#x60;, &#x60;varchar_auto&#x60;, &#x60;double&#x60;, &#x60;monetary&#x60; and &#x60;phone&#x60;. Read more about searching by custom fields &lt;a href&#x3D;\&quot;https://support.pipedrive.com/en/article/search-finding-what-you-need#searching-by-custom-fields\&quot; target&#x3D;\&quot;_blank\&quot; rel&#x3D;\&quot;noopener noreferrer\&quot;&gt;here&lt;/a&gt;. | [optional]
 **exact_match** | **bool**| When enabled, only full exact matches against the given term are returned. It is &lt;b&gt;not&lt;/b&gt; case sensitive. | [optional]
 **person_id** | **int**| Will filter deals by the provided person ID. The upper limit of found deals associated with the person is 2000. | [optional]
 **organization_id** | **int**| Will filter deals by the provided organization ID. The upper limit of found deals associated with the organization is 2000. | [optional]
 **status** | **string**| Will filter deals by the provided specific status. open &#x3D; Open, won &#x3D; Won, lost &#x3D; Lost. The upper limit of found deals associated with the status is 2000. | [optional]
 **include_fields** | **string**| Supports including optional fields in the results which are not provided by default | [optional]
 **start** | **int**| Pagination start. Note that the pagination is based on main results and does not include related items when using &#x60;search_for_related_items&#x60; parameter. | [optional] [default to 0]
 **limit** | **int**| Items shown per page | [optional]

### Return type

[**\Pipedrive\Model\DealSearchResponse**](../Model/DealSearchResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateDeal()`

```php
updateDeal($id, $update_deal_request): \Pipedrive\Model\GetAddedDeal
```

Update a deal

Updates the properties of a deal. For more information, see the tutorial for <a href=\"https://pipedrive.readme.io/docs/updating-a-deal\" target=\"_blank\" rel=\"noopener noreferrer\">updating a deal</a>.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal
$update_deal_request = new \Pipedrive\Model\UpdateDealRequest(); // \Pipedrive\Model\UpdateDealRequest

try {
    $result = $apiInstance->updateDeal($id, $update_deal_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->updateDeal: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |
 **update_deal_request** | [**\Pipedrive\Model\UpdateDealRequest**](../Model/UpdateDealRequest.md)|  | [optional]

### Return type

[**\Pipedrive\Model\GetAddedDeal**](../Model/GetAddedDeal.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateDealProduct()`

```php
updateDealProduct($id, $product_attachment_id, $update_deal_product): \Pipedrive\Model\GetProductAttachementDetails
```

Update the product attached to a deal

Updates the details of the product that has been attached to a deal.

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


$apiInstance = new Pipedrive\Api\DealsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | The ID of the deal
$product_attachment_id = 56; // int | The ID of the deal-product (the ID of the product attached to the deal)
$update_deal_product = new \Pipedrive\Model\UpdateDealProduct(); // \Pipedrive\Model\UpdateDealProduct

try {
    $result = $apiInstance->updateDealProduct($id, $product_attachment_id, $update_deal_product);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DealsApi->updateDealProduct: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| The ID of the deal |
 **product_attachment_id** | **int**| The ID of the deal-product (the ID of the product attached to the deal) |
 **update_deal_product** | [**\Pipedrive\Model\UpdateDealProduct**](../Model/UpdateDealProduct.md)|  | [optional]

### Return type

[**\Pipedrive\Model\GetProductAttachementDetails**](../Model/GetProductAttachementDetails.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
