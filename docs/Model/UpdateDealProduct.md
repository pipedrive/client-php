# # UpdateDealProduct

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**product_id** | **int** | The ID of the product to use | [optional]
**item_price** | **float** | The price at which this product will be added to the deal | [optional]
**quantity** | **int** | How many items of this product will be added to the deal | [optional]
**discount_percentage** | **float** | The discount %. If omitted, will be set to 0. | [optional] [default to 0]
**duration** | **float** | The duration of the product | [optional] [default to 1]
**duration_unit** | [**DealProductUnitDuration**](DealProductUnitDuration.md) | The unit duration of the product | [optional]
**product_variation_id** | **int** | The ID of the product variation to use. When omitted, no variation will be used. | [optional]
**comments** | **string** | A textual comment associated with this product-deal attachment | [optional]
**tax** | **float** | The tax percentage | [optional] [default to 0]
**enabled_flag** | **bool** | Whether the product is enabled for a deal or not. This makes it possible to add products to a deal with a specific price and discount criteria, but keep them disabled, which refrains them from being included in the deal value calculation. When omitted, the product will be marked as enabled by default. | [optional] [default to true]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
