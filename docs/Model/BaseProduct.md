# # BaseProduct

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **float** | The ID of the product | [optional]
**name** | **string** | The name of the product | [optional]
**code** | **string** | The product code | [optional]
**unit** | **string** | The unit in which this product is sold | [optional]
**tax** | **float** | The ax percentage | [optional] [default to 0]
**active_flag** | **bool** | Whether this product is active or not | [optional] [default to true]
**selectable** | **bool** | Whether this product is selected in deals or not | [optional] [default to true]
**visible_to** | [**VisibleTo**](VisibleTo.md) | Visibility of the product | [optional]
**owner_id** | **object** | Information about the Pipedrive user who owns the product | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
