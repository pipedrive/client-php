# # TaskPostObject

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**title** | **string** | The title of the task |
**project_id** | **float** | The ID of a project |
**description** | **string** | The description of the task | [optional]
**parent_task_id** | **float** | The ID of a parent task. Can not be ID of a task which is already a subtask. | [optional]
**assignee_id** | **float** | The ID of the user who will be the assignee of the task | [optional]
**done** | [**NumberBoolean**](NumberBoolean.md) | Whether the task is done or not. 0 &#x3D; Not done, 1 &#x3D; Done. | [optional]
**due_date** | **\DateTime** | The due date of the task. Format: YYYY-MM-DD. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
