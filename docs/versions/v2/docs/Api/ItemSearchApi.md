# Pipedrive\versions\v2\ItemSearchApi

All URIs are relative to https://api.pipedrive.com/api/v2.

Method | HTTP request | Description
------------- | ------------- | -------------
[**searchItem()**](ItemSearchApi.md#searchItem) | **GET** /itemSearch | Perform a search from multiple item types
[**searchItemByField()**](ItemSearchApi.md#searchItemByField) | **GET** /itemSearch/field | Perform a search using a specific field from an item type


## `searchItem()`

```php
searchItem($term, $item_types, $fields, $search_for_related_items, $exact_match, $include_fields, $limit, $cursor): \Pipedrive\versions\v2\Model\ItemSearchResponse
```

Perform a search from multiple item types

Performs a search from your choice of item types and fields.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: api_key
$config = (new Pipedrive\versions\v2\Configuration())->setApiKey('api_token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = (new Pipedrive\versions\v2\Configuration())->setApiKeyPrefix('api_token', 'Bearer');

// Configure OAuth2 access token for authorization: oauth2
$config = (new Pipedrive\versions\v2\Configuration())->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Pipedrive\versions\v2\Api\ItemSearchApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term = 'term_example'; // string | The search term to look for. Minimum 2 characters (or 1 if using `exact_match`). Please note that the search term has to be URL encoded.
$item_types = 'item_types_example'; // string | A comma-separated string array. The type of items to perform the search from. Defaults to all.
$fields = 'fields_example'; // string | A comma-separated string array. The fields to perform the search from. Defaults to all. Relevant for each item type are:<br> <table> <tr><th><b>Item type</b></th><th><b>Field</b></th></tr> <tr><td>Deal</td><td>`custom_fields`, `notes`, `title`</td></tr> <tr><td>Person</td><td>`custom_fields`, `email`, `name`, `notes`, `phone`</td></tr> <tr><td>Organization</td><td>`address`, `custom_fields`, `name`, `notes`</td></tr> <tr><td>Product</td><td>`code`, `custom_fields`, `name`</td></tr> <tr><td>Lead</td><td>`custom_fields`, `notes`, `email`, `organization_name`, `person_name`, `phone`, `title`</td></tr> <tr><td>File</td><td>`name`</td></tr> <tr><td>Mail attachment</td><td>`name`</td></tr> <tr><td>Project</td><td> `custom_fields`, `notes`, `title`, `description` </td></tr> </table> <br> Only the following custom field types are searchable: `address`, `varchar`, `text`, `varchar_auto`, `double`, `monetary` and `phone`. Read more about searching by custom fields <a href=\"https://support.pipedrive.com/en/article/search-finding-what-you-need#searching-by-custom-fields\" target=\"_blank\" rel=\"noopener noreferrer\">here</a>.<br/> When searching for leads, the email, organization_name, person_name, and phone fields will return results only for leads not linked to contacts. For searching leads by person or organization values, please use `search_for_related_items`.
$search_for_related_items = True; // bool | When enabled, the response will include up to 100 newest related leads and 100 newest related deals for each found person and organization and up to 100 newest related persons for each found organization
$exact_match = True; // bool | When enabled, only full exact matches against the given term are returned. It is <b>not</b> case sensitive.
$include_fields = 'include_fields_example'; // string | A comma-separated string array. Supports including optional fields in the results which are not provided by default.
$limit = 100; // int | For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.
$cursor = 'cursor_example'; // string | For pagination, the marker (an opaque string value) representing the first item on the next page

try {
    $result = $apiInstance->searchItem($term, $item_types, $fields, $search_for_related_items, $exact_match, $include_fields, $limit, $cursor);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ItemSearchApi->searchItem: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **term** | **string**| The search term to look for. Minimum 2 characters (or 1 if using &#x60;exact_match&#x60;). Please note that the search term has to be URL encoded. |
 **item_types** | **string**| A comma-separated string array. The type of items to perform the search from. Defaults to all. | [optional]
 **fields** | **string**| A comma-separated string array. The fields to perform the search from. Defaults to all. Relevant for each item type are:&lt;br&gt; &lt;table&gt; &lt;tr&gt;&lt;th&gt;&lt;b&gt;Item type&lt;/b&gt;&lt;/th&gt;&lt;th&gt;&lt;b&gt;Field&lt;/b&gt;&lt;/th&gt;&lt;/tr&gt; &lt;tr&gt;&lt;td&gt;Deal&lt;/td&gt;&lt;td&gt;&#x60;custom_fields&#x60;, &#x60;notes&#x60;, &#x60;title&#x60;&lt;/td&gt;&lt;/tr&gt; &lt;tr&gt;&lt;td&gt;Person&lt;/td&gt;&lt;td&gt;&#x60;custom_fields&#x60;, &#x60;email&#x60;, &#x60;name&#x60;, &#x60;notes&#x60;, &#x60;phone&#x60;&lt;/td&gt;&lt;/tr&gt; &lt;tr&gt;&lt;td&gt;Organization&lt;/td&gt;&lt;td&gt;&#x60;address&#x60;, &#x60;custom_fields&#x60;, &#x60;name&#x60;, &#x60;notes&#x60;&lt;/td&gt;&lt;/tr&gt; &lt;tr&gt;&lt;td&gt;Product&lt;/td&gt;&lt;td&gt;&#x60;code&#x60;, &#x60;custom_fields&#x60;, &#x60;name&#x60;&lt;/td&gt;&lt;/tr&gt; &lt;tr&gt;&lt;td&gt;Lead&lt;/td&gt;&lt;td&gt;&#x60;custom_fields&#x60;, &#x60;notes&#x60;, &#x60;email&#x60;, &#x60;organization_name&#x60;, &#x60;person_name&#x60;, &#x60;phone&#x60;, &#x60;title&#x60;&lt;/td&gt;&lt;/tr&gt; &lt;tr&gt;&lt;td&gt;File&lt;/td&gt;&lt;td&gt;&#x60;name&#x60;&lt;/td&gt;&lt;/tr&gt; &lt;tr&gt;&lt;td&gt;Mail attachment&lt;/td&gt;&lt;td&gt;&#x60;name&#x60;&lt;/td&gt;&lt;/tr&gt; &lt;tr&gt;&lt;td&gt;Project&lt;/td&gt;&lt;td&gt; &#x60;custom_fields&#x60;, &#x60;notes&#x60;, &#x60;title&#x60;, &#x60;description&#x60; &lt;/td&gt;&lt;/tr&gt; &lt;/table&gt; &lt;br&gt; Only the following custom field types are searchable: &#x60;address&#x60;, &#x60;varchar&#x60;, &#x60;text&#x60;, &#x60;varchar_auto&#x60;, &#x60;double&#x60;, &#x60;monetary&#x60; and &#x60;phone&#x60;. Read more about searching by custom fields &lt;a href&#x3D;\&quot;https://support.pipedrive.com/en/article/search-finding-what-you-need#searching-by-custom-fields\&quot; target&#x3D;\&quot;_blank\&quot; rel&#x3D;\&quot;noopener noreferrer\&quot;&gt;here&lt;/a&gt;.&lt;br/&gt; When searching for leads, the email, organization_name, person_name, and phone fields will return results only for leads not linked to contacts. For searching leads by person or organization values, please use &#x60;search_for_related_items&#x60;. | [optional]
 **search_for_related_items** | **bool**| When enabled, the response will include up to 100 newest related leads and 100 newest related deals for each found person and organization and up to 100 newest related persons for each found organization | [optional]
 **exact_match** | **bool**| When enabled, only full exact matches against the given term are returned. It is &lt;b&gt;not&lt;/b&gt; case sensitive. | [optional]
 **include_fields** | **string**| A comma-separated string array. Supports including optional fields in the results which are not provided by default. | [optional]
 **limit** | **int**| For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed. | [optional]
 **cursor** | **string**| For pagination, the marker (an opaque string value) representing the first item on the next page | [optional]

### Return type

[**\Pipedrive\versions\v2\Model\ItemSearchResponse**](../Model/ItemSearchResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../../../README.md#models)
[[Back to README]](../../../../README.md)

## `searchItemByField()`

```php
searchItemByField($term, $entity_type, $field, $match, $limit, $cursor): \Pipedrive\versions\v2\Model\ItemSearchFieldResponse
```

Perform a search using a specific field from an item type

Performs a search from the values of a specific field. Results can either be the distinct values of the field (useful for searching autocomplete field values), or the IDs of actual items (deals, leads, persons, organizations or products).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: api_key
$config = (new Pipedrive\versions\v2\Configuration())->setApiKey('api_token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = (new Pipedrive\versions\v2\Configuration())->setApiKeyPrefix('api_token', 'Bearer');

// Configure OAuth2 access token for authorization: oauth2
$config = (new Pipedrive\versions\v2\Configuration())->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Pipedrive\versions\v2\Api\ItemSearchApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term = 'term_example'; // string | The search term to look for. Minimum 2 characters (or 1 if `match` is `exact`). Please note that the search term has to be URL encoded.
$entity_type = 'entity_type_example'; // string | The type of the field to perform the search from
$field = 'field_example'; // string | The key of the field to search from. The field key can be obtained by fetching the list of the fields using any of the fields' API GET methods (dealFields, personFields, etc.). Only the following custom field types are searchable: `address`, `varchar`, `text`, `varchar_auto`, `double`, `monetary` and `phone`. Read more about searching by custom fields <a href=\"https://support.pipedrive.com/en/article/search-finding-what-you-need#searching-by-custom-fields\" target=\"_blank\" rel=\"noopener noreferrer\">here</a>.
$match = 'exact'; // string | The type of match used against the term. The search <b>is</b> case sensitive.<br/><br/> E.g. in case of searching for a value `monkey`, <ul> <li>with `exact` match, you will only find it if term is `monkey`</li> <li>with `beginning` match, you will only find it if the term matches the beginning or the whole string, e.g. `monk` and `monkey`</li> <li>with `middle` match, you will find the it if the term matches any substring of the value, e.g. `onk` and `ke`</li> </ul>.
$limit = 100; // int | For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.
$cursor = 'cursor_example'; // string | For pagination, the marker (an opaque string value) representing the first item on the next page

try {
    $result = $apiInstance->searchItemByField($term, $entity_type, $field, $match, $limit, $cursor);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ItemSearchApi->searchItemByField: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **term** | **string**| The search term to look for. Minimum 2 characters (or 1 if &#x60;match&#x60; is &#x60;exact&#x60;). Please note that the search term has to be URL encoded. |
 **entity_type** | **string**| The type of the field to perform the search from |
 **field** | **string**| The key of the field to search from. The field key can be obtained by fetching the list of the fields using any of the fields&#39; API GET methods (dealFields, personFields, etc.). Only the following custom field types are searchable: &#x60;address&#x60;, &#x60;varchar&#x60;, &#x60;text&#x60;, &#x60;varchar_auto&#x60;, &#x60;double&#x60;, &#x60;monetary&#x60; and &#x60;phone&#x60;. Read more about searching by custom fields &lt;a href&#x3D;\&quot;https://support.pipedrive.com/en/article/search-finding-what-you-need#searching-by-custom-fields\&quot; target&#x3D;\&quot;_blank\&quot; rel&#x3D;\&quot;noopener noreferrer\&quot;&gt;here&lt;/a&gt;. |
 **match** | **string**| The type of match used against the term. The search &lt;b&gt;is&lt;/b&gt; case sensitive.&lt;br/&gt;&lt;br/&gt; E.g. in case of searching for a value &#x60;monkey&#x60;, &lt;ul&gt; &lt;li&gt;with &#x60;exact&#x60; match, you will only find it if term is &#x60;monkey&#x60;&lt;/li&gt; &lt;li&gt;with &#x60;beginning&#x60; match, you will only find it if the term matches the beginning or the whole string, e.g. &#x60;monk&#x60; and &#x60;monkey&#x60;&lt;/li&gt; &lt;li&gt;with &#x60;middle&#x60; match, you will find the it if the term matches any substring of the value, e.g. &#x60;onk&#x60; and &#x60;ke&#x60;&lt;/li&gt; &lt;/ul&gt;. | [optional] [default to &#39;exact&#39;]
 **limit** | **int**| For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed. | [optional]
 **cursor** | **string**| For pagination, the marker (an opaque string value) representing the first item on the next page | [optional]

### Return type

[**\Pipedrive\versions\v2\Model\ItemSearchFieldResponse**](../Model/ItemSearchFieldResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../../../README.md#models)
[[Back to README]](../../../../README.md)
