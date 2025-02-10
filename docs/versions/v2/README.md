# Pipedrive client for API v2

## Getting started

Please follow the [installation procedure](#installation--usage) and then run the following:

### With a pre-set API token

```php
<?php

use Pipedrive\versions\v2\Configuration;

require_once('/path/to/client/vendor/autoload.php');

// Configure API key authorization: api_key
$config = (new Pipedrive\versions\v2\Configuration())->setApiKey('api_token', 'YOUR_API_KEY');

$apiInstance = new Pipedrive\versions\v2\Api\ActivitiesApi(
// If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
// This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getActivities();
    echo '<pre>';
    print_r($result);
    echo '</pre>';
} catch (Exception $e) {
    echo 'Exception when calling ActivitiesApi->getActivities: ', $e->getMessage(), PHP_EOL;
}

?>
```

### With OAuth 2.0

In order to setup authentication in the API client, you need the following information:

| Parameter | Description |
|-----------|-------------|
| oAuthClientId | OAuth 2.0 Client ID |
| oAuthClientSecret | OAuth 2.0 Client Secret |
| oAuthRedirectUri | OAuth 2.0 Redirection endpoint or Callback Uri |


The API client can be initialized as following:

```php
$oAuthClientId = 'oAuthClientId'; // OAuth 2 Client ID
$oAuthClientSecret = 'oAuthClientSecret'; // OAuth 2 Client Secret
$oAuthRedirectUri = 'https://example.com/oauth/callback'; // OAuth 2 Redirection endpoint or Callback Uri

$config = (new Pipedrive\versions\v2\Configuration());
$config->setClientId($oAuthClientId);
$config->setClientSecret($oAuthClientSecret);
$config->setOauthRedirectUri($oAuthRedirectUri);

$dealsApiInstance = new DealsApi(null, $config);
```

You must now authorize the client.

### Authorizing your client

Your application must obtain user authorization before it can execute an endpoint call.
The SDK uses *OAuth 2.0 authorization* to obtain a user's consent to perform an API request on the user's behalf.

#### 1. Obtain user consent

To obtain user consent, you must redirect the user to the authorization page. The `getAuthorizationPageUrl()` method creates the URL to the authorization page when you have clientID and OAuthRedirect set in $config
```php
$authUrl = $config->getAuthorizationPageUrl();
header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
```

#### 2. Handle the OAuth server response

Once the user responds to the consent request, the OAuth 2.0 server responds to your application's access request by redirecting the user to the redirect URI specified in `Configuration`.

If the user approves the request, the authorization code will be sent as the `code` query string:

```
https://example.com/oauth/callback?code=XXXXXXXXXXXXXXXXXXXXXXXXX
```

If the user does not approve the request, the response contains an `error` query string:

```
https://example.com/oauth/callback?error=access_denied
```

#### 3. Authorize the client using the code

After the server receives the code, it can exchange this for an *access token*. The access token is an object containing information for authorizing client requests and refreshing the token itself.

```php
try {
    $config->authorize($_GET['code']);
} catch (Exception $ex) {
    // handle exception
}
```

### Refreshing the token

An access token may expire after sometime. To extend its lifetime, you must refresh the token.

```php
if ($configuration->getExpiresAt() < time()) {
    try {
        $config->refreshToken();
    } catch (Exception $ex) {
        // handle exception
    }
}
```

If a token expires, the SDK will attempt to automatically refresh the token before the next endpoint call requiring authentication.

### Storing an access token for reuse

It is recommended that you store the access token for reuse.

You can store the access token in the `$_SESSION` global or any other persistent storage:

```php
// store token
$_SESSION['access_token'] = $config->getAccessToken();
```

However, since the SDK will attempt to automatically refresh the token when it expires, it is recommended that you register a *token update callback* to detect any change to the access token.

```php
$config->setOAuthTokenUpdateCallback(function ($token) {
    $_SESSION['token'] = $token;
});
```

The token update callback will be fired upon authorization as well as token refresh.

### Creating a client from a stored token

To authorize a client from a stored access token, just set the access token in `Configuration` along with the other configuration parameters before creating the client:

```php
// load token later...
$config->setAccessToken($_SESSION['token']->access_token);

// If you want to set all of the OAuth2 related fields at once from the token gotten from Pipedrive OAuth server
// you can use the updateOAuthRelatedFields() function
$config->updateOAuthRelatedFields($_SESSION['token']);
// This will set the access token, expiresIn, expiresAt, scope and host attributes in the Configuration class
// In order to get automatic access token refreshing, you will still need the client ID, client secret and redirectURI

// Set other configuration, then instantiate client
$activitiesApiInstance = new ActivitiesApi(null, $config);
```

### Revoke token

When there is a need for an application to indicate to the authorization server that user token should be invalidated, use the `revokeToken` method with provided `hint` argument value:

```php
$config = (new Pipedrive\versions\v2\Configuration());
$config->updateOAuthRelatedFields(/* ... */);
```

When configuration is set, just call the method:

```php
// this will revoke all user tokens
$config->revokeToken('refresh_token');

/* OR */

// this will revoke only access token
$config->revokeToken('access_token');
```

### Complete example with OAuth

In this example, the `index.php` will first check if an access token is available for the user. If one is not set, it redirects the user to `authcallback.php` which will obtain an access token and redirect the user back to the `index.php` page.
Now that an access token is set, `index.php` can use the client to make authorized calls to the server.

#### `index.php`

```php
<?php

use Pipedrive\versions\v2\Api\DealsApi;
use Pipedrive\versions\v2\Configuration;

require_once('../../sdks/php/vendor/autoload.php');

session_start();

$config = (new Pipedrive\versions\v2\Configuration());
$config->setOauthRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/authcallback.php');
$config->setClientSecret('YOUR_CLIENT_SECRET');
$config->setClientId('YOUR_CLIENT_ID');

//$usersApiInstance = new UsersApi(null, $config);
$dealsApiInstance = new DealsApi(null, $config);

// check if a token is available
if (isset($_SESSION['token']) && $_SESSION['token']) {
    // set access token in configuration
    $config->updateOAuthRelatedFields($_SESSION['token']);

    try {
        $dealsResponse = $dealsApiInstance->getDeals();
        echo '<pre>';
        print_r($dealsResponse);
        echo '</pre>';
    } catch (Exception $e) {
        echo 'Exception when trying to get deals data', $e, PHP_EOL;
    }
} else {
    header('Location: ' . filter_var($config->getAuthorizationPageUrl(), FILTER_SANITIZE_URL));
}
```

#### `authcallback.php`

```php
<?php
require_once('../../sdks/php/vendor/autoload.php');

use Pipedrive\versions\v2\Configuration;

session_start();

$config = (new Pipedrive\versions\v2\Configuration());

$config->setOauthRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/authcallback.php');
$config->setClientSecret('YOUR_CLIENT_SECRET');
$config->setClientId('YOUR_CLIENT_ID');
$config->setAuthorizationPageUrl('https://oauth.pipedrive.com/oauth/authorize?client_id=YOUR_CLIENT_ID&redirect_uri=http%3A%2F%2Flocalhost%3A8081%2Fauthcallback.php');

$config->setOAuthTokenUpdateCallback(function ($token) {
    $_SESSION['token'] = $token;
});

// if authorization code is absent, redirect to authorization page
if (!isset($_GET['code'])) {
    header('Location: ' . filter_var($config->getAuthorizationPageUrl(), FILTER_SANITIZE_URL));
} else {
    try {
        $config->authorize($_GET['code']);

        // resume user activity
        $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    } catch (Exception $ex) {
        print_r($ex);
    }
}
```
## Documentation for API endpoints

All URIs are relative to *https://api.pipedrive.com/api/v2*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*ActivitiesApi* | [**addActivity**](docs/Api/ActivitiesApi.md#addactivity) | **POST** /activities | Add a new activity
*ActivitiesApi* | [**deleteActivity**](docs/Api/ActivitiesApi.md#deleteactivity) | **DELETE** /activities/{id} | Delete an activity
*ActivitiesApi* | [**getActivities**](docs/Api/ActivitiesApi.md#getactivities) | **GET** /activities | Get all activities
*ActivitiesApi* | [**getActivity**](docs/Api/ActivitiesApi.md#getactivity) | **GET** /activities/{id} | Get details of an activity
*ActivitiesApi* | [**updateActivity**](docs/Api/ActivitiesApi.md#updateactivity) | **PATCH** /activities/{id} | Update an activity
*BetaApi* | [**addActivity**](docs/Api/BetaApi.md#addactivity) | **POST** /activities | Add a new activity
*BetaApi* | [**addDeal**](docs/Api/BetaApi.md#adddeal) | **POST** /deals | Add a new deal
*BetaApi* | [**addDealProduct**](docs/Api/BetaApi.md#adddealproduct) | **POST** /deals/{id}/products | Add a product to a deal
*BetaApi* | [**addOrganization**](docs/Api/BetaApi.md#addorganization) | **POST** /organizations | Add a new organization
*BetaApi* | [**addPerson**](docs/Api/BetaApi.md#addperson) | **POST** /persons | Add a new person
*BetaApi* | [**deleteActivity**](docs/Api/BetaApi.md#deleteactivity) | **DELETE** /activities/{id} | Delete an activity
*BetaApi* | [**deleteAdditionalDiscount**](docs/Api/BetaApi.md#deleteadditionaldiscount) | **DELETE** /deals/{id}/discounts/{discount_id} | Delete a discount from a deal
*BetaApi* | [**deleteDeal**](docs/Api/BetaApi.md#deletedeal) | **DELETE** /deals/{id} | Delete a deal
*BetaApi* | [**deleteDealProduct**](docs/Api/BetaApi.md#deletedealproduct) | **DELETE** /deals/{id}/products/{product_attachment_id} | Delete an attached product from a deal
*BetaApi* | [**deleteOrganization**](docs/Api/BetaApi.md#deleteorganization) | **DELETE** /organizations/{id} | Delete a organization
*BetaApi* | [**deletePerson**](docs/Api/BetaApi.md#deleteperson) | **DELETE** /persons/{id} | Delete a person
*BetaApi* | [**getActivities**](docs/Api/BetaApi.md#getactivities) | **GET** /activities | Get all activities
*BetaApi* | [**getActivity**](docs/Api/BetaApi.md#getactivity) | **GET** /activities/{id} | Get details of an activity
*BetaApi* | [**getAdditionalDiscounts**](docs/Api/BetaApi.md#getadditionaldiscounts) | **GET** /deals/{id}/discounts | List discounts added to a deal
*BetaApi* | [**getDeal**](docs/Api/BetaApi.md#getdeal) | **GET** /deals/{id} | Get details of a deal
*BetaApi* | [**getDealProducts**](docs/Api/BetaApi.md#getdealproducts) | **GET** /deals/{id}/products | List products attached to a deal
*BetaApi* | [**getDeals**](docs/Api/BetaApi.md#getdeals) | **GET** /deals | Get all deals
*BetaApi* | [**getDealsProducts**](docs/Api/BetaApi.md#getdealsproducts) | **GET** /deals/products | Get deal products of several deals
*BetaApi* | [**getOrganization**](docs/Api/BetaApi.md#getorganization) | **GET** /organizations/{id} | Get details of a organization
*BetaApi* | [**getOrganizations**](docs/Api/BetaApi.md#getorganizations) | **GET** /organizations | Get all organizations
*BetaApi* | [**getPerson**](docs/Api/BetaApi.md#getperson) | **GET** /persons/{id} | Get details of a person
*BetaApi* | [**getPersons**](docs/Api/BetaApi.md#getpersons) | **GET** /persons | Get all persons
*BetaApi* | [**postAdditionalDiscount**](docs/Api/BetaApi.md#postadditionaldiscount) | **POST** /deals/{id}/discounts | Add a discount to a deal
*BetaApi* | [**searchDeals**](docs/Api/BetaApi.md#searchdeals) | **GET** /deals/search | Search deals
*BetaApi* | [**searchItem**](docs/Api/BetaApi.md#searchitem) | **GET** /itemSearch | Perform a search from multiple item types
*BetaApi* | [**searchItemByField**](docs/Api/BetaApi.md#searchitembyfield) | **GET** /itemSearch/field | Perform a search using a specific field from an item type
*BetaApi* | [**searchLeads**](docs/Api/BetaApi.md#searchleads) | **GET** /leads/search | Search leads
*BetaApi* | [**searchOrganization**](docs/Api/BetaApi.md#searchorganization) | **GET** /organizations/search | Search organizations
*BetaApi* | [**searchPersons**](docs/Api/BetaApi.md#searchpersons) | **GET** /persons/search | Search persons
*BetaApi* | [**updateActivity**](docs/Api/BetaApi.md#updateactivity) | **PATCH** /activities/{id} | Update an activity
*BetaApi* | [**updateAdditionalDiscount**](docs/Api/BetaApi.md#updateadditionaldiscount) | **PATCH** /deals/{id}/discounts/{discount_id} | Update a discount added to a deal
*BetaApi* | [**updateDeal**](docs/Api/BetaApi.md#updatedeal) | **PATCH** /deals/{id} | Update a deal
*BetaApi* | [**updateDealProduct**](docs/Api/BetaApi.md#updatedealproduct) | **PATCH** /deals/{id}/products/{product_attachment_id} | Update the product attached to a deal
*BetaApi* | [**updateOrganization**](docs/Api/BetaApi.md#updateorganization) | **PATCH** /organizations/{id} | Update a organization
*BetaApi* | [**updatePerson**](docs/Api/BetaApi.md#updateperson) | **PATCH** /persons/{id} | Update a person
*DealsApi* | [**addDeal**](docs/Api/DealsApi.md#adddeal) | **POST** /deals | Add a new deal
*DealsApi* | [**addDealProduct**](docs/Api/DealsApi.md#adddealproduct) | **POST** /deals/{id}/products | Add a product to a deal
*DealsApi* | [**deleteAdditionalDiscount**](docs/Api/DealsApi.md#deleteadditionaldiscount) | **DELETE** /deals/{id}/discounts/{discount_id} | Delete a discount from a deal
*DealsApi* | [**deleteDeal**](docs/Api/DealsApi.md#deletedeal) | **DELETE** /deals/{id} | Delete a deal
*DealsApi* | [**deleteDealProduct**](docs/Api/DealsApi.md#deletedealproduct) | **DELETE** /deals/{id}/products/{product_attachment_id} | Delete an attached product from a deal
*DealsApi* | [**getAdditionalDiscounts**](docs/Api/DealsApi.md#getadditionaldiscounts) | **GET** /deals/{id}/discounts | List discounts added to a deal
*DealsApi* | [**getDeal**](docs/Api/DealsApi.md#getdeal) | **GET** /deals/{id} | Get details of a deal
*DealsApi* | [**getDealProducts**](docs/Api/DealsApi.md#getdealproducts) | **GET** /deals/{id}/products | List products attached to a deal
*DealsApi* | [**getDeals**](docs/Api/DealsApi.md#getdeals) | **GET** /deals | Get all deals
*DealsApi* | [**getDealsProducts**](docs/Api/DealsApi.md#getdealsproducts) | **GET** /deals/products | Get deal products of several deals
*DealsApi* | [**postAdditionalDiscount**](docs/Api/DealsApi.md#postadditionaldiscount) | **POST** /deals/{id}/discounts | Add a discount to a deal
*DealsApi* | [**searchDeals**](docs/Api/DealsApi.md#searchdeals) | **GET** /deals/search | Search deals
*DealsApi* | [**updateAdditionalDiscount**](docs/Api/DealsApi.md#updateadditionaldiscount) | **PATCH** /deals/{id}/discounts/{discount_id} | Update a discount added to a deal
*DealsApi* | [**updateDeal**](docs/Api/DealsApi.md#updatedeal) | **PATCH** /deals/{id} | Update a deal
*DealsApi* | [**updateDealProduct**](docs/Api/DealsApi.md#updatedealproduct) | **PATCH** /deals/{id}/products/{product_attachment_id} | Update the product attached to a deal
*ItemSearchApi* | [**searchItem**](docs/Api/ItemSearchApi.md#searchitem) | **GET** /itemSearch | Perform a search from multiple item types
*ItemSearchApi* | [**searchItemByField**](docs/Api/ItemSearchApi.md#searchitembyfield) | **GET** /itemSearch/field | Perform a search using a specific field from an item type
*LeadsApi* | [**searchLeads**](docs/Api/LeadsApi.md#searchleads) | **GET** /leads/search | Search leads
*OrganizationsApi* | [**addOrganization**](docs/Api/OrganizationsApi.md#addorganization) | **POST** /organizations | Add a new organization
*OrganizationsApi* | [**deleteOrganization**](docs/Api/OrganizationsApi.md#deleteorganization) | **DELETE** /organizations/{id} | Delete a organization
*OrganizationsApi* | [**getOrganization**](docs/Api/OrganizationsApi.md#getorganization) | **GET** /organizations/{id} | Get details of a organization
*OrganizationsApi* | [**getOrganizations**](docs/Api/OrganizationsApi.md#getorganizations) | **GET** /organizations | Get all organizations
*OrganizationsApi* | [**searchOrganization**](docs/Api/OrganizationsApi.md#searchorganization) | **GET** /organizations/search | Search organizations
*OrganizationsApi* | [**updateOrganization**](docs/Api/OrganizationsApi.md#updateorganization) | **PATCH** /organizations/{id} | Update a organization
*PersonsApi* | [**addPerson**](docs/Api/PersonsApi.md#addperson) | **POST** /persons | Add a new person
*PersonsApi* | [**deletePerson**](docs/Api/PersonsApi.md#deleteperson) | **DELETE** /persons/{id} | Delete a person
*PersonsApi* | [**getPerson**](docs/Api/PersonsApi.md#getperson) | **GET** /persons/{id} | Get details of a person
*PersonsApi* | [**getPersons**](docs/Api/PersonsApi.md#getpersons) | **GET** /persons | Get all persons
*PersonsApi* | [**searchPersons**](docs/Api/PersonsApi.md#searchpersons) | **GET** /persons/search | Search persons
*PersonsApi* | [**updatePerson**](docs/Api/PersonsApi.md#updateperson) | **PATCH** /persons/{id} | Update a person
*PipelinesApi* | [**addPipeline**](docs/Api/PipelinesApi.md#addpipeline) | **POST** /pipelines | Add a new pipeline
*PipelinesApi* | [**deletePipeline**](docs/Api/PipelinesApi.md#deletepipeline) | **DELETE** /pipelines/{id} | Delete a pipeline
*PipelinesApi* | [**getPipeline**](docs/Api/PipelinesApi.md#getpipeline) | **GET** /pipelines/{id} | Get one pipeline
*PipelinesApi* | [**getPipelines**](docs/Api/PipelinesApi.md#getpipelines) | **GET** /pipelines | Get all pipelines
*PipelinesApi* | [**updatePipeline**](docs/Api/PipelinesApi.md#updatepipeline) | **PATCH** /pipelines/{id} | Update a pipeline
*ProductsApi* | [**addProduct**](docs/Api/ProductsApi.md#addproduct) | **POST** /products | Add a product
*ProductsApi* | [**addProductVariation**](docs/Api/ProductsApi.md#addproductvariation) | **POST** /products/{id}/variations | Add a product variation
*ProductsApi* | [**deleteProduct**](docs/Api/ProductsApi.md#deleteproduct) | **DELETE** /products/{id} | Delete a product
*ProductsApi* | [**deleteProductVariation**](docs/Api/ProductsApi.md#deleteproductvariation) | **DELETE** /products/{id}/variations/{product_variation_id} | Delete a product variation
*ProductsApi* | [**getProduct**](docs/Api/ProductsApi.md#getproduct) | **GET** /products/{id} | Get one product
*ProductsApi* | [**getProductVariations**](docs/Api/ProductsApi.md#getproductvariations) | **GET** /products/{id}/variations | Get all product variations
*ProductsApi* | [**getProducts**](docs/Api/ProductsApi.md#getproducts) | **GET** /products | Get all products
*ProductsApi* | [**searchProducts**](docs/Api/ProductsApi.md#searchproducts) | **GET** /products/search | Search products
*ProductsApi* | [**updateProduct**](docs/Api/ProductsApi.md#updateproduct) | **PATCH** /products/{id} | Update a product
*ProductsApi* | [**updateProductVariation**](docs/Api/ProductsApi.md#updateproductvariation) | **PATCH** /products/{id}/variations/{product_variation_id} | Update a product variation
*StagesApi* | [**addStage**](docs/Api/StagesApi.md#addstage) | **POST** /stages | Add a new stage
*StagesApi* | [**deleteStage**](docs/Api/StagesApi.md#deletestage) | **DELETE** /stages/{id} | Delete a stage
*StagesApi* | [**getStage**](docs/Api/StagesApi.md#getstage) | **GET** /stages/{id} | Get one stage
*StagesApi* | [**getStages**](docs/Api/StagesApi.md#getstages) | **GET** /stages | Get all stages
*StagesApi* | [**updateStage**](docs/Api/StagesApi.md#updatestage) | **PATCH** /stages/{id} | Update stage details


## Documentation for models

 - [ActivityItem](docs/Model/ActivityItem.md)
 - [ActivityItemAttendees](docs/Model/ActivityItemAttendees.md)
 - [ActivityItemLocation](docs/Model/ActivityItemLocation.md)
 - [ActivityItemParticipants](docs/Model/ActivityItemParticipants.md)
 - [ActivityRequestBody](docs/Model/ActivityRequestBody.md)
 - [AddAdditionalDiscountResponse](docs/Model/AddAdditionalDiscountResponse.md)
 - [AddDealProductResponse](docs/Model/AddDealProductResponse.md)
 - [AddProductRequestBody](docs/Model/AddProductRequestBody.md)
 - [AdditionalDataWithCursorPagination](docs/Model/AdditionalDataWithCursorPagination.md)
 - [AdditionalDiscountRequestBody](docs/Model/AdditionalDiscountRequestBody.md)
 - [AdditionalDiscountsResponse](docs/Model/AdditionalDiscountsResponse.md)
 - [ArrayPrices](docs/Model/ArrayPrices.md)
 - [BaseAdditionalDiscount](docs/Model/BaseAdditionalDiscount.md)
 - [BaseDealProduct](docs/Model/BaseDealProduct.md)
 - [BaseDealProductAllOf](docs/Model/BaseDealProductAllOf.md)
 - [BaseDealProductAllOf1](docs/Model/BaseDealProductAllOf1.md)
 - [BaseDealProductAllOf2](docs/Model/BaseDealProductAllOf2.md)
 - [BaseDealProductAllOf3](docs/Model/BaseDealProductAllOf3.md)
 - [BaseProduct](docs/Model/BaseProduct.md)
 - [BaseProductAllOf](docs/Model/BaseProductAllOf.md)
 - [BaseProductAllOf1](docs/Model/BaseProductAllOf1.md)
 - [BaseResponse](docs/Model/BaseResponse.md)
 - [BillingFrequency](docs/Model/BillingFrequency.md)
 - [BillingFrequency1](docs/Model/BillingFrequency1.md)
 - [DealItem](docs/Model/DealItem.md)
 - [DealProductRequestBody](docs/Model/DealProductRequestBody.md)
 - [DealRequestBody](docs/Model/DealRequestBody.md)
 - [DealSearchItem](docs/Model/DealSearchItem.md)
 - [DealSearchItemItem](docs/Model/DealSearchItemItem.md)
 - [DealSearchItemItemOrganization](docs/Model/DealSearchItemItemOrganization.md)
 - [DealSearchItemItemOwner](docs/Model/DealSearchItemItemOwner.md)
 - [DealSearchItemItemPerson](docs/Model/DealSearchItemItemPerson.md)
 - [DealSearchItemItemStage](docs/Model/DealSearchItemItemStage.md)
 - [DealsProductsResponse](docs/Model/DealsProductsResponse.md)
 - [DeleteActivityResponse](docs/Model/DeleteActivityResponse.md)
 - [DeleteActivityResponseData](docs/Model/DeleteActivityResponseData.md)
 - [DeleteAdditionalDiscountResponse](docs/Model/DeleteAdditionalDiscountResponse.md)
 - [DeleteAdditionalDiscountResponseData](docs/Model/DeleteAdditionalDiscountResponseData.md)
 - [DeleteDealProduct](docs/Model/DeleteDealProduct.md)
 - [DeleteDealProductData](docs/Model/DeleteDealProductData.md)
 - [DeleteDealResponse](docs/Model/DeleteDealResponse.md)
 - [DeleteDealResponseData](docs/Model/DeleteDealResponseData.md)
 - [DeleteOrganizationResponse](docs/Model/DeleteOrganizationResponse.md)
 - [DeleteOrganizationResponseData](docs/Model/DeleteOrganizationResponseData.md)
 - [DeletePersonResponse](docs/Model/DeletePersonResponse.md)
 - [DeletePersonResponseData](docs/Model/DeletePersonResponseData.md)
 - [DeletePipelineResponse](docs/Model/DeletePipelineResponse.md)
 - [DeletePipelineResponseData](docs/Model/DeletePipelineResponseData.md)
 - [DeleteProductResponse](docs/Model/DeleteProductResponse.md)
 - [DeleteProductResponseData](docs/Model/DeleteProductResponseData.md)
 - [DeleteProductVariation](docs/Model/DeleteProductVariation.md)
 - [DeleteProductVariationData](docs/Model/DeleteProductVariationData.md)
 - [DeleteStageResponse](docs/Model/DeleteStageResponse.md)
 - [DeleteStageResponseData](docs/Model/DeleteStageResponseData.md)
 - [GetActivities](docs/Model/GetActivities.md)
 - [GetActivitiesAllOf](docs/Model/GetActivitiesAllOf.md)
 - [GetDealSearchResponse](docs/Model/GetDealSearchResponse.md)
 - [GetDealSearchResponseAllOf](docs/Model/GetDealSearchResponseAllOf.md)
 - [GetDealSearchResponseAllOfData](docs/Model/GetDealSearchResponseAllOfData.md)
 - [GetDeals](docs/Model/GetDeals.md)
 - [GetDealsAllOf](docs/Model/GetDealsAllOf.md)
 - [GetItemSearchResponseData](docs/Model/GetItemSearchResponseData.md)
 - [GetItemSearchResponseDataData](docs/Model/GetItemSearchResponseDataData.md)
 - [GetLeadSearchResponseData](docs/Model/GetLeadSearchResponseData.md)
 - [GetLeadSearchResponseDataData](docs/Model/GetLeadSearchResponseDataData.md)
 - [GetOrganizationSearchResponse](docs/Model/GetOrganizationSearchResponse.md)
 - [GetOrganizationSearchResponseAllOf](docs/Model/GetOrganizationSearchResponseAllOf.md)
 - [GetOrganizationSearchResponseAllOfData](docs/Model/GetOrganizationSearchResponseAllOfData.md)
 - [GetOrganizations](docs/Model/GetOrganizations.md)
 - [GetOrganizationsAllOf](docs/Model/GetOrganizationsAllOf.md)
 - [GetPersons](docs/Model/GetPersons.md)
 - [GetPersonsAllOf](docs/Model/GetPersonsAllOf.md)
 - [GetPipelines](docs/Model/GetPipelines.md)
 - [GetPipelinesAllOf](docs/Model/GetPipelinesAllOf.md)
 - [GetStages](docs/Model/GetStages.md)
 - [ItemSearchFieldResponse](docs/Model/ItemSearchFieldResponse.md)
 - [ItemSearchFieldResponseAllOf](docs/Model/ItemSearchFieldResponseAllOf.md)
 - [ItemSearchItem](docs/Model/ItemSearchItem.md)
 - [ItemSearchResponse](docs/Model/ItemSearchResponse.md)
 - [LeadSearchItem](docs/Model/LeadSearchItem.md)
 - [LeadSearchItemItem](docs/Model/LeadSearchItemItem.md)
 - [LeadSearchItemItemOrganization](docs/Model/LeadSearchItemItemOrganization.md)
 - [LeadSearchItemItemOwner](docs/Model/LeadSearchItemItemOwner.md)
 - [LeadSearchItemItemPerson](docs/Model/LeadSearchItemItemPerson.md)
 - [LeadSearchResponse](docs/Model/LeadSearchResponse.md)
 - [NameObject](docs/Model/NameObject.md)
 - [NewDealProductRequestBody](docs/Model/NewDealProductRequestBody.md)
 - [OrganizationItem](docs/Model/OrganizationItem.md)
 - [OrganizationItemAddress](docs/Model/OrganizationItemAddress.md)
 - [OrganizationRequestBody](docs/Model/OrganizationRequestBody.md)
 - [OrganizationSearchItem](docs/Model/OrganizationSearchItem.md)
 - [OrganizationSearchItemItem](docs/Model/OrganizationSearchItemItem.md)
 - [PersonItem](docs/Model/PersonItem.md)
 - [PersonItemEmails](docs/Model/PersonItemEmails.md)
 - [PersonItemIm](docs/Model/PersonItemIm.md)
 - [PersonItemPhones](docs/Model/PersonItemPhones.md)
 - [PersonItemPostalAddress](docs/Model/PersonItemPostalAddress.md)
 - [PersonRequestBody](docs/Model/PersonRequestBody.md)
 - [PersonRequestBodyEmails](docs/Model/PersonRequestBodyEmails.md)
 - [PersonRequestBodyPhones](docs/Model/PersonRequestBodyPhones.md)
 - [PersonSearchItem](docs/Model/PersonSearchItem.md)
 - [PersonSearchItemItem](docs/Model/PersonSearchItemItem.md)
 - [PersonSearchItemItemOrganization](docs/Model/PersonSearchItemItemOrganization.md)
 - [PersonSearchItemItemOwner](docs/Model/PersonSearchItemItemOwner.md)
 - [PersonSearchResponse](docs/Model/PersonSearchResponse.md)
 - [PersonSearchResponseAllOf](docs/Model/PersonSearchResponseAllOf.md)
 - [PersonSearchResponseAllOfData](docs/Model/PersonSearchResponseAllOfData.md)
 - [PipelineItem](docs/Model/PipelineItem.md)
 - [PipelineRequestBody](docs/Model/PipelineRequestBody.md)
 - [PostPatchGetActivity](docs/Model/PostPatchGetActivity.md)
 - [PostPatchGetDeal](docs/Model/PostPatchGetDeal.md)
 - [PostPatchGetOrganization](docs/Model/PostPatchGetOrganization.md)
 - [PostPatchGetPerson](docs/Model/PostPatchGetPerson.md)
 - [PostPatchGetPipeline](docs/Model/PostPatchGetPipeline.md)
 - [PostPatchGetStage](docs/Model/PostPatchGetStage.md)
 - [ProductRequest](docs/Model/ProductRequest.md)
 - [ProductResponse](docs/Model/ProductResponse.md)
 - [ProductSearchItem](docs/Model/ProductSearchItem.md)
 - [ProductSearchItemItem](docs/Model/ProductSearchItemItem.md)
 - [ProductSearchItemItemOwner](docs/Model/ProductSearchItemItemOwner.md)
 - [ProductSearchResponse](docs/Model/ProductSearchResponse.md)
 - [ProductSearchResponseAllOf](docs/Model/ProductSearchResponseAllOf.md)
 - [ProductSearchResponseAllOfData](docs/Model/ProductSearchResponseAllOfData.md)
 - [ProductVariation](docs/Model/ProductVariation.md)
 - [ProductVariationRequestBody](docs/Model/ProductVariationRequestBody.md)
 - [ProductVariationResponse](docs/Model/ProductVariationResponse.md)
 - [ProductVariationsResponse](docs/Model/ProductVariationsResponse.md)
 - [ProductWithArrayPrices](docs/Model/ProductWithArrayPrices.md)
 - [ProductsResponse](docs/Model/ProductsResponse.md)
 - [StageItem](docs/Model/StageItem.md)
 - [StageRequestBody](docs/Model/StageRequestBody.md)
 - [UpdateAdditionalDiscountResponse](docs/Model/UpdateAdditionalDiscountResponse.md)
 - [UpdateDealProductRequestBody](docs/Model/UpdateDealProductRequestBody.md)
 - [UpdateProductRequestBody](docs/Model/UpdateProductRequestBody.md)
 - [UpdateProductResponse](docs/Model/UpdateProductResponse.md)
 - [UpsertActivityResponseData](docs/Model/UpsertActivityResponseData.md)
 - [UpsertDealResponseData](docs/Model/UpsertDealResponseData.md)
 - [UpsertOrganizationResponseData](docs/Model/UpsertOrganizationResponseData.md)
 - [UpsertPersonResponseData](docs/Model/UpsertPersonResponseData.md)
 - [UpsertPipelineResponseData](docs/Model/UpsertPipelineResponseData.md)
 - [VisibleTo](docs/Model/VisibleTo.md)


## Documentation for authorization



## api_key


- **Type**: API key
- **API key parameter name**: api_token
- **Location**: URL query string




## basic_authentication


- **Type**: HTTP basic authentication



## oauth2


- **Type**: OAuth
- **Flow**: accessCode
- **Authorization URL**: https://oauth.pipedrive.com/oauth/authorize
- **Scopes**: 
- **base**: Read settings of the authorized user and currencies in an account
- **deals:read**: Read most of the data about deals and related entities - deal fields, products, followers, participants; all notes, files, filters, pipelines, stages, and statistics. Does not include access to activities (except the last and next activity related to a deal)
- **deals:full**: Create, read, update and delete deals, its participants and followers; all files, notes, and filters. It also includes read access to deal fields, pipelines, stages, and statistics. Does not include access to activities (except the last and next activity related to a deal)
- **mail:read**: Read mail threads and messages
- **mail:full**: Read, update and delete mail threads. Also grants read access to mail messages
- **activities:read**: Read activities, its fields and types; all files and filters
- **activities:full**: Create, read, update and delete activities and all files and filters. Also includes read access to activity fields and types
- **contacts:read**: Read the data about persons and organizations, their related fields and followers; also all notes, files, filters
- **contacts:full**: Create, read, update and delete persons and organizations and their followers; all notes, files, filters. Also grants read access to contacts-related fields
- **products:read**: Read products, its fields, files, followers and products connected to a deal
- **products:full**: Create, read, update and delete products and its fields; add products to deals
- **projects:read**: Read projects and its fields, tasks and project templates
- **projects:full**: Create, read, update and delete projects and its fields; add projects templates and project related tasks
- **users:read**: Read data about users (people with access to a Pipedrive account), their permissions, roles and followers
- **recents:read**: Read all recent changes occurred in an account. Includes data about activities, activity types, deals, files, filters, notes, persons, organizations, pipelines, stages, products and users
- **search:read**: Search across the account for deals, persons, organizations, files and products, and see details about the returned results
- **admin**: Allows to do many things that an administrator can do in a Pipedrive company account - create, read, update and delete pipelines and its stages; deal, person and organization fields; activity types; users and permissions, etc. It also allows the app to create webhooks and fetch and delete webhooks that are created by the app
- **leads:read**: Read data about leads and lead labels
- **leads:full**: Create, read, update and delete leads and lead labels
- **phone-integration**: Enables advanced call integration features like logging call duration and other metadata, and play call recordings inside Pipedrive
- **goals:read**: Read data on all goals
- **goals:full**: Create, read, update and delete goals
- **video-calls**: Allows application to register as a video call integration provider and create conference links
- **messengers-integration**: Allows application to register as a messengers integration provider and allows them to deliver incoming messages and their statuses

