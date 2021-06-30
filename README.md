# Pipedrive client for PHP based apps
Pipedrive is a sales pipeline software that gets you organized. It's a powerful sales CRM with effortless sales pipeline management. See www.pipedrive.com for details.

This is the official Pipedrive API wrapper-client for PHP based apps, distributed by Pipedrive Inc freely under the MIT licence. It provides convenient access to the Pipedrive API, allowing you to operate with objects such as Deals, Persons, Organizations, Products and much more.

> ⚠️ Version 1 is the initial release of our official php client. It provides its users access to our API in a convenient way using either API tokens or OAuth2.
>
> Please use the [issues page](https://github.com/pipedrive/client-php/issues) for reporting bugs or leaving feedback. Keep in mind most of the code is [automatically generated](https://github.com/pipedrive/client-php/#contributing).

## Installation

You can install the package via `composer require` command:

```shell
composer require pipedrive/pipedrive
```

Or simply add it to your composer.json dependences and run `composer update`:

```json
"require": {
    "pipedrive/pipedrive": "^1.0"
}
```

## API Documentation

The Pipedrive REST API documentation can be found at https://developers.pipedrive.com/v1

## Licence

This Pipedrive API client is distributed under the MIT licence.

## How to use

### With a pre-set API token

```php
<?php

require_once __DIR__.'/vendor/autoload.php';

session_start();

// Client configuration
$apiToken = 'YOUR_API_TOKEN_HERE';

$client = new Pipedrive\Client(null, null, null, $apiToken); // First 3 parameters are for OAuth2

try {
    $response = $client->getUsers()->getCurrentUserData();
    echo '<pre>';
    var_dump($response);
    echo '</pre>';
} catch (\Pipedrive\APIException $e) {
    echo $e;
}
```

### With OAuth 2

In order to setup authentication in the API client, you need the following information.

| Parameter | Description |
|-----------|-------------|
| oAuthClientId | OAuth 2 Client ID |
| oAuthClientSecret | OAuth 2 Client Secret |
| oAuthRedirectUri | OAuth 2 Redirection endpoint or Callback Uri |


API client can be initialized as following:

```php
$oAuthClientId = 'oAuthClientId'; // OAuth 2 Client ID
$oAuthClientSecret = 'oAuthClientSecret'; // OAuth 2 Client Secret
$oAuthRedirectUri = 'https://example.com/oauth/callback'; // OAuth 2 Redirection endpoint or Callback Uri

$client = new Pipedrive\Client($oAuthClientId, $oAuthClientSecret, $oAuthRedirectUri);
```

You must now authorize the client.

### Authorizing your client

Your application must obtain user authorization before it can execute an endpoint call.
The SDK uses *OAuth 2.0 authorization* to obtain a user's consent to perform an API request on user's behalf.

#### 1. Obtain user consent

To obtain user's consent, you must redirect the user to the authorization page. The `buildAuthorizationUrl()` method creates the URL to the authorization page.
```php
$authUrl = $client->auth()->buildAuthorizationUrl();
header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
```

#### 2. Handle the OAuth server response

Once the user responds to the consent request, the OAuth 2.0 server responds to your application's access request by redirecting the user to the redirect URI specified set in `Configuration`.

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
    $client->auth()->authorize($_GET['code']);
} catch (Pipedrive\Exceptions\OAuthProviderException $ex) {
    // handle exception
}
```

### Refreshing token

An access token may expire after sometime. To extend its lifetime, you must refresh the token.

```php
if ($client->auth()->isTokenExpired()) {
    try {
        $client->auth()->refreshToken();
    } catch (Pipedrive\Exceptions\OAuthProviderException $ex) {
        // handle exception
    }
}
```

If a token expires, the SDK will attempt to automatically refresh the token before the next endpoint call requiring authentication.

### Storing an access token for reuse

It is recommended that you store the access token for reuse.

You can store the access token in the `$_SESSION` global:

```php
// store token
$_SESSION['access_token'] = Pipedrive\Configuration::$oAuthToken;
```

However, since the the SDK will attempt to automatically refresh the token when it expires, it is recommended that you register a *token update callback* to detect any change to the access token.

```php
Pipedrive\Configuration::$oAuthTokenUpdateCallback = function($token) {
    // use session or some other way to persist the $token
    $_SESSION['access_token'] = $token;
};
```

The token update callback will be fired upon authorization as well as token refresh.

### Creating a client from a stored token

To authorize a client from a stored access token, just set the access token in `Configuration` along with the other configuration parameters before creating the client:

```php
// load token later...
Pipedrive\Configuration::$oAuthToken = $_SESSION['access_token'];

// Set other configuration, then instantiate client
$client = new Pipedrive\Client();
```

### Complete example with OAuth2

In this example, the `index.php` will first check if an access token is available for the user. If one is not set,
it redirects the user to `authcallback.php` which will obtain an access token and redirect the user back to the `index.php` page.
Now that an access token is set, `index.php` can use the client to make authorized calls to the server.

#### `index.php`

```php
<?php

require_once __DIR__.'/vendor/autoload.php';

session_start();

// Client configuration
$oAuthClientId = 'oAuthClientId';
$oAuthClientSecret = 'oAuthClientSecret';
$oAuthRedirectUri = 'http://' . $_SERVER['HTTP_HOST'] . '/authcallback.php';

$client = new Pipedrive\Client($oAuthClientId, $oAuthClientSecret, $oAuthRedirectUri);

// callback stores token for reuse when token is updated
Pipedrive\Configuration::$oAuthTokenUpdateCallback = function($token) {
    $_SESSION['access_token'] = $token;
};

// check if a token is available
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    // set access token in configuration
    Pipedrive\Configuration::$oAuthToken = $_SESSION['access_token'];

    try {
        $response = $client->getUsers()->getCurrentUserData();
        echo '<pre>';
        var_dump($response);
        echo '</pre>';
    } catch (\Pipedrive\APIException $e) {
        echo $e;
    }

    // now you can use $client to make endpoint calls
    // client will automatically refresh the token when it expires and call the token update callback
} else {
    // redirect user to a page that handles authorization
    header('Location: ' . filter_var($oAuthRedirectUri, FILTER_SANITIZE_URL));
}
```

#### `authcallback.php`

```php
<?php
require_once __DIR__.'/vendor/autoload.php';

session_start();

// Client configuration
$oAuthClientId = 'oAuthClientId';
$oAuthClientSecret = 'oAuthClientSecret';
$oAuthRedirectUri = 'http://' . $_SERVER['HTTP_HOST'] . '/authcallback.php';

$client = new Pipedrive\Client($oAuthClientId, $oAuthClientSecret, $oAuthRedirectUri);

// callback stores token for reuse when token is updated
Pipedrive\Configuration::$oAuthTokenUpdateCallback = function($token) {
    $_SESSION['access_token'] = $token;
};

if (! isset($_GET['code'])) {
    // if authorization code is absent, redirect to authorization page
    $authUrl = $client->auth()->buildAuthorizationUrl();
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
} else {
    try {
        // authorize client (calls token update callback as well)
        $token = $client->auth()->authorize($_GET['code']);

        // resume user activity
        $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    } catch (Pipedrive\Exceptions\OAuthProviderException $ex) {
        // handle exception
    }
}
```

## Contributing
- Run tests
- Open a pull request

Please be aware that most of the code is auto-generated. You are welcome to suggest changes and report bugs. However, any updates will have to be implemented in the underlying generator.

## How to Test

Unit tests in this SDK can be run using PHPUnit. 

1. First install the dependencies using composer including the `require-dev` dependencies.
2. Run `vendor\bin\phpunit --verbose` from commandline to execute tests. If you have 
   installed PHPUnit globally, run tests using `phpunit --verbose` instead.

You can change the PHPUnit test configuration in the `phpunit.xml` file.

# Class Reference

## <a name="list_of_controllers"></a>List of Controllers

* [ActivitiesController](#activities_controller)
* [ActivityFieldsController](#activity_fields_controller)
* [ActivityTypesController](#activity_types_controller)
* [CurrenciesController](#currencies_controller)
* [DealFieldsController](#deal_fields_controller)
* [DealsController](#deals_controller)
* [FilesController](#files_controller)
* [FiltersController](#filters_controller)
* [GlobalMessagesController](#global_messages_controller)
* [GoalsController](#goals_controller)
* [ItemSearchController](#item_search_controller)
* [MailMessagesController](#mail_messages_controller)
* [MailThreadsController](#mail_threads_controller)
* [NoteFieldsController](#note_fields_controller)
* [NotesController](#notes_controller)
* [OrganizationFieldsController](#organization_fields_controller)
* [OrganizationRelationshipsController](#organization_relationships_controller)
* [OrganizationsController](#organizations_controller)
* [PermissionSetsController](#permission_sets_controller)
* [PersonFieldsController](#person_fields_controller)
* [PersonsController](#persons_controller)
* [PipelinesController](#pipelines_controller)
* [ProductFieldsController](#product_fields_controller)
* [ProductsController](#products_controller)
* [RecentsController](#recents_controller)
* [RolesController](#roles_controller)
* [SearchResultsController](#search_results_controller)
* [StagesController](#stages_controller)
* [TeamsController](#teams_controller)
* [UserConnectionsController](#user_connections_controller)
* [UserSettingsController](#user_settings_controller)
* [UsersController](#users_controller)
* [WebhooksController](#webhooks_controller)

## <a name="activities_controller"></a>![Class: ](https://apidocs.io/img/class.png ".ActivitiesController") ActivitiesController

### Get singleton instance

The singleton instance of the ``` ActivitiesController ``` class can be accessed from the API Client.

```php
$activities = $client->getActivities();
```

### <a name="delete_multiple_activities_in_bulk"></a>![Method: ](https://apidocs.io/img/method.png ".ActivitiesController.deleteMultipleActivitiesInBulk") deleteMultipleActivitiesInBulk

> Marks multiple activities as deleted.


```php
function deleteMultipleActivitiesInBulk($ids)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| ids |  ``` Required ```  | Comma-separated IDs that will be deleted |



#### Example Usage

```php
$ids = 'ids';

$activities->deleteMultipleActivitiesInBulk($ids);

```


### <a name="get_all_activities_assigned_to_a_particular_user"></a>![Method: ](https://apidocs.io/img/method.png ".ActivitiesController.getAllActivitiesAssignedToAParticularUser") getAllActivitiesAssignedToAParticularUser

> Returns all activities assigned to a particular user.


```php
function getAllActivitiesAssignedToAParticularUser($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| userId |  ``` Optional ```  | ID of the user whose activities will be fetched. If omitted, the user associated with the API token will be used. If 0, activities for all company users will be fetched based on the permission sets. |
| filterId |  ``` Optional ```  | ID of the filter to use (will narrow down results if used together with user_id parameter). |
| type |  ``` Optional ```  | Type of the activity, can be one type or multiple types separated by a comma. This is in correlation with the key_string parameter of ActivityTypes. |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |
| startDate |  ``` Optional ```  | Date in format of YYYY-MM-DD from which activities to fetch from. |
| endDate |  ``` Optional ```  | Date in format of YYYY-MM-DD until which activities to fetch to. |
| done |  ``` Optional ```  | Whether the activity is done or not. 0 = Not done, 1 = Done. If omitted returns both Done and Not done activities. |



#### Example Usage

```php
$userId = 119;
$collect['userId'] = $userId;

$filterId = 119;
$collect['filterId'] = $filterId;

$type = 'type';
$collect['type'] = $type;

$start = 0;
$collect['start'] = $start;

$limit = 119;
$collect['limit'] = $limit;

$startDate = date("D M d, Y G:i");
$collect['startDate'] = $startDate;

$endDate = date("D M d, Y G:i");
$collect['endDate'] = $endDate;

$done = int::ENUM_0;
$collect['done'] = $done;


$activities->getAllActivitiesAssignedToAParticularUser($collect);

```


### <a name="add_an_activity"></a>![Method: ](https://apidocs.io/img/method.png ".ActivitiesController.addAnActivity") addAnActivity

> Adds a new activity. Includes more_activities_scheduled_in_context property in response's additional_data which indicates whether there are more undone activities scheduled with the same deal, person or organization (depending on the supplied data). For more information on how to add an activity, see <a href="https://pipedrive.readme.io/docs/adding-an-activity" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function addAnActivity($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| subject |  ``` Required ```  | Subject of the activity |
| type |  ``` Required ```  | Type of the activity. This is in correlation with the key_string parameter of ActivityTypes. |
| done |  ``` Optional ```  | TODO: Add a parameter description |
| dueDate |  ``` Optional ```  | Due date of the activity. Format: YYYY-MM-DD |
| dueTime |  ``` Optional ```  | Due time of the activity in UTC. Format: HH:MM |
| duration |  ``` Optional ```  | Duration of the activity. Format: HH:MM |
| userId |  ``` Optional ```  | ID of the user whom the activity will be assigned to. If omitted, the activity will be assigned to the authorized user. |
| dealId |  ``` Optional ```  | ID of the deal this activity will be associated with |
| personId |  ``` Optional ```  | ID of the person this activity will be associated with |
| participants |  ``` Optional ```  | List of multiple persons (participants) this activity will be associated with. If omitted, single participant from person_id field is used. It requires a structure as follows: [{"person_id":1,"primary_flag":true}] |
| orgId |  ``` Optional ```  | ID of the organization this activity will be associated with |
| note |  ``` Optional ```  | Note of the activity (HTML format) |



#### Example Usage

```php
$subject = 'subject';
$collect['subject'] = $subject;

$type = 'type';
$collect['type'] = $type;

$done = int::ENUM_0;
$collect['done'] = $done;

$dueDate = date("D M d, Y G:i");
$collect['dueDate'] = $dueDate;

$dueTime = 'due_time';
$collect['dueTime'] = $dueTime;

$duration = 'duration';
$collect['duration'] = $duration;

$userId = 119;
$collect['userId'] = $userId;

$dealId = 119;
$collect['dealId'] = $dealId;

$personId = 119;
$collect['personId'] = $personId;

$participants = 'participants';
$collect['participants'] = $participants;

$orgId = 119;
$collect['orgId'] = $orgId;

$note = 'note';
$collect['note'] = $note;


$activities->addAnActivity($collect);

```


### <a name="delete_an_activity"></a>![Method: ](https://apidocs.io/img/method.png ".ActivitiesController.deleteAnActivity") deleteAnActivity

> Deletes an activity.


```php
function deleteAnActivity($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the activity |



#### Example Usage

```php
$id = 119;

$activities->deleteAnActivity($id);

```


### <a name="get_details_of_an_activity"></a>![Method: ](https://apidocs.io/img/method.png ".ActivitiesController.getDetailsOfAnActivity") getDetailsOfAnActivity

> Returns details of a specific activity.


```php
function getDetailsOfAnActivity($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the activity |



#### Example Usage

```php
$id = 119;

$activities->getDetailsOfAnActivity($id);

```


### <a name="update_edit_an_activity"></a>![Method: ](https://apidocs.io/img/method.png ".ActivitiesController.updateEditAnActivity") updateEditAnActivity

> Modifies an activity. Includes more_activities_scheduled_in_context property in response's additional_data which indicates whether there are more undone activities scheduled with the same deal, person or organization (depending on the supplied data).


```php
function updateEditAnActivity($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the activity |
| subject |  ``` Required ```  | Subject of the activity |
| type |  ``` Required ```  | Type of the activity. This is in correlation with the key_string parameter of ActivityTypes. |
| done |  ``` Optional ```  | TODO: Add a parameter description |
| dueDate |  ``` Optional ```  | Due date of the activity. Format: YYYY-MM-DD |
| dueTime |  ``` Optional ```  | Due time of the activity in UTC. Format: HH:MM |
| duration |  ``` Optional ```  | Duration of the activity. Format: HH:MM |
| userId |  ``` Optional ```  | ID of the user whom the activity will be assigned to. If omitted, the activity will be assigned to the authorized user. |
| dealId |  ``` Optional ```  | ID of the deal this activity will be associated with |
| personId |  ``` Optional ```  | ID of the person this activity will be associated with |
| participants |  ``` Optional ```  | List of multiple persons (participants) this activity will be associated with. If omitted, single participant from person_id field is used. It requires a structure as follows: [{"person_id":1,"primary_flag":true}] |
| orgId |  ``` Optional ```  | ID of the organization this activity will be associated with |
| note |  ``` Optional ```  | Note of the activity (HTML format) |



#### Example Usage

```php
$id = 119;
$collect['id'] = $id;

$subject = 'subject';
$collect['subject'] = $subject;

$type = 'type';
$collect['type'] = $type;

$done = int::ENUM_0;
$collect['done'] = $done;

$dueDate = date("D M d, Y G:i");
$collect['dueDate'] = $dueDate;

$dueTime = 'due_time';
$collect['dueTime'] = $dueTime;

$duration = 'duration';
$collect['duration'] = $duration;

$userId = 119;
$collect['userId'] = $userId;

$dealId = 119;
$collect['dealId'] = $dealId;

$personId = 119;
$collect['personId'] = $personId;

$participants = 'participants';
$collect['participants'] = $participants;

$orgId = 119;
$collect['orgId'] = $orgId;

$note = 'note';
$collect['note'] = $note;


$activities->updateEditAnActivity($collect);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="activity_fields_controller"></a>![Class: ](https://apidocs.io/img/class.png ".ActivityFieldsController") ActivityFieldsController

### Get singleton instance

The singleton instance of the ``` ActivityFieldsController ``` class can be accessed from the API Client.

```php
$activityFields = $client->getActivityFields();
```

### <a name="get_all_fields_for_an_activity"></a>![Method: ](https://apidocs.io/img/method.png ".ActivityFieldsController.getAllFieldsForAnActivity") getAllFieldsForAnActivity

> Return list of all fields for activity


```php
function getAllFieldsForAnActivity()
```

#### Example Usage

```php

$activityFields->getAllFieldsForAnActivity();

```


[Back to List of Controllers](#list_of_controllers)

## <a name="activity_types_controller"></a>![Class: ](https://apidocs.io/img/class.png ".ActivityTypesController") ActivityTypesController

### Get singleton instance

The singleton instance of the ``` ActivityTypesController ``` class can be accessed from the API Client.

```php
$activityTypes = $client->getActivityTypes();
```

### <a name="delete_multiple_activity_types_in_bulk"></a>![Method: ](https://apidocs.io/img/method.png ".ActivityTypesController.deleteMultipleActivityTypesInBulk") deleteMultipleActivityTypesInBulk

> Marks multiple activity types as deleted.


```php
function deleteMultipleActivityTypesInBulk($ids)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| ids |  ``` Required ```  | Comma-separated activity type IDs to delete |



#### Example Usage

```php
$ids = 'ids';

$activityTypes->deleteMultipleActivityTypesInBulk($ids);

```


### <a name="get_all_activity_types"></a>![Method: ](https://apidocs.io/img/method.png ".ActivityTypesController.getAllActivityTypes") getAllActivityTypes

> Returns all activity types


```php
function getAllActivityTypes()
```

#### Example Usage

```php

$activityTypes->getAllActivityTypes();

```


### <a name="add_new_activity_type"></a>![Method: ](https://apidocs.io/img/method.png ".ActivityTypesController.addNewActivityType") addNewActivityType

> Adds a new activity type, returns the ID, the key_string and the order number of the newly added activity type upon success.


```php
function addNewActivityType($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| name |  ``` Required ```  | Name of the activity type |
| iconKey |  ``` Required ```  | Icon graphic to use for representing this activity type. |
| color |  ``` Optional ```  | A designated color for the activity type in 6-character HEX format (e.g. FFFFFF for white, 000000 for black). |



#### Example Usage

```php
$name = 'name';
$collect['name'] = $name;

$iconKey = string::TASK;
$collect['iconKey'] = $iconKey;

$color = 'color';
$collect['color'] = $color;


$activityTypes->addNewActivityType($collect);

```


### <a name="delete_an_activity_type"></a>![Method: ](https://apidocs.io/img/method.png ".ActivityTypesController.deleteAnActivityType") deleteAnActivityType

> Marks an activity type as deleted.


```php
function deleteAnActivityType($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the activity type |



#### Example Usage

```php
$id = 119;

$activityTypes->deleteAnActivityType($id);

```


### <a name="update_edit_activity_type"></a>![Method: ](https://apidocs.io/img/method.png ".ActivityTypesController.updateEditActivityType") updateEditActivityType

> Updates an activity type.


```php
function updateEditActivityType($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the activity type |
| name |  ``` Optional ```  | Name of the activity type |
| iconKey |  ``` Optional ```  | Icon graphic to use for representing this activity type. |
| color |  ``` Optional ```  | A designated color for the activity type in 6-character HEX format (e.g. FFFFFF for white, 000000 for black). |
| orderNr |  ``` Optional ```  | An order number for this activity type. Order numbers should be used to order the types in the activity type selections. |



#### Example Usage

```php
$id = 119;
$collect['id'] = $id;

$name = 'name';
$collect['name'] = $name;

$iconKey = string::TASK;
$collect['iconKey'] = $iconKey;

$color = 'color';
$collect['color'] = $color;

$orderNr = 119;
$collect['orderNr'] = $orderNr;


$activityTypes->updateEditActivityType($collect);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="currencies_controller"></a>![Class: ](https://apidocs.io/img/class.png ".CurrenciesController") CurrenciesController

### Get singleton instance

The singleton instance of the ``` CurrenciesController ``` class can be accessed from the API Client.

```php
$currencies = $client->getCurrencies();
```

### <a name="get_all_supported_currencies"></a>![Method: ](https://apidocs.io/img/method.png ".CurrenciesController.getAllSupportedCurrencies") getAllSupportedCurrencies

> Returns all supported currencies in given account which should be used when saving monetary values with other objects. The 'code' parameter of the returning objects is the currency code according to ISO 4217 for all non-custom currencies.


```php
function getAllSupportedCurrencies($term = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| term |  ``` Optional ```  | Optional search term that is searched for from currency's name and/or code. |



#### Example Usage

```php
$term = 'term';

$result = $currencies->getAllSupportedCurrencies($term);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="deal_fields_controller"></a>![Class: ](https://apidocs.io/img/class.png ".DealFieldsController") DealFieldsController

### Get singleton instance

The singleton instance of the ``` DealFieldsController ``` class can be accessed from the API Client.

```php
$dealFields = $client->getDealFields();
```

### <a name="delete_multiple_deal_fields_in_bulk"></a>![Method: ](https://apidocs.io/img/method.png ".DealFieldsController.deleteMultipleDealFieldsInBulk") deleteMultipleDealFieldsInBulk

> Marks multiple fields as deleted.


```php
function deleteMultipleDealFieldsInBulk($ids)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| ids |  ``` Required ```  | Comma-separated field IDs to delete |



#### Example Usage

```php
$ids = 'ids';

$dealFields->deleteMultipleDealFieldsInBulk($ids);

```


### <a name="get_all_deal_fields"></a>![Method: ](https://apidocs.io/img/method.png ".DealFieldsController.getAllDealFields") getAllDealFields

> Returns data about all fields deals can have


```php
function getAllDealFields($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |



#### Example Usage

```php
$start = 0;
$collect['start'] = $start;

$limit = 119;
$collect['limit'] = $limit;


$dealFields->getAllDealFields($collect);

```


### <a name="add_a_new_deal_field"></a>![Method: ](https://apidocs.io/img/method.png ".DealFieldsController.addANewDealField") addANewDealField

> Adds a new deal field. For more information on adding a new custom field, see <a href="https://pipedrive.readme.io/docs/adding-a-new-custom-field" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function addANewDealField($body = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| body |  ``` Optional ```  | TODO: Add a parameter description |



#### Example Usage

```php
$body = array('key' => 'value');

$dealFields->addANewDealField($body);

```


### <a name="delete_a_deal_field"></a>![Method: ](https://apidocs.io/img/method.png ".DealFieldsController.deleteADealField") deleteADealField

> Marks a field as deleted. For more information on how to delete a custom field, see <a href="https://pipedrive.readme.io/docs/deleting-a-custom-field" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function deleteADealField($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the field |



#### Example Usage

```php
$id = 119;

$dealFields->deleteADealField($id);

```


### <a name="get_one_deal_field"></a>![Method: ](https://apidocs.io/img/method.png ".DealFieldsController.getOneDealField") getOneDealField

> Returns data about a specific deal field.


```php
function getOneDealField($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the field |



#### Example Usage

```php
$id = 119;

$dealFields->getOneDealField($id);

```


### <a name="update_a_deal_field"></a>![Method: ](https://apidocs.io/img/method.png ".DealFieldsController.updateADealField") updateADealField

> Updates a deal field. See an example of updating custom fields’ values in <a href=" https://pipedrive.readme.io/docs/updating-custom-field-value " target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function updateADealField($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the field |
| name |  ``` Required ```  | Name of the field |
| options |  ``` Optional ```  | When field_type is either set or enum, possible options must be supplied as a JSON-encoded sequential array, for example: ["red","blue","lilac"] |



#### Example Usage

```php
$id = 119;
$collect['id'] = $id;

$name = 'name';
$collect['name'] = $name;

$options = 'options';
$collect['options'] = $options;


$dealFields->updateADealField($collect);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="deals_controller"></a>![Class: ](https://apidocs.io/img/class.png ".DealsController") DealsController

### Get singleton instance

The singleton instance of the ``` DealsController ``` class can be accessed from the API Client.

```php
$deals = $client->getDeals();
```

### <a name="delete_multiple_deals_in_bulk"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.deleteMultipleDealsInBulk") deleteMultipleDealsInBulk

> Marks multiple deals as deleted.


```php
function deleteMultipleDealsInBulk($ids)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| ids |  ``` Required ```  | Comma-separated IDs that will be deleted |



#### Example Usage

```php
$ids = 'ids';

$result = $deals->deleteMultipleDealsInBulk($ids);

```


### <a name="get_all_deals"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.getAllDeals") getAllDeals

> Returns all deals. For more information on how to get all deals, see <a href="https://pipedrive.readme.io/docs/getting-all-deals" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function getAllDeals($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| userId |  ``` Optional ```  | If supplied, only deals matching the given user will be returned. |
| filterId |  ``` Optional ```  | ID of the filter to use |
| stageId |  ``` Optional ```  | If supplied, only deals within the given stage will be returned. |
| status |  ``` Optional ```  ``` DefaultValue ```  | Only fetch deals with specific status. If omitted, all not deleted deals are fetched. |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |
| sort |  ``` Optional ```  | Field names and sorting mode separated by a comma (field_name_1 ASC, field_name_2 DESC). Only first-level field keys are supported (no nested keys). |
| ownedByYou |  ``` Optional ```  | When supplied, only deals owned by you are returned. However filter_id takes precedence over owned_by_you when both are supplied. |



#### Example Usage

```php
$userId = 119;
$collect['userId'] = $userId;

$filterId = 119;
$collect['filterId'] = $filterId;

$stageId = 119;
$collect['stageId'] = $stageId;

$status = string::ALL_NOT_DELETED;
$collect['status'] = $status;

$start = 0;
$collect['start'] = $start;

$limit = 119;
$collect['limit'] = $limit;

$sort = 'sort';
$collect['sort'] = $sort;

$ownedByYou = int::ENUM_0;
$collect['ownedByYou'] = $ownedByYou;


$result = $deals->getAllDeals($collect);

```

### <a name="search_deals"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.searchDeals") searchDeals

> Searches all Deals by title, notes and/or custom fields. This endpoint is a wrapper of /v1/itemSearch with a narrower OAuth scope. Found Deals can be filtered by Person ID and Organization ID.


```php
function searchDeals($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| term |  ``` Required ```  | The search term to look for. Minimum 2 characters (or 1 if using exact_match). |
| fields |  ``` Optional ```  | A comma-separated string array. The fields to perform the search from. Defaults to all of them. |
| exactMatch |  ``` Optional ```  | When enabled, only full exact matches against the given term are returned. It is not case sensitive. |
| personId |  ``` Optional ```  | Will filter Deals by the provided Person ID. The upper limit of found Deals associated with the Person is 2000. |
| organizationId |  ``` Optional ```  | Will filter Deals by the provided Organization ID. The upper limit of found Deals associated with the Organization is 2000. |
| status |  ``` Optional ```  | Will filter Deals by the provided specific status. open = Open, won = Won, lost = Lost. The upper limit of found Deals associated with the status is 2000. |
| includeFields |  ``` Optional ```  | Supports including optional fields in the results which are not provided by default. |
| start |  ``` Optional ```  | Pagination start. Note that the pagination is based on main results and does not include related items when using search_for_related_items parameter. |
| limit |  ``` Optional ```  | Items shown per page |


#### Example Usage

```php
$term = 'term';
$collect['term'] = $term;

$results = $deals->searchDeals($collect);

```


### <a name="add_a_deal"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.addADeal") addADeal

> Adds a new deal. Note that you can supply additional custom fields along with the request that are not described here. These custom fields are different for each Pipedrive account and can be recognized by long hashes as keys. To determine which custom fields exists, fetch the dealFields and look for 'key' values. For more information on how to add a deal, see <a href="https://pipedrive.readme.io/docs/creating-a-deal" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function addADeal($body = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| body |  ``` Optional ```  | TODO: Add a parameter description |



#### Example Usage

```php
$body = array('key' => 'value');

$result = $deals->addADeal($body);

```


### <a name="get_deals_summary"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.getDealsSummary") getDealsSummary

> Returns summary of all the deals.


```php
function getDealsSummary($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| status |  ``` Optional ```  | Only fetch deals with specific status. open = Open, won = Won, lost = Lost |
| filterId |  ``` Optional ```  | user_id will not be considered. Only deals matching the given filter will be returned. |
| userId |  ``` Optional ```  | Only deals matching the given user will be returned. user_id will not be considered if you use filter_id. |
| stageId |  ``` Optional ```  | Only deals within the given stage will be returned. |



#### Example Usage

```php
$status = string::OPEN;
$collect['status'] = $status;

$filterId = 119;
$collect['filterId'] = $filterId;

$userId = 119;
$collect['userId'] = $userId;

$stageId = 119;
$collect['stageId'] = $stageId;


$result = $deals->getDealsSummary($collect);

```


### <a name="get_deals_timeline"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.getDealsTimeline") getDealsTimeline

> Returns open and won deals, grouped by defined interval of time set in a date-type dealField (field_key) — e.g. when month is the chosen interval, and 3 months are asked starting from  January 1st, 2012, deals are returned grouped into 3 groups — January, February and March — based on the value of the given field_key.


```php
function getDealsTimeline($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| startDate |  ``` Required ```  | Date where first interval starts. Format: YYYY-MM-DD |
| interval |  ``` Required ```  | Type of interval.<dl class="fields-list"><dt>day</dt><dd>Day</dd><dt>week</dt><dd>A full week (7 days) starting from start_date</dd><dt>month</dt><dd>A full month (depending on the number of days in given month) starting from start_date</dd><dt>quarter</dt><dd>A full quarter (3 months) starting from start_date</dd></dl> |
| amount |  ``` Required ```  | Number of given intervals, starting from start_date, to fetch. E.g. 3 (months). |
| fieldKey |  ``` Required ```  | The name of the date field by which to get deals by. |
| userId |  ``` Optional ```  | If supplied, only deals matching the given user will be returned. |
| pipelineId |  ``` Optional ```  | If supplied, only deals matching the given pipeline will be returned. |
| filterId |  ``` Optional ```  | If supplied, only deals matching the given filter will be returned. |
| excludeDeals |  ``` Optional ```  | Whether to exclude deals list (1) or not (0). Note that when deals are excluded, the timeline summary (counts and values) is still returned. |
| totalsConvertCurrency |  ``` Optional ```  | 3-letter currency code of any of the supported currencies. When supplied, totals_converted is returned per each interval which contains the currency-converted total amounts in the given currency. You may also set this parameter to 'default_currency' in which case users default currency is used. |



#### Example Usage

```php
$startDate = date("D M d, Y G:i");
$collect['startDate'] = $startDate;

$interval = string::DAY;
$collect['interval'] = $interval;

$amount = 119;
$collect['amount'] = $amount;

$fieldKey = 'field_key';
$collect['fieldKey'] = $fieldKey;

$userId = 119;
$collect['userId'] = $userId;

$pipelineId = 119;
$collect['pipelineId'] = $pipelineId;

$filterId = 119;
$collect['filterId'] = $filterId;

$excludeDeals = int::ENUM_0;
$collect['excludeDeals'] = $excludeDeals;

$totalsConvertCurrency = 'totals_convert_currency';
$collect['totalsConvertCurrency'] = $totalsConvertCurrency;


$result = $deals->getDealsTimeline($collect);

```


### <a name="delete_a_deal"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.deleteADeal") deleteADeal

> Marks a deal as deleted.


```php
function deleteADeal($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |



#### Example Usage

```php
$id = 119;

$result = $deals->deleteADeal($id);

```


### <a name="get_details_of_a_deal"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.getDetailsOfADeal") getDetailsOfADeal

> Returns details of a specific deal. Note that this also returns some additional fields which are not present when asking for all deals – such as deal age and stay in pipeline stages. Also note that custom fields appear as long hashes in the resulting data. These hashes can be mapped against the 'key' value of dealFields. For more information on how to get all details of a deal, see <a href="https://pipedrive.readme.io/docs/getting-details-of-a-deal" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function getDetailsOfADeal($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |



#### Example Usage

```php
$id = 119;

$result = $deals->getDetailsOfADeal($id);

```


### <a name="update_a_deal"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.updateADeal") updateADeal

> Updates the properties of a deal. For more information on how to update a deal, see <a href="https://pipedrive.readme.io/docs/updating-a-deal" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function updateADeal($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |
| title |  ``` Optional ```  | Deal title |
| value |  ``` Optional ```  | Value of the deal. If omitted, value will be set to 0. |
| currency |  ``` Optional ```  | Currency of the deal. Accepts a 3-character currency code. If omitted, currency will be set to the default currency of the authorized user. |
| userId |  ``` Optional ```  | ID of the user who will be marked as the owner of this deal. If omitted, the authorized user ID will be used. |
| personId |  ``` Optional ```  | ID of the person this deal will be associated with |
| orgId |  ``` Optional ```  | ID of the organization this deal will be associated with |
| stageId |  ``` Optional ```  | ID of the stage this deal will be placed in a pipeline (note that you can't supply the ID of the pipeline as this will be assigned automatically based on stage_id). If omitted, the deal will be placed in the first stage of the default pipeline. |
| status |  ``` Optional ```  | open = Open, won = Won, lost = Lost, deleted = Deleted. If omitted, status will be set to open. |
| probability |  ``` Optional ```  | Deal success probability percentage. Used/shown only when deal_probability for the pipeline of the deal is enabled. |
| lostReason |  ``` Optional ```  | Optional message about why the deal was lost (to be used when status=lost) |
| visibleTo |  ``` Optional ```  | Visibility of the deal. If omitted, visibility will be set to the default visibility setting of this item type for the authorized user.<dl class="fields-list"><dt>1</dt><dd>Owner &amp; followers (private)</dd><dt>3</dt><dd>Entire company (shared)</dd></dl> |



#### Example Usage

```php
$id = 27;
$collect['id'] = $id;

$title = 'title';
$collect['title'] = $title;

$value = 'value';
$collect['value'] = $value;

$currency = 'currency';
$collect['currency'] = $currency;

$userId = 27;
$collect['userId'] = $userId;

$personId = 27;
$collect['personId'] = $personId;

$orgId = 27;
$collect['orgId'] = $orgId;

$stageId = 27;
$collect['stageId'] = $stageId;

$status = string::OPEN;
$collect['status'] = $status;

$probability = 27.9633801840075;
$collect['probability'] = $probability;

$lostReason = 'lost_reason';
$collect['lostReason'] = $lostReason;

$visibleTo = int::ENUM_1;
$collect['visibleTo'] = $visibleTo;


$result = $deals->updateADeal($collect);

```


### <a name="list_activities_associated_with_a_deal"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.listActivitiesAssociatedWithADeal") listActivitiesAssociatedWithADeal

> Lists activities associated with a deal.


```php
function listActivitiesAssociatedWithADeal($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |
| done |  ``` Optional ```  | Whether the activity is done or not. 0 = Not done, 1 = Done. If omitted returns both Done and Not done activities. |
| exclude |  ``` Optional ```  | A comma-separated string of activity IDs to exclude from result |



#### Example Usage

```php
$id = 27;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 27;
$collect['limit'] = $limit;

$done = int::ENUM_0;
$collect['done'] = $done;

$exclude = 'exclude';
$collect['exclude'] = $exclude;


$deals->listActivitiesAssociatedWithADeal($collect);

```


### <a name="create_duplicate_deal"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.createDuplicateDeal") createDuplicateDeal

> Duplicate a deal


```php
function createDuplicateDeal($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |



#### Example Usage

```php
$id = 27;

$result = $deals->createDuplicateDeal($id);

```


### <a name="list_files_attached_to_a_deal"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.listFilesAttachedToADeal") listFilesAttachedToADeal

> Lists files associated with a deal.


```php
function listFilesAttachedToADeal($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |
| includeDeletedFiles |  ``` Optional ```  | When enabled, the list of files will also include deleted files. Please note that trying to download these files will not work. |
| sort |  ``` Optional ```  | Field names and sorting mode separated by a comma (field_name_1 ASC, field_name_2 DESC). Only first-level field keys are supported (no nested keys). Supported fields: id, user_id, deal_id, person_id, org_id, product_id, add_time, update_time, file_name, file_type, file_size, comment. |



#### Example Usage

```php
$id = 27;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 27;
$collect['limit'] = $limit;

$includeDeletedFiles = int::ENUM_0;
$collect['includeDeletedFiles'] = $includeDeletedFiles;

$sort = 'sort';
$collect['sort'] = $sort;


$deals->listFilesAttachedToADeal($collect);

```


### <a name="list_updates_about_a_deal"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.listUpdatesAboutADeal") listUpdatesAboutADeal

> Lists updates about a deal.


```php
function listUpdatesAboutADeal($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |



#### Example Usage

```php
$id = 27;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 27;
$collect['limit'] = $limit;


$deals->listUpdatesAboutADeal($collect);

```


### <a name="list_followers_of_a_deal"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.listFollowersOfADeal") listFollowersOfADeal

> Lists the followers of a deal.


```php
function listFollowersOfADeal($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |



#### Example Usage

```php
$id = 27;

$deals->listFollowersOfADeal($id);

```


### <a name="add_a_follower_to_a_deal"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.addAFollowerToADeal") addAFollowerToADeal

> Adds a follower to a deal.


```php
function addAFollowerToADeal($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |
| userId |  ``` Required ```  | ID of the user |



#### Example Usage

```php
$id = 27;
$collect['id'] = $id;

$userId = 27;
$collect['userId'] = $userId;


$result = $deals->addAFollowerToADeal($collect);

```


### <a name="delete_a_follower_from_a_deal"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.deleteAFollowerFromADeal") deleteAFollowerFromADeal

> Deletes a follower from a deal.


```php
function deleteAFollowerFromADeal($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |
| followerId |  ``` Required ```  | ID of the follower |



#### Example Usage

```php
$id = 27;
$collect['id'] = $id;

$followerId = 27;
$collect['followerId'] = $followerId;


$result = $deals->deleteAFollowerFromADeal($collect);

```


### <a name="list_mail_messages_associated_with_a_deal"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.listMailMessagesAssociatedWithADeal") listMailMessagesAssociatedWithADeal

> Lists mail messages associated with a deal.


```php
function listMailMessagesAssociatedWithADeal($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |



#### Example Usage

```php
$id = 27;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 27;
$collect['limit'] = $limit;


$deals->listMailMessagesAssociatedWithADeal($collect);

```


### <a name="update_merge_two_deals"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.updateMergeTwoDeals") updateMergeTwoDeals

> Merges a deal with another deal. For more information on how to merge two deals, see <a href="https://pipedrive.readme.io/docs/merging-two-deals" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function updateMergeTwoDeals($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |
| mergeWithId |  ``` Required ```  | ID of the deal that the deal will be merged with |



#### Example Usage

```php
$id = 27;
$collect['id'] = $id;

$mergeWithId = 27;
$collect['mergeWithId'] = $mergeWithId;


$result = $deals->updateMergeTwoDeals($collect);

```


### <a name="list_participants_of_a_deal"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.listParticipantsOfADeal") listParticipantsOfADeal

> Lists participants associated with a deal.


```php
function listParticipantsOfADeal($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |



#### Example Usage

```php
$id = 27;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 27;
$collect['limit'] = $limit;


$deals->listParticipantsOfADeal($collect);

```


### <a name="add_a_participant_to_a_deal"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.addAParticipantToADeal") addAParticipantToADeal

> Adds a participant to a deal.


```php
function addAParticipantToADeal($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |
| personId |  ``` Required ```  | ID of the person |



#### Example Usage

```php
$id = 27;
$collect['id'] = $id;

$personId = 27;
$collect['personId'] = $personId;


$deals->addAParticipantToADeal($collect);

```


### <a name="delete_a_participant_from_a_deal"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.deleteAParticipantFromADeal") deleteAParticipantFromADeal

> Deletes a participant from a deal.


```php
function deleteAParticipantFromADeal($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |
| dealParticipantId |  ``` Required ```  | ID of the deal participant |



#### Example Usage

```php
$id = 27;
$collect['id'] = $id;

$dealParticipantId = 27;
$collect['dealParticipantId'] = $dealParticipantId;


$result = $deals->deleteAParticipantFromADeal($collect);

```


### <a name="list_permitted_users"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.listPermittedUsers") listPermittedUsers

> List users permitted to access a deal


```php
function listPermittedUsers($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |



#### Example Usage

```php
$id = 27;

$deals->listPermittedUsers($id);

```


### <a name="list_all_persons_associated_with_a_deal"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.listAllPersonsAssociatedWithADeal") listAllPersonsAssociatedWithADeal

> Lists all persons associated with a deal, regardless of whether the person is the primary contact of the deal, or added as a participant.


```php
function listAllPersonsAssociatedWithADeal($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |



#### Example Usage

```php
$id = 27;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 27;
$collect['limit'] = $limit;


$deals->listAllPersonsAssociatedWithADeal($collect);

```


### <a name="list_products_attached_to_a_deal"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.listProductsAttachedToADeal") listProductsAttachedToADeal

> Lists products attached to a deal.


```php
function listProductsAttachedToADeal($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |
| includeProductData |  ``` Optional ```  | Whether to fetch product data along with each attached product (1) or not (0, default). |



#### Example Usage

```php
$id = 27;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 27;
$collect['limit'] = $limit;

$includeProductData = int::ENUM_0;
$collect['includeProductData'] = $includeProductData;


$deals->listProductsAttachedToADeal($collect);

```


### <a name="add_a_product_to_the_deal_eventually_creating_a_new_item_called_a_deal_product"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.addAProductToTheDealEventuallyCreatingANewItemCalledADealProduct") addAProductToTheDealEventuallyCreatingANewItemCalledADealProduct

> Adds a product to the deal.


```php
function addAProductToTheDealEventuallyCreatingANewItemCalledADealProduct($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |
| body |  ``` Optional ```  | TODO: Add a parameter description |



#### Example Usage

```php
$id = 27;
$collect['id'] = $id;

$body = array('key' => 'value');
$collect['body'] = $body;


$result = $deals->addAProductToTheDealEventuallyCreatingANewItemCalledADealProduct($collect);

```


### <a name="update_product_attachment_details_of_the_deal_product_a_product_already_attached_to_a_deal"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.updateProductAttachmentDetailsOfTheDealProductAProductAlreadyAttachedToADeal") updateProductAttachmentDetailsOfTheDealProductAProductAlreadyAttachedToADeal

> Updates product attachment details.


```php
function updateProductAttachmentDetailsOfTheDealProductAProductAlreadyAttachedToADeal($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |
| productAttachmentId |  ``` Required ```  | ID of the deal-product (the ID of the product attached to the deal) |
| itemPrice |  ``` Optional ```  | Price at which this product will be added to the deal |
| quantity |  ``` Optional ```  | Quantity – e.g. how many items of this product will be added to the deal |
| discountPercentage |  ``` Optional ```  | Discount %. If omitted, will be set to 0 |
| duration |  ``` Optional ```  | Duration of the product (when product durations are not enabled for the company or if omitted, defaults to 1) |
| productVariationId |  ``` Optional ```  | ID of the product variation to use. When omitted, no variation will be used. |
| comments |  ``` Optional ```  | Any textual comment associated with this product-deal attachment. Visible and editable in the application UI. |
| enabledFlag |  ``` Optional ```  | Whether the product is enabled on the deal or not. This makes it possible to add products to a deal with specific price and discount criteria - but keep them disabled, which refrains them from being included in deal price calculation. When omitted, the product will be marked as enabled by default. |



#### Example Usage

```php
$id = 27;
$collect['id'] = $id;

$productAttachmentId = 27;
$collect['productAttachmentId'] = $productAttachmentId;

$itemPrice = 27.9633801840075;
$collect['itemPrice'] = $itemPrice;

$quantity = 27;
$collect['quantity'] = $quantity;

$discountPercentage = 27.9633801840075;
$collect['discountPercentage'] = $discountPercentage;

$duration = 27.9633801840075;
$collect['duration'] = $duration;

$productVariationId = 27;
$collect['productVariationId'] = $productVariationId;

$comments = 'comments';
$collect['comments'] = $comments;

$enabledFlag = int::ENUM_0;
$collect['enabledFlag'] = $enabledFlag;


$result = $deals->updateProductAttachmentDetailsOfTheDealProductAProductAlreadyAttachedToADeal($collect);

```


### <a name="delete_an_attached_product_from_a_deal"></a>![Method: ](https://apidocs.io/img/method.png ".DealsController.deleteAnAttachedProductFromADeal") deleteAnAttachedProductFromADeal

> Deletes a product attachment from a deal, using the product_attachment_id.


```php
function deleteAnAttachedProductFromADeal($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the deal |
| productAttachmentId |  ``` Required ```  | Product attachment ID. This is returned as product_attachment_id after attaching a product to a deal or as id when listing the products attached to a deal. |



#### Example Usage

```php
$id = 27;
$collect['id'] = $id;

$productAttachmentId = 27;
$collect['productAttachmentId'] = $productAttachmentId;


$result = $deals->deleteAnAttachedProductFromADeal($collect);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="files_controller"></a>![Class: ](https://apidocs.io/img/class.png ".FilesController") FilesController

### Get singleton instance

The singleton instance of the ``` FilesController ``` class can be accessed from the API Client.

```php
$files = $client->getFiles();
```

### <a name="get_all_files"></a>![Method: ](https://apidocs.io/img/method.png ".FilesController.getAllFiles") getAllFiles

> Returns data about all files.


```php
function getAllFiles($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |
| includeDeletedFiles |  ``` Optional ```  | When enabled, the list of files will also include deleted files. Please note that trying to download these files will not work. |
| sort |  ``` Optional ```  | Field names and sorting mode separated by a comma (field_name_1 ASC, field_name_2 DESC). Only first-level field keys are supported (no nested keys). Supported fields: id, user_id, deal_id, person_id, org_id, product_id, add_time, update_time, file_name, file_type, file_size, comment. |



#### Example Usage

```php
$start = 0;
$collect['start'] = $start;

$limit = 27;
$collect['limit'] = $limit;

$includeDeletedFiles = int::ENUM_0;
$collect['includeDeletedFiles'] = $includeDeletedFiles;

$sort = 'sort';
$collect['sort'] = $sort;


$files->getAllFiles($collect);

```


### <a name="add_file"></a>![Method: ](https://apidocs.io/img/method.png ".FilesController.addFile") addFile

> Lets you upload a file and associate it with Deal, Person, Organization, Activity or Product. For more information on how to add a file, see <a href="https://pipedrive.readme.io/docs/adding-a-file" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function addFile($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| file |  ``` Required ```  | A single file, supplied in the multipart/form-data encoding and contained within the given boundaries. |
| dealId |  ``` Optional ```  | ID of the deal to associate file(s) with |
| personId |  ``` Optional ```  | ID of the person to associate file(s) with |
| orgId |  ``` Optional ```  | ID of the organization to associate file(s) with |
| productId |  ``` Optional ```  | ID of the product to associate file(s) with |
| activityId |  ``` Optional ```  | ID of the activity to associate file(s) with |
| noteId |  ``` Optional ```  | ID of the note to associate file(s) with |



#### Example Usage

```php
$file = "PathToFile";
$collect['file'] = $file;

$dealId = 27;
$collect['dealId'] = $dealId;

$personId = 27;
$collect['personId'] = $personId;

$orgId = 27;
$collect['orgId'] = $orgId;

$productId = 27;
$collect['productId'] = $productId;

$activityId = 27;
$collect['activityId'] = $activityId;

$noteId = 27;
$collect['noteId'] = $noteId;


$files->addFile($collect);

```


### <a name="create_a_remote_file_and_link_it_to_an_item"></a>![Method: ](https://apidocs.io/img/method.png ".FilesController.createARemoteFileAndLinkItToAnItem") createARemoteFileAndLinkItToAnItem

> Creates a new empty file in the remote location (googledrive) that will be linked to the item you supply. For more information on how to add a remote file, see <a href="https://pipedrive.readme.io/docs/adding-a-remote-file" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function createARemoteFileAndLinkItToAnItem($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| fileType |  ``` Required ```  | The file type |
| title |  ``` Required ```  | The title of the file |
| itemType |  ``` Required ```  | The item type |
| itemId |  ``` Required ```  | ID of the item to associate the file with |
| remoteLocation |  ``` Required ```  | The location type to send the file to. Only googledrive is supported at the moment. |



#### Example Usage

```php
$fileType = string::GDOC;
$collect['fileType'] = $fileType;

$title = 'title';
$collect['title'] = $title;

$itemType = string::DEAL;
$collect['itemType'] = $itemType;

$itemId = 27;
$collect['itemId'] = $itemId;

$remoteLocation = string::GOOGLEDRIVE;
$collect['remoteLocation'] = $remoteLocation;


$files->createARemoteFileAndLinkItToAnItem($collect);

```


### <a name="create_link_a_remote_file_to_an_item"></a>![Method: ](https://apidocs.io/img/method.png ".FilesController.createLinkARemoteFileToAnItem") createLinkARemoteFileToAnItem

> Links an existing remote file (googledrive) to the item you supply. For more information on how to link a remote file, see <a href="https://pipedrive.readme.io/docs/adding-a-remote-file" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function createLinkARemoteFileToAnItem($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| itemType |  ``` Required ```  | The item type |
| itemId |  ``` Required ```  | ID of the item to associate the file with |
| remoteId |  ``` Required ```  | The remote item id |
| remoteLocation |  ``` Required ```  | The location type to send the file to. Only googledrive is supported at the moment. |



#### Example Usage

```php
$itemType = string::DEAL;
$collect['itemType'] = $itemType;

$itemId = 27;
$collect['itemId'] = $itemId;

$remoteId = 'remote_id';
$collect['remoteId'] = $remoteId;

$remoteLocation = string::GOOGLEDRIVE;
$collect['remoteLocation'] = $remoteLocation;


$files->createLinkARemoteFileToAnItem($collect);

```


### <a name="delete_a_file"></a>![Method: ](https://apidocs.io/img/method.png ".FilesController.deleteAFile") deleteAFile

> Marks a file as deleted.


```php
function deleteAFile($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the file |



#### Example Usage

```php
$id = 27;

$files->deleteAFile($id);

```


### <a name="get_one_file"></a>![Method: ](https://apidocs.io/img/method.png ".FilesController.getOneFile") getOneFile

> Returns data about a specific file.


```php
function getOneFile($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the file |



#### Example Usage

```php
$id = 27;

$files->getOneFile($id);

```


### <a name="update_file_details"></a>![Method: ](https://apidocs.io/img/method.png ".FilesController.updateFileDetails") updateFileDetails

> Updates the properties of a file.


```php
function updateFileDetails($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the file |
| name |  ``` Optional ```  | Visible name of the file |
| description |  ``` Optional ```  | Description of the file |



#### Example Usage

```php
$id = 27;
$collect['id'] = $id;

$name = 'name';
$collect['name'] = $name;

$description = 'description';
$collect['description'] = $description;


$files->updateFileDetails($collect);

```


### <a name="get_download_one_file"></a>![Method: ](https://apidocs.io/img/method.png ".FilesController.getDownloadOneFile") getDownloadOneFile

> Initializes a file download.


```php
function getDownloadOneFile($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the file |



#### Example Usage

```php
$id = 27;

$files->getDownloadOneFile($id);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="filters_controller"></a>![Class: ](https://apidocs.io/img/class.png ".FiltersController") FiltersController

### Get singleton instance

The singleton instance of the ``` FiltersController ``` class can be accessed from the API Client.

```php
$filters = $client->getFilters();
```

### <a name="delete_multiple_filters_in_bulk"></a>![Method: ](https://apidocs.io/img/method.png ".FiltersController.deleteMultipleFiltersInBulk") deleteMultipleFiltersInBulk

> Marks multiple filters as deleted.


```php
function deleteMultipleFiltersInBulk($ids)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| ids |  ``` Required ```  | Comma-separated filter IDs to delete |



#### Example Usage

```php
$ids = 'ids';

$filters->deleteMultipleFiltersInBulk($ids);

```


### <a name="get_all_filters"></a>![Method: ](https://apidocs.io/img/method.png ".FiltersController.getAllFilters") getAllFilters

> Returns data about all filters


```php
function getAllFilters($type = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| type |  ``` Optional ```  | Types of filters to fetch |



#### Example Usage

```php
$type = string::DEALS;

$filters->getAllFilters($type);

```


### <a name="add_a_new_filter"></a>![Method: ](https://apidocs.io/img/method.png ".FiltersController.addANewFilter") addANewFilter

> Adds a new filter, returns the ID upon success. Note that in the conditions json object only one first-level condition group is supported, and it must be glued with 'AND', and only two second level condition groups are supported of which one must be glued with 'AND' and the second with 'OR'. Other combinations do not work (yet) but the syntax supports introducing them in future. For more information on how to add a new filter, see <a href="https://pipedrive.readme.io/docs/adding-a-filter" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function addANewFilter($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| name |  ``` Required ```  | Filter name |
| conditions |  ``` Required ```  | Filter conditions as a JSON object. It requires a minimum structure as follows: {"glue":"and","conditions":[{"glue":"and","conditions": [CONDITION_OBJECTS]},{"glue":"or","conditions":[CONDITION_OBJECTS]}]}. Replace CONDITION_OBJECTS with JSON objects of the following structure: {"object":"","field_id":"", "operator":"","value":"", "extra_value":""} or leave the array empty. Depending on the object type you should use another API endpoint to get field_id. There are five types of objects you can choose from: "person", "deal", "organization", "product", "activity" and you can use these types of operators depending on what type of a field you have: "IS NOT NULL", "IS NULL", "<=", ">=", "<", ">", "!=", "=", "LIKE '%$%'", "NOT LIKE '%$%'", "LIKE '$%'", "NOT LIKE '$%'", "LIKE '%$'", "NOT LIKE '%$'". To get a better understanding of how filters work try creating them directly from the Pipedrive application. |
| type |  ``` Required ```  | Type of filter to create. |



#### Example Usage

```php
$name = 'name';
$collect['name'] = $name;

$conditions = 'conditions';
$collect['conditions'] = $conditions;

$type = string::DEALS;
$collect['type'] = $type;


$filters->addANewFilter($collect);

```


### <a name="get_all_filter_helpers"></a>![Method: ](https://apidocs.io/img/method.png ".FiltersController.getAllFilterHelpers") getAllFilterHelpers

> Returns all supported filter helpers. It helps to know what conditions and helpers are available when you want to <a href="/docs/api/v1/#!/Filters/post_filters">add</a> or <a href="/docs/api/v1/#!/Filters/put_filters_id">update</a> filters. For more information on how filter’s helpers can be used, see <a href="https://pipedrive.readme.io/docs/adding-a-filter" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function getAllFilterHelpers()
```

#### Example Usage

```php

$filters->getAllFilterHelpers();

```


### <a name="delete_a_filter"></a>![Method: ](https://apidocs.io/img/method.png ".FiltersController.deleteAFilter") deleteAFilter

> Marks a filter as deleted.


```php
function deleteAFilter($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the filter |



#### Example Usage

```php
$id = 27;

$filters->deleteAFilter($id);

```


### <a name="get_one_filter"></a>![Method: ](https://apidocs.io/img/method.png ".FiltersController.getOneFilter") getOneFilter

> Returns data about a specific filter. Note that this also returns the condition lines of the filter.


```php
function getOneFilter($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the filter |



#### Example Usage

```php
$id = 27;

$filters->getOneFilter($id);

```


### <a name="update_filter"></a>![Method: ](https://apidocs.io/img/method.png ".FiltersController.updateFilter") updateFilter

> Updates existing filter.


```php
function updateFilter($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the filter |
| conditions |  ``` Required ```  | Filter conditions as a JSON object. It requires a minimum structure as follows: {"glue":"and","conditions":[{"glue":"and","conditions": [CONDITION_OBJECTS]},{"glue":"or","conditions":[CONDITION_OBJECTS]}]}. Replace CONDITION_OBJECTS with JSON objects of the following structure: {"object":"","field_id":"", "operator":"","value":"", "extra_value":""} or leave the array empty. Depending on the object type you should use another API endpoint to get field_id. There are five types of objects you can choose from: "person", "deal", "organization", "product", "activity" and you can use these types of operators depending on what type of a field you have: "IS NOT NULL", "IS NULL", "<=", ">=", "<", ">", "!=", "=", "LIKE '%$%'", "NOT LIKE '%$%'", "LIKE '$%'", "NOT LIKE '$%'", "LIKE '%$'", "NOT LIKE '%$'". To get a better understanding of how filters work try creating them directly from the Pipedrive application. |
| name |  ``` Optional ```  | Filter name |



#### Example Usage

```php
$id = 27;
$collect['id'] = $id;

$conditions = 'conditions';
$collect['conditions'] = $conditions;

$name = 'name';
$collect['name'] = $name;


$filters->updateFilter($collect);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="global_messages_controller"></a>![Class: ](https://apidocs.io/img/class.png ".GlobalMessagesController") GlobalMessagesController

### Get singleton instance

The singleton instance of the ``` GlobalMessagesController ``` class can be accessed from the API Client.

```php
$globalMessages = $client->getGlobalMessages();
```

### <a name="get_global_messages"></a>![Method: ](https://apidocs.io/img/method.png ".GlobalMessagesController.getGlobalMessages") getGlobalMessages

> Returns data about global messages to display for the authorized user.


```php
function getGlobalMessages($limit = 1)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| limit |  ``` Optional ```  ``` DefaultValue ```  | Number of messages to get from 1 to 100. The message number 1 is returned by default. |



#### Example Usage

```php
$limit = 1;

$result = $globalMessages->getGlobalMessages($limit);

```


### <a name="delete_dismiss_a_global_message"></a>![Method: ](https://apidocs.io/img/method.png ".GlobalMessagesController.deleteDismissAGlobalMessage") deleteDismissAGlobalMessage

> Removes global message from being shown, if message is dismissible


```php
function deleteDismissAGlobalMessage($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of global message to be dismissed. |



#### Example Usage

```php
$id = 27;

$result = $globalMessages->deleteDismissAGlobalMessage($id);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="goals_controller"></a>![Class: ](https://apidocs.io/img/class.png ".GoalsController") GoalsController

### Get singleton instance

The singleton instance of the ``` GoalsController ``` class can be accessed from the API Client.

```php
$goals = $client->getGoals();
```

### <a name="add_a_new_goal"></a>![Method: ](https://apidocs.io/img/method.png ".GoalsController.addANewGoal") addANewGoal

> Adds a new goal.


```php
function addANewGoal($body = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| body |  ``` Optional ```  | TODO: Add a parameter description |



#### Example Usage

```php
$body = array('key' => 'value');

$goals->addANewGoal($body);

```


### <a name="find_goals"></a>![Method: ](https://apidocs.io/img/method.png ".GoalsController.findGoals") findGoals

> Returns data about goals based on criteria. For searching, append `{searchField}={searchValue}` to the URL, where `searchField` can be any one of the lowest-level fields in dot-notation (e.g. `type.params.pipeline_id`; `title`). `searchValue` should be the value you are looking for on that field. Additionally, `is_active=<true|false>` can be provided to search for only active/inactive goals. When providing `period.start`, `period.end` must also be provided and vice versa.


```php
function findGoals($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| typeName |  ``` Optional ```  | Type of the goal. If provided, everyone's goals will be returned. |
| title |  ``` Optional ```  | Title of the goal. |
| isActive |  ``` Optional ```  ``` DefaultValue ```  | Whether goal is active or not. |
| assigneeId |  ``` Optional ```  | ID of the user who's goal to fetch. When omitted, only your goals will be returned. |
| assigneeType |  ``` Optional ```  | Type of the goal's assignee. If provided, everyone's goals will be returned. |
| expectedOutcomeTarget |  ``` Optional ```  | Numeric value of the outcome. If provided, everyone's goals will be returned. |
| expectedOutcomeTrackingMetric |  ``` Optional ```  | Tracking metric of the expected outcome of the goal. If provided, everyone's goals will be returned. |
| expectedOutcomeCurrencyId |  ``` Optional ```  | Numeric ID of the goal's currency. Only applicable to goals with `expected_outcome.tracking_metric` with value `sum`. If provided, everyone's goals will be returned. |
| typeParamsPipelineId |  ``` Optional ```  | ID of the pipeline or `null` for all pipelines. If provided, everyone's goals will be returned. |
| typeParamsStageId |  ``` Optional ```  | ID of the stage. Applicable to only `deals_progressed` type of goals. If provided, everyone's goals will be returned. |
| typeParamsActivityTypeId |  ``` Optional ```  | ID of the activity type. Applicable to only `activities_completed` or `activities_added` types of goals. If provided, everyone's goals will be returned. |
| periodStart |  ``` Optional ```  | Start date of the period for which to find goals. Date in format of YYYY-MM-DD. When `period.start` is provided, `period.end` must be provided too. |
| periodEnd |  ``` Optional ```  | End date of the period for which to find goals. Date in format of YYYY-MM-DD. |



#### Example Usage

```php
$typeName = string::DEALS_WON;
$collect['typeName'] = $typeName;

$title = 'title';
$collect['title'] = $title;

$isActive = true;
$collect['isActive'] = $isActive;

$assigneeId = 27;
$collect['assigneeId'] = $assigneeId;

$assigneeType = string::PERSON;
$collect['assigneeType'] = $assigneeType;

$expectedOutcomeTarget = 27.9633801840075;
$collect['expectedOutcomeTarget'] = $expectedOutcomeTarget;

$expectedOutcomeTrackingMetric = string::QUANTITY;
$collect['expectedOutcomeTrackingMetric'] = $expectedOutcomeTrackingMetric;

$expectedOutcomeCurrencyId = 27;
$collect['expectedOutcomeCurrencyId'] = $expectedOutcomeCurrencyId;

$typeParamsPipelineId = 27;
$collect['typeParamsPipelineId'] = $typeParamsPipelineId;

$typeParamsStageId = 27;
$collect['typeParamsStageId'] = $typeParamsStageId;

$typeParamsActivityTypeId = 27;
$collect['typeParamsActivityTypeId'] = $typeParamsActivityTypeId;

$periodStart = date("D M d, Y G:i");
$collect['periodStart'] = $periodStart;

$periodEnd = date("D M d, Y G:i");
$collect['periodEnd'] = $periodEnd;


$goals->findGoals($collect);

```


### <a name="update_existing_goal"></a>![Method: ](https://apidocs.io/img/method.png ".GoalsController.updateExistingGoal") updateExistingGoal

> Updates existing goal.


```php
function updateExistingGoal($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the goal to be updated. |
| title |  ``` Optional ```  | Title of the goal. |
| assignee |  ``` Optional ```  | Who is this goal assigned to. It requires the following JSON structure: { "id": "1", "type": "person" }. `type` can be either `person`, `company` or `team`. ID of the assignee person, company or team. |
| type |  ``` Optional ```  | Type of the goal. It requires the following JSON structure: { "name": "deals_started", "params": { "pipeline_id": 1 } }. Type can be one of: `deals_won`,`deals_progressed`,`activities_completed`,`activities_added` or `deals_started`. `params` can include `pipeline_id`, `stage_id` or `activity_type_id`. `stage_id` is related to only `deals_progressed` type of goals and `activity_type_id` to `activities_completed` or `activities_added` types of goals. To track goal in all pipelines set `pipeline_id` as `null`. |
| expectedOutcome |  ``` Optional ```  | Expected outcome of the goal. Expected outcome can be tracked either by `quantity` or by `sum`. It requires the following JSON structure: { "target": "50", "tracking_metric": "quantity" } or { "target": "50", "tracking_metric": "sum", "currency_id": 1 }. `currency_id` should only be added to `sum` type of goals. |
| duration |  ``` Optional ```  | Date when the goal starts and ends. It requires the following JSON structure: { "start": "2019-01-01", "end": "2022-12-31" }. Date in format of YYYY-MM-DD. |
| interval |  ``` Optional ```  | Date when the goal starts and ends. It requires the following JSON structure: { "start": "2019-01-01", "end": "2022-12-31" }. Date in format of YYYY-MM-DD. |



#### Example Usage

```php
$id = 'id';
$collect['id'] = $id;

$title = 'title';
$collect['title'] = $title;

$assignee = array('key' => 'value');
$collect['assignee'] = $assignee;

$type = array('key' => 'value');
$collect['type'] = $type;

$expectedOutcome = array('key' => 'value');
$collect['expectedOutcome'] = $expectedOutcome;

$duration = array('key' => 'value');
$collect['duration'] = $duration;

$interval = string::WEEKLY;
$collect['interval'] = $interval;


$goals->updateExistingGoal($collect);

```


### <a name="delete_existing_goal"></a>![Method: ](https://apidocs.io/img/method.png ".GoalsController.deleteExistingGoal") deleteExistingGoal

> Marks goal as deleted.


```php
function deleteExistingGoal($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the goal to be deleted. |



#### Example Usage

```php
$id = 'id';

$goals->deleteExistingGoal($id);

```


### <a name="get_result_of_a_goal"></a>![Method: ](https://apidocs.io/img/method.png ".GoalsController.getResultOfAGoal") getResultOfAGoal

> Gets progress of a goal for specified period.


```php
function getResultOfAGoal($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the goal that the results are looked for. |
| periodStart |  ``` Required ```  | Start date of the period for which to find progress of a goal. Date in format of YYYY-MM-DD. |
| periodEnd |  ``` Required ```  | End date of the period for which to find progress of a goal. Date in format of YYYY-MM-DD. |



#### Example Usage

```php
$id = 'id';
$collect['id'] = $id;

$periodStart = date("D M d, Y G:i");
$collect['periodStart'] = $periodStart;

$periodEnd = date("D M d, Y G:i");
$collect['periodEnd'] = $periodEnd;


$goals->getResultOfAGoal($collect);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="item_search_controller"></a>![Class: ](https://apidocs.io/img/class.png ".ItemSearchController") ItemSearchController

### Get singleton instance

The singleton instance of the ```ItemSearchController``` class can be accessed from the API Client.

```php
$itemSearch = $client->getItemSearch();
```


### <a name="perform_a_search_from_multiple_item_types"></a>![Method: ](https://apidocs.io/img/method.png ".ItemSearchController.performASearchFromMultipleItemTypes") performASearchFromMultipleItemTypes

> Perform a search from multiple item types


```php
function performASearchFromMultipleItemTypes($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| term |  ``` Required ```  | Search term to look for, minimum 2 characters. |
| itemTypes |  ``` Optional ```  | A comma-separated string array. The type of items to perform the search from. Defaults to all. |
| fields |  ``` Optional ```  | A comma-separated string array. The fields to perform the search from. Defaults to all. |
| searchForRelatedItems |  ``` Optional ```  | When enabled, the response will include up to 100 newest related Leads and 100 newest related Deals for each found Person and Organization and up to 100 newest related Persons for each found Organization. |
| exactMatch |  ``` Optional ```  | When enabled, only full exact matches against the given term are returned. It is not case sensitive. |
| includeFields |  ``` Optional ```  | A comma-separated string array. Supports including optional fields in the results which are not provided by default.|
| start |  ``` Optional ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |


#### Example Usage

```php
$term = 'term';
$collect['term'] = $term;

$results = $itemSearch->performASearchFromMultipleItemTypes($collect);

```

### <a name="perform_a_search_using_a_specific_field_from_an_item_type"></a>![Method: ](https://apidocs.io/img/method.png ".ItemSearchController.performASearchUsingASpecificFieldFromAnItemType") performASearchUsingASpecificFieldFromAnItemType

> Perform a search using a specific field from an item type


```php
function performASearchUsingASpecificFieldFromAnItemType($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| term |  ``` Required ```  | The search term to look for. Minimum 2 characters (or 1 if using exact_match). |
| fieldType |  ``` Required ```  | The type of the field to perform the search from |
| fieldKey |  ``` Required ```  | The key of the field to search from. The field key can be obtained by fetching the list of the fields using any of the fields' API GET methods (dealFields, personFields, etc.). |
| exactMatch |  ``` Optional ```  | When enabled, only full exact matches against the given term are returned. The search is case sensitive. |
| returnItemIds |  ``` Optional ```  | Whether to return the IDs of the matching items or not. When not set or set to 0 or false, only distinct values of the searched field are returned. When set to 1 or true, the ID of each found item is returned. |
| start |  ``` Optional ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |


#### Example Usage

```php

$collect['term'] = 'term';
$collect['fieldType'] = 'dealField';
$collect['fieldKey'] = 'title';

$results = $itemSearch->performASearchUsingASpecificFieldFromAnItemType($collect);

```

[Back to List of Controllers](#list_of_controllers)

## <a name="mail_messages_controller"></a>![Class: ](https://apidocs.io/img/class.png ".MailMessagesController") MailMessagesController

### Get singleton instance

The singleton instance of the ``` MailMessagesController ``` class can be accessed from the API Client.

```php
$mailMessages = $client->getMailMessages();
```

### <a name="get_one_mail_message"></a>![Method: ](https://apidocs.io/img/method.png ".MailMessagesController.getOneMailMessage") getOneMailMessage

> Returns data about specific mail message.


```php
function getOneMailMessage($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the mail message to fetch. |
| includeBody |  ``` Optional ```  | Whether to include full message body or not. 0 = Don't include, 1 = Include |



#### Example Usage

```php
$id = 27;
$collect['id'] = $id;

$includeBody = int::ENUM_0;
$collect['includeBody'] = $includeBody;


$result = $mailMessages->getOneMailMessage($collect);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="mail_threads_controller"></a>![Class: ](https://apidocs.io/img/class.png ".MailThreadsController") MailThreadsController

### Get singleton instance

The singleton instance of the ``` MailThreadsController ``` class can be accessed from the API Client.

```php
$mailThreads = $client->getMailThreads();
```

### <a name="get_mail_threads"></a>![Method: ](https://apidocs.io/img/method.png ".MailThreadsController.getMailThreads") getMailThreads

> Returns mail threads in specified folder ordered by most recent message within.


```php
function getMailThreads($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| folder |  ``` Required ```  ``` DefaultValue ```  | Type of folder to fetch. |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |



#### Example Usage

```php
$folder = string::INBOX;
$collect['folder'] = $folder;

$start = 0;
$collect['start'] = $start;

$limit = 27;
$collect['limit'] = $limit;


$result = $mailThreads->getMailThreads($collect);

```


### <a name="delete_mail_thread"></a>![Method: ](https://apidocs.io/img/method.png ".MailThreadsController.deleteMailThread") deleteMailThread

> Marks mail thread as deleted.


```php
function deleteMailThread($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the mail thread |



#### Example Usage

```php
$id = 27;

$result = $mailThreads->deleteMailThread($id);

```


### <a name="get_one_mail_thread"></a>![Method: ](https://apidocs.io/img/method.png ".MailThreadsController.getOneMailThread") getOneMailThread

> Returns specific mail thread.


```php
function getOneMailThread($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the mail thread |



#### Example Usage

```php
$id = 27;

$result = $mailThreads->getOneMailThread($id);

```


### <a name="update_mail_thread_details"></a>![Method: ](https://apidocs.io/img/method.png ".MailThreadsController.updateMailThreadDetails") updateMailThreadDetails

> Updates the properties of a mail thread.


```php
function updateMailThreadDetails($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the mail thread |
| dealId |  ``` Optional ```  | ID of the deal this thread is associated with |
| sharedFlag |  ``` Optional ```  | TODO: Add a parameter description |
| readFlag |  ``` Optional ```  | TODO: Add a parameter description |
| archivedFlag |  ``` Optional ```  | TODO: Add a parameter description |



#### Example Usage

```php
$id = 27;
$collect['id'] = $id;

$dealId = 27;
$collect['dealId'] = $dealId;

$sharedFlag = int::ENUM_0;
$collect['sharedFlag'] = $sharedFlag;

$readFlag = int::ENUM_0;
$collect['readFlag'] = $readFlag;

$archivedFlag = int::ENUM_0;
$collect['archivedFlag'] = $archivedFlag;


$result = $mailThreads->updateMailThreadDetails($collect);

```


### <a name="get_all_mail_messages_of_mail_thread"></a>![Method: ](https://apidocs.io/img/method.png ".MailThreadsController.getAllMailMessagesOfMailThread") getAllMailMessagesOfMailThread

> Get mail messages inside specified mail thread.


```php
function getAllMailMessagesOfMailThread($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the mail thread |



#### Example Usage

```php
$id = 27;

$result = $mailThreads->getAllMailMessagesOfMailThread($id);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="note_fields_controller"></a>![Class: ](https://apidocs.io/img/class.png ".NoteFieldsController") NoteFieldsController

### Get singleton instance

The singleton instance of the ``` NoteFieldsController ``` class can be accessed from the API Client.

```php
$noteFields = $client->getNoteFields();
```

### <a name="get_all_fields_for_a_note"></a>![Method: ](https://apidocs.io/img/method.png ".NoteFieldsController.getAllFieldsForANote") getAllFieldsForANote

> Return list of all fields for note


```php
function getAllFieldsForANote()
```

#### Example Usage

```php

$noteFields->getAllFieldsForANote();

```


[Back to List of Controllers](#list_of_controllers)

## <a name="notes_controller"></a>![Class: ](https://apidocs.io/img/class.png ".NotesController") NotesController

### Get singleton instance

The singleton instance of the ``` NotesController ``` class can be accessed from the API Client.

```php
$notes = $client->getNotes();
```

### <a name="get_all_notes"></a>![Method: ](https://apidocs.io/img/method.png ".NotesController.getAllNotes") getAllNotes

> Returns all notes.


```php
function getAllNotes($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| userId |  ``` Optional ```  | ID of the user whose notes to fetch. If omitted, notes by all users will be returned. |
| leadId |  ``` Optional ```  | ID of the lead which notes to fetch. If omitted, notes about all leads will be returned. |
| dealId |  ``` Optional ```  | ID of the deal which notes to fetch. If omitted, notes about all deals will be returned. |
| personId |  ``` Optional ```  | ID of the person whose notes to fetch. If omitted, notes about all persons will be returned. |
| orgId |  ``` Optional ```  | ID of the organization which notes to fetch. If omitted, notes about all organizations will be returned. |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |
| sort |  ``` Optional ```  | Field names and sorting mode separated by a comma (field_name_1 ASC, field_name_2 DESC). Only first-level field keys are supported (no nested keys). Supported fields: id, user_id, deal_id, person_id, org_id, content, add_time, update_time. |
| startDate |  ``` Optional ```  | Date in format of YYYY-MM-DD from which notes to fetch from. |
| endDate |  ``` Optional ```  | Date in format of YYYY-MM-DD until which notes to fetch to. |
| pinnedToLeadlFlag |  ``` Optional ```  | If set, then results are filtered by note to lead pinning state. |
| pinnedToDealFlag |  ``` Optional ```  | If set, then results are filtered by note to deal pinning state. |
| pinnedToOrganizationFlag |  ``` Optional ```  | If set, then results are filtered by note to organization pinning state. |
| pinnedToPersonFlag |  ``` Optional ```  | If set, then results are filtered by note to person pinning state. |



#### Example Usage

```php
$userId = 69;
$collect['userId'] = $userId;

$leadId = 'adf21080-0e10-11eb-879b-05d71fb426ec';
$collect['leadId'] = $leadId;

$dealId = 69;
$collect['dealId'] = $dealId;

$personId = 69;
$collect['personId'] = $personId;

$orgId = 69;
$collect['orgId'] = $orgId;

$start = 0;
$collect['start'] = $start;

$limit = 69;
$collect['limit'] = $limit;

$sort = 'sort';
$collect['sort'] = $sort;

$startDate = date("D M d, Y G:i");
$collect['startDate'] = $startDate;

$endDate = date("D M d, Y G:i");
$collect['endDate'] = $endDate;

$pinnedToLeadFlag = int::ENUM_0;
$collect['pinnedToLeadFlag'] = $pinnedToLeadFlag;

$pinnedToDealFlag = int::ENUM_0;
$collect['pinnedToDealFlag'] = $pinnedToDealFlag;

$pinnedToOrganizationFlag = int::ENUM_0;
$collect['pinnedToOrganizationFlag'] = $pinnedToOrganizationFlag;

$pinnedToPersonFlag = int::ENUM_0;
$collect['pinnedToPersonFlag'] = $pinnedToPersonFlag;


$result = $notes->getAllNotes($collect);

```


### <a name="add_a_note"></a>![Method: ](https://apidocs.io/img/method.png ".NotesController.addANote") addANote

> Adds a new note.


```php
function addANote($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| content |  ``` Required ```  | Content of the note in HTML format. Subject to sanitization on the back-end. |
| userId |  ``` Optional ```  | ID of the user who will be marked as the author of this note. Only an admin can change the author. |
| leadId |  ``` Optional ```  | ID of the lead the note will be attached to. |
| dealId |  ``` Optional ```  | ID of the deal the note will be attached to. |
| personId |  ``` Optional ```  | ID of the person this note will be attached to. |
| orgId |  ``` Optional ```  | ID of the organization this note will be attached to. |
| addTime |  ``` Optional ```  | Optional creation date & time of the Note in UTC. Can be set in the past or in the future. Requires admin user API token. Format: YYYY-MM-DD HH:MM:SS |
| pinnedToLeadFlag |  ``` Optional ```  | If set, then results are filtered by note to lead pinning state (lead_id is also required). |
| pinnedToDealFlag |  ``` Optional ```  | If set, then results are filtered by note to deal pinning state (deal_id is also required). |
| pinnedToOrganizationFlag |  ``` Optional ```  | If set, then results are filtered by note to organization pinning state (org_id is also required). |
| pinnedToPersonFlag |  ``` Optional ```  | If set, then results are filtered by note to person pinning state (person_id is also required). |



#### Example Usage

```php
$content = 'content';
$collect['content'] = $content;

$userId = 69;
$collect['userId'] = $userId;

$leadId = 'adf21080-0e10-11eb-879b-05d71fb426ec';
$collect['leadId'] = $leadId;

$dealId = 69;
$collect['dealId'] = $dealId;

$personId = 69;
$collect['personId'] = $personId;

$orgId = 69;
$collect['orgId'] = $orgId;

$addTime = 'add_time';
$collect['addTime'] = $addTime;

$pinnedToLeadFlag = int::ENUM_0;
$collect['pinnedToLeadFlag'] = $pinnedToLeadFlag;

$pinnedToDealFlag = int::ENUM_0;
$collect['pinnedToDealFlag'] = $pinnedToDealFlag;

$pinnedToOrganizationFlag = int::ENUM_0;
$collect['pinnedToOrganizationFlag'] = $pinnedToOrganizationFlag;

$pinnedToPersonFlag = int::ENUM_0;
$collect['pinnedToPersonFlag'] = $pinnedToPersonFlag;


$result = $notes->addANote($collect);

```


### <a name="delete_a_note"></a>![Method: ](https://apidocs.io/img/method.png ".NotesController.deleteANote") deleteANote

> Deletes a specific note.


```php
function deleteANote($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the note |



#### Example Usage

```php
$id = 69;

$result = $notes->deleteANote($id);

```


### <a name="get_one_note"></a>![Method: ](https://apidocs.io/img/method.png ".NotesController.getOneNote") getOneNote

> Returns details about a specific note.


```php
function getOneNote($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the note |



#### Example Usage

```php
$id = 69;

$result = $notes->getOneNote($id);

```


### <a name="update_a_note"></a>![Method: ](https://apidocs.io/img/method.png ".NotesController.updateANote") updateANote

> Updates a note.


```php
function updateANote($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the note |
| content |  ``` Required ```  | Content of the note in HTML format. Subject to sanitization on the back-end. |
| userId |  ``` Optional ```  | ID of the user who will be marked as the author of this note. Only an admin can change the author. |
| leadId |  ``` Optional ```  | ID of the lead the note will be attached to. |
| dealId |  ``` Optional ```  | ID of the deal the note will be attached to. |
| personId |  ``` Optional ```  | ID of the person this note will be attached to. |
| orgId |  ``` Optional ```  | ID of the organization this note will be attached to. |
| addTime |  ``` Optional ```  | Optional creation date & time of the Note in UTC. Can be set in the past or in the future. Requires admin user API token. Format: YYYY-MM-DD HH:MM:SS |
| pinnedToLeadFlag |  ``` Optional ```  | If set, then results are filtered by note to lead pinning state (lead_id is also required). |
| pinnedToDealFlag |  ``` Optional ```  | If set, then results are filtered by note to deal pinning state (deal_id is also required). |
| pinnedToOrganizationFlag |  ``` Optional ```  | If set, then results are filtered by note to organization pinning state (org_id is also required). |
| pinnedToPersonFlag |  ``` Optional ```  | If set, then results are filtered by note to person pinning state (person_id is also required). |



#### Example Usage

```php
$id = 69;
$collect['id'] = $id;

$content = 'content';
$collect['content'] = $content;

$userId = 69;
$collect['userId'] = $userId;

$leadId = 'adf21080-0e10-11eb-879b-05d71fb426ec';
$collect['leadId'] = $leadId;

$dealId = 69;
$collect['dealId'] = $dealId;

$personId = 69;
$collect['personId'] = $personId;

$orgId = 69;
$collect['orgId'] = $orgId;

$addTime = 'add_time';
$collect['addTime'] = $addTime;

$pinnedToLeadFlag = int::ENUM_0;
$collect['pinnedToLeadFlag'] = $pinnedToLeadFlag;

$pinnedToDealFlag = int::ENUM_0;
$collect['pinnedToDealFlag'] = $pinnedToDealFlag;

$pinnedToOrganizationFlag = int::ENUM_0;
$collect['pinnedToOrganizationFlag'] = $pinnedToOrganizationFlag;

$pinnedToPersonFlag = int::ENUM_0;
$collect['pinnedToPersonFlag'] = $pinnedToPersonFlag;


$result = $notes->updateANote($collect);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="organization_fields_controller"></a>![Class: ](https://apidocs.io/img/class.png ".OrganizationFieldsController") OrganizationFieldsController

### Get singleton instance

The singleton instance of the ``` OrganizationFieldsController ``` class can be accessed from the API Client.

```php
$organizationFields = $client->getOrganizationFields();
```

### <a name="delete_multiple_organization_fields_in_bulk"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationFieldsController.deleteMultipleOrganizationFieldsInBulk") deleteMultipleOrganizationFieldsInBulk

> Marks multiple fields as deleted.


```php
function deleteMultipleOrganizationFieldsInBulk($ids)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| ids |  ``` Required ```  | Comma-separated field IDs to delete |



#### Example Usage

```php
$ids = 'ids';

$organizationFields->deleteMultipleOrganizationFieldsInBulk($ids);

```


### <a name="get_all_organization_fields"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationFieldsController.getAllOrganizationFields") getAllOrganizationFields

> Returns data about all organization fields


```php
function getAllOrganizationFields()
```

#### Example Usage

```php

$organizationFields->getAllOrganizationFields();

```


### <a name="add_a_new_organization_field"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationFieldsController.addANewOrganizationField") addANewOrganizationField

> Adds a new organization field. For more information on adding a new custom field, see <a href="https://pipedrive.readme.io/docs/adding-a-new-custom-field" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function addANewOrganizationField($body = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| body |  ``` Optional ```  | TODO: Add a parameter description |



#### Example Usage

```php
$body = array('key' => 'value');

$organizationFields->addANewOrganizationField($body);

```


### <a name="delete_an_organization_field"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationFieldsController.deleteAnOrganizationField") deleteAnOrganizationField

> Marks a field as deleted. For more information on how to delete a custom field, see <a href="https://pipedrive.readme.io/docs/deleting-a-custom-field" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function deleteAnOrganizationField($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the field |



#### Example Usage

```php
$id = 69;

$organizationFields->deleteAnOrganizationField($id);

```


### <a name="get_one_organization_field"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationFieldsController.getOneOrganizationField") getOneOrganizationField

> Returns data about a specific organization field.


```php
function getOneOrganizationField($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the field |



#### Example Usage

```php
$id = 69;

$organizationFields->getOneOrganizationField($id);

```


### <a name="update_an_organization_field"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationFieldsController.updateAnOrganizationField") updateAnOrganizationField

> Updates an organization field. See an example of updating custom fields’ values in <a href=" https://pipedrive.readme.io/docs/updating-custom-field-value " target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function updateAnOrganizationField($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the field |
| name |  ``` Required ```  | Name of the field |
| options |  ``` Optional ```  | When field_type is either set or enum, possible options must be supplied as a JSON-encoded sequential array of objects. All active items must be supplied and already existing items must have their ID supplied. New items only require a label. Example: [{"id":123,"label":"Existing Item"},{"label":"New Item"}] |



#### Example Usage

```php
$id = 69;
$collect['id'] = $id;

$name = 'name';
$collect['name'] = $name;

$options = 'options';
$collect['options'] = $options;


$organizationFields->updateAnOrganizationField($collect);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="organization_relationships_controller"></a>![Class: ](https://apidocs.io/img/class.png ".OrganizationRelationshipsController") OrganizationRelationshipsController

### Get singleton instance

The singleton instance of the ``` OrganizationRelationshipsController ``` class can be accessed from the API Client.

```php
$organizationRelationships = $client->getOrganizationRelationships();
```

### <a name="get_all_relationships_for_organization"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationRelationshipsController.getAllRelationshipsForOrganization") getAllRelationshipsForOrganization

> Gets all of the relationships for a supplied organization id.


```php
function getAllRelationshipsForOrganization($orgId)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| orgId |  ``` Required ```  | ID of the organization to get relationships for |



#### Example Usage

```php
$orgId = 69;

$organizationRelationships->getAllRelationshipsForOrganization($orgId);

```


### <a name="create_an_organization_relationship"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationRelationshipsController.createAnOrganizationRelationship") createAnOrganizationRelationship

> Creates and returns an organization relationship.


```php
function createAnOrganizationRelationship($body = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| body |  ``` Optional ```  | TODO: Add a parameter description |



#### Example Usage

```php
$body = array('key' => 'value');

$organizationRelationships->createAnOrganizationRelationship($body);

```


### <a name="delete_an_organization_relationship"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationRelationshipsController.deleteAnOrganizationRelationship") deleteAnOrganizationRelationship

> Deletes an organization relationship and returns the deleted id.


```php
function deleteAnOrganizationRelationship($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the organization relationship |



#### Example Usage

```php
$id = 69;

$organizationRelationships->deleteAnOrganizationRelationship($id);

```


### <a name="get_one_organization_relationship"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationRelationshipsController.getOneOrganizationRelationship") getOneOrganizationRelationship

> Finds and returns an organization relationship from its ID.


```php
function getOneOrganizationRelationship($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the organization relationship |
| orgId |  ``` Optional ```  | ID of the base organization for the returned calculated values |



#### Example Usage

```php
$id = 69;
$collect['id'] = $id;

$orgId = 69;
$collect['orgId'] = $orgId;


$organizationRelationships->getOneOrganizationRelationship($collect);

```


### <a name="update_an_organization_relationship"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationRelationshipsController.updateAnOrganizationRelationship") updateAnOrganizationRelationship

> Updates and returns an organization relationship.


```php
function updateAnOrganizationRelationship($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the organization relationship |
| orgId |  ``` Optional ```  | ID of the base organization for the returned calculated values |
| type |  ``` Optional ```  | The type of organization relationship. |
| relOwnerOrgId |  ``` Optional ```  | The owner of this relationship. If type is 'parent', then the owner is the parent and the linked organization is the daughter. |
| relLinkedOrgId |  ``` Optional ```  | The linked organization in this relationship. If type is 'parent', then the linked organization is the daughter. |



#### Example Usage

```php
$id = 69;
$collect['id'] = $id;

$orgId = 69;
$collect['orgId'] = $orgId;

$type = string::PARENT;
$collect['type'] = $type;

$relOwnerOrgId = 69;
$collect['relOwnerOrgId'] = $relOwnerOrgId;

$relLinkedOrgId = 69;
$collect['relLinkedOrgId'] = $relLinkedOrgId;


$organizationRelationships->updateAnOrganizationRelationship($collect);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="organizations_controller"></a>![Class: ](https://apidocs.io/img/class.png ".OrganizationsController") OrganizationsController

### Get singleton instance

The singleton instance of the ``` OrganizationsController ``` class can be accessed from the API Client.

```php
$organizations = $client->getOrganizations();
```

### <a name="delete_multiple_organizations_in_bulk"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationsController.deleteMultipleOrganizationsInBulk") deleteMultipleOrganizationsInBulk

> Marks multiple organizations as deleted.


```php
function deleteMultipleOrganizationsInBulk($ids)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| ids |  ``` Required ```  | Comma-separated IDs that will be deleted |



#### Example Usage

```php
$ids = 'ids';

$organizations->deleteMultipleOrganizationsInBulk($ids);

```


### <a name="get_all_organizations"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationsController.getAllOrganizations") getAllOrganizations

> Returns all organizations


```php
function getAllOrganizations($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| userId |  ``` Optional ```  | If supplied, only organizations owned by the given user will be returned. |
| filterId |  ``` Optional ```  | ID of the filter to use |
| firstChar |  ``` Optional ```  | If supplied, only organizations whose name starts with the specified letter will be returned (case insensitive). |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |
| sort |  ``` Optional ```  | Field names and sorting mode separated by a comma (field_name_1 ASC, field_name_2 DESC). Only first-level field keys are supported (no nested keys). |



#### Example Usage

```php
$userId = 69;
$collect['userId'] = $userId;

$filterId = 69;
$collect['filterId'] = $filterId;

$firstChar = 'first_char';
$collect['firstChar'] = $firstChar;

$start = 0;
$collect['start'] = $start;

$limit = 69;
$collect['limit'] = $limit;

$sort = 'sort';
$collect['sort'] = $sort;


$organizations->getAllOrganizations($collect);

```

### <a name="search_organizations"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationsController.searchOrganizations") searchOrganizations

> Searches all Organizations by name, address, notes and/or custom fields. This endpoint is a wrapper of /v1/itemSearch with a narrower OAuth scope.


```php
function searchOrganizations($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| term |  ``` Required ```  | The search term to look for. Minimum 2 characters (or 1 if using exact_match). |
| fields |  ``` Optional ```  | A comma-separated string array. The fields to perform the search from. Defaults to all of them. |
| exactMatch |  ``` Optional ```  | When enabled, only full exact matches against the given term are returned. It is not case sensitive. |
| start |  ``` Optional ```  | Pagination start. Note that the pagination is based on main results and does not include related items when using search_for_related_items parameter. |
| limit |  ``` Optional ```  | Items shown per page |


#### Example Usage

```php
$term = 'term';
$collect['term'] = $term;

$results = $organizations->searchOrganizations($collect);

```


### <a name="add_an_organization"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationsController.addAnOrganization") addAnOrganization

> Adds a new organization. Note that you can supply additional custom fields along with the request that are not described here. These custom fields are different for each Pipedrive account and can be recognized by long hashes as keys. To determine which custom fields exists, fetch the organizationFields and look for 'key' values. For more information on how to add an organization, see <a href="https://pipedrive.readme.io/docs/adding-an-organization" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function addAnOrganization($body = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| body |  ``` Optional ```  | TODO: Add a parameter description |



#### Example Usage

```php
$body = array('key' => 'value');

$organizations->addAnOrganization($body);

```

### <a name="delete_an_organization"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationsController.deleteAnOrganization") deleteAnOrganization

> Marks an organization as deleted.


```php
function deleteAnOrganization($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the organization |



#### Example Usage

```php
$id = 69;

$organizations->deleteAnOrganization($id);

```


### <a name="get_details_of_an_organization"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationsController.getDetailsOfAnOrganization") getDetailsOfAnOrganization

> Returns details of an organization. Note that this also returns some additional fields which are not present when asking for all organizations. Also note that custom fields appear as long hashes in the resulting data. These hashes can be mapped against the 'key' value of organizationFields.


```php
function getDetailsOfAnOrganization($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the organization |



#### Example Usage

```php
$id = 69;

$organizations->getDetailsOfAnOrganization($id);

```


### <a name="update_an_organization"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationsController.updateAnOrganization") updateAnOrganization

> Updates the properties of an organization.


```php
function updateAnOrganization($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the organization |
| name |  ``` Optional ```  | Organization name |
| ownerId |  ``` Optional ```  | ID of the user who will be marked as the owner of this organization. When omitted, the authorized user ID will be used. |
| visibleTo |  ``` Optional ```  | Visibility of the organization. If omitted, visibility will be set to the default visibility setting of this item type for the authorized user.<dl class=\"fields-list\"><dt>1</dt><dd>Owner &amp; followers (private)</dd><dt>3</dt><dd>Entire company (shared)</dd></dl> |



#### Example Usage

```php
$id = 69;
$collect['id'] = $id;

$name = 'name';
$collect['name'] = $name;

$ownerId = 69;
$collect['ownerId'] = $ownerId;

$visibleTo = int::ENUM_1;
$collect['visibleTo'] = $visibleTo;


$organizations->updateAnOrganization($collect);

```


### <a name="list_activities_associated_with_an_organization"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationsController.listActivitiesAssociatedWithAnOrganization") listActivitiesAssociatedWithAnOrganization

> Lists activities associated with an organization.


```php
function listActivitiesAssociatedWithAnOrganization($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the organization |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |
| done |  ``` Optional ```  | Whether the activity is done or not. 0 = Not done, 1 = Done. If omitted returns both Done and Not done activities. |
| exclude |  ``` Optional ```  | A comma-separated string of activity IDs to exclude from result |



#### Example Usage

```php
$id = 69;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 69;
$collect['limit'] = $limit;

$done = int::ENUM_0;
$collect['done'] = $done;

$exclude = 'exclude';
$collect['exclude'] = $exclude;


$organizations->listActivitiesAssociatedWithAnOrganization($collect);

```


### <a name="list_deals_associated_with_an_organization"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationsController.listDealsAssociatedWithAnOrganization") listDealsAssociatedWithAnOrganization

> Lists deals associated with an organization.


```php
function listDealsAssociatedWithAnOrganization($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the organization |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |
| status |  ``` Optional ```  ``` DefaultValue ```  | Only fetch deals with specific status. If omitted, all not deleted deals are fetched. |
| sort |  ``` Optional ```  | Field names and sorting mode separated by a comma (field_name_1 ASC, field_name_2 DESC). Only first-level field keys are supported (no nested keys). |
| onlyPrimaryAssociation |  ``` Optional ```  | If set, only deals that are directly associated to the organization are fetched. If not set (default), all deals are fetched that are either directly or indirectly related to the organization. Indirect relations include relations through custom, organization-type fields and through persons of the given organization. |



#### Example Usage

```php
$id = 69;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 69;
$collect['limit'] = $limit;

$status = string::ALL_NOT_DELETED;
$collect['status'] = $status;

$sort = 'sort';
$collect['sort'] = $sort;

$onlyPrimaryAssociation = int::ENUM_0;
$collect['onlyPrimaryAssociation'] = $onlyPrimaryAssociation;


$organizations->listDealsAssociatedWithAnOrganization($collect);

```


### <a name="list_files_attached_to_an_organization"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationsController.listFilesAttachedToAnOrganization") listFilesAttachedToAnOrganization

> Lists files associated with an organization.


```php
function listFilesAttachedToAnOrganization($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the organization |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |
| includeDeletedFiles |  ``` Optional ```  | When enabled, the list of files will also include deleted files. Please note that trying to download these files will not work. |
| sort |  ``` Optional ```  | Field names and sorting mode separated by a comma (field_name_1 ASC, field_name_2 DESC). Only first-level field keys are supported (no nested keys). Supported fields: id, user_id, deal_id, person_id, org_id, product_id, add_time, update_time, file_name, file_type, file_size, comment. |



#### Example Usage

```php
$id = 69;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 69;
$collect['limit'] = $limit;

$includeDeletedFiles = int::ENUM_0;
$collect['includeDeletedFiles'] = $includeDeletedFiles;

$sort = 'sort';
$collect['sort'] = $sort;


$organizations->listFilesAttachedToAnOrganization($collect);

```


### <a name="list_updates_about_an_organization"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationsController.listUpdatesAboutAnOrganization") listUpdatesAboutAnOrganization

> Lists updates about an organization.


```php
function listUpdatesAboutAnOrganization($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the organization |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |



#### Example Usage

```php
$id = 69;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 69;
$collect['limit'] = $limit;


$organizations->listUpdatesAboutAnOrganization($collect);

```


### <a name="list_followers_of_an_organization"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationsController.listFollowersOfAnOrganization") listFollowersOfAnOrganization

> Lists the followers of an organization.


```php
function listFollowersOfAnOrganization($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the organization |



#### Example Usage

```php
$id = 69;

$organizations->listFollowersOfAnOrganization($id);

```


### <a name="add_a_follower_to_an_organization"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationsController.addAFollowerToAnOrganization") addAFollowerToAnOrganization

> Adds a follower to an organization.


```php
function addAFollowerToAnOrganization($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the organization |
| userId |  ``` Required ```  | ID of the user |



#### Example Usage

```php
$id = 69;
$collect['id'] = $id;

$userId = 69;
$collect['userId'] = $userId;


$organizations->addAFollowerToAnOrganization($collect);

```


### <a name="delete_a_follower_from_an_organization"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationsController.deleteAFollowerFromAnOrganization") deleteAFollowerFromAnOrganization

> Deletes a follower from an organization. You can retrieve the follower_id from the <a href="https://developers.pipedrive.com/docs/api/v1/#!/Organizations/get_organizations_id_followers">List followers of an organization</a> endpoint.


```php
function deleteAFollowerFromAnOrganization($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the organization |
| followerId |  ``` Required ```  | ID of the follower |



#### Example Usage

```php
$id = 69;
$collect['id'] = $id;

$followerId = 69;
$collect['followerId'] = $followerId;


$organizations->deleteAFollowerFromAnOrganization($collect);

```


### <a name="list_mail_messages_associated_with_an_organization"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationsController.listMailMessagesAssociatedWithAnOrganization") listMailMessagesAssociatedWithAnOrganization

> Lists mail messages associated with an organization.


```php
function listMailMessagesAssociatedWithAnOrganization($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the organization |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |



#### Example Usage

```php
$id = 69;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 69;
$collect['limit'] = $limit;


$organizations->listMailMessagesAssociatedWithAnOrganization($collect);

```


### <a name="update_merge_two_organizations"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationsController.updateMergeTwoOrganizations") updateMergeTwoOrganizations

> Merges an organization with another organization. For more information on how to merge two organizations, see <a href="https://pipedrive.readme.io/docs/merging-two-organizations" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function updateMergeTwoOrganizations($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the organization |
| mergeWithId |  ``` Required ```  | ID of the organization that the organization will be merged with |



#### Example Usage

```php
$id = 69;
$collect['id'] = $id;

$mergeWithId = 69;
$collect['mergeWithId'] = $mergeWithId;


$organizations->updateMergeTwoOrganizations($collect);

```


### <a name="list_permitted_users"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationsController.listPermittedUsers") listPermittedUsers

> List users permitted to access an organization


```php
function listPermittedUsers($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the organization |



#### Example Usage

```php
$id = 69;

$organizations->listPermittedUsers($id);

```


### <a name="list_persons_of_an_organization"></a>![Method: ](https://apidocs.io/img/method.png ".OrganizationsController.listPersonsOfAnOrganization") listPersonsOfAnOrganization

> Lists persons associated with an organization.


```php
function listPersonsOfAnOrganization($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the organization |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |



#### Example Usage

```php
$id = 69;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 69;
$collect['limit'] = $limit;


$organizations->listPersonsOfAnOrganization($collect);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="permission_sets_controller"></a>![Class: ](https://apidocs.io/img/class.png ".PermissionSetsController") PermissionSetsController

### Get singleton instance

The singleton instance of the ``` PermissionSetsController ``` class can be accessed from the API Client.

```php
$permissionSets = $client->getPermissionSets();
```

### <a name="get_all_permission_sets"></a>![Method: ](https://apidocs.io/img/method.png ".PermissionSetsController.getAllPermissionSets") getAllPermissionSets

> Get all Permission Sets


```php
function getAllPermissionSets()
```

#### Example Usage

```php

$result = $permissionSets->getAllPermissionSets();

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 404 | If the User ID has no assignments, then it will return NotFound |



### <a name="get_one_permission_set"></a>![Method: ](https://apidocs.io/img/method.png ".PermissionSetsController.getOnePermissionSet") getOnePermissionSet

> Get one Permission Set


```php
function getOnePermissionSet($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the permission set |



#### Example Usage

```php
$id = 69;

$result = $permissionSets->getOnePermissionSet($id);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 404 | If the User ID has no assignments, then it will return NotFound |



### <a name="list_permission_set_assignments"></a>![Method: ](https://apidocs.io/img/method.png ".PermissionSetsController.listPermissionSetAssignments") listPermissionSetAssignments

> The list of assignments for a Permission Set


```php
function listPermissionSetAssignments($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the permission set |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |



#### Example Usage

```php
$id = 69;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 69;
$collect['limit'] = $limit;


$result = $permissionSets->listPermissionSetAssignments($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 404 | If the User ID has no assignments, then it will return NotFound |



[Back to List of Controllers](#list_of_controllers)

## <a name="person_fields_controller"></a>![Class: ](https://apidocs.io/img/class.png ".PersonFieldsController") PersonFieldsController

### Get singleton instance

The singleton instance of the ``` PersonFieldsController ``` class can be accessed from the API Client.

```php
$personFields = $client->getPersonFields();
```

### <a name="delete_multiple_person_fields_in_bulk"></a>![Method: ](https://apidocs.io/img/method.png ".PersonFieldsController.deleteMultiplePersonFieldsInBulk") deleteMultiplePersonFieldsInBulk

> Marks multiple fields as deleted.


```php
function deleteMultiplePersonFieldsInBulk($ids)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| ids |  ``` Required ```  | Comma-separated field IDs to delete |



#### Example Usage

```php
$ids = 'ids';

$personFields->deleteMultiplePersonFieldsInBulk($ids);

```


### <a name="get_all_person_fields"></a>![Method: ](https://apidocs.io/img/method.png ".PersonFieldsController.getAllPersonFields") getAllPersonFields

> Returns data about all person fields


```php
function getAllPersonFields()
```

#### Example Usage

```php

$personFields->getAllPersonFields();

```


### <a name="add_a_new_person_field"></a>![Method: ](https://apidocs.io/img/method.png ".PersonFieldsController.addANewPersonField") addANewPersonField

> Adds a new person field. For more information on adding a new custom field, see <a href="https://pipedrive.readme.io/docs/adding-a-new-custom-field" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function addANewPersonField($body = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| body |  ``` Optional ```  | TODO: Add a parameter description |



#### Example Usage

```php
$body = array('key' => 'value');

$personFields->addANewPersonField($body);

```


### <a name="delete_a_person_field"></a>![Method: ](https://apidocs.io/img/method.png ".PersonFieldsController.deleteAPersonField") deleteAPersonField

> Marks a field as deleted. For more information on how to delete a custom field, see <a href="https://pipedrive.readme.io/docs/deleting-a-custom-field" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function deleteAPersonField($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the field |



#### Example Usage

```php
$id = 69;

$personFields->deleteAPersonField($id);

```


### <a name="get_one_person_field"></a>![Method: ](https://apidocs.io/img/method.png ".PersonFieldsController.getOnePersonField") getOnePersonField

> Returns data about a specific person field.


```php
function getOnePersonField($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the field |



#### Example Usage

```php
$id = 69;

$personFields->getOnePersonField($id);

```


### <a name="update_a_person_field"></a>![Method: ](https://apidocs.io/img/method.png ".PersonFieldsController.updateAPersonField") updateAPersonField

> Updates a person field. See an example of updating custom fields’ values in <a href="https://pipedrive.readme.io/docs/updating-custom-field-value" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function updateAPersonField($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the field |
| name |  ``` Required ```  | Name of the field |
| options |  ``` Optional ```  | When field_type is either set or enum, possible options must be supplied as a JSON-encoded sequential array of objects. All active items must be supplied and already existing items must have their ID supplied. New items only require a label. Example: [{"id":123,"label":"Existing Item"},{"label":"New Item"}] |



#### Example Usage

```php
$id = 69;
$collect['id'] = $id;

$name = 'name';
$collect['name'] = $name;

$options = 'options';
$collect['options'] = $options;


$personFields->updateAPersonField($collect);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="persons_controller"></a>![Class: ](https://apidocs.io/img/class.png ".PersonsController") PersonsController

### Get singleton instance

The singleton instance of the ``` PersonsController ``` class can be accessed from the API Client.

```php
$persons = $client->getPersons();
```

### <a name="delete_multiple_persons_in_bulk"></a>![Method: ](https://apidocs.io/img/method.png ".PersonsController.deleteMultiplePersonsInBulk") deleteMultiplePersonsInBulk

> Marks multiple persons as deleted.


```php
function deleteMultiplePersonsInBulk($ids = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| ids |  ``` Optional ```  | Comma-separated IDs that will be deleted |



#### Example Usage

```php
$ids = 'ids';

$persons->deleteMultiplePersonsInBulk($ids);

```


### <a name="get_all_persons"></a>![Method: ](https://apidocs.io/img/method.png ".PersonsController.getAllPersons") getAllPersons

> Returns all persons


```php
function getAllPersons($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| userId |  ``` Optional ```  | If supplied, only persons owned by the given user will be returned. |
| filterId |  ``` Optional ```  | ID of the filter to use. |
| firstChar |  ``` Optional ```  | If supplied, only persons whose name starts with the specified letter will be returned (case insensitive). |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |
| sort |  ``` Optional ```  | Field names and sorting mode separated by a comma (field_name_1 ASC, field_name_2 DESC). Only first-level field keys are supported (no nested keys). |



#### Example Usage

```php
$userId = 233;
$collect['userId'] = $userId;

$filterId = 233;
$collect['filterId'] = $filterId;

$firstChar = 'first_char';
$collect['firstChar'] = $firstChar;

$start = 0;
$collect['start'] = $start;

$limit = 233;
$collect['limit'] = $limit;

$sort = 'sort';
$collect['sort'] = $sort;


$persons->getAllPersons($collect);

```

### <a name="search_persons"></a>![Method: ](https://apidocs.io/img/method.png ".PersonsController.searchPersons") searchPersons

> Searches all Persons by name, email, phone, notes and/or custom fields. This endpoint is a wrapper of /v1/itemSearch with a narrower OAuth scope. Found Persons can be filtered by Organization ID.


```php
function searchPersons($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| term |  ``` Required ```  | The search term to look for. Minimum 2 characters (or 1 if using exact_match). |
| fields |  ``` Optional ```  | A comma-separated string array. The fields to perform the search from. Defaults to all of them. |
| exactMatch |  ``` Optional ```  | When enabled, only full exact matches against the given term are returned. It is not case sensitive. |
| organizationId |  ``` Optional ```  | Will filter Deals by the provided Organization ID. The upper limit of found Deals associated with the Organization is 2000. |
| includeFields |  ``` Optional ```  | Supports including optional fields in the results which are not provided by default. |
| start |  ``` Optional ```  | Pagination start. Note that the pagination is based on main results and does not include related items when using search_for_related_items parameter. |
| limit |  ``` Optional ```  | Items shown per page |


#### Example Usage

```php
$term = 'term';
$collect['term'] = $term;

$results = $persons->searchPersons($collect);

```


### <a name="add_a_person"></a>![Method: ](https://apidocs.io/img/method.png ".PersonsController.addAPerson") addAPerson

> Adds a new person. Note that you can supply additional custom fields along with the request that are not described here. These custom fields are different for each Pipedrive account and can be recognized by long hashes as keys. To determine which custom fields exists, fetch the personFields and look for 'key' values.


```php
function addAPerson($body = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| body |  ``` Optional ```  | TODO: Add a parameter description |



#### Example Usage

```php
$body = array('key' => 'value');

$persons->addAPerson($body);

```


### <a name="delete_a_person"></a>![Method: ](https://apidocs.io/img/method.png ".PersonsController.deleteAPerson") deleteAPerson

> Marks a person as deleted.


```php
function deleteAPerson($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of a person |



#### Example Usage

```php
$id = 233;

$persons->deleteAPerson($id);

```


### <a name="get_details_of_a_person"></a>![Method: ](https://apidocs.io/img/method.png ".PersonsController.getDetailsOfAPerson") getDetailsOfAPerson

> Returns details of a person. Note that this also returns some additional fields which are not present when asking for all persons. Also note that custom fields appear as long hashes in the resulting data. These hashes can be mapped against the 'key' value of personFields.


```php
function getDetailsOfAPerson($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of a person |



#### Example Usage

```php
$id = 233;

$persons->getDetailsOfAPerson($id);

```


### <a name="update_a_person"></a>![Method: ](https://apidocs.io/img/method.png ".PersonsController.updateAPerson") updateAPerson

> Updates the properties of a person. For more information on how to update a person, see <a href="https://pipedrive.readme.io/docs/updating-a-person" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function updateAPerson($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of a person |
| name |  ``` Optional ```  | Person name |
| ownerId |  ``` Optional ```  | ID of the user who will be marked as the owner of this person. When omitted, the authorized user ID will be used. |
| orgId |  ``` Optional ```  | ID of the organization this person will belong to. |
| email |  ``` Optional ```  ``` Collection ```  | Email addresses (one or more) associated with the person, presented in the same manner as received by GET request of a person. |
| phone |  ``` Optional ```  ``` Collection ```  | Phone numbers (one or more) associated with the person, presented in the same manner as received by GET request of a person. |
| visibleTo |  ``` Optional ```  | Visibility of the person. If omitted, visibility will be set to the default visibility setting of this item type for the authorized user.<dl class="fields-list"><dt>1</dt><dd>Owner &amp; followers (private)</dd><dt>3</dt><dd>Entire company (shared)</dd></dl> |



#### Example Usage

```php
$id = 233;
$collect['id'] = $id;

$name = 'name';
$collect['name'] = $name;

$ownerId = 233;
$collect['ownerId'] = $ownerId;

$orgId = 233;
$collect['orgId'] = $orgId;

$email = array('email');
$collect['email'] = $email;

$phone = array('phone');
$collect['phone'] = $phone;

$visibleTo = int::ENUM_1;
$collect['visibleTo'] = $visibleTo;


$persons->updateAPerson($collect);

```


### <a name="list_activities_associated_with_a_person"></a>![Method: ](https://apidocs.io/img/method.png ".PersonsController.listActivitiesAssociatedWithAPerson") listActivitiesAssociatedWithAPerson

> Lists activities associated with a person.


```php
function listActivitiesAssociatedWithAPerson($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of a person |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |
| done |  ``` Optional ```  | Whether the activity is done or not. 0 = Not done, 1 = Done. If omitted returns both Done and Not done activities. |
| exclude |  ``` Optional ```  | A comma-separated string of activity IDs to exclude from result |



#### Example Usage

```php
$id = 233;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 233;
$collect['limit'] = $limit;

$done = int::ENUM_0;
$collect['done'] = $done;

$exclude = 'exclude';
$collect['exclude'] = $exclude;


$persons->listActivitiesAssociatedWithAPerson($collect);

```


### <a name="list_deals_associated_with_a_person"></a>![Method: ](https://apidocs.io/img/method.png ".PersonsController.listDealsAssociatedWithAPerson") listDealsAssociatedWithAPerson

> Lists deals associated with a person.


```php
function listDealsAssociatedWithAPerson($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of a person |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |
| status |  ``` Optional ```  ``` DefaultValue ```  | Only fetch deals with specific status. If omitted, all not deleted deals are fetched. |
| sort |  ``` Optional ```  | Field names and sorting mode separated by a comma (field_name_1 ASC, field_name_2 DESC). Only first-level field keys are supported (no nested keys). |



#### Example Usage

```php
$id = 233;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 233;
$collect['limit'] = $limit;

$status = string::ALL_NOT_DELETED;
$collect['status'] = $status;

$sort = 'sort';
$collect['sort'] = $sort;


$persons->listDealsAssociatedWithAPerson($collect);

```


### <a name="list_files_attached_to_a_person"></a>![Method: ](https://apidocs.io/img/method.png ".PersonsController.listFilesAttachedToAPerson") listFilesAttachedToAPerson

> Lists files associated with a person.


```php
function listFilesAttachedToAPerson($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of a person |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |
| includeDeletedFiles |  ``` Optional ```  | When enabled, the list of files will also include deleted files. Please note that trying to download these files will not work. |
| sort |  ``` Optional ```  | Field names and sorting mode separated by a comma (field_name_1 ASC, field_name_2 DESC). Only first-level field keys are supported (no nested keys). Supported fields: id, user_id, deal_id, person_id, org_id, product_id, add_time, update_time, file_name, file_type, file_size, comment. |



#### Example Usage

```php
$id = 233;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 233;
$collect['limit'] = $limit;

$includeDeletedFiles = int::ENUM_0;
$collect['includeDeletedFiles'] = $includeDeletedFiles;

$sort = 'sort';
$collect['sort'] = $sort;


$persons->listFilesAttachedToAPerson($collect);

```


### <a name="list_updates_about_a_person"></a>![Method: ](https://apidocs.io/img/method.png ".PersonsController.listUpdatesAboutAPerson") listUpdatesAboutAPerson

> Lists updates about a person.


```php
function listUpdatesAboutAPerson($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of a person |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |



#### Example Usage

```php
$id = 233;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 233;
$collect['limit'] = $limit;


$persons->listUpdatesAboutAPerson($collect);

```


### <a name="list_followers_of_a_person"></a>![Method: ](https://apidocs.io/img/method.png ".PersonsController.listFollowersOfAPerson") listFollowersOfAPerson

> Lists the followers of a person.


```php
function listFollowersOfAPerson($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of a person |



#### Example Usage

```php
$id = 233;

$persons->listFollowersOfAPerson($id);

```


### <a name="add_a_follower_to_a_person"></a>![Method: ](https://apidocs.io/img/method.png ".PersonsController.addAFollowerToAPerson") addAFollowerToAPerson

> Adds a follower to a person.


```php
function addAFollowerToAPerson($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of a person |
| userId |  ``` Required ```  | ID of the user |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$userId = 19;
$collect['userId'] = $userId;


$persons->addAFollowerToAPerson($collect);

```


### <a name="deletes_a_follower_from_a_person"></a>![Method: ](https://apidocs.io/img/method.png ".PersonsController.deletesAFollowerFromAPerson") deletesAFollowerFromAPerson

> Delete a follower from a person


```php
function deletesAFollowerFromAPerson($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of a person |
| followerId |  ``` Required ```  | ID of the follower |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$followerId = 19;
$collect['followerId'] = $followerId;


$persons->deletesAFollowerFromAPerson($collect);

```


### <a name="list_mail_messages_associated_with_a_person"></a>![Method: ](https://apidocs.io/img/method.png ".PersonsController.listMailMessagesAssociatedWithAPerson") listMailMessagesAssociatedWithAPerson

> Lists mail messages associated with a person.


```php
function listMailMessagesAssociatedWithAPerson($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of a person |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 19;
$collect['limit'] = $limit;


$persons->listMailMessagesAssociatedWithAPerson($collect);

```


### <a name="update_merge_two_persons"></a>![Method: ](https://apidocs.io/img/method.png ".PersonsController.updateMergeTwoPersons") updateMergeTwoPersons

> Merges a person with another person. For more information on how to merge two persons, see <a href="https://pipedrive.readme.io/docs/merging-two-persons" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function updateMergeTwoPersons($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of a person |
| mergeWithId |  ``` Required ```  | ID of the person that the person will be merged with |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$mergeWithId = 19;
$collect['mergeWithId'] = $mergeWithId;


$persons->updateMergeTwoPersons($collect);

```


### <a name="list_permitted_users"></a>![Method: ](https://apidocs.io/img/method.png ".PersonsController.listPermittedUsers") listPermittedUsers

> List users permitted to access a person


```php
function listPermittedUsers($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of a person |



#### Example Usage

```php
$id = 19;

$persons->listPermittedUsers($id);

```


### <a name="delete_person_picture"></a>![Method: ](https://apidocs.io/img/method.png ".PersonsController.deletePersonPicture") deletePersonPicture

> Delete person picture


```php
function deletePersonPicture($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of a person |



#### Example Usage

```php
$id = 19;

$persons->deletePersonPicture($id);

```


### <a name="add_person_picture"></a>![Method: ](https://apidocs.io/img/method.png ".PersonsController.addPersonPicture") addPersonPicture

> Add a picture to a person. If a picture is already set, the old picture will be replaced. Added image (or the cropping parameters supplied with the request) should have an equal width and height and should be at least 128 pixels. GIF, JPG and PNG are accepted. All added images will be resized to 128 and 512 pixel wide squares.


```php
function addPersonPicture($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of a person |
| file |  ``` Required ```  | One image supplied in the multipart/form-data encoding. |
| cropX |  ``` Optional ```  | X coordinate to where start cropping form (in pixels) |
| cropY |  ``` Optional ```  | Y coordinate to where start cropping form (in pixels) |
| cropWidth |  ``` Optional ```  | Width of cropping area (in pixels) |
| cropHeight |  ``` Optional ```  | Height of cropping area (in pixels) |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$file = "PathToFile";
$collect['file'] = $file;

$cropX = 19;
$collect['cropX'] = $cropX;

$cropY = 19;
$collect['cropY'] = $cropY;

$cropWidth = 19;
$collect['cropWidth'] = $cropWidth;

$cropHeight = 19;
$collect['cropHeight'] = $cropHeight;


$persons->addPersonPicture($collect);

```


### <a name="list_products_associated_with_a_person"></a>![Method: ](https://apidocs.io/img/method.png ".PersonsController.listProductsAssociatedWithAPerson") listProductsAssociatedWithAPerson

> Lists products associated with a person.


```php
function listProductsAssociatedWithAPerson($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of a person |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 19;
$collect['limit'] = $limit;


$persons->listProductsAssociatedWithAPerson($collect);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="pipelines_controller"></a>![Class: ](https://apidocs.io/img/class.png ".PipelinesController") PipelinesController

### Get singleton instance

The singleton instance of the ``` PipelinesController ``` class can be accessed from the API Client.

```php
$pipelines = $client->getPipelines();
```

### <a name="get_all_pipelines"></a>![Method: ](https://apidocs.io/img/method.png ".PipelinesController.getAllPipelines") getAllPipelines

> Returns data about all pipelines


```php
function getAllPipelines()
```

#### Example Usage

```php

$pipelines->getAllPipelines();

```


### <a name="add_a_new_pipeline"></a>![Method: ](https://apidocs.io/img/method.png ".PipelinesController.addANewPipeline") addANewPipeline

> Adds a new pipeline


```php
function addANewPipeline($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| name |  ``` Optional ```  | Name of the pipeline |
| dealProbability |  ``` Optional ```  | TODO: Add a parameter description |
| orderNr |  ``` Optional ```  | Defines pipelines order. First order(order_nr=0) is the default pipeline. |
| active |  ``` Optional ```  | TODO: Add a parameter description |



#### Example Usage

```php
$name = 'name';
$collect['name'] = $name;

$dealProbability = int::ENUM_0;
$collect['dealProbability'] = $dealProbability;

$orderNr = 19;
$collect['orderNr'] = $orderNr;

$active = int::ENUM_0;
$collect['active'] = $active;


$pipelines->addANewPipeline($collect);

```


### <a name="delete_a_pipeline"></a>![Method: ](https://apidocs.io/img/method.png ".PipelinesController.deleteAPipeline") deleteAPipeline

> Marks a pipeline as deleted.


```php
function deleteAPipeline($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the pipeline |



#### Example Usage

```php
$id = 19;

$pipelines->deleteAPipeline($id);

```


### <a name="get_one_pipeline"></a>![Method: ](https://apidocs.io/img/method.png ".PipelinesController.getOnePipeline") getOnePipeline

> Returns data about a specific pipeline. Also returns the summary of the deals in this pipeline across its stages.


```php
function getOnePipeline($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the pipeline |
| totalsConvertCurrency |  ``` Optional ```  | 3-letter currency code of any of the supported currencies. When supplied, per_stages_converted is returned in deals_summary which contains the currency-converted total amounts in the given currency per each stage. You may also set this parameter to 'default_currency' in which case users default currency is used. |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$totalsConvertCurrency = 'totals_convert_currency';
$collect['totalsConvertCurrency'] = $totalsConvertCurrency;


$pipelines->getOnePipeline($collect);

```


### <a name="update_edit_a_pipeline"></a>![Method: ](https://apidocs.io/img/method.png ".PipelinesController.updateEditAPipeline") updateEditAPipeline

> Updates pipeline properties


```php
function updateEditAPipeline($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the pipeline |
| name |  ``` Optional ```  | Name of the pipeline |
| dealProbability |  ``` Optional ```  | TODO: Add a parameter description |
| orderNr |  ``` Optional ```  | Defines pipelines order. First order(order_nr=0) is the default pipeline. |
| active |  ``` Optional ```  | TODO: Add a parameter description |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$name = 'name';
$collect['name'] = $name;

$dealProbability = int::ENUM_0;
$collect['dealProbability'] = $dealProbability;

$orderNr = 19;
$collect['orderNr'] = $orderNr;

$active = int::ENUM_0;
$collect['active'] = $active;


$pipelines->updateEditAPipeline($collect);

```


### <a name="get_deals_conversion_rates_in_pipeline"></a>![Method: ](https://apidocs.io/img/method.png ".PipelinesController.getDealsConversionRatesInPipeline") getDealsConversionRatesInPipeline

> Returns all stage-to-stage conversion and pipeline-to-close rates for given time period.


```php
function getDealsConversionRatesInPipeline($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the pipeline |
| startDate |  ``` Required ```  | Start of the period. Date in format of YYYY-MM-DD. |
| endDate |  ``` Required ```  | End of the period. Date in format of YYYY-MM-DD. |
| userId |  ``` Optional ```  | ID of the user who's pipeline metrics statistics to fetch. If omitted, the authorized user will be used. |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$startDate = date("D M d, Y G:i");
$collect['startDate'] = $startDate;

$endDate = date("D M d, Y G:i");
$collect['endDate'] = $endDate;

$userId = 19;
$collect['userId'] = $userId;


$pipelines->getDealsConversionRatesInPipeline($collect);

```


### <a name="get_deals_in_a_pipeline"></a>![Method: ](https://apidocs.io/img/method.png ".PipelinesController.getDealsInAPipeline") getDealsInAPipeline

> Lists deals in a specific pipeline across all its stages


```php
function getDealsInAPipeline($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the pipeline |
| filterId |  ``` Optional ```  | If supplied, only deals matching the given filter will be returned. |
| userId |  ``` Optional ```  | If supplied, filter_id will not be considered and only deals owned by the given user will be returned. If omitted, deals owned by the authorized user will be returned. |
| everyone |  ``` Optional ```  | If supplied, filter_id and user_id will not be considered – instead, deals owned by everyone will be returned. |
| stageId |  ``` Optional ```  | If supplied, only deals within the given stage will be returned. |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |
| getSummary |  ``` Optional ```  | Whether to include summary of the pipeline in the additional_data or not. |
| totalsConvertCurrency |  ``` Optional ```  | 3-letter currency code of any of the supported currencies. When supplied, per_stages_converted is returned inside deals_summary inside additional_data which contains the currency-converted total amounts in the given currency per each stage. You may also set this parameter to 'default_currency' in which case users default currency is used. Only works when get_summary parameter flag is enabled. |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$filterId = 19;
$collect['filterId'] = $filterId;

$userId = 19;
$collect['userId'] = $userId;

$everyone = int::ENUM_0;
$collect['everyone'] = $everyone;

$stageId = 19;
$collect['stageId'] = $stageId;

$start = 0;
$collect['start'] = $start;

$limit = 19;
$collect['limit'] = $limit;

$getSummary = int::ENUM_0;
$collect['getSummary'] = $getSummary;

$totalsConvertCurrency = 'totals_convert_currency';
$collect['totalsConvertCurrency'] = $totalsConvertCurrency;


$pipelines->getDealsInAPipeline($collect);

```


### <a name="get_deals_movements_in_pipeline"></a>![Method: ](https://apidocs.io/img/method.png ".PipelinesController.getDealsMovementsInPipeline") getDealsMovementsInPipeline

> Returns statistics for deals movements for given time period.


```php
function getDealsMovementsInPipeline($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the pipeline |
| startDate |  ``` Required ```  | Start of the period. Date in format of YYYY-MM-DD. |
| endDate |  ``` Required ```  | End of the period. Date in format of YYYY-MM-DD. |
| userId |  ``` Optional ```  | ID of the user who's pipeline statistics to fetch. If omitted, the authorized user will be used. |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$startDate = date("D M d, Y G:i");
$collect['startDate'] = $startDate;

$endDate = date("D M d, Y G:i");
$collect['endDate'] = $endDate;

$userId = 19;
$collect['userId'] = $userId;


$pipelines->getDealsMovementsInPipeline($collect);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="product_fields_controller"></a>![Class: ](https://apidocs.io/img/class.png ".ProductFieldsController") ProductFieldsController

### Get singleton instance

The singleton instance of the ``` ProductFieldsController ``` class can be accessed from the API Client.

```php
$productFields = $client->getProductFields();
```

### <a name="delete_multiple_product_fields_in_bulk"></a>![Method: ](https://apidocs.io/img/method.png ".ProductFieldsController.deleteMultipleProductFieldsInBulk") deleteMultipleProductFieldsInBulk

> Marks multiple fields as deleted.


```php
function deleteMultipleProductFieldsInBulk($ids)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| ids |  ``` Required ```  | Comma-separated field IDs to delete |



#### Example Usage

```php
$ids = 'ids';

$result = $productFields->deleteMultipleProductFieldsInBulk($ids);

```


### <a name="get_all_product_fields"></a>![Method: ](https://apidocs.io/img/method.png ".ProductFieldsController.getAllProductFields") getAllProductFields

> Returns data about all product fields


```php
function getAllProductFields()
```

#### Example Usage

```php

$result = $productFields->getAllProductFields();

```


### <a name="add_a_new_product_field"></a>![Method: ](https://apidocs.io/img/method.png ".ProductFieldsController.addANewProductField") addANewProductField

> Adds a new product field. For more information on adding a new custom field, see <a href="https://pipedrive.readme.io/docs/adding-a-new-custom-field" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function addANewProductField($body = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| body |  ``` Optional ```  | TODO: Add a parameter description |



#### Example Usage

```php
$body = array('key' => 'value');

$result = $productFields->addANewProductField($body);

```


### <a name="delete_a_product_field"></a>![Method: ](https://apidocs.io/img/method.png ".ProductFieldsController.deleteAProductField") deleteAProductField

> Marks a field as deleted. For more information on how to delete a custom field, see <a href="https://pipedrive.readme.io/docs/deleting-a-custom-field" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function deleteAProductField($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the Product Field |



#### Example Usage

```php
$id = 19;

$result = $productFields->deleteAProductField($id);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 410 | The Product Field with the specified ID does not exist or is inaccessible |



### <a name="get_one_product_field"></a>![Method: ](https://apidocs.io/img/method.png ".ProductFieldsController.getOneProductField") getOneProductField

> Returns data about a specific product field.


```php
function getOneProductField($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the Product Field |



#### Example Usage

```php
$id = 19;

$result = $productFields->getOneProductField($id);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 410 | The Product Field with the specified ID does not exist or is inaccessible |



### <a name="update_a_product_field"></a>![Method: ](https://apidocs.io/img/method.png ".ProductFieldsController.updateAProductField") updateAProductField

> Updates a product field. See an example of updating custom fields’ values in <a href=" https://pipedrive.readme.io/docs/updating-custom-field-value " target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function updateAProductField($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the Product Field |
| name |  ``` Required ```  | Name of the field |
| options |  ``` Optional ```  | When field_type is either set or enum, possible options must be supplied as a JSON-encoded sequential array, for example: ["red","blue","lilac"] |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$name = 'name';
$collect['name'] = $name;

$options = 'options';
$collect['options'] = $options;


$result = $productFields->updateAProductField($collect);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="products_controller"></a>![Class: ](https://apidocs.io/img/class.png ".ProductsController") ProductsController

### Get singleton instance

The singleton instance of the ``` ProductsController ``` class can be accessed from the API Client.

```php
$products = $client->getProducts();
```

### <a name="get_all_products"></a>![Method: ](https://apidocs.io/img/method.png ".ProductsController.getAllProducts") getAllProducts

> Returns data about all products.


```php
function getAllProducts($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| userId |  ``` Optional ```  | If supplied, only products owned by the given user will be returned. |
| filterId |  ``` Optional ```  | ID of the filter to use |
| firstChar |  ``` Optional ```  | If supplied, only products whose name starts with the specified letter will be returned (case insensitive). |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |



#### Example Usage

```php
$userId = 19;
$collect['userId'] = $userId;

$filterId = 19;
$collect['filterId'] = $filterId;

$firstChar = 'first_char';
$collect['firstChar'] = $firstChar;

$start = 0;
$collect['start'] = $start;

$limit = 19;
$collect['limit'] = $limit;


$result = $products->getAllProducts($collect);

```

### <a name="search_products"></a>![Method: ](https://apidocs.io/img/method.png ".ProductsController.searchProducts") searchProducts

> Searches all Products by name, code and/or custom fields. This endpoint is a wrapper of /v1/itemSearch with a narrower OAuth scope.


```php
function searchProducts($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| term |  ``` Required ```  | The search term to look for. Minimum 2 characters (or 1 if using exact_match). |
| fields |  ``` Optional ```  | A comma-separated string array. The fields to perform the search from. Defaults to all of them. |
| exactMatch |  ``` Optional ```  | When enabled, only full exact matches against the given term are returned. It is not case sensitive. |
| includeFields |  ``` Optional ```  | Supports including optional fields in the results which are not provided by default. |
| start |  ``` Optional ```  | Pagination start. Note that the pagination is based on main results and does not include related items when using search_for_related_items parameter. |
| limit |  ``` Optional ```  | Items shown per page |


#### Example Usage

```php
$term = 'term';
$collect['term'] = $term;

$results = $products->searchProducts($collect);

```


### <a name="add_a_product"></a>![Method: ](https://apidocs.io/img/method.png ".ProductsController.addAProduct") addAProduct

> Adds a new product to the products inventory. For more information on how to add a product, see <a href="https://pipedrive.readme.io/docs/adding-a-product" target="_blank" rel="noopener noreferrer">this tutorial</a>.


```php
function addAProduct($body = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| body |  ``` Optional ```  | TODO: Add a parameter description |



#### Example Usage

```php
$body = array('key' => 'value');

$products->addAProduct($body);

```


### <a name="delete_a_product"></a>![Method: ](https://apidocs.io/img/method.png ".ProductsController.deleteAProduct") deleteAProduct

> Marks a product as deleted.


```php
function deleteAProduct($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the product |



#### Example Usage

```php
$id = 19;

$products->deleteAProduct($id);

```


### <a name="get_one_product"></a>![Method: ](https://apidocs.io/img/method.png ".ProductsController.getOneProduct") getOneProduct

> Returns data about a specific product.


```php
function getOneProduct($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the product |



#### Example Usage

```php
$id = 19;

$products->getOneProduct($id);

```


### <a name="update_a_product"></a>![Method: ](https://apidocs.io/img/method.png ".ProductsController.updateAProduct") updateAProduct

> Updates product data.


```php
function updateAProduct($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the product |
| name |  ``` Optional ```  | Name of the product. |
| code |  ``` Optional ```  | Product code. |
| unit |  ``` Optional ```  | Unit in which this product is sold |
| tax |  ``` Optional ```  | Tax percentage |
| activeFlag |  ``` Optional ```  | Whether this product will be made active or not. |
| visibleTo |  ``` Optional ```  | Visibility of the product. If omitted, visibility will be set to the default visibility setting of this item type for the authorized user.<dl class="fields-list"><dt>1</dt><dd>Owner &amp; followers (private)</dd><dt>3</dt><dd>Entire company (shared)</dd></dl> |
| ownerId |  ``` Optional ```  | ID of the user who will be marked as the owner of this product. When omitted, the authorized user ID will be used. |
| prices |  ``` Optional ```  | Array of objects, each containing: currency (string), price (number), cost (number, optional), overhead_cost (number, optional). Note that there can only be one price per product per currency. When 'prices' is omitted altogether, no prices will be set up for the product. |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$name = 'name';
$collect['name'] = $name;

$code = 'code';
$collect['code'] = $code;

$unit = 'unit';
$collect['unit'] = $unit;

$tax = 19.9144447454784;
$collect['tax'] = $tax;

$activeFlag = int::ENUM_0;
$collect['activeFlag'] = $activeFlag;

$visibleTo = int::ENUM_1;
$collect['visibleTo'] = $visibleTo;

$ownerId = 19;
$collect['ownerId'] = $ownerId;

$prices = 'prices';
$collect['prices'] = $prices;


$result = $products->updateAProduct($collect);

```


### <a name="get_deals_where_a_product_is_attached_to"></a>![Method: ](https://apidocs.io/img/method.png ".ProductsController.getDealsWhereAProductIsAttachedTo") getDealsWhereAProductIsAttachedTo

> Returns data about deals that have a product attached to.


```php
function getDealsWhereAProductIsAttachedTo($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the product |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |
| status |  ``` Optional ```  ``` DefaultValue ```  | Only fetch deals with specific status. If omitted, all not deleted deals are fetched. |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 19;
$collect['limit'] = $limit;

$status = string::ALL_NOT_DELETED;
$collect['status'] = $status;


$result = $products->getDealsWhereAProductIsAttachedTo($collect);

```


### <a name="list_files_attached_to_a_product"></a>![Method: ](https://apidocs.io/img/method.png ".ProductsController.listFilesAttachedToAProduct") listFilesAttachedToAProduct

> Lists files associated with a product.


```php
function listFilesAttachedToAProduct($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the product |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |
| includeDeletedFiles |  ``` Optional ```  | When enabled, the list of files will also include deleted files. Please note that trying to download these files will not work. |
| sort |  ``` Optional ```  | Field names and sorting mode separated by a comma (field_name_1 ASC, field_name_2 DESC). Only first-level field keys are supported (no nested keys). Supported fields: id, user_id, deal_id, person_id, org_id, product_id, add_time, update_time, file_name, file_type, file_size, comment. |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 19;
$collect['limit'] = $limit;

$includeDeletedFiles = int::ENUM_0;
$collect['includeDeletedFiles'] = $includeDeletedFiles;

$sort = 'sort';
$collect['sort'] = $sort;


$products->listFilesAttachedToAProduct($collect);

```


### <a name="list_followers_of_a_product"></a>![Method: ](https://apidocs.io/img/method.png ".ProductsController.listFollowersOfAProduct") listFollowersOfAProduct

> Lists the followers of a Product


```php
function listFollowersOfAProduct($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the product |



#### Example Usage

```php
$id = 19;

$result = $products->listFollowersOfAProduct($id);

```


### <a name="add_a_follower_to_a_product"></a>![Method: ](https://apidocs.io/img/method.png ".ProductsController.addAFollowerToAProduct") addAFollowerToAProduct

> Adds a follower to a product.


```php
function addAFollowerToAProduct($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the product |
| userId |  ``` Required ```  | ID of the user |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$userId = 19;
$collect['userId'] = $userId;


$result = $products->addAFollowerToAProduct($collect);

```


### <a name="delete_a_follower_from_a_product"></a>![Method: ](https://apidocs.io/img/method.png ".ProductsController.deleteAFollowerFromAProduct") deleteAFollowerFromAProduct

> Deletes a follower from a product.


```php
function deleteAFollowerFromAProduct($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the product |
| followerId |  ``` Required ```  | ID of the follower |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$followerId = 19;
$collect['followerId'] = $followerId;


$result = $products->deleteAFollowerFromAProduct($collect);

```


### <a name="list_permitted_users"></a>![Method: ](https://apidocs.io/img/method.png ".ProductsController.listPermittedUsers") listPermittedUsers

> Lists users permitted to access a product.


```php
function listPermittedUsers($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the product |



#### Example Usage

```php
$id = 19;

$result = $products->listPermittedUsers($id);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="recents_controller"></a>![Class: ](https://apidocs.io/img/class.png ".RecentsController") RecentsController

### Get singleton instance

The singleton instance of the ``` RecentsController ``` class can be accessed from the API Client.

```php
$recents = $client->getRecents();
```

### <a name="get_recents"></a>![Method: ](https://apidocs.io/img/method.png ".RecentsController.getRecents") getRecents

> Returns data about all recent changes occured after given timestamp.


```php
function getRecents($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| sinceTimestamp |  ``` Required ```  | Timestamp in UTC. Format: YYYY-MM-DD HH:MM:SS |
| items |  ``` Optional ```  | Multiple selection of item types to include in query (optional) |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |



#### Example Usage

```php
$sinceTimestamp = 'since_timestamp';
$collect['sinceTimestamp'] = $sinceTimestamp;

$items = string::ACTIVITY;
$collect['items'] = $items;

$start = 0;
$collect['start'] = $start;

$limit = 19;
$collect['limit'] = $limit;


$recents->getRecents($collect);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="roles_controller"></a>![Class: ](https://apidocs.io/img/class.png ".RolesController") RolesController

### Get singleton instance

The singleton instance of the ``` RolesController ``` class can be accessed from the API Client.

```php
$roles = $client->getRoles();
```

### <a name="get_all_roles"></a>![Method: ](https://apidocs.io/img/method.png ".RolesController.getAllRoles") getAllRoles

> Get all roles


```php
function getAllRoles($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |



#### Example Usage

```php
$start = 0;
$collect['start'] = $start;

$limit = 19;
$collect['limit'] = $limit;


$result = $roles->getAllRoles($collect);

```


### <a name="add_a_role"></a>![Method: ](https://apidocs.io/img/method.png ".RolesController.addARole") addARole

> Add a role


```php
function addARole($body = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| body |  ``` Optional ```  | TODO: Add a parameter description |



#### Example Usage

```php
$body = array('key' => 'value');

$result = $roles->addARole($body);

```


### <a name="delete_a_role"></a>![Method: ](https://apidocs.io/img/method.png ".RolesController.deleteARole") deleteARole

> Delete a role


```php
function deleteARole($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the role |



#### Example Usage

```php
$id = 19;

$result = $roles->deleteARole($id);

```


### <a name="get_one_role"></a>![Method: ](https://apidocs.io/img/method.png ".RolesController.getOneRole") getOneRole

> Get one role


```php
function getOneRole($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the role |



#### Example Usage

```php
$id = 19;

$result = $roles->getOneRole($id);

```


### <a name="update_role_details"></a>![Method: ](https://apidocs.io/img/method.png ".RolesController.updateRoleDetails") updateRoleDetails

> Update role details


```php
function updateRoleDetails($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the role |
| parentRoleId |  ``` Optional ```  | The ID of the parent Role |
| name |  ``` Optional ```  | The name of the Role |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$parentRoleId = 19;
$collect['parentRoleId'] = $parentRoleId;

$name = 'name';
$collect['name'] = $name;


$result = $roles->updateRoleDetails($collect);

```


### <a name="delete_a_role_assignment"></a>![Method: ](https://apidocs.io/img/method.png ".RolesController.deleteARoleAssignment") deleteARoleAssignment

> Delete assignment from a role


```php
function deleteARoleAssignment($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the role |
| userId |  ``` Required ```  | ID of the user |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$userId = 19;
$collect['userId'] = $userId;


$result = $roles->deleteARoleAssignment($collect);

```


### <a name="list_role_assignments"></a>![Method: ](https://apidocs.io/img/method.png ".RolesController.listRoleAssignments") listRoleAssignments

> List assignments for a role


```php
function listRoleAssignments($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the role |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 19;
$collect['limit'] = $limit;


$result = $roles->listRoleAssignments($collect);

```


### <a name="add_role_assignment"></a>![Method: ](https://apidocs.io/img/method.png ".RolesController.addRoleAssignment") addRoleAssignment

> Add assignment for a role


```php
function addRoleAssignment($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the role |
| userId |  ``` Required ```  | ID of the user |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$userId = 19;
$collect['userId'] = $userId;


$result = $roles->addRoleAssignment($collect);

```


### <a name="list_role_sub_roles"></a>![Method: ](https://apidocs.io/img/method.png ".RolesController.listRoleSubRoles") listRoleSubRoles

> List role sub-roles


```php
function listRoleSubRoles($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the role |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 19;
$collect['limit'] = $limit;


$result = $roles->listRoleSubRoles($collect);

```


### <a name="list_role_settings"></a>![Method: ](https://apidocs.io/img/method.png ".RolesController.listRoleSettings") listRoleSettings

> List role settings


```php
function listRoleSettings($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the role |



#### Example Usage

```php
$id = 19;

$result = $roles->listRoleSettings($id);

```


### <a name="add_or_update_role_setting"></a>![Method: ](https://apidocs.io/img/method.png ".RolesController.addOrUpdateRoleSetting") addOrUpdateRoleSetting

> Add or update role setting


```php
function addOrUpdateRoleSetting($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the role |
| settingKey |  ``` Required ```  | TODO: Add a parameter description |
| value |  ``` Required ```  | Possible values for default_visibility settings: 0...1. |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$settingKey = string::DEAL_DEFAULT_VISIBILITY;
$collect['settingKey'] = $settingKey;

$value = int::ENUM_0;
$collect['value'] = $value;


$result = $roles->addOrUpdateRoleSetting($collect);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="stages_controller"></a>![Class: ](https://apidocs.io/img/class.png ".StagesController") StagesController

### Get singleton instance

The singleton instance of the ``` StagesController ``` class can be accessed from the API Client.

```php
$stages = $client->getStages();
```

### <a name="delete_multiple_stages_in_bulk"></a>![Method: ](https://apidocs.io/img/method.png ".StagesController.deleteMultipleStagesInBulk") deleteMultipleStagesInBulk

> Marks multiple stages as deleted.


```php
function deleteMultipleStagesInBulk($ids)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| ids |  ``` Required ```  | Comma-separated stage IDs to delete |



#### Example Usage

```php
$ids = 'ids';

$stages->deleteMultipleStagesInBulk($ids);

```


### <a name="get_all_stages"></a>![Method: ](https://apidocs.io/img/method.png ".StagesController.getAllStages") getAllStages

> Returns data about all stages


```php
function getAllStages($pipelineId = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| pipelineId |  ``` Optional ```  | ID of the pipeline to fetch stages for. If omitted, stages for all pipelines will be fetched. |



#### Example Usage

```php
$pipelineId = 19;

$stages->getAllStages($pipelineId);

```


### <a name="add_a_new_stage"></a>![Method: ](https://apidocs.io/img/method.png ".StagesController.addANewStage") addANewStage

> Adds a new stage, returns the ID upon success.


```php
function addANewStage($body = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| body |  ``` Optional ```  | TODO: Add a parameter description |



#### Example Usage

```php
$body = array('key' => 'value');

$stages->addANewStage($body);

```


### <a name="delete_a_stage"></a>![Method: ](https://apidocs.io/img/method.png ".StagesController.deleteAStage") deleteAStage

> Marks a stage as deleted.


```php
function deleteAStage($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the stage |



#### Example Usage

```php
$id = 19;

$stages->deleteAStage($id);

```


### <a name="get_one_stage"></a>![Method: ](https://apidocs.io/img/method.png ".StagesController.getOneStage") getOneStage

> Returns data about a specific stage


```php
function getOneStage($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the stage |



#### Example Usage

```php
$id = 19;

$stages->getOneStage($id);

```


### <a name="update_stage_details"></a>![Method: ](https://apidocs.io/img/method.png ".StagesController.updateStageDetails") updateStageDetails

> Updates the properties of a stage.


```php
function updateStageDetails($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the stage |
| body |  ``` Optional ```  | TODO: Add a parameter description |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$body = array('key' => 'value');
$collect['body'] = $body;


$stages->updateStageDetails($collect);

```


### <a name="get_deals_in_a_stage"></a>![Method: ](https://apidocs.io/img/method.png ".StagesController.getDealsInAStage") getDealsInAStage

> Lists deals in a specific stage


```php
function getDealsInAStage($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the stage |
| filterId |  ``` Optional ```  | If supplied, only deals matching the given filter will be returned. |
| userId |  ``` Optional ```  | If supplied, filter_id will not be considered and only deals owned by the given user will be returned. If omitted, deals owned by the authorized user will be returned. |
| everyone |  ``` Optional ```  | If supplied, filter_id and user_id will not be considered – instead, deals owned by everyone will be returned. |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |



#### Example Usage

```php
$id = 19;
$collect['id'] = $id;

$filterId = 19;
$collect['filterId'] = $filterId;

$userId = 19;
$collect['userId'] = $userId;

$everyone = int::ENUM_0;
$collect['everyone'] = $everyone;

$start = 0;
$collect['start'] = $start;

$limit = 19;
$collect['limit'] = $limit;


$stages->getDealsInAStage($collect);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="teams_controller"></a>![Class: ](https://apidocs.io/img/class.png ".TeamsController") TeamsController

### Get singleton instance

The singleton instance of the ``` TeamsController ``` class can be accessed from the API Client.

```php
$teams = $client->getTeams();
```

### <a name="get_all_teams"></a>![Method: ](https://apidocs.io/img/method.png ".TeamsController.getAllTeams") getAllTeams

> Returns data about teams within the company


```php
function getAllTeams($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| orderBy |  ``` Optional ```  ``` DefaultValue ```  | Field name to sort returned teams by |
| skipUsers |  ``` Optional ```  | When enabled, the teams will not include IDs of member users |



#### Example Usage

```php
$orderBy = string::ID;
$collect['orderBy'] = $orderBy;

$skipUsers = int::ENUM_0;
$collect['skipUsers'] = $skipUsers;


$result = $teams->getAllTeams($collect);

```


### <a name="add_a_new_team"></a>![Method: ](https://apidocs.io/img/method.png ".TeamsController.addANewTeam") addANewTeam

> Adds a new team to the company and returns the created object


```php
function addANewTeam($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| name |  ``` Required ```  | The Team name |
| managerId |  ``` Required ```  | The Team manager ID |
| description |  ``` Optional ```  | The Team description |
| users |  ``` Optional ```  ``` Collection ```  | IDs of the Users that belong to the Team |



#### Example Usage

```php
$name = 'name';
$collect['name'] = $name;

$managerId = 183;
$collect['managerId'] = $managerId;

$description = 'description';
$collect['description'] = $description;

$users = array(183);
$collect['users'] = $users;


$result = $teams->addANewTeam($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 403 | Forbidden response |



### <a name="get_a_single_team"></a>![Method: ](https://apidocs.io/img/method.png ".TeamsController.getASingleTeam") getASingleTeam

> Returns data about a specific team


```php
function getASingleTeam($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the team |
| skipUsers |  ``` Optional ```  | When enabled, the teams will not include IDs of member users |



#### Example Usage

```php
$id = 183;
$collect['id'] = $id;

$skipUsers = int::ENUM_0;
$collect['skipUsers'] = $skipUsers;


$result = $teams->getASingleTeam($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 404 | Team with specified ID does not exist or is inaccessible |



### <a name="update_a_team"></a>![Method: ](https://apidocs.io/img/method.png ".TeamsController.updateATeam") updateATeam

> Updates an existing team and returns the updated object


```php
function updateATeam($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the team |
| body |  ``` Optional ```  | TODO: Add a parameter description |



#### Example Usage

```php
$id = 183;
$collect['id'] = $id;

$body = array('key' => 'value');
$collect['body'] = $body;


$result = $teams->updateATeam($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 403 | Forbidden response |
| 404 | Team with specified ID does not exist or is inaccessible |



### <a name="get_all_users_in_a_team"></a>![Method: ](https://apidocs.io/img/method.png ".TeamsController.getAllUsersInATeam") getAllUsersInATeam

> Returns list of all user IDs within a team


```php
function getAllUsersInATeam($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the team |



#### Example Usage

```php
$id = 183;

$result = $teams->getAllUsersInATeam($id);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 404 | Team with specified ID does not exist or is inaccessible |



### <a name="add_users_to_a_team"></a>![Method: ](https://apidocs.io/img/method.png ".TeamsController.addUsersToATeam") addUsersToATeam

> Adds users to an existing team


```php
function addUsersToATeam($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the team |
| users |  ``` Required ```  ``` Collection ```  | List of User IDs |



#### Example Usage

```php
$id = 183;
$collect['id'] = $id;

$users = array(183);
$collect['users'] = $users;


$result = $teams->addUsersToATeam($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 403 | Forbidden response |
| 404 | Team with specified ID does not exist or is inaccessible |



### <a name="delete_users_from_a_team"></a>![Method: ](https://apidocs.io/img/method.png ".TeamsController.deleteUsersFromATeam") deleteUsersFromATeam

> Deletes users from an existing team


```php
function deleteUsersFromATeam($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the team |
| users |  ``` Required ```  ``` Collection ```  | List of User IDs |



#### Example Usage

```php
$id = 183;
$collect['id'] = $id;

$users = array(183);
$collect['users'] = $users;


$result = $teams->deleteUsersFromATeam($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 403 | Forbidden response |
| 404 | Team with specified ID does not exist or is inaccessible |



### <a name="get_all_teams_of_a_user"></a>![Method: ](https://apidocs.io/img/method.png ".TeamsController.getAllTeamsOfAUser") getAllTeamsOfAUser

> Returns data about all teams which have specified user as a member


```php
function getAllTeamsOfAUser($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the user |
| orderBy |  ``` Optional ```  ``` DefaultValue ```  | Field name to sort returned teams by |
| skipUsers |  ``` Optional ```  | When enabled, the teams will not include IDs of member users |



#### Example Usage

```php
$id = 183;
$collect['id'] = $id;

$orderBy = string::ID;
$collect['orderBy'] = $orderBy;

$skipUsers = int::ENUM_0;
$collect['skipUsers'] = $skipUsers;


$result = $teams->getAllTeamsOfAUser($collect);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="user_connections_controller"></a>![Class: ](https://apidocs.io/img/class.png ".UserConnectionsController") UserConnectionsController

### Get singleton instance

The singleton instance of the ``` UserConnectionsController ``` class can be accessed from the API Client.

```php
$userConnections = $client->getUserConnections();
```

### <a name="get_all_user_connections"></a>![Method: ](https://apidocs.io/img/method.png ".UserConnectionsController.getAllUserConnections") getAllUserConnections

> Returns data about all connections for authorized user.


```php
function getAllUserConnections()
```

#### Example Usage

```php

$result = $userConnections->getAllUserConnections();

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 401 | Unauthorized response |



[Back to List of Controllers](#list_of_controllers)

## <a name="user_settings_controller"></a>![Class: ](https://apidocs.io/img/class.png ".UserSettingsController") UserSettingsController

### Get singleton instance

The singleton instance of the ``` UserSettingsController ``` class can be accessed from the API Client.

```php
$userSettings = $client->getUserSettings();
```

### <a name="list_settings_of_authorized_user"></a>![Method: ](https://apidocs.io/img/method.png ".UserSettingsController.listSettingsOfAuthorizedUser") listSettingsOfAuthorizedUser

> Lists settings of authorized user.


```php
function listSettingsOfAuthorizedUser()
```

#### Example Usage

```php

$userSettings->listSettingsOfAuthorizedUser();

```


[Back to List of Controllers](#list_of_controllers)

## <a name="users_controller"></a>![Class: ](https://apidocs.io/img/class.png ".UsersController") UsersController

### Get singleton instance

The singleton instance of the ``` UsersController ``` class can be accessed from the API Client.

```php
$users = $client->getUsers();
```

### <a name="get_all_users"></a>![Method: ](https://apidocs.io/img/method.png ".UsersController.getAllUsers") getAllUsers

> Returns data about all users within the company


```php
function getAllUsers()
```

#### Example Usage

```php

$result = $users->getAllUsers();

```


### <a name="add_a_new_user"></a>![Method: ](https://apidocs.io/img/method.png ".UsersController.addANewUser") addANewUser

> Adds a new user to the company, returns the ID upon success.


```php
function addANewUser($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| name |  ``` Required ```  | Name of the user |
| email |  ``` Required ```  | Email of the user |
| activeFlag |  ``` Required ```  | Whether the user is active or not. false = Not activated, true = Activated |



#### Example Usage

```php
$name = 'name';
$collect['name'] = $name;

$email = 'email';
$collect['email'] = $email;

$activeFlag = true;
$collect['activeFlag'] = $activeFlag;


$result = $users->addANewUser($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 403 | Forbidden response |



### <a name="find_users_by_name"></a>![Method: ](https://apidocs.io/img/method.png ".UsersController.findUsersByName") findUsersByName

> Finds users by their name.


```php
function findUsersByName($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| term |  ``` Required ```  | Search term to look for |
| searchByEmail |  ``` Optional ```  | When enabled, term will only be matched against email addresses of users. Default: false |



#### Example Usage

```php
$term = 'term';
$collect['term'] = $term;

$searchByEmail = int::ENUM_0;
$collect['searchByEmail'] = $searchByEmail;


$result = $users->findUsersByName($collect);

```


### <a name="get_current_user_data"></a>![Method: ](https://apidocs.io/img/method.png ".UsersController.getCurrentUserData") getCurrentUserData

> Returns data about an authorized user within the company with bound company data: company ID, company name, and domain. Note that the 'locale' property means 'Date and number format' in the Pipedrive settings, not the chosen language.


```php
function getCurrentUserData()
```

#### Example Usage

```php

$result = $users->getCurrentUserData();

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 401 | Unauthorized response |



### <a name="get_one_user"></a>![Method: ](https://apidocs.io/img/method.png ".UsersController.getOneUser") getOneUser

> Returns data about a specific user within the company


```php
function getOneUser($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the user |



#### Example Usage

```php
$id = 183;

$result = $users->getOneUser($id);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 404 | User with specified ID does not exist or is inaccessible |



### <a name="update_user_details"></a>![Method: ](https://apidocs.io/img/method.png ".UsersController.updateUserDetails") updateUserDetails

> Updates the properties of a user. Currently, only active_flag can be updated.


```php
function updateUserDetails($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the user |
| activeFlag |  ``` Required ```  | Whether the user is active or not. false = Not activated, true = Activated |



#### Example Usage

```php
$id = 183;
$collect['id'] = $id;

$activeFlag = true;
$collect['activeFlag'] = $activeFlag;


$result = $users->updateUserDetails($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 403 | Forbidden response |
| 404 | User with specified ID does not exist or is inaccessible |



### <a name="list_blacklisted_email_addresses_of_a_user"></a>![Method: ](https://apidocs.io/img/method.png ".UsersController.listBlacklistedEmailAddressesOfAUser") listBlacklistedEmailAddressesOfAUser

> Lists blacklisted email addresses of a specific user. Blacklisted emails are such that will not get synced in to Pipedrive when using the built-in Mailbox.


```php
function listBlacklistedEmailAddressesOfAUser($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the user |



#### Example Usage

```php
$id = 183;

$users->listBlacklistedEmailAddressesOfAUser($id);

```


### <a name="add_blacklisted_email_address_for_a_user"></a>![Method: ](https://apidocs.io/img/method.png ".UsersController.addBlacklistedEmailAddressForAUser") addBlacklistedEmailAddressForAUser

> Add blacklisted email address for a specific user.


```php
function addBlacklistedEmailAddressForAUser($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the user |
| address |  ``` Required ```  | Email address to blacklist (can contain \\* for wildcards, e.g. \\*@example.com, or john\\*@ex\\*.com) |



#### Example Usage

```php
$id = 183;
$collect['id'] = $id;

$address = 'address';
$collect['address'] = $address;


$users->addBlacklistedEmailAddressForAUser($collect);

```


### <a name="list_followers_of_a_user"></a>![Method: ](https://apidocs.io/img/method.png ".UsersController.listFollowersOfAUser") listFollowersOfAUser

> Lists followers of a specific user.


```php
function listFollowersOfAUser($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the user |



#### Example Usage

```php
$id = 183;

$result = $users->listFollowersOfAUser($id);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 403 | Forbidden response |



### <a name="list_user_permissions"></a>![Method: ](https://apidocs.io/img/method.png ".UsersController.listUserPermissions") listUserPermissions

> List aggregated permissions over all assigned permission sets for a user


```php
function listUserPermissions($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the user |



#### Example Usage

```php
$id = 183;

$users->listUserPermissions($id);

```


### <a name="delete_a_role_assignment"></a>![Method: ](https://apidocs.io/img/method.png ".UsersController.deleteARoleAssignment") deleteARoleAssignment

> Delete a role assignment for a user


```php
function deleteARoleAssignment($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the user |
| roleId |  ``` Required ```  | ID of the role |



#### Example Usage

```php
$id = 183;
$collect['id'] = $id;

$roleId = 183;
$collect['roleId'] = $roleId;


$users->deleteARoleAssignment($collect);

```


### <a name="list_role_assignments"></a>![Method: ](https://apidocs.io/img/method.png ".UsersController.listRoleAssignments") listRoleAssignments

> List role assignments for a user


```php
function listRoleAssignments($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the user |
| start |  ``` Optional ```  ``` DefaultValue ```  | Pagination start |
| limit |  ``` Optional ```  | Items shown per page |



#### Example Usage

```php
$id = 183;
$collect['id'] = $id;

$start = 0;
$collect['start'] = $start;

$limit = 183;
$collect['limit'] = $limit;


$users->listRoleAssignments($collect);

```


### <a name="add_role_assignment"></a>![Method: ](https://apidocs.io/img/method.png ".UsersController.addRoleAssignment") addRoleAssignment

> Add role assignment for a user


```php
function addRoleAssignment($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the user |
| roleId |  ``` Required ```  | ID of the role |



#### Example Usage

```php
$id = 183;
$collect['id'] = $id;

$roleId = 183;
$collect['roleId'] = $roleId;


$users->addRoleAssignment($collect);

```


### <a name="list_user_role_settings"></a>![Method: ](https://apidocs.io/img/method.png ".UsersController.listUserRoleSettings") listUserRoleSettings

> List settings of user's assigned role


```php
function listUserRoleSettings($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | ID of the user |



#### Example Usage

```php
$id = 183;

$users->listUserRoleSettings($id);

```


[Back to List of Controllers](#list_of_controllers)

## <a name="webhooks_controller"></a>![Class: ](https://apidocs.io/img/class.png ".WebhooksController") WebhooksController

### Get singleton instance

The singleton instance of the ``` WebhooksController ``` class can be accessed from the API Client.

```php
$webhooks = $client->getWebhooks();
```

### <a name="get_all_webhooks"></a>![Method: ](https://apidocs.io/img/method.png ".WebhooksController.getAllWebhooks") getAllWebhooks

> Returns data about all webhooks of a company.


```php
function getAllWebhooks()
```

#### Example Usage

```php

$result = $webhooks->getAllWebhooks();

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 401 | Unauthorized response |



### <a name="create_a_new_webhook"></a>![Method: ](https://apidocs.io/img/method.png ".WebhooksController.createANewWebhook") createANewWebhook

> Creates a new webhook and returns its details. Note that specifying an event which triggers the webhook combines 2 parameters - 'event_action' and 'event_object'. E.g., use '\*.\*' for getting notifications about all events, 'added.deal' for any newly added deals, 'deleted.persons' for any deleted persons, etc. See <a href="https://pipedrive.readme.io/docs/guide-for-webhooks?utm_source=api_reference">https://pipedrive.readme.io/docs/guide-for-webhooks</a> for more details.


```php
function createANewWebhook($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| subscriptionUrl |  ``` Required ```  | A full, valid, publicly accessible URL. Determines where to send the notifications. Please note that you cannot use Pipedrive API endpoints as the subscription_url. |
| eventAction |  ``` Required ```  | Type of action to receive notifications about. Wildcard will match all supported actions. |
| eventObject |  ``` Required ```  | Type of object to receive notifications about. Wildcard will match all supported objects. |
| userId |  ``` Optional ```  | The ID of the user this webhook will be authorized with. If not set, current authorized user will be used. Note that this does not filter only certain user's events — rather, this specifies the user's permissions under which each event is checked. Events about objects the selected user is not entitled to access are not sent. If you want to receive notifications for all events, a top-level admin user should be used. |
| httpAuthUser |  ``` Optional ```  | HTTP basic auth username of the subscription URL endpoint (if required). |
| httpAuthPassword |  ``` Optional ```  | HTTP basic auth password of the subscription URL endpoint (if required). |



#### Example Usage

```php
$subscriptionUrl = 'subscription_url';
$collect['subscriptionUrl'] = $subscriptionUrl;

$eventAction = string::ENUM_0;
$collect['eventAction'] = $eventAction;

$eventObject = string::ENUM_0;
$collect['eventObject'] = $eventObject;

$userId = 183;
$collect['userId'] = $userId;

$httpAuthUser = 'http_auth_user';
$collect['httpAuthUser'] = $httpAuthUser;

$httpAuthPassword = 'http_auth_password';
$collect['httpAuthPassword'] = $httpAuthPassword;


$result = $webhooks->createANewWebhook($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | The bad response on webhook creation |
| 401 | Unauthorized response |



### <a name="delete_existing_webhook"></a>![Method: ](https://apidocs.io/img/method.png ".WebhooksController.deleteExistingWebhook") deleteExistingWebhook

> Deletes the specified webhook.


```php
function deleteExistingWebhook($id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| id |  ``` Required ```  | The ID of the webhook to delete |



#### Example Usage

```php
$id = 183;

$result = $webhooks->deleteExistingWebhook($id);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 401 | Unauthorized response |
| 403 | The webhook deletion forbidden response |
| 404 | The webhook deletion not found response |



[Back to List of Controllers](#list_of_controllers)
