# # ProjectResponseObject

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The ID of the project, generated when the task was created | [optional]
**title** | **string** | The title of the project | [optional]
**board_id** | **float** | The ID of the board this project is associated with | [optional]
**phase_id** | **float** | The ID of the phase this project is associated with | [optional]
**description** | **string** | The description of the project | [optional]
**status** | **string** | The status of the project | [optional]
**owner_id** | **float** | The ID of a project owner | [optional]
**start_date** | **\DateTime** | The start date of the project. Format: YYYY-MM-DD. | [optional]
**end_date** | **\DateTime** | The end date of the project. Format: YYYY-MM-DD. | [optional]
**deal_ids** | **int[]** | An array of IDs of the deals this project is associated with | [optional]
**org_id** | **float** | The ID of the organization this project is associated with | [optional]
**person_id** | **float** | The ID of the person this project is associated with | [optional]
**labels** | **int[]** | An array of IDs of the labels this project has | [optional]
**add_time** | **string** | The creation date and time of the project in UTC. Format: YYYY-MM-DD HH:MM:SS. | [optional]
**update_time** | **string** | The update date and time of the project in UTC. Format: YYYY-MM-DD HH:MM:SS. | [optional]
**status_change_time** | **string** | The status changed date and time of the project in UTC. Format: YYYY-MM-DD HH:MM:SS. | [optional]
**archive_time** | **string** | The archived date and time of the project in UTC. Format: YYYY-MM-DD HH:MM:SS. If not archived then &#39;null&#39;. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
