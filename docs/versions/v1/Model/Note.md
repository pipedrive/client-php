# # Note

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**content** | **string** | The content of the note in HTML format. Subject to sanitization on the back-end. | [optional]
**lead_id** | **string** | The ID of the lead the note will be attached to | [optional]
**deal_id** | **int** | The ID of the deal the note will be attached to | [optional]
**person_id** | **int** | The ID of the person the note will be attached to | [optional]
**org_id** | **int** | The ID of the organization the note will be attached to | [optional]
**project_id** | **int** | The ID of the project the note will be attached to | [optional]
**user_id** | **int** | The ID of the user who will be marked as the author of the note. Only an admin can change the author. | [optional]
**add_time** | **string** | The optional creation date &amp; time of the note in UTC. Can be set in the past or in the future. Format: YYYY-MM-DD HH:MM:SS | [optional]
**pinned_to_lead_flag** | [**NumberBoolean**](NumberBoolean.md) | If set, the results are filtered by note to lead pinning state (&#x60;lead_id&#x60; is also required) | [optional]
**pinned_to_deal_flag** | [**NumberBoolean**](NumberBoolean.md) | If set, the results are filtered by note to deal pinning state (&#x60;deal_id&#x60; is also required) | [optional]
**pinned_to_organization_flag** | [**NumberBoolean**](NumberBoolean.md) | If set, the results are filtered by note to organization pinning state (&#x60;org_id&#x60; is also required) | [optional]
**pinned_to_person_flag** | [**NumberBoolean**](NumberBoolean.md) | If set, the results are filtered by note to person pinning state (&#x60;person_id&#x60; is also required) | [optional]
**pinned_to_project_flag** | [**NumberBoolean**](NumberBoolean.md) | If set, the results are filtered by note to project pinning state (&#x60;project_id&#x60; is also required) | [optional]

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)
