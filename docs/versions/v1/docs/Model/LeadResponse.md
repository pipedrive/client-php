# # LeadResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The unique ID of the lead in the UUID format |
**title** | **string** | The title of the lead |
**owner_id** | **int** | The ID of the user who owns the lead |
**creator_id** | **int** | The ID of the user who created the lead |
**label_ids** | **string[]** | The IDs of the lead labels which are associated with the lead |
**person_id** | **int** | The ID of a person which this lead is linked to |
**organization_id** | **int** | The ID of an organization which this lead is linked to |
**source_name** | **string** | Defines where the lead comes from. Will be &#x60;API&#x60; if the lead was created through the Public API and will be &#x60;Manually created&#x60; if the lead was created manually through the UI. |
**origin** | **string** | The way this Lead was created. &#x60;origin&#x60; field is set by Pipedrive when Lead is created and cannot be changed. |
**origin_id** | **string** | The optional ID to further distinguish the origin of the lead - e.g. Which API integration created this Lead. |
**channel** | **int** | The ID of your Marketing channel this Lead was created from. Recognized Marketing channels can be configured in your &lt;a href&#x3D;\&quot;https://app.pipedrive.com/settings/fields\&quot; target&#x3D;\&quot;_blank\&quot; rel&#x3D;\&quot;noopener noreferrer\&quot;&gt;Company settings&lt;/a&gt;. |
**channel_id** | **string** | The optional ID to further distinguish the Marketing channel. |
**is_archived** | **bool** | A flag indicating whether the lead is archived or not |
**was_seen** | **bool** | A flag indicating whether the lead was seen by someone in the Pipedrive UI |
**value** | [**\Pipedrive\versions\v1\Model\LeadValue**](LeadValue.md) |  |
**expected_close_date** | **\DateTime** | The date of when the deal which will be created from the lead is expected to be closed. In ISO 8601 format: YYYY-MM-DD. |
**next_activity_id** | **int** | The ID of the next activity associated with the lead |
**add_time** | **\DateTime** | The date and time of when the lead was created. In ISO 8601 format: YYYY-MM-DDTHH:MM:SSZ. |
**update_time** | **\DateTime** | The date and time of when the lead was last updated. In ISO 8601 format: YYYY-MM-DDTHH:MM:SSZ. |
**visible_to** | [**VisibleTo**](VisibleTo.md) | The visibility of the lead. If omitted, the visibility will be set to the default visibility setting of this item type for the authorized user.&lt;table&gt;&lt;tr&gt;&lt;th&gt;Value&lt;/th&gt;&lt;th&gt;Description&lt;/th&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;&#x60;1&#x60;&lt;/td&gt;&lt;td&gt;Owner &amp;amp; followers (private)&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;&#x60;3&#x60;&lt;/td&gt;&lt;td&gt;Entire company (shared)&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt; |
**cc_email** | **string** | The BCC email of the lead |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
