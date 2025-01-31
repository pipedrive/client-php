# # NewDeal

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**title** | **string** | The title of the deal |
**value** | **string** | The value of the deal. If omitted, value will be set to 0. | [optional]
**label** | **int[]** | The array of the labels IDs. | [optional]
**currency** | **string** | The currency of the deal. Accepts a 3-character currency code. If omitted, currency will be set to the default currency of the authorized user. | [optional]
**user_id** | **int** | The ID of the user which will be the owner of the created deal. If not provided, the user making the request will be used. | [optional]
**person_id** | **int** | The ID of a person which this deal will be linked to. If the person does not exist yet, it needs to be created first. This property is required unless &#x60;org_id&#x60; is specified. | [optional]
**org_id** | **int** | The ID of an organization which this deal will be linked to. If the organization does not exist yet, it needs to be created first. This property is required unless &#x60;person_id&#x60; is specified. | [optional]
**pipeline_id** | **int** | The ID of the pipeline this deal will be added to. By default, the deal will be added to the first stage of the specified pipeline. Please note that &#x60;pipeline_id&#x60; and &#x60;stage_id&#x60; should not be used together as &#x60;pipeline_id&#x60; will be ignored. | [optional]
**stage_id** | **int** | The ID of the stage this deal will be added to. Please note that a pipeline will be assigned automatically based on the &#x60;stage_id&#x60;. If omitted, the deal will be placed in the first stage of the default pipeline. | [optional]
**status** | **string** | open &#x3D; Open, won &#x3D; Won, lost &#x3D; Lost, deleted &#x3D; Deleted. If omitted, status will be set to open. | [optional]
**origin_id** | **string** | The optional ID to further distinguish the origin of the deal - e.g. Which API integration created this deal. If omitted, &#x60;origin_id&#x60; will be set to null. | [optional]
**channel** | **int** | The ID of Marketing channel this deal was created from. Provided value must be one of the channels configured for your company. You can fetch allowed values with &lt;a href&#x3D;\&quot;https://developers.pipedrive.com/docs/api/v1/DealFields#getDealField\&quot; target&#x3D;\&quot;_blank\&quot; rel&#x3D;\&quot;noopener noreferrer\&quot;&gt;GET /v1/dealFields&lt;/a&gt;. If omitted, channel will be set to null. | [optional]
**channel_id** | **string** | The optional ID to further distinguish the Marketing channel. If omitted, &#x60;channel_id&#x60; will be set to null. | [optional]
**add_time** | **string** | The optional creation date &amp; time of the deal in UTC. Format: YYYY-MM-DD HH:MM:SS | [optional]
**won_time** | **string** | The optional date and time of changing the deal status as won in UTC. Format: YYYY-MM-DD HH:MM:SS. Can be set only when deal &#x60;status&#x60; is already Won. Can not be used together with &#x60;lost_time&#x60;. | [optional]
**lost_time** | **string** | The optional date and time of changing the deal status as lost in UTC. Format: YYYY-MM-DD HH:MM:SS. Can be set only when deal &#x60;status&#x60; is already Lost. Can not be used together with &#x60;won_time&#x60;. | [optional]
**close_time** | **string** | The optional date and time of closing the deal in UTC. Format: YYYY-MM-DD HH:MM:SS. | [optional]
**expected_close_date** | **\DateTime** | The expected close date of the deal. In ISO 8601 format: YYYY-MM-DD. | [optional]
**probability** | **float** | The success probability percentage of the deal. Used/shown only when &#x60;deal_probability&#x60; for the pipeline of the deal is enabled. | [optional]
**lost_reason** | **string** | The optional message about why the deal was lost (to be used when status &#x3D; lost) | [optional]
**visible_to** | [**VisibleTo**](VisibleTo.md) | The visibility of the deal. If omitted, the visibility will be set to the default visibility setting of this item type for the authorized user. Read more about visibility groups &lt;a href&#x3D;\&quot;https://support.pipedrive.com/en/article/visibility-groups\&quot; target&#x3D;\&quot;_blank\&quot; rel&#x3D;\&quot;noopener noreferrer\&quot;&gt;here&lt;/a&gt;.&lt;h4&gt;Essential / Advanced plan&lt;/h4&gt;&lt;table&gt;&lt;tr&gt;&lt;th style&#x3D;\&quot;width:40px\&quot;&gt;Value&lt;/th&gt;&lt;th&gt;Description&lt;/th&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;&#x60;1&#x60;&lt;/td&gt;&lt;td&gt;Owner &amp;amp; followers&lt;/td&gt;&lt;tr&gt;&lt;td&gt;&#x60;3&#x60;&lt;/td&gt;&lt;td&gt;Entire company&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;&lt;h4&gt;Professional / Enterprise plan&lt;/h4&gt;&lt;table&gt;&lt;tr&gt;&lt;th style&#x3D;\&quot;width:40px\&quot;&gt;Value&lt;/th&gt;&lt;th&gt;Description&lt;/th&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;&#x60;1&#x60;&lt;/td&gt;&lt;td&gt;Owner only&lt;/td&gt;&lt;tr&gt;&lt;td&gt;&#x60;3&#x60;&lt;/td&gt;&lt;td&gt;Owner&#39;s visibility group&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;&#x60;5&#x60;&lt;/td&gt;&lt;td&gt;Owner&#39;s visibility group and sub-groups&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;&#x60;7&#x60;&lt;/td&gt;&lt;td&gt;Entire company&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt; | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
