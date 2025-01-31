# # BaseUserMe

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The user ID | [optional]
**name** | **string** | The user name | [optional]
**default_currency** | **string** | The user default currency | [optional]
**locale** | **string** | The user locale | [optional]
**lang** | **int** | The user language ID | [optional]
**email** | **string** | The user email | [optional]
**phone** | **string** | The user phone | [optional]
**activated** | **bool** | Boolean that indicates whether the user is activated | [optional]
**last_login** | **string** | The last login date and time of the user. Format: YYYY-MM-DD HH:MM:SS | [optional]
**created** | **string** | The creation date and time of the user. Format: YYYY-MM-DD HH:MM:SS | [optional]
**modified** | **string** | The last modification date and time of the user. Format: YYYY-MM-DD HH:MM:SS | [optional]
**has_created_company** | **bool** | Boolean that indicates whether the user has created a company | [optional]
**access** | [**\Pipedrive\versions\v1\Model\UserAccess[]**](UserAccess.md) |  | [optional]
**active_flag** | **bool** | Boolean that indicates whether the user is activated | [optional]
**timezone_name** | **string** | The user timezone name | [optional]
**timezone_offset** | **string** | The user timezone offset | [optional]
**role_id** | **int** | The ID of the user role | [optional]
**icon_url** | **string** | The user icon URL | [optional]
**is_you** | **bool** | Boolean that indicates if the requested user is the same which is logged in (in this case, always true) | [optional]
**is_deleted** | **bool** | Boolean that indicates whether the user is deleted from the company | [optional]
**company_id** | **int** | The user company ID | [optional]
**company_name** | **string** | The user company name | [optional]
**company_domain** | **string** | The user company domain | [optional]
**company_country** | **string** | The user company country | [optional]
**company_industry** | **string** | The user company industry | [optional]
**language** | [**\Pipedrive\versions\v1\Model\BaseUserMeAllOfLanguage**](BaseUserMeAllOfLanguage.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
