# # ProductListItem

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The ID of the deal-product (the ID of the product attached to the deal) | [optional]
**deal_id** | **int** | The ID of the deal | [optional]
**order_nr** | **int** | The order number of the product | [optional]
**product_id** | **int** | The ID of the product | [optional]
**product_variation_id** | **int** | The ID of the product variation | [optional]
**item_price** | **int** | The price value of the product | [optional]
**discount_percentage** | **int** | The discount percentage of the product | [optional]
**duration** | **int** | The duration of the product | [optional]
**duration_unit** | **string** | The type of the duration. (For example hourly, daily, etc.) | [optional]
**sum_no_discount** | **float** | The product sum without the discount | [optional]
**sum** | **float** | The sum of all the products attached to the deal | [optional]
**currency** | **string** | The currency associated with the deal product | [optional]
**enabled_flag** | **bool** | Whether the product is enabled or not | [optional]
**add_time** | **string** | The date and time when the product was added to the deal | [optional]
**last_edit** | **string** | The date and time when the deal product was last edited | [optional]
**comments** | **string** | The comments of the product | [optional]
**active_flag** | **bool** | Whether the product is active or not | [optional]
**tax** | **float** | The product tax | [optional]
**name** | **string** | The product name | [optional]
**sum_formatted** | **string** | The formatted sum of the product | [optional]
**quantity_formatted** | **string** | The formatted quantity of the product | [optional]
**quantity** | **int** | The quantity of the product | [optional]
**product** | [**\Pipedrive\Model\ProductWithObjectPrices**](ProductWithObjectPrices.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
