# # UpdateDealParameters

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**value** | **string** | The value of the deal. | [optional]
**currency** | **string** | The currency of the deal. Accepts a 3-character currency code. | [optional]
**user_id** | **int** | The ID of the user which will be the new owner of the deal. | [optional]
**person_id** | **int** | The ID of a person which this deal will be linked to. If the person does not exist yet, it needs to be created first. | [optional]
**org_id** | **int** | The ID of an organization which this deal will be linked to. If the organization does not exist yet, it needs to be created first. | [optional]
**pipeline_id** | **int** | The ID of the pipeline this deal will be added to. By default, the deal will be added to the first stage of the specified pipeline. Please note that &#x60;pipeline_id&#x60; and &#x60;stage_id&#x60; should not be used together as &#x60;pipeline_id&#x60; will be ignored. | [optional]
**stage_id** | **int** | The ID of the stage this deal will be added to. Please note that a pipeline will be assigned automatically based on the &#x60;stage_id&#x60;. | [optional]
**status** | **string** | open &#x3D; Open, won &#x3D; Won, lost &#x3D; Lost, deleted &#x3D; Deleted. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
