# Pipedrive client for PHP based apps

Pipedrive is a global sales-first CRM and intelligent revenue management platform for small businesses. Check out www.pipedrive.com for more details.

This is the official Pipedrive API wrapper-client for PHP based apps, distributed by Pipedrive Inc freely under the MIT licence. It provides convenient access to the Pipedrive API, allowing you to operate with entities such as deals, persons, organizations, products and more.

> ⚠️ With version 5 of the SDK, we have moved to an open-source SDK generator called [OpenAPI Generator](https://openapi-generator.tech). This enables us to better respond to any issues you might have with our SDK.
>
> Please use the [issues page](https://github.com/pipedrive/client-php/issues) for reporting bugs or feedback.

## Installation and usage

### Requirements

PHP 7.4+ and later.

### Composer

```shell
composer require pipedrive/pipedrive
```

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/pipedrive/vendor/autoload.php');
```

## Tests

To run the unit tests:

```bash
composer install
composer test
```

## Getting started

Please follow the [installation procedure](#installation--usage) and then run the following:

### With a pre-set API token

```php
<?php

use Pipedrive\Configuration;

require_once('/path/to/client/vendor/autoload.php');

// Configure API key authorization: api_key
$config = (new Pipedrive\Configuration())->setApiKey('api_token', 'YOUR_API_KEY');

$apiInstance = new Pipedrive\Api\ActivitiesApi(
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

$config = (new Pipedrive\Configuration());
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
$config = (new Pipedrive\Configuration());
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

use Pipedrive\Api\DealsApi;
use Pipedrive\Configuration;

require_once('../../sdks/php/vendor/autoload.php');

session_start();

$config = (new Pipedrive\Configuration());
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

use Pipedrive\Configuration;

session_start();

$config = (new Pipedrive\Configuration());

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

All URIs are relative to *https://api.pipedrive.com/v1*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*ActivitiesApi* | [**addActivity**](docs/Api/ActivitiesApi.md#addactivity) | **POST** /activities | Add an activity
*ActivitiesApi* | [**deleteActivities**](docs/Api/ActivitiesApi.md#deleteactivities) | **DELETE** /activities | Delete multiple activities in bulk
*ActivitiesApi* | [**deleteActivity**](docs/Api/ActivitiesApi.md#deleteactivity) | **DELETE** /activities/{id} | Delete an activity
*ActivitiesApi* | [**getActivities**](docs/Api/ActivitiesApi.md#getactivities) | **GET** /activities | Get all activities assigned to a particular user
*ActivitiesApi* | [**getActivitiesCollection**](docs/Api/ActivitiesApi.md#getactivitiescollection) | **GET** /activities/collection | Get all activities (BETA)
*ActivitiesApi* | [**getActivity**](docs/Api/ActivitiesApi.md#getactivity) | **GET** /activities/{id} | Get details of an activity
*ActivitiesApi* | [**updateActivity**](docs/Api/ActivitiesApi.md#updateactivity) | **PUT** /activities/{id} | Update an activity
*ActivityFieldsApi* | [**getActivityFields**](docs/Api/ActivityFieldsApi.md#getactivityfields) | **GET** /activityFields | Get all activity fields
*ActivityTypesApi* | [**addActivityType**](docs/Api/ActivityTypesApi.md#addactivitytype) | **POST** /activityTypes | Add new activity type
*ActivityTypesApi* | [**deleteActivityType**](docs/Api/ActivityTypesApi.md#deleteactivitytype) | **DELETE** /activityTypes/{id} | Delete an activity type
*ActivityTypesApi* | [**deleteActivityTypes**](docs/Api/ActivityTypesApi.md#deleteactivitytypes) | **DELETE** /activityTypes | Delete multiple activity types in bulk
*ActivityTypesApi* | [**getActivityTypes**](docs/Api/ActivityTypesApi.md#getactivitytypes) | **GET** /activityTypes | Get all activity types
*ActivityTypesApi* | [**updateActivityType**](docs/Api/ActivityTypesApi.md#updateactivitytype) | **PUT** /activityTypes/{id} | Update an activity type
*BillingApi* | [**getCompanyAddons**](docs/Api/BillingApi.md#getcompanyaddons) | **GET** /billing/subscriptions/addons | Get all add-ons for a single company
*CallLogsApi* | [**addCallLog**](docs/Api/CallLogsApi.md#addcalllog) | **POST** /callLogs | Add a call log
*CallLogsApi* | [**addCallLogAudioFile**](docs/Api/CallLogsApi.md#addcalllogaudiofile) | **POST** /callLogs/{id}/recordings | Attach an audio file to the call log
*CallLogsApi* | [**deleteCallLog**](docs/Api/CallLogsApi.md#deletecalllog) | **DELETE** /callLogs/{id} | Delete a call log
*CallLogsApi* | [**getCallLog**](docs/Api/CallLogsApi.md#getcalllog) | **GET** /callLogs/{id} | Get details of a call log
*CallLogsApi* | [**getUserCallLogs**](docs/Api/CallLogsApi.md#getusercalllogs) | **GET** /callLogs | Get all call logs assigned to a particular user
*ChannelsApi* | [**addChannel**](docs/Api/ChannelsApi.md#addchannel) | **POST** /channels | Add a channel
*ChannelsApi* | [**deleteChannel**](docs/Api/ChannelsApi.md#deletechannel) | **DELETE** /channels/{id} | Delete a channel
*ChannelsApi* | [**deleteConversation**](docs/Api/ChannelsApi.md#deleteconversation) | **DELETE** /channels/{channel-id}/conversations/{conversation-id} | Delete a conversation
*ChannelsApi* | [**receiveMessage**](docs/Api/ChannelsApi.md#receivemessage) | **POST** /channels/messages/receive | Receives an incoming message
*CurrenciesApi* | [**getCurrencies**](docs/Api/CurrenciesApi.md#getcurrencies) | **GET** /currencies | Get all supported currencies
*DealFieldsApi* | [**addDealField**](docs/Api/DealFieldsApi.md#adddealfield) | **POST** /dealFields | Add a new deal field
*DealFieldsApi* | [**deleteDealField**](docs/Api/DealFieldsApi.md#deletedealfield) | **DELETE** /dealFields/{id} | Delete a deal field
*DealFieldsApi* | [**deleteDealFields**](docs/Api/DealFieldsApi.md#deletedealfields) | **DELETE** /dealFields | Delete multiple deal fields in bulk
*DealFieldsApi* | [**getDealField**](docs/Api/DealFieldsApi.md#getdealfield) | **GET** /dealFields/{id} | Get one deal field
*DealFieldsApi* | [**getDealFields**](docs/Api/DealFieldsApi.md#getdealfields) | **GET** /dealFields | Get all deal fields
*DealFieldsApi* | [**updateDealField**](docs/Api/DealFieldsApi.md#updatedealfield) | **PUT** /dealFields/{id} | Update a deal field
*DealsApi* | [**addDeal**](docs/Api/DealsApi.md#adddeal) | **POST** /deals | Add a deal
*DealsApi* | [**addDealFollower**](docs/Api/DealsApi.md#adddealfollower) | **POST** /deals/{id}/followers | Add a follower to a deal
*DealsApi* | [**addDealParticipant**](docs/Api/DealsApi.md#adddealparticipant) | **POST** /deals/{id}/participants | Add a participant to a deal
*DealsApi* | [**addDealProduct**](docs/Api/DealsApi.md#adddealproduct) | **POST** /deals/{id}/products | Add a product to a deal
*DealsApi* | [**deleteDeal**](docs/Api/DealsApi.md#deletedeal) | **DELETE** /deals/{id} | Delete a deal
*DealsApi* | [**deleteDealFollower**](docs/Api/DealsApi.md#deletedealfollower) | **DELETE** /deals/{id}/followers/{follower_id} | Delete a follower from a deal
*DealsApi* | [**deleteDealParticipant**](docs/Api/DealsApi.md#deletedealparticipant) | **DELETE** /deals/{id}/participants/{deal_participant_id} | Delete a participant from a deal
*DealsApi* | [**deleteDealProduct**](docs/Api/DealsApi.md#deletedealproduct) | **DELETE** /deals/{id}/products/{product_attachment_id} | Delete an attached product from a deal
*DealsApi* | [**deleteDeals**](docs/Api/DealsApi.md#deletedeals) | **DELETE** /deals | Delete multiple deals in bulk
*DealsApi* | [**duplicateDeal**](docs/Api/DealsApi.md#duplicatedeal) | **POST** /deals/{id}/duplicate | Duplicate deal
*DealsApi* | [**getDeal**](docs/Api/DealsApi.md#getdeal) | **GET** /deals/{id} | Get details of a deal
*DealsApi* | [**getDealActivities**](docs/Api/DealsApi.md#getdealactivities) | **GET** /deals/{id}/activities | List activities associated with a deal
*DealsApi* | [**getDealChangelog**](docs/Api/DealsApi.md#getdealchangelog) | **GET** /deals/{id}/changelog | List updates about deal field values
*DealsApi* | [**getDealFiles**](docs/Api/DealsApi.md#getdealfiles) | **GET** /deals/{id}/files | List files attached to a deal
*DealsApi* | [**getDealFollowers**](docs/Api/DealsApi.md#getdealfollowers) | **GET** /deals/{id}/followers | List followers of a deal
*DealsApi* | [**getDealMailMessages**](docs/Api/DealsApi.md#getdealmailmessages) | **GET** /deals/{id}/mailMessages | List mail messages associated with a deal
*DealsApi* | [**getDealParticipants**](docs/Api/DealsApi.md#getdealparticipants) | **GET** /deals/{id}/participants | List participants of a deal
*DealsApi* | [**getDealParticipantsChangelog**](docs/Api/DealsApi.md#getdealparticipantschangelog) | **GET** /deals/{id}/participantsChangelog | List updates about participants of a deal
*DealsApi* | [**getDealPersons**](docs/Api/DealsApi.md#getdealpersons) | **GET** /deals/{id}/persons | List all persons associated with a deal
*DealsApi* | [**getDealProducts**](docs/Api/DealsApi.md#getdealproducts) | **GET** /deals/{id}/products | List products attached to a deal
*DealsApi* | [**getDealUpdates**](docs/Api/DealsApi.md#getdealupdates) | **GET** /deals/{id}/flow | List updates about a deal
*DealsApi* | [**getDealUsers**](docs/Api/DealsApi.md#getdealusers) | **GET** /deals/{id}/permittedUsers | List permitted users
*DealsApi* | [**getDeals**](docs/Api/DealsApi.md#getdeals) | **GET** /deals | Get all deals
*DealsApi* | [**getDealsCollection**](docs/Api/DealsApi.md#getdealscollection) | **GET** /deals/collection | Get all deals (BETA)
*DealsApi* | [**getDealsSummary**](docs/Api/DealsApi.md#getdealssummary) | **GET** /deals/summary | Get deals summary
*DealsApi* | [**getDealsTimeline**](docs/Api/DealsApi.md#getdealstimeline) | **GET** /deals/timeline | Get deals timeline
*DealsApi* | [**mergeDeals**](docs/Api/DealsApi.md#mergedeals) | **PUT** /deals/{id}/merge | Merge two deals
*DealsApi* | [**searchDeals**](docs/Api/DealsApi.md#searchdeals) | **GET** /deals/search | Search deals
*DealsApi* | [**updateDeal**](docs/Api/DealsApi.md#updatedeal) | **PUT** /deals/{id} | Update a deal
*DealsApi* | [**updateDealProduct**](docs/Api/DealsApi.md#updatedealproduct) | **PUT** /deals/{id}/products/{product_attachment_id} | Update the product attached to a deal
*FilesApi* | [**addFile**](docs/Api/FilesApi.md#addfile) | **POST** /files | Add file
*FilesApi* | [**addFileAndLinkIt**](docs/Api/FilesApi.md#addfileandlinkit) | **POST** /files/remote | Create a remote file and link it to an item
*FilesApi* | [**deleteFile**](docs/Api/FilesApi.md#deletefile) | **DELETE** /files/{id} | Delete a file
*FilesApi* | [**downloadFile**](docs/Api/FilesApi.md#downloadfile) | **GET** /files/{id}/download | Download one file
*FilesApi* | [**getFile**](docs/Api/FilesApi.md#getfile) | **GET** /files/{id} | Get one file
*FilesApi* | [**getFiles**](docs/Api/FilesApi.md#getfiles) | **GET** /files | Get all files
*FilesApi* | [**linkFileToItem**](docs/Api/FilesApi.md#linkfiletoitem) | **POST** /files/remoteLink | Link a remote file to an item
*FilesApi* | [**updateFile**](docs/Api/FilesApi.md#updatefile) | **PUT** /files/{id} | Update file details
*FiltersApi* | [**addFilter**](docs/Api/FiltersApi.md#addfilter) | **POST** /filters | Add a new filter
*FiltersApi* | [**deleteFilter**](docs/Api/FiltersApi.md#deletefilter) | **DELETE** /filters/{id} | Delete a filter
*FiltersApi* | [**deleteFilters**](docs/Api/FiltersApi.md#deletefilters) | **DELETE** /filters | Delete multiple filters in bulk
*FiltersApi* | [**getFilter**](docs/Api/FiltersApi.md#getfilter) | **GET** /filters/{id} | Get one filter
*FiltersApi* | [**getFilterHelpers**](docs/Api/FiltersApi.md#getfilterhelpers) | **GET** /filters/helpers | Get all filter helpers
*FiltersApi* | [**getFilters**](docs/Api/FiltersApi.md#getfilters) | **GET** /filters | Get all filters
*FiltersApi* | [**updateFilter**](docs/Api/FiltersApi.md#updatefilter) | **PUT** /filters/{id} | Update filter
*GoalsApi* | [**addGoal**](docs/Api/GoalsApi.md#addgoal) | **POST** /goals | Add a new goal
*GoalsApi* | [**deleteGoal**](docs/Api/GoalsApi.md#deletegoal) | **DELETE** /goals/{id} | Delete existing goal
*GoalsApi* | [**getGoalResult**](docs/Api/GoalsApi.md#getgoalresult) | **GET** /goals/{id}/results | Get result of a goal
*GoalsApi* | [**getGoals**](docs/Api/GoalsApi.md#getgoals) | **GET** /goals/find | Find goals
*GoalsApi* | [**updateGoal**](docs/Api/GoalsApi.md#updategoal) | **PUT** /goals/{id} | Update existing goal
*ItemSearchApi* | [**searchItem**](docs/Api/ItemSearchApi.md#searchitem) | **GET** /itemSearch | Perform a search from multiple item types
*ItemSearchApi* | [**searchItemByField**](docs/Api/ItemSearchApi.md#searchitembyfield) | **GET** /itemSearch/field | Perform a search using a specific field from an item type
*LeadLabelsApi* | [**addLeadLabel**](docs/Api/LeadLabelsApi.md#addleadlabel) | **POST** /leadLabels | Add a lead label
*LeadLabelsApi* | [**deleteLeadLabel**](docs/Api/LeadLabelsApi.md#deleteleadlabel) | **DELETE** /leadLabels/{id} | Delete a lead label
*LeadLabelsApi* | [**getLeadLabels**](docs/Api/LeadLabelsApi.md#getleadlabels) | **GET** /leadLabels | Get all lead labels
*LeadLabelsApi* | [**updateLeadLabel**](docs/Api/LeadLabelsApi.md#updateleadlabel) | **PATCH** /leadLabels/{id} | Update a lead label
*LeadSourcesApi* | [**getLeadSources**](docs/Api/LeadSourcesApi.md#getleadsources) | **GET** /leadSources | Get all lead sources
*LeadsApi* | [**addLead**](docs/Api/LeadsApi.md#addlead) | **POST** /leads | Add a lead
*LeadsApi* | [**deleteLead**](docs/Api/LeadsApi.md#deletelead) | **DELETE** /leads/{id} | Delete a lead
*LeadsApi* | [**getLead**](docs/Api/LeadsApi.md#getlead) | **GET** /leads/{id} | Get one lead
*LeadsApi* | [**getLeadUsers**](docs/Api/LeadsApi.md#getleadusers) | **GET** /leads/{id}/permittedUsers | List permitted users
*LeadsApi* | [**getLeads**](docs/Api/LeadsApi.md#getleads) | **GET** /leads | Get all leads
*LeadsApi* | [**searchLeads**](docs/Api/LeadsApi.md#searchleads) | **GET** /leads/search | Search leads
*LeadsApi* | [**updateLead**](docs/Api/LeadsApi.md#updatelead) | **PATCH** /leads/{id} | Update a lead
*LegacyTeamsApi* | [**addTeam**](docs/Api/LegacyTeamsApi.md#addteam) | **POST** /legacyTeams | Add a new team
*LegacyTeamsApi* | [**addTeamUser**](docs/Api/LegacyTeamsApi.md#addteamuser) | **POST** /legacyTeams/{id}/users | Add users to a team
*LegacyTeamsApi* | [**deleteTeamUser**](docs/Api/LegacyTeamsApi.md#deleteteamuser) | **DELETE** /legacyTeams/{id}/users | Delete users from a team
*LegacyTeamsApi* | [**getTeam**](docs/Api/LegacyTeamsApi.md#getteam) | **GET** /legacyTeams/{id} | Get a single team
*LegacyTeamsApi* | [**getTeamUsers**](docs/Api/LegacyTeamsApi.md#getteamusers) | **GET** /legacyTeams/{id}/users | Get all users in a team
*LegacyTeamsApi* | [**getTeams**](docs/Api/LegacyTeamsApi.md#getteams) | **GET** /legacyTeams | Get all teams
*LegacyTeamsApi* | [**getUserTeams**](docs/Api/LegacyTeamsApi.md#getuserteams) | **GET** /legacyTeams/user/{id} | Get all teams of a user
*LegacyTeamsApi* | [**updateTeam**](docs/Api/LegacyTeamsApi.md#updateteam) | **PUT** /legacyTeams/{id} | Update a team
*MailboxApi* | [**deleteMailThread**](docs/Api/MailboxApi.md#deletemailthread) | **DELETE** /mailbox/mailThreads/{id} | Delete mail thread
*MailboxApi* | [**getMailMessage**](docs/Api/MailboxApi.md#getmailmessage) | **GET** /mailbox/mailMessages/{id} | Get one mail message
*MailboxApi* | [**getMailThread**](docs/Api/MailboxApi.md#getmailthread) | **GET** /mailbox/mailThreads/{id} | Get one mail thread
*MailboxApi* | [**getMailThreadMessages**](docs/Api/MailboxApi.md#getmailthreadmessages) | **GET** /mailbox/mailThreads/{id}/mailMessages | Get all mail messages of mail thread
*MailboxApi* | [**getMailThreads**](docs/Api/MailboxApi.md#getmailthreads) | **GET** /mailbox/mailThreads | Get mail threads
*MailboxApi* | [**updateMailThreadDetails**](docs/Api/MailboxApi.md#updatemailthreaddetails) | **PUT** /mailbox/mailThreads/{id} | Update mail thread details
*MeetingsApi* | [**deleteUserProviderLink**](docs/Api/MeetingsApi.md#deleteuserproviderlink) | **DELETE** /meetings/userProviderLinks/{id} | Delete the link between a user and the installed video call integration
*MeetingsApi* | [**saveUserProviderLink**](docs/Api/MeetingsApi.md#saveuserproviderlink) | **POST** /meetings/userProviderLinks | Link a user with the installed video call integration
*NoteFieldsApi* | [**getNoteFields**](docs/Api/NoteFieldsApi.md#getnotefields) | **GET** /noteFields | Get all note fields
*NotesApi* | [**addNote**](docs/Api/NotesApi.md#addnote) | **POST** /notes | Add a note
*NotesApi* | [**addNoteComment**](docs/Api/NotesApi.md#addnotecomment) | **POST** /notes/{id}/comments | Add a comment to a note
*NotesApi* | [**deleteComment**](docs/Api/NotesApi.md#deletecomment) | **DELETE** /notes/{id}/comments/{commentId} | Delete a comment related to a note
*NotesApi* | [**deleteNote**](docs/Api/NotesApi.md#deletenote) | **DELETE** /notes/{id} | Delete a note
*NotesApi* | [**getComment**](docs/Api/NotesApi.md#getcomment) | **GET** /notes/{id}/comments/{commentId} | Get one comment
*NotesApi* | [**getNote**](docs/Api/NotesApi.md#getnote) | **GET** /notes/{id} | Get one note
*NotesApi* | [**getNoteComments**](docs/Api/NotesApi.md#getnotecomments) | **GET** /notes/{id}/comments | Get all comments for a note
*NotesApi* | [**getNotes**](docs/Api/NotesApi.md#getnotes) | **GET** /notes | Get all notes
*NotesApi* | [**updateCommentForNote**](docs/Api/NotesApi.md#updatecommentfornote) | **PUT** /notes/{id}/comments/{commentId} | Update a comment related to a note
*NotesApi* | [**updateNote**](docs/Api/NotesApi.md#updatenote) | **PUT** /notes/{id} | Update a note
*OrganizationFieldsApi* | [**addOrganizationField**](docs/Api/OrganizationFieldsApi.md#addorganizationfield) | **POST** /organizationFields | Add a new organization field
*OrganizationFieldsApi* | [**deleteOrganizationField**](docs/Api/OrganizationFieldsApi.md#deleteorganizationfield) | **DELETE** /organizationFields/{id} | Delete an organization field
*OrganizationFieldsApi* | [**deleteOrganizationFields**](docs/Api/OrganizationFieldsApi.md#deleteorganizationfields) | **DELETE** /organizationFields | Delete multiple organization fields in bulk
*OrganizationFieldsApi* | [**getOrganizationField**](docs/Api/OrganizationFieldsApi.md#getorganizationfield) | **GET** /organizationFields/{id} | Get one organization field
*OrganizationFieldsApi* | [**getOrganizationFields**](docs/Api/OrganizationFieldsApi.md#getorganizationfields) | **GET** /organizationFields | Get all organization fields
*OrganizationFieldsApi* | [**updateOrganizationField**](docs/Api/OrganizationFieldsApi.md#updateorganizationfield) | **PUT** /organizationFields/{id} | Update an organization field
*OrganizationRelationshipsApi* | [**addOrganizationRelationship**](docs/Api/OrganizationRelationshipsApi.md#addorganizationrelationship) | **POST** /organizationRelationships | Create an organization relationship
*OrganizationRelationshipsApi* | [**deleteOrganizationRelationship**](docs/Api/OrganizationRelationshipsApi.md#deleteorganizationrelationship) | **DELETE** /organizationRelationships/{id} | Delete an organization relationship
*OrganizationRelationshipsApi* | [**getOrganizationRelationship**](docs/Api/OrganizationRelationshipsApi.md#getorganizationrelationship) | **GET** /organizationRelationships/{id} | Get one organization relationship
*OrganizationRelationshipsApi* | [**getOrganizationRelationships**](docs/Api/OrganizationRelationshipsApi.md#getorganizationrelationships) | **GET** /organizationRelationships | Get all relationships for organization
*OrganizationRelationshipsApi* | [**updateOrganizationRelationship**](docs/Api/OrganizationRelationshipsApi.md#updateorganizationrelationship) | **PUT** /organizationRelationships/{id} | Update an organization relationship
*OrganizationsApi* | [**addOrganization**](docs/Api/OrganizationsApi.md#addorganization) | **POST** /organizations | Add an organization
*OrganizationsApi* | [**addOrganizationFollower**](docs/Api/OrganizationsApi.md#addorganizationfollower) | **POST** /organizations/{id}/followers | Add a follower to an organization
*OrganizationsApi* | [**deleteOrganization**](docs/Api/OrganizationsApi.md#deleteorganization) | **DELETE** /organizations/{id} | Delete an organization
*OrganizationsApi* | [**deleteOrganizationFollower**](docs/Api/OrganizationsApi.md#deleteorganizationfollower) | **DELETE** /organizations/{id}/followers/{follower_id} | Delete a follower from an organization
*OrganizationsApi* | [**deleteOrganizations**](docs/Api/OrganizationsApi.md#deleteorganizations) | **DELETE** /organizations | Delete multiple organizations in bulk
*OrganizationsApi* | [**getOrganization**](docs/Api/OrganizationsApi.md#getorganization) | **GET** /organizations/{id} | Get details of an organization
*OrganizationsApi* | [**getOrganizationActivities**](docs/Api/OrganizationsApi.md#getorganizationactivities) | **GET** /organizations/{id}/activities | List activities associated with an organization
*OrganizationsApi* | [**getOrganizationChangelog**](docs/Api/OrganizationsApi.md#getorganizationchangelog) | **GET** /organizations/{id}/changelog | List updates about organization field values
*OrganizationsApi* | [**getOrganizationDeals**](docs/Api/OrganizationsApi.md#getorganizationdeals) | **GET** /organizations/{id}/deals | List deals associated with an organization
*OrganizationsApi* | [**getOrganizationFiles**](docs/Api/OrganizationsApi.md#getorganizationfiles) | **GET** /organizations/{id}/files | List files attached to an organization
*OrganizationsApi* | [**getOrganizationFollowers**](docs/Api/OrganizationsApi.md#getorganizationfollowers) | **GET** /organizations/{id}/followers | List followers of an organization
*OrganizationsApi* | [**getOrganizationMailMessages**](docs/Api/OrganizationsApi.md#getorganizationmailmessages) | **GET** /organizations/{id}/mailMessages | List mail messages associated with an organization
*OrganizationsApi* | [**getOrganizationPersons**](docs/Api/OrganizationsApi.md#getorganizationpersons) | **GET** /organizations/{id}/persons | List persons of an organization
*OrganizationsApi* | [**getOrganizationUpdates**](docs/Api/OrganizationsApi.md#getorganizationupdates) | **GET** /organizations/{id}/flow | List updates about an organization
*OrganizationsApi* | [**getOrganizationUsers**](docs/Api/OrganizationsApi.md#getorganizationusers) | **GET** /organizations/{id}/permittedUsers | List permitted users
*OrganizationsApi* | [**getOrganizations**](docs/Api/OrganizationsApi.md#getorganizations) | **GET** /organizations | Get all organizations
*OrganizationsApi* | [**getOrganizationsCollection**](docs/Api/OrganizationsApi.md#getorganizationscollection) | **GET** /organizations/collection | Get all organizations (BETA)
*OrganizationsApi* | [**mergeOrganizations**](docs/Api/OrganizationsApi.md#mergeorganizations) | **PUT** /organizations/{id}/merge | Merge two organizations
*OrganizationsApi* | [**searchOrganization**](docs/Api/OrganizationsApi.md#searchorganization) | **GET** /organizations/search | Search organizations
*OrganizationsApi* | [**updateOrganization**](docs/Api/OrganizationsApi.md#updateorganization) | **PUT** /organizations/{id} | Update an organization
*PermissionSetsApi* | [**getPermissionSet**](docs/Api/PermissionSetsApi.md#getpermissionset) | **GET** /permissionSets/{id} | Get one permission set
*PermissionSetsApi* | [**getPermissionSetAssignments**](docs/Api/PermissionSetsApi.md#getpermissionsetassignments) | **GET** /permissionSets/{id}/assignments | List permission set assignments
*PermissionSetsApi* | [**getPermissionSets**](docs/Api/PermissionSetsApi.md#getpermissionsets) | **GET** /permissionSets | Get all permission sets
*PersonFieldsApi* | [**addPersonField**](docs/Api/PersonFieldsApi.md#addpersonfield) | **POST** /personFields | Add a new person field
*PersonFieldsApi* | [**deletePersonField**](docs/Api/PersonFieldsApi.md#deletepersonfield) | **DELETE** /personFields/{id} | Delete a person field
*PersonFieldsApi* | [**deletePersonFields**](docs/Api/PersonFieldsApi.md#deletepersonfields) | **DELETE** /personFields | Delete multiple person fields in bulk
*PersonFieldsApi* | [**getPersonField**](docs/Api/PersonFieldsApi.md#getpersonfield) | **GET** /personFields/{id} | Get one person field
*PersonFieldsApi* | [**getPersonFields**](docs/Api/PersonFieldsApi.md#getpersonfields) | **GET** /personFields | Get all person fields
*PersonFieldsApi* | [**updatePersonField**](docs/Api/PersonFieldsApi.md#updatepersonfield) | **PUT** /personFields/{id} | Update a person field
*PersonsApi* | [**addPerson**](docs/Api/PersonsApi.md#addperson) | **POST** /persons | Add a person
*PersonsApi* | [**addPersonFollower**](docs/Api/PersonsApi.md#addpersonfollower) | **POST** /persons/{id}/followers | Add a follower to a person
*PersonsApi* | [**addPersonPicture**](docs/Api/PersonsApi.md#addpersonpicture) | **POST** /persons/{id}/picture | Add person picture
*PersonsApi* | [**deletePerson**](docs/Api/PersonsApi.md#deleteperson) | **DELETE** /persons/{id} | Delete a person
*PersonsApi* | [**deletePersonFollower**](docs/Api/PersonsApi.md#deletepersonfollower) | **DELETE** /persons/{id}/followers/{follower_id} | Delete a follower from a person
*PersonsApi* | [**deletePersonPicture**](docs/Api/PersonsApi.md#deletepersonpicture) | **DELETE** /persons/{id}/picture | Delete person picture
*PersonsApi* | [**deletePersons**](docs/Api/PersonsApi.md#deletepersons) | **DELETE** /persons | Delete multiple persons in bulk
*PersonsApi* | [**getPerson**](docs/Api/PersonsApi.md#getperson) | **GET** /persons/{id} | Get details of a person
*PersonsApi* | [**getPersonActivities**](docs/Api/PersonsApi.md#getpersonactivities) | **GET** /persons/{id}/activities | List activities associated with a person
*PersonsApi* | [**getPersonChangelog**](docs/Api/PersonsApi.md#getpersonchangelog) | **GET** /persons/{id}/changelog | List updates about person field values
*PersonsApi* | [**getPersonDeals**](docs/Api/PersonsApi.md#getpersondeals) | **GET** /persons/{id}/deals | List deals associated with a person
*PersonsApi* | [**getPersonFiles**](docs/Api/PersonsApi.md#getpersonfiles) | **GET** /persons/{id}/files | List files attached to a person
*PersonsApi* | [**getPersonFollowers**](docs/Api/PersonsApi.md#getpersonfollowers) | **GET** /persons/{id}/followers | List followers of a person
*PersonsApi* | [**getPersonMailMessages**](docs/Api/PersonsApi.md#getpersonmailmessages) | **GET** /persons/{id}/mailMessages | List mail messages associated with a person
*PersonsApi* | [**getPersonProducts**](docs/Api/PersonsApi.md#getpersonproducts) | **GET** /persons/{id}/products | List products associated with a person
*PersonsApi* | [**getPersonUpdates**](docs/Api/PersonsApi.md#getpersonupdates) | **GET** /persons/{id}/flow | List updates about a person
*PersonsApi* | [**getPersonUsers**](docs/Api/PersonsApi.md#getpersonusers) | **GET** /persons/{id}/permittedUsers | List permitted users
*PersonsApi* | [**getPersons**](docs/Api/PersonsApi.md#getpersons) | **GET** /persons | Get all persons
*PersonsApi* | [**getPersonsCollection**](docs/Api/PersonsApi.md#getpersonscollection) | **GET** /persons/collection | Get all persons (BETA)
*PersonsApi* | [**mergePersons**](docs/Api/PersonsApi.md#mergepersons) | **PUT** /persons/{id}/merge | Merge two persons
*PersonsApi* | [**searchPersons**](docs/Api/PersonsApi.md#searchpersons) | **GET** /persons/search | Search persons
*PersonsApi* | [**updatePerson**](docs/Api/PersonsApi.md#updateperson) | **PUT** /persons/{id} | Update a person
*PipelinesApi* | [**addPipeline**](docs/Api/PipelinesApi.md#addpipeline) | **POST** /pipelines | Add a new pipeline
*PipelinesApi* | [**deletePipeline**](docs/Api/PipelinesApi.md#deletepipeline) | **DELETE** /pipelines/{id} | Delete a pipeline
*PipelinesApi* | [**getPipeline**](docs/Api/PipelinesApi.md#getpipeline) | **GET** /pipelines/{id} | Get one pipeline
*PipelinesApi* | [**getPipelineConversionStatistics**](docs/Api/PipelinesApi.md#getpipelineconversionstatistics) | **GET** /pipelines/{id}/conversion_statistics | Get deals conversion rates in pipeline
*PipelinesApi* | [**getPipelineDeals**](docs/Api/PipelinesApi.md#getpipelinedeals) | **GET** /pipelines/{id}/deals | Get deals in a pipeline
*PipelinesApi* | [**getPipelineMovementStatistics**](docs/Api/PipelinesApi.md#getpipelinemovementstatistics) | **GET** /pipelines/{id}/movement_statistics | Get deals movements in pipeline
*PipelinesApi* | [**getPipelines**](docs/Api/PipelinesApi.md#getpipelines) | **GET** /pipelines | Get all pipelines
*PipelinesApi* | [**updatePipeline**](docs/Api/PipelinesApi.md#updatepipeline) | **PUT** /pipelines/{id} | Update a pipeline
*ProductFieldsApi* | [**addProductField**](docs/Api/ProductFieldsApi.md#addproductfield) | **POST** /productFields | Add a new product field
*ProductFieldsApi* | [**deleteProductField**](docs/Api/ProductFieldsApi.md#deleteproductfield) | **DELETE** /productFields/{id} | Delete a product field
*ProductFieldsApi* | [**deleteProductFields**](docs/Api/ProductFieldsApi.md#deleteproductfields) | **DELETE** /productFields | Delete multiple product fields in bulk
*ProductFieldsApi* | [**getProductField**](docs/Api/ProductFieldsApi.md#getproductfield) | **GET** /productFields/{id} | Get one product field
*ProductFieldsApi* | [**getProductFields**](docs/Api/ProductFieldsApi.md#getproductfields) | **GET** /productFields | Get all product fields
*ProductFieldsApi* | [**updateProductField**](docs/Api/ProductFieldsApi.md#updateproductfield) | **PUT** /productFields/{id} | Update a product field
*ProductsApi* | [**addProduct**](docs/Api/ProductsApi.md#addproduct) | **POST** /products | Add a product
*ProductsApi* | [**addProductFollower**](docs/Api/ProductsApi.md#addproductfollower) | **POST** /products/{id}/followers | Add a follower to a product
*ProductsApi* | [**deleteProduct**](docs/Api/ProductsApi.md#deleteproduct) | **DELETE** /products/{id} | Delete a product
*ProductsApi* | [**deleteProductFollower**](docs/Api/ProductsApi.md#deleteproductfollower) | **DELETE** /products/{id}/followers/{follower_id} | Delete a follower from a product
*ProductsApi* | [**getProduct**](docs/Api/ProductsApi.md#getproduct) | **GET** /products/{id} | Get one product
*ProductsApi* | [**getProductDeals**](docs/Api/ProductsApi.md#getproductdeals) | **GET** /products/{id}/deals | Get deals where a product is attached to
*ProductsApi* | [**getProductFiles**](docs/Api/ProductsApi.md#getproductfiles) | **GET** /products/{id}/files | List files attached to a product
*ProductsApi* | [**getProductFollowers**](docs/Api/ProductsApi.md#getproductfollowers) | **GET** /products/{id}/followers | List followers of a product
*ProductsApi* | [**getProductUsers**](docs/Api/ProductsApi.md#getproductusers) | **GET** /products/{id}/permittedUsers | List permitted users
*ProductsApi* | [**getProducts**](docs/Api/ProductsApi.md#getproducts) | **GET** /products | Get all products
*ProductsApi* | [**searchProducts**](docs/Api/ProductsApi.md#searchproducts) | **GET** /products/search | Search products
*ProductsApi* | [**updateProduct**](docs/Api/ProductsApi.md#updateproduct) | **PUT** /products/{id} | Update a product
*ProjectTemplatesApi* | [**getProjectTemplate**](docs/Api/ProjectTemplatesApi.md#getprojecttemplate) | **GET** /projectTemplates/{id} | Get details of a template
*ProjectTemplatesApi* | [**getProjectTemplates**](docs/Api/ProjectTemplatesApi.md#getprojecttemplates) | **GET** /projectTemplates | Get all project templates
*ProjectTemplatesApi* | [**getProjectsBoard**](docs/Api/ProjectTemplatesApi.md#getprojectsboard) | **GET** /projects/boards/{id} | Get details of a board
*ProjectTemplatesApi* | [**getProjectsPhase**](docs/Api/ProjectTemplatesApi.md#getprojectsphase) | **GET** /projects/phases/{id} | Get details of a phase
*ProjectsApi* | [**addProject**](docs/Api/ProjectsApi.md#addproject) | **POST** /projects | Add a project
*ProjectsApi* | [**archiveProject**](docs/Api/ProjectsApi.md#archiveproject) | **POST** /projects/{id}/archive | Archive a project
*ProjectsApi* | [**deleteProject**](docs/Api/ProjectsApi.md#deleteproject) | **DELETE** /projects/{id} | Delete a project
*ProjectsApi* | [**getProject**](docs/Api/ProjectsApi.md#getproject) | **GET** /projects/{id} | Get details of a project
*ProjectsApi* | [**getProjectActivities**](docs/Api/ProjectsApi.md#getprojectactivities) | **GET** /projects/{id}/activities | Returns project activities
*ProjectsApi* | [**getProjectGroups**](docs/Api/ProjectsApi.md#getprojectgroups) | **GET** /projects/{id}/groups | Returns project groups
*ProjectsApi* | [**getProjectPlan**](docs/Api/ProjectsApi.md#getprojectplan) | **GET** /projects/{id}/plan | Returns project plan
*ProjectsApi* | [**getProjectTasks**](docs/Api/ProjectsApi.md#getprojecttasks) | **GET** /projects/{id}/tasks | Returns project tasks
*ProjectsApi* | [**getProjects**](docs/Api/ProjectsApi.md#getprojects) | **GET** /projects | Get all projects
*ProjectsApi* | [**getProjectsBoards**](docs/Api/ProjectsApi.md#getprojectsboards) | **GET** /projects/boards | Get all project boards
*ProjectsApi* | [**getProjectsPhases**](docs/Api/ProjectsApi.md#getprojectsphases) | **GET** /projects/phases | Get project phases
*ProjectsApi* | [**putProjectPlanActivity**](docs/Api/ProjectsApi.md#putprojectplanactivity) | **PUT** /projects/{id}/plan/activities/{activityId} | Update activity in project plan
*ProjectsApi* | [**putProjectPlanTask**](docs/Api/ProjectsApi.md#putprojectplantask) | **PUT** /projects/{id}/plan/tasks/{taskId} | Update task in project plan
*ProjectsApi* | [**updateProject**](docs/Api/ProjectsApi.md#updateproject) | **PUT** /projects/{id} | Update a project
*RecentsApi* | [**getRecents**](docs/Api/RecentsApi.md#getrecents) | **GET** /recents | Get recents
*RolesApi* | [**addOrUpdateRoleSetting**](docs/Api/RolesApi.md#addorupdaterolesetting) | **POST** /roles/{id}/settings | Add or update role setting
*RolesApi* | [**addRole**](docs/Api/RolesApi.md#addrole) | **POST** /roles | Add a role
*RolesApi* | [**addRoleAssignment**](docs/Api/RolesApi.md#addroleassignment) | **POST** /roles/{id}/assignments | Add role assignment
*RolesApi* | [**deleteRole**](docs/Api/RolesApi.md#deleterole) | **DELETE** /roles/{id} | Delete a role
*RolesApi* | [**deleteRoleAssignment**](docs/Api/RolesApi.md#deleteroleassignment) | **DELETE** /roles/{id}/assignments | Delete a role assignment
*RolesApi* | [**getRole**](docs/Api/RolesApi.md#getrole) | **GET** /roles/{id} | Get one role
*RolesApi* | [**getRoleAssignments**](docs/Api/RolesApi.md#getroleassignments) | **GET** /roles/{id}/assignments | List role assignments
*RolesApi* | [**getRolePipelines**](docs/Api/RolesApi.md#getrolepipelines) | **GET** /roles/{id}/pipelines | List pipeline visibility for a role
*RolesApi* | [**getRoleSettings**](docs/Api/RolesApi.md#getrolesettings) | **GET** /roles/{id}/settings | List role settings
*RolesApi* | [**getRoles**](docs/Api/RolesApi.md#getroles) | **GET** /roles | Get all roles
*RolesApi* | [**updateRole**](docs/Api/RolesApi.md#updaterole) | **PUT** /roles/{id} | Update role details
*RolesApi* | [**updateRolePipelines**](docs/Api/RolesApi.md#updaterolepipelines) | **PUT** /roles/{id}/pipelines | Update pipeline visibility for a role
*StagesApi* | [**addStage**](docs/Api/StagesApi.md#addstage) | **POST** /stages | Add a new stage
*StagesApi* | [**deleteStage**](docs/Api/StagesApi.md#deletestage) | **DELETE** /stages/{id} | Delete a stage
*StagesApi* | [**deleteStages**](docs/Api/StagesApi.md#deletestages) | **DELETE** /stages | Delete multiple stages in bulk
*StagesApi* | [**getStage**](docs/Api/StagesApi.md#getstage) | **GET** /stages/{id} | Get one stage
*StagesApi* | [**getStageDeals**](docs/Api/StagesApi.md#getstagedeals) | **GET** /stages/{id}/deals | Get deals in a stage
*StagesApi* | [**getStages**](docs/Api/StagesApi.md#getstages) | **GET** /stages | Get all stages
*StagesApi* | [**updateStage**](docs/Api/StagesApi.md#updatestage) | **PUT** /stages/{id} | Update stage details
*SubscriptionsApi* | [**addRecurringSubscription**](docs/Api/SubscriptionsApi.md#addrecurringsubscription) | **POST** /subscriptions/recurring | Add a recurring subscription
*SubscriptionsApi* | [**addSubscriptionInstallment**](docs/Api/SubscriptionsApi.md#addsubscriptioninstallment) | **POST** /subscriptions/installment | Add an installment subscription
*SubscriptionsApi* | [**cancelRecurringSubscription**](docs/Api/SubscriptionsApi.md#cancelrecurringsubscription) | **PUT** /subscriptions/recurring/{id}/cancel | Cancel a recurring subscription
*SubscriptionsApi* | [**deleteSubscription**](docs/Api/SubscriptionsApi.md#deletesubscription) | **DELETE** /subscriptions/{id} | Delete a subscription
*SubscriptionsApi* | [**findSubscriptionByDeal**](docs/Api/SubscriptionsApi.md#findsubscriptionbydeal) | **GET** /subscriptions/find/{dealId} | Find subscription by deal
*SubscriptionsApi* | [**getSubscription**](docs/Api/SubscriptionsApi.md#getsubscription) | **GET** /subscriptions/{id} | Get details of a subscription
*SubscriptionsApi* | [**getSubscriptionPayments**](docs/Api/SubscriptionsApi.md#getsubscriptionpayments) | **GET** /subscriptions/{id}/payments | Get all payments of a subscription
*SubscriptionsApi* | [**updateRecurringSubscription**](docs/Api/SubscriptionsApi.md#updaterecurringsubscription) | **PUT** /subscriptions/recurring/{id} | Update a recurring subscription
*SubscriptionsApi* | [**updateSubscriptionInstallment**](docs/Api/SubscriptionsApi.md#updatesubscriptioninstallment) | **PUT** /subscriptions/installment/{id} | Update an installment subscription
*TasksApi* | [**addTask**](docs/Api/TasksApi.md#addtask) | **POST** /tasks | Add a task
*TasksApi* | [**deleteTask**](docs/Api/TasksApi.md#deletetask) | **DELETE** /tasks/{id} | Delete a task
*TasksApi* | [**getTask**](docs/Api/TasksApi.md#gettask) | **GET** /tasks/{id} | Get details of a task
*TasksApi* | [**getTasks**](docs/Api/TasksApi.md#gettasks) | **GET** /tasks | Get all tasks
*TasksApi* | [**updateTask**](docs/Api/TasksApi.md#updatetask) | **PUT** /tasks/{id} | Update a task
*UserConnectionsApi* | [**getUserConnections**](docs/Api/UserConnectionsApi.md#getuserconnections) | **GET** /userConnections | Get all user connections
*UserSettingsApi* | [**getUserSettings**](docs/Api/UserSettingsApi.md#getusersettings) | **GET** /userSettings | List settings of an authorized user
*UsersApi* | [**addUser**](docs/Api/UsersApi.md#adduser) | **POST** /users | Add a new user
*UsersApi* | [**findUsersByName**](docs/Api/UsersApi.md#findusersbyname) | **GET** /users/find | Find users by name
*UsersApi* | [**getCurrentUser**](docs/Api/UsersApi.md#getcurrentuser) | **GET** /users/me | Get current user data
*UsersApi* | [**getUser**](docs/Api/UsersApi.md#getuser) | **GET** /users/{id} | Get one user
*UsersApi* | [**getUserFollowers**](docs/Api/UsersApi.md#getuserfollowers) | **GET** /users/{id}/followers | List followers of a user
*UsersApi* | [**getUserPermissions**](docs/Api/UsersApi.md#getuserpermissions) | **GET** /users/{id}/permissions | List user permissions
*UsersApi* | [**getUserRoleAssignments**](docs/Api/UsersApi.md#getuserroleassignments) | **GET** /users/{id}/roleAssignments | List role assignments
*UsersApi* | [**getUserRoleSettings**](docs/Api/UsersApi.md#getuserrolesettings) | **GET** /users/{id}/roleSettings | List user role settings
*UsersApi* | [**getUsers**](docs/Api/UsersApi.md#getusers) | **GET** /users | Get all users
*UsersApi* | [**updateUser**](docs/Api/UsersApi.md#updateuser) | **PUT** /users/{id} | Update user details
*WebhooksApi* | [**addWebhook**](docs/Api/WebhooksApi.md#addwebhook) | **POST** /webhooks | Create a new Webhook
*WebhooksApi* | [**deleteWebhook**](docs/Api/WebhooksApi.md#deletewebhook) | **DELETE** /webhooks/{id} | Delete existing Webhook
*WebhooksApi* | [**getWebhooks**](docs/Api/WebhooksApi.md#getwebhooks) | **GET** /webhooks | Get all Webhooks


## Documentation for models

 - [ActivityCollectionResponseObject](docs/Model/ActivityCollectionResponseObject.md)
 - [ActivityCollectionResponseObjectAllOf](docs/Model/ActivityCollectionResponseObjectAllOf.md)
 - [ActivityDistributionData](docs/Model/ActivityDistributionData.md)
 - [ActivityDistributionDataActivityDistribution](docs/Model/ActivityDistributionDataActivityDistribution.md)
 - [ActivityDistributionDataActivityDistributionASSIGNEDTOUSERID](docs/Model/ActivityDistributionDataActivityDistributionASSIGNEDTOUSERID.md)
 - [ActivityDistributionDataActivityDistributionASSIGNEDTOUSERIDActivities](docs/Model/ActivityDistributionDataActivityDistributionASSIGNEDTOUSERIDActivities.md)
 - [ActivityDistributionDataWithAdditionalData](docs/Model/ActivityDistributionDataWithAdditionalData.md)
 - [ActivityInfo](docs/Model/ActivityInfo.md)
 - [ActivityObjectFragment](docs/Model/ActivityObjectFragment.md)
 - [ActivityPostObject](docs/Model/ActivityPostObject.md)
 - [ActivityPostObjectAllOf](docs/Model/ActivityPostObjectAllOf.md)
 - [ActivityPutObject](docs/Model/ActivityPutObject.md)
 - [ActivityPutObjectAllOf](docs/Model/ActivityPutObjectAllOf.md)
 - [ActivityRecordAdditionalData](docs/Model/ActivityRecordAdditionalData.md)
 - [ActivityResponseObject](docs/Model/ActivityResponseObject.md)
 - [ActivityResponseObjectAllOf](docs/Model/ActivityResponseObjectAllOf.md)
 - [ActivityTypeBulkDeleteResponse](docs/Model/ActivityTypeBulkDeleteResponse.md)
 - [ActivityTypeBulkDeleteResponseAllOf](docs/Model/ActivityTypeBulkDeleteResponseAllOf.md)
 - [ActivityTypeBulkDeleteResponseAllOfData](docs/Model/ActivityTypeBulkDeleteResponseAllOfData.md)
 - [ActivityTypeCreateRequest](docs/Model/ActivityTypeCreateRequest.md)
 - [ActivityTypeCreateUpdateDeleteResponse](docs/Model/ActivityTypeCreateUpdateDeleteResponse.md)
 - [ActivityTypeCreateUpdateDeleteResponseAllOf](docs/Model/ActivityTypeCreateUpdateDeleteResponseAllOf.md)
 - [ActivityTypeListResponse](docs/Model/ActivityTypeListResponse.md)
 - [ActivityTypeListResponseAllOf](docs/Model/ActivityTypeListResponseAllOf.md)
 - [ActivityTypeObjectResponse](docs/Model/ActivityTypeObjectResponse.md)
 - [ActivityTypeUpdateRequest](docs/Model/ActivityTypeUpdateRequest.md)
 - [AddActivityResponse](docs/Model/AddActivityResponse.md)
 - [AddActivityResponseRelatedObjects](docs/Model/AddActivityResponseRelatedObjects.md)
 - [AddDealFollowerRequest](docs/Model/AddDealFollowerRequest.md)
 - [AddDealParticipantRequest](docs/Model/AddDealParticipantRequest.md)
 - [AddFile](docs/Model/AddFile.md)
 - [AddFilterRequest](docs/Model/AddFilterRequest.md)
 - [AddFollowerToPersonResponse](docs/Model/AddFollowerToPersonResponse.md)
 - [AddFollowerToPersonResponseAllOf](docs/Model/AddFollowerToPersonResponseAllOf.md)
 - [AddFollowerToPersonResponseAllOfData](docs/Model/AddFollowerToPersonResponseAllOfData.md)
 - [AddLeadLabelRequest](docs/Model/AddLeadLabelRequest.md)
 - [AddLeadRequest](docs/Model/AddLeadRequest.md)
 - [AddNewPipeline](docs/Model/AddNewPipeline.md)
 - [AddNewPipelineAllOf](docs/Model/AddNewPipelineAllOf.md)
 - [AddNoteRequest](docs/Model/AddNoteRequest.md)
 - [AddNoteRequestAllOf](docs/Model/AddNoteRequestAllOf.md)
 - [AddOrUpdateRoleSettingRequest](docs/Model/AddOrUpdateRoleSettingRequest.md)
 - [AddOrganizationFollowerRequest](docs/Model/AddOrganizationFollowerRequest.md)
 - [AddOrganizationRelationshipRequest](docs/Model/AddOrganizationRelationshipRequest.md)
 - [AddPersonFollowerRequest](docs/Model/AddPersonFollowerRequest.md)
 - [AddPersonPictureResponse](docs/Model/AddPersonPictureResponse.md)
 - [AddPersonPictureResponseAllOf](docs/Model/AddPersonPictureResponseAllOf.md)
 - [AddPersonResponse](docs/Model/AddPersonResponse.md)
 - [AddPersonResponseAllOf](docs/Model/AddPersonResponseAllOf.md)
 - [AddProductAttachmentDetails](docs/Model/AddProductAttachmentDetails.md)
 - [AddProductAttachmentDetailsAllOf](docs/Model/AddProductAttachmentDetailsAllOf.md)
 - [AddProductFollowerRequest](docs/Model/AddProductFollowerRequest.md)
 - [AddProductRequestBody](docs/Model/AddProductRequestBody.md)
 - [AddProductRequestBodyAllOf](docs/Model/AddProductRequestBodyAllOf.md)
 - [AddProductRequestBodyAllOf1](docs/Model/AddProductRequestBodyAllOf1.md)
 - [AddProjectResponse](docs/Model/AddProjectResponse.md)
 - [AddRole](docs/Model/AddRole.md)
 - [AddRoleAssignmentRequest](docs/Model/AddRoleAssignmentRequest.md)
 - [AddTaskResponse](docs/Model/AddTaskResponse.md)
 - [AddTeamUserRequest](docs/Model/AddTeamUserRequest.md)
 - [AddUserRequest](docs/Model/AddUserRequest.md)
 - [AddWebhookRequest](docs/Model/AddWebhookRequest.md)
 - [AddedDealFollower](docs/Model/AddedDealFollower.md)
 - [AddedDealFollowerData](docs/Model/AddedDealFollowerData.md)
 - [AdditionalBaseOrganizationItemInfo](docs/Model/AdditionalBaseOrganizationItemInfo.md)
 - [AdditionalData](docs/Model/AdditionalData.md)
 - [AdditionalDataWithCursorPagination](docs/Model/AdditionalDataWithCursorPagination.md)
 - [AdditionalDataWithOffsetPagination](docs/Model/AdditionalDataWithOffsetPagination.md)
 - [AdditionalDataWithPaginationDetails](docs/Model/AdditionalDataWithPaginationDetails.md)
 - [AdditionalMergePersonInfo](docs/Model/AdditionalMergePersonInfo.md)
 - [AdditionalPersonInfo](docs/Model/AdditionalPersonInfo.md)
 - [AllOrganizationRelationshipsGetResponse](docs/Model/AllOrganizationRelationshipsGetResponse.md)
 - [AllOrganizationRelationshipsGetResponseAllOf](docs/Model/AllOrganizationRelationshipsGetResponseAllOf.md)
 - [AllOrganizationRelationshipsGetResponseAllOfRelatedObjects](docs/Model/AllOrganizationRelationshipsGetResponseAllOfRelatedObjects.md)
 - [AllOrganizationsGetResponse](docs/Model/AllOrganizationsGetResponse.md)
 - [AllOrganizationsGetResponseAllOf](docs/Model/AllOrganizationsGetResponseAllOf.md)
 - [AllOrganizationsGetResponseAllOfRelatedObjects](docs/Model/AllOrganizationsGetResponseAllOfRelatedObjects.md)
 - [ArrayPrices](docs/Model/ArrayPrices.md)
 - [Assignee](docs/Model/Assignee.md)
 - [BaseComment](docs/Model/BaseComment.md)
 - [BaseCurrency](docs/Model/BaseCurrency.md)
 - [BaseDeal](docs/Model/BaseDeal.md)
 - [BaseFollowerItem](docs/Model/BaseFollowerItem.md)
 - [BaseMailThread](docs/Model/BaseMailThread.md)
 - [BaseMailThreadAllOf](docs/Model/BaseMailThreadAllOf.md)
 - [BaseMailThreadAllOfParties](docs/Model/BaseMailThreadAllOfParties.md)
 - [BaseMailThreadMessages](docs/Model/BaseMailThreadMessages.md)
 - [BaseMailThreadMessagesAllOf](docs/Model/BaseMailThreadMessagesAllOf.md)
 - [BaseNote](docs/Model/BaseNote.md)
 - [BaseNoteDealTitle](docs/Model/BaseNoteDealTitle.md)
 - [BaseNoteOrganization](docs/Model/BaseNoteOrganization.md)
 - [BaseNotePerson](docs/Model/BaseNotePerson.md)
 - [BaseOrganizationItem](docs/Model/BaseOrganizationItem.md)
 - [BaseOrganizationItemFields](docs/Model/BaseOrganizationItemFields.md)
 - [BaseOrganizationItemWithEditNameFlag](docs/Model/BaseOrganizationItemWithEditNameFlag.md)
 - [BaseOrganizationItemWithEditNameFlagAllOf](docs/Model/BaseOrganizationItemWithEditNameFlagAllOf.md)
 - [BaseOrganizationRelationshipItem](docs/Model/BaseOrganizationRelationshipItem.md)
 - [BasePersonItem](docs/Model/BasePersonItem.md)
 - [BasePersonItemEmail](docs/Model/BasePersonItemEmail.md)
 - [BasePersonItemPhone](docs/Model/BasePersonItemPhone.md)
 - [BasePipeline](docs/Model/BasePipeline.md)
 - [BasePipelineWithSelectedFlag](docs/Model/BasePipelineWithSelectedFlag.md)
 - [BasePipelineWithSelectedFlagAllOf](docs/Model/BasePipelineWithSelectedFlagAllOf.md)
 - [BaseProduct](docs/Model/BaseProduct.md)
 - [BaseResponse](docs/Model/BaseResponse.md)
 - [BaseResponseWithStatus](docs/Model/BaseResponseWithStatus.md)
 - [BaseResponseWithStatusAllOf](docs/Model/BaseResponseWithStatusAllOf.md)
 - [BaseRole](docs/Model/BaseRole.md)
 - [BaseStage](docs/Model/BaseStage.md)
 - [BaseTeam](docs/Model/BaseTeam.md)
 - [BaseTeamAdditionalProperties](docs/Model/BaseTeamAdditionalProperties.md)
 - [BaseUser](docs/Model/BaseUser.md)
 - [BaseUserMe](docs/Model/BaseUserMe.md)
 - [BaseUserMeAllOf](docs/Model/BaseUserMeAllOf.md)
 - [BaseUserMeAllOfLanguage](docs/Model/BaseUserMeAllOfLanguage.md)
 - [BaseWebhook](docs/Model/BaseWebhook.md)
 - [BasicDeal](docs/Model/BasicDeal.md)
 - [BasicDealProduct](docs/Model/BasicDealProduct.md)
 - [BasicDealProductAllOf](docs/Model/BasicDealProductAllOf.md)
 - [BasicGoal](docs/Model/BasicGoal.md)
 - [BasicOrganization](docs/Model/BasicOrganization.md)
 - [BasicPerson](docs/Model/BasicPerson.md)
 - [BasicPersonEmail](docs/Model/BasicPersonEmail.md)
 - [BillingFrequency](docs/Model/BillingFrequency.md)
 - [BillingFrequency1](docs/Model/BillingFrequency1.md)
 - [BulkDeleteResponse](docs/Model/BulkDeleteResponse.md)
 - [BulkDeleteResponseAllOf](docs/Model/BulkDeleteResponseAllOf.md)
 - [BulkDeleteResponseAllOfData](docs/Model/BulkDeleteResponseAllOfData.md)
 - [CalculatedFields](docs/Model/CalculatedFields.md)
 - [CallLogBadRequestResponse](docs/Model/CallLogBadRequestResponse.md)
 - [CallLogConflictResponse](docs/Model/CallLogConflictResponse.md)
 - [CallLogForbiddenResponse](docs/Model/CallLogForbiddenResponse.md)
 - [CallLogGoneResponse](docs/Model/CallLogGoneResponse.md)
 - [CallLogInternalErrorResponse](docs/Model/CallLogInternalErrorResponse.md)
 - [CallLogNotFoundResponse](docs/Model/CallLogNotFoundResponse.md)
 - [CallLogObject](docs/Model/CallLogObject.md)
 - [CallLogResponse200](docs/Model/CallLogResponse200.md)
 - [CallLogsResponse](docs/Model/CallLogsResponse.md)
 - [CallLogsResponseAdditionalData](docs/Model/CallLogsResponseAdditionalData.md)
 - [ChangelogResponse](docs/Model/ChangelogResponse.md)
 - [ChangelogResponseAllOf](docs/Model/ChangelogResponseAllOf.md)
 - [ChangelogResponseAllOfData](docs/Model/ChangelogResponseAllOfData.md)
 - [ChannelObject](docs/Model/ChannelObject.md)
 - [ChannelObjectResponse](docs/Model/ChannelObjectResponse.md)
 - [ChannelObjectResponseData](docs/Model/ChannelObjectResponseData.md)
 - [CommentPostPutObject](docs/Model/CommentPostPutObject.md)
 - [CommonMailThread](docs/Model/CommonMailThread.md)
 - [CreateRemoteFileAndLinkItToItem](docs/Model/CreateRemoteFileAndLinkItToItem.md)
 - [CreateTeam](docs/Model/CreateTeam.md)
 - [Currencies](docs/Model/Currencies.md)
 - [DealCollectionResponseObject](docs/Model/DealCollectionResponseObject.md)
 - [DealCountAndActivityInfo](docs/Model/DealCountAndActivityInfo.md)
 - [DealFlowResponse](docs/Model/DealFlowResponse.md)
 - [DealFlowResponseAllOf](docs/Model/DealFlowResponseAllOf.md)
 - [DealFlowResponseAllOfData](docs/Model/DealFlowResponseAllOfData.md)
 - [DealFlowResponseAllOfRelatedObjects](docs/Model/DealFlowResponseAllOfRelatedObjects.md)
 - [DealListActivitiesResponse](docs/Model/DealListActivitiesResponse.md)
 - [DealListActivitiesResponseAllOf](docs/Model/DealListActivitiesResponseAllOf.md)
 - [DealListActivitiesResponseAllOfRelatedObjects](docs/Model/DealListActivitiesResponseAllOfRelatedObjects.md)
 - [DealNonStrict](docs/Model/DealNonStrict.md)
 - [DealNonStrictModeFields](docs/Model/DealNonStrictModeFields.md)
 - [DealNonStrictModeFieldsCreatorUserId](docs/Model/DealNonStrictModeFieldsCreatorUserId.md)
 - [DealNonStrictWithDetails](docs/Model/DealNonStrictWithDetails.md)
 - [DealNonStrictWithDetailsAllOf](docs/Model/DealNonStrictWithDetailsAllOf.md)
 - [DealNonStrictWithDetailsAllOfAge](docs/Model/DealNonStrictWithDetailsAllOfAge.md)
 - [DealNonStrictWithDetailsAllOfAverageTimeToWon](docs/Model/DealNonStrictWithDetailsAllOfAverageTimeToWon.md)
 - [DealNonStrictWithDetailsAllOfStayInPipelineStages](docs/Model/DealNonStrictWithDetailsAllOfStayInPipelineStages.md)
 - [DealOrganizationData](docs/Model/DealOrganizationData.md)
 - [DealOrganizationDataWithId](docs/Model/DealOrganizationDataWithId.md)
 - [DealOrganizationDataWithIdAllOf](docs/Model/DealOrganizationDataWithIdAllOf.md)
 - [DealParticipantCountInfo](docs/Model/DealParticipantCountInfo.md)
 - [DealParticipants](docs/Model/DealParticipants.md)
 - [DealParticipantsChangelog](docs/Model/DealParticipantsChangelog.md)
 - [DealPersonData](docs/Model/DealPersonData.md)
 - [DealPersonDataEmail](docs/Model/DealPersonDataEmail.md)
 - [DealPersonDataPhone](docs/Model/DealPersonDataPhone.md)
 - [DealPersonDataWithId](docs/Model/DealPersonDataWithId.md)
 - [DealPersonDataWithIdAllOf](docs/Model/DealPersonDataWithIdAllOf.md)
 - [DealProductRequestBody](docs/Model/DealProductRequestBody.md)
 - [DealSearchItem](docs/Model/DealSearchItem.md)
 - [DealSearchItemItem](docs/Model/DealSearchItemItem.md)
 - [DealSearchItemItemOrganization](docs/Model/DealSearchItemItemOrganization.md)
 - [DealSearchItemItemOwner](docs/Model/DealSearchItemItemOwner.md)
 - [DealSearchItemItemPerson](docs/Model/DealSearchItemItemPerson.md)
 - [DealSearchItemItemStage](docs/Model/DealSearchItemItemStage.md)
 - [DealSearchResponse](docs/Model/DealSearchResponse.md)
 - [DealSearchResponseAllOf](docs/Model/DealSearchResponseAllOf.md)
 - [DealSearchResponseAllOfData](docs/Model/DealSearchResponseAllOfData.md)
 - [DealStrict](docs/Model/DealStrict.md)
 - [DealStrictModeFields](docs/Model/DealStrictModeFields.md)
 - [DealStrictWithMergeId](docs/Model/DealStrictWithMergeId.md)
 - [DealStrictWithMergeIdAllOf](docs/Model/DealStrictWithMergeIdAllOf.md)
 - [DealSummary](docs/Model/DealSummary.md)
 - [DealSummaryPerCurrency](docs/Model/DealSummaryPerCurrency.md)
 - [DealSummaryPerCurrencyFull](docs/Model/DealSummaryPerCurrencyFull.md)
 - [DealSummaryPerCurrencyFullCURRENCYID](docs/Model/DealSummaryPerCurrencyFullCURRENCYID.md)
 - [DealSummaryPerStages](docs/Model/DealSummaryPerStages.md)
 - [DealSummaryPerStagesSTAGEID](docs/Model/DealSummaryPerStagesSTAGEID.md)
 - [DealSummaryPerStagesSTAGEIDCURRENCYID](docs/Model/DealSummaryPerStagesSTAGEIDCURRENCYID.md)
 - [DealTitleParameter](docs/Model/DealTitleParameter.md)
 - [DealUserData](docs/Model/DealUserData.md)
 - [DealUserDataWithId](docs/Model/DealUserDataWithId.md)
 - [DealUserDataWithIdAllOf](docs/Model/DealUserDataWithIdAllOf.md)
 - [DealsCountAndActivityInfo](docs/Model/DealsCountAndActivityInfo.md)
 - [DealsCountInfo](docs/Model/DealsCountInfo.md)
 - [DealsMovementsInfo](docs/Model/DealsMovementsInfo.md)
 - [DealsMovementsInfoFormattedValues](docs/Model/DealsMovementsInfoFormattedValues.md)
 - [DealsMovementsInfoValues](docs/Model/DealsMovementsInfoValues.md)
 - [DeleteActivitiesResponse](docs/Model/DeleteActivitiesResponse.md)
 - [DeleteActivitiesResponseData](docs/Model/DeleteActivitiesResponseData.md)
 - [DeleteActivityResponse](docs/Model/DeleteActivityResponse.md)
 - [DeleteActivityResponseData](docs/Model/DeleteActivityResponseData.md)
 - [DeleteChannelSuccess](docs/Model/DeleteChannelSuccess.md)
 - [DeleteComment](docs/Model/DeleteComment.md)
 - [DeleteConversationSuccess](docs/Model/DeleteConversationSuccess.md)
 - [DeleteDeal](docs/Model/DeleteDeal.md)
 - [DeleteDealData](docs/Model/DeleteDealData.md)
 - [DeleteDealFollower](docs/Model/DeleteDealFollower.md)
 - [DeleteDealFollowerData](docs/Model/DeleteDealFollowerData.md)
 - [DeleteDealParticipant](docs/Model/DeleteDealParticipant.md)
 - [DeleteDealParticipantData](docs/Model/DeleteDealParticipantData.md)
 - [DeleteDealProduct](docs/Model/DeleteDealProduct.md)
 - [DeleteDealProductData](docs/Model/DeleteDealProductData.md)
 - [DeleteFile](docs/Model/DeleteFile.md)
 - [DeleteFileData](docs/Model/DeleteFileData.md)
 - [DeleteGoalResponse](docs/Model/DeleteGoalResponse.md)
 - [DeleteLeadIdResponse](docs/Model/DeleteLeadIdResponse.md)
 - [DeleteMultipleDeals](docs/Model/DeleteMultipleDeals.md)
 - [DeleteMultipleDealsData](docs/Model/DeleteMultipleDealsData.md)
 - [DeleteMultipleProductFieldsResponse](docs/Model/DeleteMultipleProductFieldsResponse.md)
 - [DeleteMultipleProductFieldsResponseData](docs/Model/DeleteMultipleProductFieldsResponseData.md)
 - [DeleteNote](docs/Model/DeleteNote.md)
 - [DeletePersonResponse](docs/Model/DeletePersonResponse.md)
 - [DeletePersonResponseAllOf](docs/Model/DeletePersonResponseAllOf.md)
 - [DeletePersonResponseAllOfData](docs/Model/DeletePersonResponseAllOfData.md)
 - [DeletePersonsInBulkResponse](docs/Model/DeletePersonsInBulkResponse.md)
 - [DeletePersonsInBulkResponseAllOf](docs/Model/DeletePersonsInBulkResponseAllOf.md)
 - [DeletePersonsInBulkResponseAllOfData](docs/Model/DeletePersonsInBulkResponseAllOfData.md)
 - [DeletePipelineResponse](docs/Model/DeletePipelineResponse.md)
 - [DeletePipelineResponseData](docs/Model/DeletePipelineResponseData.md)
 - [DeleteProductFieldResponse](docs/Model/DeleteProductFieldResponse.md)
 - [DeleteProductFieldResponseData](docs/Model/DeleteProductFieldResponseData.md)
 - [DeleteProductFollowerResponse](docs/Model/DeleteProductFollowerResponse.md)
 - [DeleteProductFollowerResponseData](docs/Model/DeleteProductFollowerResponseData.md)
 - [DeleteProductResponse](docs/Model/DeleteProductResponse.md)
 - [DeleteProductResponseData](docs/Model/DeleteProductResponseData.md)
 - [DeleteProject](docs/Model/DeleteProject.md)
 - [DeleteProjectData](docs/Model/DeleteProjectData.md)
 - [DeleteProjectResponse](docs/Model/DeleteProjectResponse.md)
 - [DeleteResponse](docs/Model/DeleteResponse.md)
 - [DeleteResponseAllOf](docs/Model/DeleteResponseAllOf.md)
 - [DeleteResponseAllOfData](docs/Model/DeleteResponseAllOfData.md)
 - [DeleteRole](docs/Model/DeleteRole.md)
 - [DeleteRoleAllOf](docs/Model/DeleteRoleAllOf.md)
 - [DeleteRoleAllOfData](docs/Model/DeleteRoleAllOfData.md)
 - [DeleteRoleAssignment](docs/Model/DeleteRoleAssignment.md)
 - [DeleteRoleAssignmentAllOf](docs/Model/DeleteRoleAssignmentAllOf.md)
 - [DeleteRoleAssignmentAllOfData](docs/Model/DeleteRoleAssignmentAllOfData.md)
 - [DeleteRoleAssignmentRequest](docs/Model/DeleteRoleAssignmentRequest.md)
 - [DeleteStageResponse](docs/Model/DeleteStageResponse.md)
 - [DeleteStageResponseData](docs/Model/DeleteStageResponseData.md)
 - [DeleteStagesResponse](docs/Model/DeleteStagesResponse.md)
 - [DeleteStagesResponseData](docs/Model/DeleteStagesResponseData.md)
 - [DeleteTask](docs/Model/DeleteTask.md)
 - [DeleteTaskData](docs/Model/DeleteTaskData.md)
 - [DeleteTaskResponse](docs/Model/DeleteTaskResponse.md)
 - [DeleteTeamUserRequest](docs/Model/DeleteTeamUserRequest.md)
 - [Duration](docs/Model/Duration.md)
 - [EditPipeline](docs/Model/EditPipeline.md)
 - [EditPipelineAllOf](docs/Model/EditPipelineAllOf.md)
 - [EmailInfo](docs/Model/EmailInfo.md)
 - [ExpectedOutcome](docs/Model/ExpectedOutcome.md)
 - [FailResponse](docs/Model/FailResponse.md)
 - [Field](docs/Model/Field.md)
 - [FieldCreateRequest](docs/Model/FieldCreateRequest.md)
 - [FieldCreateRequestAllOf](docs/Model/FieldCreateRequestAllOf.md)
 - [FieldResponse](docs/Model/FieldResponse.md)
 - [FieldResponseAllOf](docs/Model/FieldResponseAllOf.md)
 - [FieldType](docs/Model/FieldType.md)
 - [FieldTypeAsString](docs/Model/FieldTypeAsString.md)
 - [FieldUpdateRequest](docs/Model/FieldUpdateRequest.md)
 - [FieldsResponse](docs/Model/FieldsResponse.md)
 - [FieldsResponseAllOf](docs/Model/FieldsResponseAllOf.md)
 - [FileData](docs/Model/FileData.md)
 - [FileItem](docs/Model/FileItem.md)
 - [FilterGetItem](docs/Model/FilterGetItem.md)
 - [FilterType](docs/Model/FilterType.md)
 - [FiltersBulkDeleteResponse](docs/Model/FiltersBulkDeleteResponse.md)
 - [FiltersBulkDeleteResponseAllOf](docs/Model/FiltersBulkDeleteResponseAllOf.md)
 - [FiltersBulkDeleteResponseAllOfData](docs/Model/FiltersBulkDeleteResponseAllOfData.md)
 - [FiltersBulkGetResponse](docs/Model/FiltersBulkGetResponse.md)
 - [FiltersBulkGetResponseAllOf](docs/Model/FiltersBulkGetResponseAllOf.md)
 - [FiltersDeleteResponse](docs/Model/FiltersDeleteResponse.md)
 - [FiltersDeleteResponseAllOf](docs/Model/FiltersDeleteResponseAllOf.md)
 - [FiltersDeleteResponseAllOfData](docs/Model/FiltersDeleteResponseAllOfData.md)
 - [FiltersGetResponse](docs/Model/FiltersGetResponse.md)
 - [FiltersGetResponseAllOf](docs/Model/FiltersGetResponseAllOf.md)
 - [FiltersPostResponse](docs/Model/FiltersPostResponse.md)
 - [FiltersPostResponseAllOf](docs/Model/FiltersPostResponseAllOf.md)
 - [FiltersPostResponseAllOfData](docs/Model/FiltersPostResponseAllOfData.md)
 - [FindGoalResponse](docs/Model/FindGoalResponse.md)
 - [FollowerData](docs/Model/FollowerData.md)
 - [FollowerDataWithID](docs/Model/FollowerDataWithID.md)
 - [FollowerDataWithIDAllOf](docs/Model/FollowerDataWithIDAllOf.md)
 - [FullProjectObject](docs/Model/FullProjectObject.md)
 - [FullRole](docs/Model/FullRole.md)
 - [FullRoleAllOf](docs/Model/FullRoleAllOf.md)
 - [FullTaskObject](docs/Model/FullTaskObject.md)
 - [GetActivitiesCollectionResponse](docs/Model/GetActivitiesCollectionResponse.md)
 - [GetActivitiesResponse](docs/Model/GetActivitiesResponse.md)
 - [GetActivitiesResponseRelatedObjects](docs/Model/GetActivitiesResponseRelatedObjects.md)
 - [GetActivityResponse](docs/Model/GetActivityResponse.md)
 - [GetAddProductAttachmentDetails](docs/Model/GetAddProductAttachmentDetails.md)
 - [GetAddUpdateStage](docs/Model/GetAddUpdateStage.md)
 - [GetAddedDeal](docs/Model/GetAddedDeal.md)
 - [GetAllFiles](docs/Model/GetAllFiles.md)
 - [GetAllPersonsResponse](docs/Model/GetAllPersonsResponse.md)
 - [GetAllPersonsResponseAllOf](docs/Model/GetAllPersonsResponseAllOf.md)
 - [GetAllPipelines](docs/Model/GetAllPipelines.md)
 - [GetAllPipelinesAllOf](docs/Model/GetAllPipelinesAllOf.md)
 - [GetAllProductFieldsResponse](docs/Model/GetAllProductFieldsResponse.md)
 - [GetComments](docs/Model/GetComments.md)
 - [GetDeal](docs/Model/GetDeal.md)
 - [GetDealAdditionalData](docs/Model/GetDealAdditionalData.md)
 - [GetDealRelatedObjects](docs/Model/GetDealRelatedObjects.md)
 - [GetDeals](docs/Model/GetDeals.md)
 - [GetDealsCollection](docs/Model/GetDealsCollection.md)
 - [GetDealsConversionRatesInPipeline](docs/Model/GetDealsConversionRatesInPipeline.md)
 - [GetDealsConversionRatesInPipelineAllOf](docs/Model/GetDealsConversionRatesInPipelineAllOf.md)
 - [GetDealsConversionRatesInPipelineAllOfData](docs/Model/GetDealsConversionRatesInPipelineAllOfData.md)
 - [GetDealsMovementsInPipeline](docs/Model/GetDealsMovementsInPipeline.md)
 - [GetDealsMovementsInPipelineAllOf](docs/Model/GetDealsMovementsInPipelineAllOf.md)
 - [GetDealsMovementsInPipelineAllOfData](docs/Model/GetDealsMovementsInPipelineAllOfData.md)
 - [GetDealsMovementsInPipelineAllOfDataAverageAgeInDays](docs/Model/GetDealsMovementsInPipelineAllOfDataAverageAgeInDays.md)
 - [GetDealsMovementsInPipelineAllOfDataAverageAgeInDaysByStages](docs/Model/GetDealsMovementsInPipelineAllOfDataAverageAgeInDaysByStages.md)
 - [GetDealsMovementsInPipelineAllOfDataMovementsBetweenStages](docs/Model/GetDealsMovementsInPipelineAllOfDataMovementsBetweenStages.md)
 - [GetDealsRelatedObjects](docs/Model/GetDealsRelatedObjects.md)
 - [GetDealsSummary](docs/Model/GetDealsSummary.md)
 - [GetDealsSummaryData](docs/Model/GetDealsSummaryData.md)
 - [GetDealsSummaryDataValuesTotal](docs/Model/GetDealsSummaryDataValuesTotal.md)
 - [GetDealsSummaryDataWeightedValuesTotal](docs/Model/GetDealsSummaryDataWeightedValuesTotal.md)
 - [GetDealsTimeline](docs/Model/GetDealsTimeline.md)
 - [GetDealsTimelineData](docs/Model/GetDealsTimelineData.md)
 - [GetDealsTimelineDataTotals](docs/Model/GetDealsTimelineDataTotals.md)
 - [GetDuplicatedDeal](docs/Model/GetDuplicatedDeal.md)
 - [GetField](docs/Model/GetField.md)
 - [GetFieldAllOf](docs/Model/GetFieldAllOf.md)
 - [GetGoalResultResponse](docs/Model/GetGoalResultResponse.md)
 - [GetGoalsResponse](docs/Model/GetGoalsResponse.md)
 - [GetLeadIdResponse](docs/Model/GetLeadIdResponse.md)
 - [GetLeadIdResponseData](docs/Model/GetLeadIdResponseData.md)
 - [GetLeadLabelsResponse](docs/Model/GetLeadLabelsResponse.md)
 - [GetLeadResponse](docs/Model/GetLeadResponse.md)
 - [GetLeadsResponse](docs/Model/GetLeadsResponse.md)
 - [GetLeadsSourceResponse](docs/Model/GetLeadsSourceResponse.md)
 - [GetLeadsSourceResponseData](docs/Model/GetLeadsSourceResponseData.md)
 - [GetMergedDeal](docs/Model/GetMergedDeal.md)
 - [GetNoteField](docs/Model/GetNoteField.md)
 - [GetNotes](docs/Model/GetNotes.md)
 - [GetOneFile](docs/Model/GetOneFile.md)
 - [GetOnePipeline](docs/Model/GetOnePipeline.md)
 - [GetOnePipelineAllOf](docs/Model/GetOnePipelineAllOf.md)
 - [GetOneStage](docs/Model/GetOneStage.md)
 - [GetPersonDetailsResponse](docs/Model/GetPersonDetailsResponse.md)
 - [GetPersonDetailsResponseAllOf](docs/Model/GetPersonDetailsResponseAllOf.md)
 - [GetPersonDetailsResponseAllOfAdditionalData](docs/Model/GetPersonDetailsResponseAllOfAdditionalData.md)
 - [GetProductAttachmentDetails](docs/Model/GetProductAttachmentDetails.md)
 - [GetProductField](docs/Model/GetProductField.md)
 - [GetProductFieldResponse](docs/Model/GetProductFieldResponse.md)
 - [GetProjectBoardResponse](docs/Model/GetProjectBoardResponse.md)
 - [GetProjectBoardsResponse](docs/Model/GetProjectBoardsResponse.md)
 - [GetProjectGroupsResponse](docs/Model/GetProjectGroupsResponse.md)
 - [GetProjectPhaseResponse](docs/Model/GetProjectPhaseResponse.md)
 - [GetProjectPhasesResponse](docs/Model/GetProjectPhasesResponse.md)
 - [GetProjectPlanResponse](docs/Model/GetProjectPlanResponse.md)
 - [GetProjectResponse](docs/Model/GetProjectResponse.md)
 - [GetProjectTemplateResponse](docs/Model/GetProjectTemplateResponse.md)
 - [GetProjectTemplatesResponse](docs/Model/GetProjectTemplatesResponse.md)
 - [GetProjectsResponse](docs/Model/GetProjectsResponse.md)
 - [GetRecents](docs/Model/GetRecents.md)
 - [GetRecentsAdditionalData](docs/Model/GetRecentsAdditionalData.md)
 - [GetRole](docs/Model/GetRole.md)
 - [GetRoleAllOf](docs/Model/GetRoleAllOf.md)
 - [GetRoleAllOfAdditionalData](docs/Model/GetRoleAllOfAdditionalData.md)
 - [GetRoleAssignments](docs/Model/GetRoleAssignments.md)
 - [GetRoleAssignmentsAllOf](docs/Model/GetRoleAssignmentsAllOf.md)
 - [GetRolePipelines](docs/Model/GetRolePipelines.md)
 - [GetRolePipelinesAllOf](docs/Model/GetRolePipelinesAllOf.md)
 - [GetRolePipelinesAllOfData](docs/Model/GetRolePipelinesAllOfData.md)
 - [GetRoleSettings](docs/Model/GetRoleSettings.md)
 - [GetRoleSettingsAllOf](docs/Model/GetRoleSettingsAllOf.md)
 - [GetRoles](docs/Model/GetRoles.md)
 - [GetRolesAllOf](docs/Model/GetRolesAllOf.md)
 - [GetStageDeals](docs/Model/GetStageDeals.md)
 - [GetStages](docs/Model/GetStages.md)
 - [GetTaskResponse](docs/Model/GetTaskResponse.md)
 - [GetTasksResponse](docs/Model/GetTasksResponse.md)
 - [GoalResults](docs/Model/GoalResults.md)
 - [GoalType](docs/Model/GoalType.md)
 - [GoalsResponseComponent](docs/Model/GoalsResponseComponent.md)
 - [IconKey](docs/Model/IconKey.md)
 - [InlineResponse200](docs/Model/InlineResponse200.md)
 - [InlineResponse2001](docs/Model/InlineResponse2001.md)
 - [InlineResponse2002](docs/Model/InlineResponse2002.md)
 - [InlineResponse400](docs/Model/InlineResponse400.md)
 - [InlineResponse4001](docs/Model/InlineResponse4001.md)
 - [InlineResponse4001AdditionalData](docs/Model/InlineResponse4001AdditionalData.md)
 - [InlineResponse400AdditionalData](docs/Model/InlineResponse400AdditionalData.md)
 - [InlineResponse403](docs/Model/InlineResponse403.md)
 - [InlineResponse4031](docs/Model/InlineResponse4031.md)
 - [InlineResponse4031AdditionalData](docs/Model/InlineResponse4031AdditionalData.md)
 - [InlineResponse403AdditionalData](docs/Model/InlineResponse403AdditionalData.md)
 - [InlineResponse404](docs/Model/InlineResponse404.md)
 - [InlineResponse404AdditionalData](docs/Model/InlineResponse404AdditionalData.md)
 - [InternalFieldType](docs/Model/InternalFieldType.md)
 - [ItemSearchAdditionalData](docs/Model/ItemSearchAdditionalData.md)
 - [ItemSearchAdditionalDataPagination](docs/Model/ItemSearchAdditionalDataPagination.md)
 - [ItemSearchFieldResponse](docs/Model/ItemSearchFieldResponse.md)
 - [ItemSearchFieldResponseAllOf](docs/Model/ItemSearchFieldResponseAllOf.md)
 - [ItemSearchFieldResponseAllOfData](docs/Model/ItemSearchFieldResponseAllOfData.md)
 - [ItemSearchItem](docs/Model/ItemSearchItem.md)
 - [ItemSearchResponse](docs/Model/ItemSearchResponse.md)
 - [ItemSearchResponseAllOf](docs/Model/ItemSearchResponseAllOf.md)
 - [ItemSearchResponseAllOfData](docs/Model/ItemSearchResponseAllOfData.md)
 - [LeadLabelColor](docs/Model/LeadLabelColor.md)
 - [LeadLabelResponse](docs/Model/LeadLabelResponse.md)
 - [LeadNotFoundResponse](docs/Model/LeadNotFoundResponse.md)
 - [LeadResponse](docs/Model/LeadResponse.md)
 - [LeadSearchItem](docs/Model/LeadSearchItem.md)
 - [LeadSearchItemItem](docs/Model/LeadSearchItemItem.md)
 - [LeadSearchItemItemOrganization](docs/Model/LeadSearchItemItemOrganization.md)
 - [LeadSearchItemItemOwner](docs/Model/LeadSearchItemItemOwner.md)
 - [LeadSearchItemItemPerson](docs/Model/LeadSearchItemItemPerson.md)
 - [LeadSearchResponse](docs/Model/LeadSearchResponse.md)
 - [LeadSearchResponseAllOf](docs/Model/LeadSearchResponseAllOf.md)
 - [LeadSearchResponseAllOfData](docs/Model/LeadSearchResponseAllOfData.md)
 - [LeadValue](docs/Model/LeadValue.md)
 - [LinkRemoteFileToItem](docs/Model/LinkRemoteFileToItem.md)
 - [ListActivitiesResponse](docs/Model/ListActivitiesResponse.md)
 - [ListActivitiesResponseAllOf](docs/Model/ListActivitiesResponseAllOf.md)
 - [ListDealsResponse](docs/Model/ListDealsResponse.md)
 - [ListDealsResponseAllOf](docs/Model/ListDealsResponseAllOf.md)
 - [ListDealsResponseAllOfRelatedObjects](docs/Model/ListDealsResponseAllOfRelatedObjects.md)
 - [ListFilesResponse](docs/Model/ListFilesResponse.md)
 - [ListFilesResponseAllOf](docs/Model/ListFilesResponseAllOf.md)
 - [ListFollowersResponse](docs/Model/ListFollowersResponse.md)
 - [ListFollowersResponseAllOf](docs/Model/ListFollowersResponseAllOf.md)
 - [ListFollowersResponseAllOfData](docs/Model/ListFollowersResponseAllOfData.md)
 - [ListMailMessagesResponse](docs/Model/ListMailMessagesResponse.md)
 - [ListMailMessagesResponseAllOf](docs/Model/ListMailMessagesResponseAllOf.md)
 - [ListMailMessagesResponseAllOfData](docs/Model/ListMailMessagesResponseAllOfData.md)
 - [ListPermittedUsersResponse](docs/Model/ListPermittedUsersResponse.md)
 - [ListPermittedUsersResponse1](docs/Model/ListPermittedUsersResponse1.md)
 - [ListPermittedUsersResponse1AllOf](docs/Model/ListPermittedUsersResponse1AllOf.md)
 - [ListPersonProductsResponse](docs/Model/ListPersonProductsResponse.md)
 - [ListPersonProductsResponseAllOf](docs/Model/ListPersonProductsResponseAllOf.md)
 - [ListPersonProductsResponseAllOfDEALID](docs/Model/ListPersonProductsResponseAllOfDEALID.md)
 - [ListPersonProductsResponseAllOfData](docs/Model/ListPersonProductsResponseAllOfData.md)
 - [ListPersonsResponse](docs/Model/ListPersonsResponse.md)
 - [ListPersonsResponseAllOf](docs/Model/ListPersonsResponseAllOf.md)
 - [ListPersonsResponseAllOfRelatedObjects](docs/Model/ListPersonsResponseAllOfRelatedObjects.md)
 - [ListProductAdditionalData](docs/Model/ListProductAdditionalData.md)
 - [ListProductAdditionalDataAllOf](docs/Model/ListProductAdditionalDataAllOf.md)
 - [ListProductFilesResponse](docs/Model/ListProductFilesResponse.md)
 - [ListProductFilesResponseAllOf](docs/Model/ListProductFilesResponseAllOf.md)
 - [ListProductFollowersResponse](docs/Model/ListProductFollowersResponse.md)
 - [ListProductFollowersResponseAllOf](docs/Model/ListProductFollowersResponseAllOf.md)
 - [ListProductFollowersResponseAllOfData](docs/Model/ListProductFollowersResponseAllOfData.md)
 - [ListProductsResponse](docs/Model/ListProductsResponse.md)
 - [ListProductsResponseAllOf](docs/Model/ListProductsResponseAllOf.md)
 - [ListProductsResponseAllOfRelatedObjects](docs/Model/ListProductsResponseAllOfRelatedObjects.md)
 - [MailMessage](docs/Model/MailMessage.md)
 - [MailMessageAllOf](docs/Model/MailMessageAllOf.md)
 - [MailMessageData](docs/Model/MailMessageData.md)
 - [MailMessageItemForList](docs/Model/MailMessageItemForList.md)
 - [MailMessageItemForListAllOf](docs/Model/MailMessageItemForListAllOf.md)
 - [MailParticipant](docs/Model/MailParticipant.md)
 - [MailServiceBaseResponse](docs/Model/MailServiceBaseResponse.md)
 - [MailThread](docs/Model/MailThread.md)
 - [MailThreadAllOf](docs/Model/MailThreadAllOf.md)
 - [MailThreadDelete](docs/Model/MailThreadDelete.md)
 - [MailThreadDeleteAllOf](docs/Model/MailThreadDeleteAllOf.md)
 - [MailThreadDeleteAllOfData](docs/Model/MailThreadDeleteAllOfData.md)
 - [MailThreadMessages](docs/Model/MailThreadMessages.md)
 - [MailThreadMessagesAllOf](docs/Model/MailThreadMessagesAllOf.md)
 - [MailThreadOne](docs/Model/MailThreadOne.md)
 - [MailThreadOneAllOf](docs/Model/MailThreadOneAllOf.md)
 - [MailThreadParticipant](docs/Model/MailThreadParticipant.md)
 - [MailThreadPut](docs/Model/MailThreadPut.md)
 - [MailThreadPutAllOf](docs/Model/MailThreadPutAllOf.md)
 - [MarketingStatus](docs/Model/MarketingStatus.md)
 - [MergeDealsRequest](docs/Model/MergeDealsRequest.md)
 - [MergeOrganizationsRequest](docs/Model/MergeOrganizationsRequest.md)
 - [MergePersonDealRelatedInfo](docs/Model/MergePersonDealRelatedInfo.md)
 - [MergePersonItem](docs/Model/MergePersonItem.md)
 - [MergePersonsRequest](docs/Model/MergePersonsRequest.md)
 - [MergePersonsResponse](docs/Model/MergePersonsResponse.md)
 - [MergePersonsResponseAllOf](docs/Model/MergePersonsResponseAllOf.md)
 - [MessageObject](docs/Model/MessageObject.md)
 - [MessageObjectAttachments](docs/Model/MessageObjectAttachments.md)
 - [NameObject](docs/Model/NameObject.md)
 - [NewDeal](docs/Model/NewDeal.md)
 - [NewDealParameters](docs/Model/NewDealParameters.md)
 - [NewDealProduct](docs/Model/NewDealProduct.md)
 - [NewDealProductAllOf](docs/Model/NewDealProductAllOf.md)
 - [NewDealProductAllOf1](docs/Model/NewDealProductAllOf1.md)
 - [NewDealProductAllOf2](docs/Model/NewDealProductAllOf2.md)
 - [NewFollowerResponse](docs/Model/NewFollowerResponse.md)
 - [NewFollowerResponseData](docs/Model/NewFollowerResponseData.md)
 - [NewGoal](docs/Model/NewGoal.md)
 - [NewOrganization](docs/Model/NewOrganization.md)
 - [NewOrganizationAllOf](docs/Model/NewOrganizationAllOf.md)
 - [NewPerson](docs/Model/NewPerson.md)
 - [NewPersonAllOf](docs/Model/NewPersonAllOf.md)
 - [NewProductField](docs/Model/NewProductField.md)
 - [Note](docs/Model/Note.md)
 - [NoteAllOf](docs/Model/NoteAllOf.md)
 - [NoteConnectToParams](docs/Model/NoteConnectToParams.md)
 - [NoteCreatorUser](docs/Model/NoteCreatorUser.md)
 - [NoteField](docs/Model/NoteField.md)
 - [NoteFieldOptions](docs/Model/NoteFieldOptions.md)
 - [NoteFieldsResponse](docs/Model/NoteFieldsResponse.md)
 - [NoteFieldsResponseAllOf](docs/Model/NoteFieldsResponseAllOf.md)
 - [NoteParams](docs/Model/NoteParams.md)
 - [NumberBoolean](docs/Model/NumberBoolean.md)
 - [NumberBooleanDefault0](docs/Model/NumberBooleanDefault0.md)
 - [NumberBooleanDefault1](docs/Model/NumberBooleanDefault1.md)
 - [OrgAndOwnerId](docs/Model/OrgAndOwnerId.md)
 - [OrganizationAddressInfo](docs/Model/OrganizationAddressInfo.md)
 - [OrganizationCountAndAddressInfo](docs/Model/OrganizationCountAndAddressInfo.md)
 - [OrganizationCountInfo](docs/Model/OrganizationCountInfo.md)
 - [OrganizationData](docs/Model/OrganizationData.md)
 - [OrganizationDataWithId](docs/Model/OrganizationDataWithId.md)
 - [OrganizationDataWithIdAllOf](docs/Model/OrganizationDataWithIdAllOf.md)
 - [OrganizationDataWithIdAndActiveFlag](docs/Model/OrganizationDataWithIdAndActiveFlag.md)
 - [OrganizationDataWithIdAndActiveFlagAllOf](docs/Model/OrganizationDataWithIdAndActiveFlagAllOf.md)
 - [OrganizationDeleteResponse](docs/Model/OrganizationDeleteResponse.md)
 - [OrganizationDeleteResponseData](docs/Model/OrganizationDeleteResponseData.md)
 - [OrganizationDetailsGetResponse](docs/Model/OrganizationDetailsGetResponse.md)
 - [OrganizationDetailsGetResponseAllOf](docs/Model/OrganizationDetailsGetResponseAllOf.md)
 - [OrganizationDetailsGetResponseAllOfAdditionalData](docs/Model/OrganizationDetailsGetResponseAllOfAdditionalData.md)
 - [OrganizationFlowResponse](docs/Model/OrganizationFlowResponse.md)
 - [OrganizationFlowResponseAllOf](docs/Model/OrganizationFlowResponseAllOf.md)
 - [OrganizationFlowResponseAllOfData](docs/Model/OrganizationFlowResponseAllOfData.md)
 - [OrganizationFlowResponseAllOfRelatedObjects](docs/Model/OrganizationFlowResponseAllOfRelatedObjects.md)
 - [OrganizationFollowerDeleteResponse](docs/Model/OrganizationFollowerDeleteResponse.md)
 - [OrganizationFollowerDeleteResponseData](docs/Model/OrganizationFollowerDeleteResponseData.md)
 - [OrganizationFollowerItem](docs/Model/OrganizationFollowerItem.md)
 - [OrganizationFollowerItemAllOf](docs/Model/OrganizationFollowerItemAllOf.md)
 - [OrganizationFollowerPostResponse](docs/Model/OrganizationFollowerPostResponse.md)
 - [OrganizationFollowersListResponse](docs/Model/OrganizationFollowersListResponse.md)
 - [OrganizationItem](docs/Model/OrganizationItem.md)
 - [OrganizationItemAllOf](docs/Model/OrganizationItemAllOf.md)
 - [OrganizationPostResponse](docs/Model/OrganizationPostResponse.md)
 - [OrganizationPostResponseAllOf](docs/Model/OrganizationPostResponseAllOf.md)
 - [OrganizationRelationship](docs/Model/OrganizationRelationship.md)
 - [OrganizationRelationshipDeleteResponse](docs/Model/OrganizationRelationshipDeleteResponse.md)
 - [OrganizationRelationshipDeleteResponseAllOf](docs/Model/OrganizationRelationshipDeleteResponseAllOf.md)
 - [OrganizationRelationshipDeleteResponseAllOfData](docs/Model/OrganizationRelationshipDeleteResponseAllOfData.md)
 - [OrganizationRelationshipDetails](docs/Model/OrganizationRelationshipDetails.md)
 - [OrganizationRelationshipGetResponse](docs/Model/OrganizationRelationshipGetResponse.md)
 - [OrganizationRelationshipGetResponseAllOf](docs/Model/OrganizationRelationshipGetResponseAllOf.md)
 - [OrganizationRelationshipPostResponse](docs/Model/OrganizationRelationshipPostResponse.md)
 - [OrganizationRelationshipPostResponseAllOf](docs/Model/OrganizationRelationshipPostResponseAllOf.md)
 - [OrganizationRelationshipUpdateResponse](docs/Model/OrganizationRelationshipUpdateResponse.md)
 - [OrganizationRelationshipWithCalculatedFields](docs/Model/OrganizationRelationshipWithCalculatedFields.md)
 - [OrganizationSearchItem](docs/Model/OrganizationSearchItem.md)
 - [OrganizationSearchItemItem](docs/Model/OrganizationSearchItemItem.md)
 - [OrganizationSearchResponse](docs/Model/OrganizationSearchResponse.md)
 - [OrganizationSearchResponseAllOf](docs/Model/OrganizationSearchResponseAllOf.md)
 - [OrganizationSearchResponseAllOfData](docs/Model/OrganizationSearchResponseAllOfData.md)
 - [OrganizationUpdateResponse](docs/Model/OrganizationUpdateResponse.md)
 - [OrganizationUpdateResponseAllOf](docs/Model/OrganizationUpdateResponseAllOf.md)
 - [OrganizationsCollectionResponseObject](docs/Model/OrganizationsCollectionResponseObject.md)
 - [OrganizationsCollectionResponseObjectAllOf](docs/Model/OrganizationsCollectionResponseObjectAllOf.md)
 - [OrganizationsDeleteResponse](docs/Model/OrganizationsDeleteResponse.md)
 - [OrganizationsDeleteResponseData](docs/Model/OrganizationsDeleteResponseData.md)
 - [OrganizationsMergeResponse](docs/Model/OrganizationsMergeResponse.md)
 - [OrganizationsMergeResponseData](docs/Model/OrganizationsMergeResponseData.md)
 - [Owner](docs/Model/Owner.md)
 - [OwnerAllOf](docs/Model/OwnerAllOf.md)
 - [PaginationDetails](docs/Model/PaginationDetails.md)
 - [PaginationDetailsAllOf](docs/Model/PaginationDetailsAllOf.md)
 - [Params](docs/Model/Params.md)
 - [ParticipantsChangelog](docs/Model/ParticipantsChangelog.md)
 - [ParticipantsChangelogItem](docs/Model/ParticipantsChangelogItem.md)
 - [PaymentItem](docs/Model/PaymentItem.md)
 - [PaymentsResponse](docs/Model/PaymentsResponse.md)
 - [PaymentsResponseAllOf](docs/Model/PaymentsResponseAllOf.md)
 - [PermissionSets](docs/Model/PermissionSets.md)
 - [PermissionSetsAllOf](docs/Model/PermissionSetsAllOf.md)
 - [PermissionSetsItem](docs/Model/PermissionSetsItem.md)
 - [PersonCountAndEmailInfo](docs/Model/PersonCountAndEmailInfo.md)
 - [PersonCountEmailDealAndActivityInfo](docs/Model/PersonCountEmailDealAndActivityInfo.md)
 - [PersonCountInfo](docs/Model/PersonCountInfo.md)
 - [PersonData](docs/Model/PersonData.md)
 - [PersonDataEmail](docs/Model/PersonDataEmail.md)
 - [PersonDataPhone](docs/Model/PersonDataPhone.md)
 - [PersonDataWithActiveFlag](docs/Model/PersonDataWithActiveFlag.md)
 - [PersonDataWithActiveFlagAllOf](docs/Model/PersonDataWithActiveFlagAllOf.md)
 - [PersonFlowResponse](docs/Model/PersonFlowResponse.md)
 - [PersonFlowResponseAllOf](docs/Model/PersonFlowResponseAllOf.md)
 - [PersonFlowResponseAllOfData](docs/Model/PersonFlowResponseAllOfData.md)
 - [PersonItem](docs/Model/PersonItem.md)
 - [PersonListProduct](docs/Model/PersonListProduct.md)
 - [PersonNameCountAndEmailInfo](docs/Model/PersonNameCountAndEmailInfo.md)
 - [PersonNameCountAndEmailInfoWithIds](docs/Model/PersonNameCountAndEmailInfoWithIds.md)
 - [PersonNameCountAndEmailInfoWithIdsAllOf](docs/Model/PersonNameCountAndEmailInfoWithIdsAllOf.md)
 - [PersonNameInfo](docs/Model/PersonNameInfo.md)
 - [PersonNameInfoWithOrgAndOwnerId](docs/Model/PersonNameInfoWithOrgAndOwnerId.md)
 - [PersonSearchItem](docs/Model/PersonSearchItem.md)
 - [PersonSearchItemItem](docs/Model/PersonSearchItemItem.md)
 - [PersonSearchItemItemOrganization](docs/Model/PersonSearchItemItemOrganization.md)
 - [PersonSearchItemItemOwner](docs/Model/PersonSearchItemItemOwner.md)
 - [PersonSearchResponse](docs/Model/PersonSearchResponse.md)
 - [PersonSearchResponseAllOf](docs/Model/PersonSearchResponseAllOf.md)
 - [PersonSearchResponseAllOfData](docs/Model/PersonSearchResponseAllOfData.md)
 - [PersonsCollectionResponseObject](docs/Model/PersonsCollectionResponseObject.md)
 - [PictureData](docs/Model/PictureData.md)
 - [PictureDataPictures](docs/Model/PictureDataPictures.md)
 - [PictureDataWithID](docs/Model/PictureDataWithID.md)
 - [PictureDataWithIDAllOf](docs/Model/PictureDataWithIDAllOf.md)
 - [PictureDataWithValue](docs/Model/PictureDataWithValue.md)
 - [PictureDataWithValueAllOf](docs/Model/PictureDataWithValueAllOf.md)
 - [Pipeline](docs/Model/Pipeline.md)
 - [PipelineDetails](docs/Model/PipelineDetails.md)
 - [PipelineDetailsAllOf](docs/Model/PipelineDetailsAllOf.md)
 - [PostComment](docs/Model/PostComment.md)
 - [PostDealParticipants](docs/Model/PostDealParticipants.md)
 - [PostDealParticipantsRelatedObjects](docs/Model/PostDealParticipantsRelatedObjects.md)
 - [PostGoalResponse](docs/Model/PostGoalResponse.md)
 - [PostNote](docs/Model/PostNote.md)
 - [PostRoleAssignment](docs/Model/PostRoleAssignment.md)
 - [PostRoleAssignmentAllOf](docs/Model/PostRoleAssignmentAllOf.md)
 - [PostRoleAssignmentAllOfData](docs/Model/PostRoleAssignmentAllOfData.md)
 - [PostRoleSettings](docs/Model/PostRoleSettings.md)
 - [PostRoleSettingsAllOf](docs/Model/PostRoleSettingsAllOf.md)
 - [PostRoleSettingsAllOfData](docs/Model/PostRoleSettingsAllOfData.md)
 - [PostRoles](docs/Model/PostRoles.md)
 - [PostRolesAllOf](docs/Model/PostRolesAllOf.md)
 - [PostRolesAllOfData](docs/Model/PostRolesAllOfData.md)
 - [ProductAttachementFields](docs/Model/ProductAttachementFields.md)
 - [ProductAttachmentDetails](docs/Model/ProductAttachmentDetails.md)
 - [ProductBaseDeal](docs/Model/ProductBaseDeal.md)
 - [ProductField](docs/Model/ProductField.md)
 - [ProductFieldAllOf](docs/Model/ProductFieldAllOf.md)
 - [ProductFileItem](docs/Model/ProductFileItem.md)
 - [ProductListItem](docs/Model/ProductListItem.md)
 - [ProductRequest](docs/Model/ProductRequest.md)
 - [ProductResponse](docs/Model/ProductResponse.md)
 - [ProductSearchItem](docs/Model/ProductSearchItem.md)
 - [ProductSearchItemItem](docs/Model/ProductSearchItemItem.md)
 - [ProductSearchItemItemOwner](docs/Model/ProductSearchItemItemOwner.md)
 - [ProductSearchResponse](docs/Model/ProductSearchResponse.md)
 - [ProductSearchResponseAllOf](docs/Model/ProductSearchResponseAllOf.md)
 - [ProductSearchResponseAllOfData](docs/Model/ProductSearchResponseAllOfData.md)
 - [ProductWithArrayPrices](docs/Model/ProductWithArrayPrices.md)
 - [ProductsResponse](docs/Model/ProductsResponse.md)
 - [ProjectBoardObject](docs/Model/ProjectBoardObject.md)
 - [ProjectGroupsObject](docs/Model/ProjectGroupsObject.md)
 - [ProjectId](docs/Model/ProjectId.md)
 - [ProjectMandatoryObjectFragment](docs/Model/ProjectMandatoryObjectFragment.md)
 - [ProjectNotChangeableObjectFragment](docs/Model/ProjectNotChangeableObjectFragment.md)
 - [ProjectObjectFragment](docs/Model/ProjectObjectFragment.md)
 - [ProjectPhaseObject](docs/Model/ProjectPhaseObject.md)
 - [ProjectPlanItemObject](docs/Model/ProjectPlanItemObject.md)
 - [ProjectPostObject](docs/Model/ProjectPostObject.md)
 - [ProjectPostObjectAllOf](docs/Model/ProjectPostObjectAllOf.md)
 - [ProjectPutObject](docs/Model/ProjectPutObject.md)
 - [ProjectPutPlanItemBodyObject](docs/Model/ProjectPutPlanItemBodyObject.md)
 - [ProjectResponseObject](docs/Model/ProjectResponseObject.md)
 - [PutRole](docs/Model/PutRole.md)
 - [PutRoleAllOf](docs/Model/PutRoleAllOf.md)
 - [PutRoleAllOfData](docs/Model/PutRoleAllOfData.md)
 - [PutRolePipelinesBody](docs/Model/PutRolePipelinesBody.md)
 - [RecentDataProduct](docs/Model/RecentDataProduct.md)
 - [RecentsActivity](docs/Model/RecentsActivity.md)
 - [RecentsActivityType](docs/Model/RecentsActivityType.md)
 - [RecentsDeal](docs/Model/RecentsDeal.md)
 - [RecentsFile](docs/Model/RecentsFile.md)
 - [RecentsFilter](docs/Model/RecentsFilter.md)
 - [RecentsNote](docs/Model/RecentsNote.md)
 - [RecentsOrganization](docs/Model/RecentsOrganization.md)
 - [RecentsPerson](docs/Model/RecentsPerson.md)
 - [RecentsPipeline](docs/Model/RecentsPipeline.md)
 - [RecentsProduct](docs/Model/RecentsProduct.md)
 - [RecentsStage](docs/Model/RecentsStage.md)
 - [RecentsUser](docs/Model/RecentsUser.md)
 - [RelatedDealData](docs/Model/RelatedDealData.md)
 - [RelatedDealDataDEALID](docs/Model/RelatedDealDataDEALID.md)
 - [RelatedFollowerData](docs/Model/RelatedFollowerData.md)
 - [RelatedOrganizationData](docs/Model/RelatedOrganizationData.md)
 - [RelatedOrganizationDataWithActiveFlag](docs/Model/RelatedOrganizationDataWithActiveFlag.md)
 - [RelatedOrganizationName](docs/Model/RelatedOrganizationName.md)
 - [RelatedPersonData](docs/Model/RelatedPersonData.md)
 - [RelatedPersonDataWithActiveFlag](docs/Model/RelatedPersonDataWithActiveFlag.md)
 - [RelatedPictureData](docs/Model/RelatedPictureData.md)
 - [RelatedUserData](docs/Model/RelatedUserData.md)
 - [RelationshipOrganizationInfoItem](docs/Model/RelationshipOrganizationInfoItem.md)
 - [RelationshipOrganizationInfoItemAllOf](docs/Model/RelationshipOrganizationInfoItemAllOf.md)
 - [RelationshipOrganizationInfoItemWithActiveFlag](docs/Model/RelationshipOrganizationInfoItemWithActiveFlag.md)
 - [RequiredPostProjectParameters](docs/Model/RequiredPostProjectParameters.md)
 - [RequiredPostTaskParameters](docs/Model/RequiredPostTaskParameters.md)
 - [RequredTitleParameter](docs/Model/RequredTitleParameter.md)
 - [ResponseCallLogObject](docs/Model/ResponseCallLogObject.md)
 - [ResponseCallLogObjectAllOf](docs/Model/ResponseCallLogObjectAllOf.md)
 - [RoleAssignment](docs/Model/RoleAssignment.md)
 - [RoleAssignmentAllOf](docs/Model/RoleAssignmentAllOf.md)
 - [RoleSettings](docs/Model/RoleSettings.md)
 - [RolesAdditionalData](docs/Model/RolesAdditionalData.md)
 - [RolesAdditionalDataPagination](docs/Model/RolesAdditionalDataPagination.md)
 - [SinglePermissionSetsItem](docs/Model/SinglePermissionSetsItem.md)
 - [SinglePermissionSetsItemAllOf](docs/Model/SinglePermissionSetsItemAllOf.md)
 - [Stage](docs/Model/Stage.md)
 - [StageConversions](docs/Model/StageConversions.md)
 - [StageDetails](docs/Model/StageDetails.md)
 - [StageWithPipelineInfo](docs/Model/StageWithPipelineInfo.md)
 - [StageWithPipelineInfoAllOf](docs/Model/StageWithPipelineInfoAllOf.md)
 - [SubRole](docs/Model/SubRole.md)
 - [SubRoleAllOf](docs/Model/SubRoleAllOf.md)
 - [SubscriptionAddonsResponse](docs/Model/SubscriptionAddonsResponse.md)
 - [SubscriptionAddonsResponseAllOf](docs/Model/SubscriptionAddonsResponseAllOf.md)
 - [SubscriptionInstallmentCreateRequest](docs/Model/SubscriptionInstallmentCreateRequest.md)
 - [SubscriptionInstallmentUpdateRequest](docs/Model/SubscriptionInstallmentUpdateRequest.md)
 - [SubscriptionItem](docs/Model/SubscriptionItem.md)
 - [SubscriptionRecurringCancelRequest](docs/Model/SubscriptionRecurringCancelRequest.md)
 - [SubscriptionRecurringCreateRequest](docs/Model/SubscriptionRecurringCreateRequest.md)
 - [SubscriptionRecurringUpdateRequest](docs/Model/SubscriptionRecurringUpdateRequest.md)
 - [SubscriptionsIdResponse](docs/Model/SubscriptionsIdResponse.md)
 - [SubscriptionsIdResponseAllOf](docs/Model/SubscriptionsIdResponseAllOf.md)
 - [TaskId](docs/Model/TaskId.md)
 - [TaskMandatoryObjectFragment](docs/Model/TaskMandatoryObjectFragment.md)
 - [TaskNotChangeableObjectFragment](docs/Model/TaskNotChangeableObjectFragment.md)
 - [TaskObjectFragment](docs/Model/TaskObjectFragment.md)
 - [TaskPostObject](docs/Model/TaskPostObject.md)
 - [TaskPutObject](docs/Model/TaskPutObject.md)
 - [TaskResponseObject](docs/Model/TaskResponseObject.md)
 - [Team](docs/Model/Team.md)
 - [TeamAllOf](docs/Model/TeamAllOf.md)
 - [TeamId](docs/Model/TeamId.md)
 - [Teams](docs/Model/Teams.md)
 - [TeamsAllOf](docs/Model/TeamsAllOf.md)
 - [TemplateObject](docs/Model/TemplateObject.md)
 - [TemplateResponseObject](docs/Model/TemplateResponseObject.md)
 - [Unauthorized](docs/Model/Unauthorized.md)
 - [UpdateActivityPlanItemResponse](docs/Model/UpdateActivityPlanItemResponse.md)
 - [UpdateActivityResponse](docs/Model/UpdateActivityResponse.md)
 - [UpdateDealParameters](docs/Model/UpdateDealParameters.md)
 - [UpdateDealProduct](docs/Model/UpdateDealProduct.md)
 - [UpdateDealRequest](docs/Model/UpdateDealRequest.md)
 - [UpdateFile](docs/Model/UpdateFile.md)
 - [UpdateFilterRequest](docs/Model/UpdateFilterRequest.md)
 - [UpdateLeadLabelRequest](docs/Model/UpdateLeadLabelRequest.md)
 - [UpdateLeadRequest](docs/Model/UpdateLeadRequest.md)
 - [UpdateOrganization](docs/Model/UpdateOrganization.md)
 - [UpdateOrganizationAllOf](docs/Model/UpdateOrganizationAllOf.md)
 - [UpdatePerson](docs/Model/UpdatePerson.md)
 - [UpdatePersonAllOf](docs/Model/UpdatePersonAllOf.md)
 - [UpdatePersonResponse](docs/Model/UpdatePersonResponse.md)
 - [UpdateProductField](docs/Model/UpdateProductField.md)
 - [UpdateProductRequestBody](docs/Model/UpdateProductRequestBody.md)
 - [UpdateProductResponse](docs/Model/UpdateProductResponse.md)
 - [UpdateProjectResponse](docs/Model/UpdateProjectResponse.md)
 - [UpdateStageRequest](docs/Model/UpdateStageRequest.md)
 - [UpdateStageRequestAllOf](docs/Model/UpdateStageRequestAllOf.md)
 - [UpdateTaskPlanItemResponse](docs/Model/UpdateTaskPlanItemResponse.md)
 - [UpdateTaskResponse](docs/Model/UpdateTaskResponse.md)
 - [UpdateTeam](docs/Model/UpdateTeam.md)
 - [UpdateTeamAllOf](docs/Model/UpdateTeamAllOf.md)
 - [UpdateTeamWithAdditionalProperties](docs/Model/UpdateTeamWithAdditionalProperties.md)
 - [UpdateUserRequest](docs/Model/UpdateUserRequest.md)
 - [UpsertGoalResponse](docs/Model/UpsertGoalResponse.md)
 - [UpsertLeadLabelResponse](docs/Model/UpsertLeadLabelResponse.md)
 - [User](docs/Model/User.md)
 - [UserAccess](docs/Model/UserAccess.md)
 - [UserAllOf](docs/Model/UserAllOf.md)
 - [UserAssignmentToPermissionSet](docs/Model/UserAssignmentToPermissionSet.md)
 - [UserAssignmentsToPermissionSet](docs/Model/UserAssignmentsToPermissionSet.md)
 - [UserAssignmentsToPermissionSetAllOf](docs/Model/UserAssignmentsToPermissionSetAllOf.md)
 - [UserConnections](docs/Model/UserConnections.md)
 - [UserConnectionsAllOf](docs/Model/UserConnectionsAllOf.md)
 - [UserConnectionsAllOfData](docs/Model/UserConnectionsAllOfData.md)
 - [UserData](docs/Model/UserData.md)
 - [UserDataWithId](docs/Model/UserDataWithId.md)
 - [UserIDs](docs/Model/UserIDs.md)
 - [UserIDsAllOf](docs/Model/UserIDsAllOf.md)
 - [UserMe](docs/Model/UserMe.md)
 - [UserMeAllOf](docs/Model/UserMeAllOf.md)
 - [UserPermissions](docs/Model/UserPermissions.md)
 - [UserPermissionsAllOf](docs/Model/UserPermissionsAllOf.md)
 - [UserPermissionsItem](docs/Model/UserPermissionsItem.md)
 - [UserProviderLinkCreateRequest](docs/Model/UserProviderLinkCreateRequest.md)
 - [UserProviderLinkErrorResponse](docs/Model/UserProviderLinkErrorResponse.md)
 - [UserProviderLinkSuccessResponse](docs/Model/UserProviderLinkSuccessResponse.md)
 - [UserProviderLinkSuccessResponseData](docs/Model/UserProviderLinkSuccessResponseData.md)
 - [UserSettings](docs/Model/UserSettings.md)
 - [UserSettingsAllOf](docs/Model/UserSettingsAllOf.md)
 - [UserSettingsItem](docs/Model/UserSettingsItem.md)
 - [Users](docs/Model/Users.md)
 - [UsersAllOf](docs/Model/UsersAllOf.md)
 - [VisibleTo](docs/Model/VisibleTo.md)
 - [Webhook](docs/Model/Webhook.md)
 - [WebhookAllOf](docs/Model/WebhookAllOf.md)
 - [WebhookBadRequest](docs/Model/WebhookBadRequest.md)
 - [WebhookBadRequestAllOf](docs/Model/WebhookBadRequestAllOf.md)
 - [Webhooks](docs/Model/Webhooks.md)
 - [WebhooksAllOf](docs/Model/WebhooksAllOf.md)
 - [WebhooksDeleteForbiddenSchema](docs/Model/WebhooksDeleteForbiddenSchema.md)
 - [WebhooksDeleteForbiddenSchemaAllOf](docs/Model/WebhooksDeleteForbiddenSchemaAllOf.md)


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


## Author




## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `1.0.0`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
