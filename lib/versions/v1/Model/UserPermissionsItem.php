<?php
/**
 * UserPermissionsItem
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  Pipedrive\versions\v1
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Pipedrive API v1
 *
 * No description provided (generated by Openapi Generator https://github.com/openapitools/openapi-generator)
 *
 * The version of the OpenAPI document: 1.0.0
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.3.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Pipedrive\versions\v1\Model;

use ArrayAccess;
use JsonException;
use JsonSerializable;
use Pipedrive\versions\v1\Traits\RawData;
use Pipedrive\versions\v1\ObjectSerializer;

/**
 * UserPermissionsItem Class Doc Comment
 *
 * @category Class
 * @package  Pipedrive\versions\v1
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class UserPermissionsItem implements ModelInterface, ArrayAccess, JsonSerializable
{
    use RawData;

    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'UserPermissionsItem';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string>
      * @phpsalm-var array<string, string>
      */
    protected static array $openAPITypes = [
        'can_add_custom_fields' => 'bool',
        'can_add_products' => 'bool',
        'can_add_prospects_as_leads' => 'bool',
        'can_bulk_edit_items' => 'bool',
        'can_change_visibility_of_items' => 'bool',
        'can_convert_deals_to_leads' => 'bool',
        'can_create_own_workflow' => 'bool',
        'can_delete_activities' => 'bool',
        'can_delete_custom_fields' => 'bool',
        'can_delete_deals' => 'bool',
        'can_edit_custom_fields' => 'bool',
        'can_edit_deals_closed_date' => 'bool',
        'can_edit_products' => 'bool',
        'can_edit_shared_filters' => 'bool',
        'can_export_data_from_lists' => 'bool',
        'can_follow_other_users' => 'bool',
        'can_merge_deals' => 'bool',
        'can_merge_organizations' => 'bool',
        'can_merge_people' => 'bool',
        'can_modify_labels' => 'bool',
        'can_see_company_wide_statistics' => 'bool',
        'can_see_deals_list_summary' => 'bool',
        'can_see_hidden_items_names' => 'bool',
        'can_see_other_users' => 'bool',
        'can_see_other_users_statistics' => 'bool',
        'can_see_security_dashboard' => 'bool',
        'can_share_filters' => 'bool',
        'can_share_insights' => 'bool',
        'can_use_api' => 'bool',
        'can_use_email_tracking' => 'bool',
        'can_use_import' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'can_add_custom_fields' => null,
        'can_add_products' => null,
        'can_add_prospects_as_leads' => null,
        'can_bulk_edit_items' => null,
        'can_change_visibility_of_items' => null,
        'can_convert_deals_to_leads' => null,
        'can_create_own_workflow' => null,
        'can_delete_activities' => null,
        'can_delete_custom_fields' => null,
        'can_delete_deals' => null,
        'can_edit_custom_fields' => null,
        'can_edit_deals_closed_date' => null,
        'can_edit_products' => null,
        'can_edit_shared_filters' => null,
        'can_export_data_from_lists' => null,
        'can_follow_other_users' => null,
        'can_merge_deals' => null,
        'can_merge_organizations' => null,
        'can_merge_people' => null,
        'can_modify_labels' => null,
        'can_see_company_wide_statistics' => null,
        'can_see_deals_list_summary' => null,
        'can_see_hidden_items_names' => null,
        'can_see_other_users' => null,
        'can_see_other_users_statistics' => null,
        'can_see_security_dashboard' => null,
        'can_share_filters' => null,
        'can_share_insights' => null,
        'can_use_api' => null,
        'can_use_email_tracking' => null,
        'can_use_import' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @phpstan-return array<string, string>
     * @psalm-return array<string, string>
     * @return array
     */
    public static function openAPITypes(): array
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @phpstan-return array<string, string|null>
     * @psalm-return array<string, string|null>
     * @return array
     */
    public static function openAPIFormats(): array
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'can_add_custom_fields' => 'can_add_custom_fields',
        'can_add_products' => 'can_add_products',
        'can_add_prospects_as_leads' => 'can_add_prospects_as_leads',
        'can_bulk_edit_items' => 'can_bulk_edit_items',
        'can_change_visibility_of_items' => 'can_change_visibility_of_items',
        'can_convert_deals_to_leads' => 'can_convert_deals_to_leads',
        'can_create_own_workflow' => 'can_create_own_workflow',
        'can_delete_activities' => 'can_delete_activities',
        'can_delete_custom_fields' => 'can_delete_custom_fields',
        'can_delete_deals' => 'can_delete_deals',
        'can_edit_custom_fields' => 'can_edit_custom_fields',
        'can_edit_deals_closed_date' => 'can_edit_deals_closed_date',
        'can_edit_products' => 'can_edit_products',
        'can_edit_shared_filters' => 'can_edit_shared_filters',
        'can_export_data_from_lists' => 'can_export_data_from_lists',
        'can_follow_other_users' => 'can_follow_other_users',
        'can_merge_deals' => 'can_merge_deals',
        'can_merge_organizations' => 'can_merge_organizations',
        'can_merge_people' => 'can_merge_people',
        'can_modify_labels' => 'can_modify_labels',
        'can_see_company_wide_statistics' => 'can_see_company_wide_statistics',
        'can_see_deals_list_summary' => 'can_see_deals_list_summary',
        'can_see_hidden_items_names' => 'can_see_hidden_items_names',
        'can_see_other_users' => 'can_see_other_users',
        'can_see_other_users_statistics' => 'can_see_other_users_statistics',
        'can_see_security_dashboard' => 'can_see_security_dashboard',
        'can_share_filters' => 'can_share_filters',
        'can_share_insights' => 'can_share_insights',
        'can_use_api' => 'can_use_api',
        'can_use_email_tracking' => 'can_use_email_tracking',
        'can_use_import' => 'can_use_import'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'can_add_custom_fields' => 'setCanAddCustomFields',
        'can_add_products' => 'setCanAddProducts',
        'can_add_prospects_as_leads' => 'setCanAddProspectsAsLeads',
        'can_bulk_edit_items' => 'setCanBulkEditItems',
        'can_change_visibility_of_items' => 'setCanChangeVisibilityOfItems',
        'can_convert_deals_to_leads' => 'setCanConvertDealsToLeads',
        'can_create_own_workflow' => 'setCanCreateOwnWorkflow',
        'can_delete_activities' => 'setCanDeleteActivities',
        'can_delete_custom_fields' => 'setCanDeleteCustomFields',
        'can_delete_deals' => 'setCanDeleteDeals',
        'can_edit_custom_fields' => 'setCanEditCustomFields',
        'can_edit_deals_closed_date' => 'setCanEditDealsClosedDate',
        'can_edit_products' => 'setCanEditProducts',
        'can_edit_shared_filters' => 'setCanEditSharedFilters',
        'can_export_data_from_lists' => 'setCanExportDataFromLists',
        'can_follow_other_users' => 'setCanFollowOtherUsers',
        'can_merge_deals' => 'setCanMergeDeals',
        'can_merge_organizations' => 'setCanMergeOrganizations',
        'can_merge_people' => 'setCanMergePeople',
        'can_modify_labels' => 'setCanModifyLabels',
        'can_see_company_wide_statistics' => 'setCanSeeCompanyWideStatistics',
        'can_see_deals_list_summary' => 'setCanSeeDealsListSummary',
        'can_see_hidden_items_names' => 'setCanSeeHiddenItemsNames',
        'can_see_other_users' => 'setCanSeeOtherUsers',
        'can_see_other_users_statistics' => 'setCanSeeOtherUsersStatistics',
        'can_see_security_dashboard' => 'setCanSeeSecurityDashboard',
        'can_share_filters' => 'setCanShareFilters',
        'can_share_insights' => 'setCanShareInsights',
        'can_use_api' => 'setCanUseApi',
        'can_use_email_tracking' => 'setCanUseEmailTracking',
        'can_use_import' => 'setCanUseImport'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'can_add_custom_fields' => 'getCanAddCustomFields',
        'can_add_products' => 'getCanAddProducts',
        'can_add_prospects_as_leads' => 'getCanAddProspectsAsLeads',
        'can_bulk_edit_items' => 'getCanBulkEditItems',
        'can_change_visibility_of_items' => 'getCanChangeVisibilityOfItems',
        'can_convert_deals_to_leads' => 'getCanConvertDealsToLeads',
        'can_create_own_workflow' => 'getCanCreateOwnWorkflow',
        'can_delete_activities' => 'getCanDeleteActivities',
        'can_delete_custom_fields' => 'getCanDeleteCustomFields',
        'can_delete_deals' => 'getCanDeleteDeals',
        'can_edit_custom_fields' => 'getCanEditCustomFields',
        'can_edit_deals_closed_date' => 'getCanEditDealsClosedDate',
        'can_edit_products' => 'getCanEditProducts',
        'can_edit_shared_filters' => 'getCanEditSharedFilters',
        'can_export_data_from_lists' => 'getCanExportDataFromLists',
        'can_follow_other_users' => 'getCanFollowOtherUsers',
        'can_merge_deals' => 'getCanMergeDeals',
        'can_merge_organizations' => 'getCanMergeOrganizations',
        'can_merge_people' => 'getCanMergePeople',
        'can_modify_labels' => 'getCanModifyLabels',
        'can_see_company_wide_statistics' => 'getCanSeeCompanyWideStatistics',
        'can_see_deals_list_summary' => 'getCanSeeDealsListSummary',
        'can_see_hidden_items_names' => 'getCanSeeHiddenItemsNames',
        'can_see_other_users' => 'getCanSeeOtherUsers',
        'can_see_other_users_statistics' => 'getCanSeeOtherUsersStatistics',
        'can_see_security_dashboard' => 'getCanSeeSecurityDashboard',
        'can_share_filters' => 'getCanShareFilters',
        'can_share_insights' => 'getCanShareInsights',
        'can_use_api' => 'getCanUseApi',
        'can_use_email_tracking' => 'getCanUseEmailTracking',
        'can_use_import' => 'getCanUseImport'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @phpstan-return array<string, string>
     * @psalm-return array<string, string>
     * @return array
     */
    public static function attributeMap(): array
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @phpstan-return array<string, string>
     * @psalm-return array<string, string>
     * @return array
     */
    public static function setters(): array
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @phpstan-return array<string, string>
     * @psalm-return array<string, string>
     * @return array
     */
    public static function getters(): array
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName(): string
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var array
     * @phpstan-var array<int|string, mixed>
     * @psalm-var array<int|string, mixed>
     */
    protected array $container = [];

    /**
     * Constructor
     *
     * @phpstan-param array<string, mixed>|null $data
     * @psalm-param array<string, mixed>|null $data
     * @param array|null $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['can_add_custom_fields'] = $data['can_add_custom_fields'] ?? null;
        $this->container['can_add_products'] = $data['can_add_products'] ?? null;
        $this->container['can_add_prospects_as_leads'] = $data['can_add_prospects_as_leads'] ?? null;
        $this->container['can_bulk_edit_items'] = $data['can_bulk_edit_items'] ?? null;
        $this->container['can_change_visibility_of_items'] = $data['can_change_visibility_of_items'] ?? null;
        $this->container['can_convert_deals_to_leads'] = $data['can_convert_deals_to_leads'] ?? null;
        $this->container['can_create_own_workflow'] = $data['can_create_own_workflow'] ?? null;
        $this->container['can_delete_activities'] = $data['can_delete_activities'] ?? null;
        $this->container['can_delete_custom_fields'] = $data['can_delete_custom_fields'] ?? null;
        $this->container['can_delete_deals'] = $data['can_delete_deals'] ?? null;
        $this->container['can_edit_custom_fields'] = $data['can_edit_custom_fields'] ?? null;
        $this->container['can_edit_deals_closed_date'] = $data['can_edit_deals_closed_date'] ?? null;
        $this->container['can_edit_products'] = $data['can_edit_products'] ?? null;
        $this->container['can_edit_shared_filters'] = $data['can_edit_shared_filters'] ?? null;
        $this->container['can_export_data_from_lists'] = $data['can_export_data_from_lists'] ?? null;
        $this->container['can_follow_other_users'] = $data['can_follow_other_users'] ?? null;
        $this->container['can_merge_deals'] = $data['can_merge_deals'] ?? null;
        $this->container['can_merge_organizations'] = $data['can_merge_organizations'] ?? null;
        $this->container['can_merge_people'] = $data['can_merge_people'] ?? null;
        $this->container['can_modify_labels'] = $data['can_modify_labels'] ?? null;
        $this->container['can_see_company_wide_statistics'] = $data['can_see_company_wide_statistics'] ?? null;
        $this->container['can_see_deals_list_summary'] = $data['can_see_deals_list_summary'] ?? null;
        $this->container['can_see_hidden_items_names'] = $data['can_see_hidden_items_names'] ?? null;
        $this->container['can_see_other_users'] = $data['can_see_other_users'] ?? null;
        $this->container['can_see_other_users_statistics'] = $data['can_see_other_users_statistics'] ?? null;
        $this->container['can_see_security_dashboard'] = $data['can_see_security_dashboard'] ?? null;
        $this->container['can_share_filters'] = $data['can_share_filters'] ?? null;
        $this->container['can_share_insights'] = $data['can_share_insights'] ?? null;
        $this->container['can_use_api'] = $data['can_use_api'] ?? null;
        $this->container['can_use_email_tracking'] = $data['can_use_email_tracking'] ?? null;
        $this->container['can_use_import'] = $data['can_use_import'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     * @phpstan-return array<int, string>
     * @psalm-return array<int, string>
     */
    public function listInvalidProperties(): array
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid(): bool
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets can_add_custom_fields
     *
     * @return bool|null
     */
    public function getCanAddCustomFields()
    {
        return $this->container['can_add_custom_fields'];
    }

    /**
     * Sets can_add_custom_fields
     *
     * @param bool|null $can_add_custom_fields If the user can add custom fields
     *
     * @return self
     */
    public function setCanAddCustomFields($can_add_custom_fields): self
    {
        $this->container['can_add_custom_fields'] = $can_add_custom_fields;

        return $this;
    }

    /**
     * Gets can_add_products
     *
     * @return bool|null
     */
    public function getCanAddProducts()
    {
        return $this->container['can_add_products'];
    }

    /**
     * Sets can_add_products
     *
     * @param bool|null $can_add_products If the user can add products
     *
     * @return self
     */
    public function setCanAddProducts($can_add_products): self
    {
        $this->container['can_add_products'] = $can_add_products;

        return $this;
    }

    /**
     * Gets can_add_prospects_as_leads
     *
     * @return bool|null
     */
    public function getCanAddProspectsAsLeads()
    {
        return $this->container['can_add_prospects_as_leads'];
    }

    /**
     * Sets can_add_prospects_as_leads
     *
     * @param bool|null $can_add_prospects_as_leads If the user can add prospects as leads
     *
     * @return self
     */
    public function setCanAddProspectsAsLeads($can_add_prospects_as_leads): self
    {
        $this->container['can_add_prospects_as_leads'] = $can_add_prospects_as_leads;

        return $this;
    }

    /**
     * Gets can_bulk_edit_items
     *
     * @return bool|null
     */
    public function getCanBulkEditItems()
    {
        return $this->container['can_bulk_edit_items'];
    }

    /**
     * Sets can_bulk_edit_items
     *
     * @param bool|null $can_bulk_edit_items If the user can bulk edit items
     *
     * @return self
     */
    public function setCanBulkEditItems($can_bulk_edit_items): self
    {
        $this->container['can_bulk_edit_items'] = $can_bulk_edit_items;

        return $this;
    }

    /**
     * Gets can_change_visibility_of_items
     *
     * @return bool|null
     */
    public function getCanChangeVisibilityOfItems()
    {
        return $this->container['can_change_visibility_of_items'];
    }

    /**
     * Sets can_change_visibility_of_items
     *
     * @param bool|null $can_change_visibility_of_items If the user can change visibility of items
     *
     * @return self
     */
    public function setCanChangeVisibilityOfItems($can_change_visibility_of_items): self
    {
        $this->container['can_change_visibility_of_items'] = $can_change_visibility_of_items;

        return $this;
    }

    /**
     * Gets can_convert_deals_to_leads
     *
     * @return bool|null
     */
    public function getCanConvertDealsToLeads()
    {
        return $this->container['can_convert_deals_to_leads'];
    }

    /**
     * Sets can_convert_deals_to_leads
     *
     * @param bool|null $can_convert_deals_to_leads If the user can convert deals to leads
     *
     * @return self
     */
    public function setCanConvertDealsToLeads($can_convert_deals_to_leads): self
    {
        $this->container['can_convert_deals_to_leads'] = $can_convert_deals_to_leads;

        return $this;
    }

    /**
     * Gets can_create_own_workflow
     *
     * @return bool|null
     */
    public function getCanCreateOwnWorkflow()
    {
        return $this->container['can_create_own_workflow'];
    }

    /**
     * Sets can_create_own_workflow
     *
     * @param bool|null $can_create_own_workflow If the user can create workflows
     *
     * @return self
     */
    public function setCanCreateOwnWorkflow($can_create_own_workflow): self
    {
        $this->container['can_create_own_workflow'] = $can_create_own_workflow;

        return $this;
    }

    /**
     * Gets can_delete_activities
     *
     * @return bool|null
     */
    public function getCanDeleteActivities()
    {
        return $this->container['can_delete_activities'];
    }

    /**
     * Sets can_delete_activities
     *
     * @param bool|null $can_delete_activities If the user can delete activities
     *
     * @return self
     */
    public function setCanDeleteActivities($can_delete_activities): self
    {
        $this->container['can_delete_activities'] = $can_delete_activities;

        return $this;
    }

    /**
     * Gets can_delete_custom_fields
     *
     * @return bool|null
     */
    public function getCanDeleteCustomFields()
    {
        return $this->container['can_delete_custom_fields'];
    }

    /**
     * Sets can_delete_custom_fields
     *
     * @param bool|null $can_delete_custom_fields If the user can delete custom fields
     *
     * @return self
     */
    public function setCanDeleteCustomFields($can_delete_custom_fields): self
    {
        $this->container['can_delete_custom_fields'] = $can_delete_custom_fields;

        return $this;
    }

    /**
     * Gets can_delete_deals
     *
     * @return bool|null
     */
    public function getCanDeleteDeals()
    {
        return $this->container['can_delete_deals'];
    }

    /**
     * Sets can_delete_deals
     *
     * @param bool|null $can_delete_deals If the user can delete deals
     *
     * @return self
     */
    public function setCanDeleteDeals($can_delete_deals): self
    {
        $this->container['can_delete_deals'] = $can_delete_deals;

        return $this;
    }

    /**
     * Gets can_edit_custom_fields
     *
     * @return bool|null
     */
    public function getCanEditCustomFields()
    {
        return $this->container['can_edit_custom_fields'];
    }

    /**
     * Sets can_edit_custom_fields
     *
     * @param bool|null $can_edit_custom_fields If the user can edit custom fields
     *
     * @return self
     */
    public function setCanEditCustomFields($can_edit_custom_fields): self
    {
        $this->container['can_edit_custom_fields'] = $can_edit_custom_fields;

        return $this;
    }

    /**
     * Gets can_edit_deals_closed_date
     *
     * @return bool|null
     */
    public function getCanEditDealsClosedDate()
    {
        return $this->container['can_edit_deals_closed_date'];
    }

    /**
     * Sets can_edit_deals_closed_date
     *
     * @param bool|null $can_edit_deals_closed_date If the user can edit deals' closed date
     *
     * @return self
     */
    public function setCanEditDealsClosedDate($can_edit_deals_closed_date): self
    {
        $this->container['can_edit_deals_closed_date'] = $can_edit_deals_closed_date;

        return $this;
    }

    /**
     * Gets can_edit_products
     *
     * @return bool|null
     */
    public function getCanEditProducts()
    {
        return $this->container['can_edit_products'];
    }

    /**
     * Sets can_edit_products
     *
     * @param bool|null $can_edit_products If the user can edit products
     *
     * @return self
     */
    public function setCanEditProducts($can_edit_products): self
    {
        $this->container['can_edit_products'] = $can_edit_products;

        return $this;
    }

    /**
     * Gets can_edit_shared_filters
     *
     * @return bool|null
     */
    public function getCanEditSharedFilters()
    {
        return $this->container['can_edit_shared_filters'];
    }

    /**
     * Sets can_edit_shared_filters
     *
     * @param bool|null $can_edit_shared_filters If the user can edit shared filters
     *
     * @return self
     */
    public function setCanEditSharedFilters($can_edit_shared_filters): self
    {
        $this->container['can_edit_shared_filters'] = $can_edit_shared_filters;

        return $this;
    }

    /**
     * Gets can_export_data_from_lists
     *
     * @return bool|null
     */
    public function getCanExportDataFromLists()
    {
        return $this->container['can_export_data_from_lists'];
    }

    /**
     * Sets can_export_data_from_lists
     *
     * @param bool|null $can_export_data_from_lists If the user can export data from item lists
     *
     * @return self
     */
    public function setCanExportDataFromLists($can_export_data_from_lists): self
    {
        $this->container['can_export_data_from_lists'] = $can_export_data_from_lists;

        return $this;
    }

    /**
     * Gets can_follow_other_users
     *
     * @return bool|null
     */
    public function getCanFollowOtherUsers()
    {
        return $this->container['can_follow_other_users'];
    }

    /**
     * Sets can_follow_other_users
     *
     * @param bool|null $can_follow_other_users If the user can follow other users
     *
     * @return self
     */
    public function setCanFollowOtherUsers($can_follow_other_users): self
    {
        $this->container['can_follow_other_users'] = $can_follow_other_users;

        return $this;
    }

    /**
     * Gets can_merge_deals
     *
     * @return bool|null
     */
    public function getCanMergeDeals()
    {
        return $this->container['can_merge_deals'];
    }

    /**
     * Sets can_merge_deals
     *
     * @param bool|null $can_merge_deals If the user can merge deals
     *
     * @return self
     */
    public function setCanMergeDeals($can_merge_deals): self
    {
        $this->container['can_merge_deals'] = $can_merge_deals;

        return $this;
    }

    /**
     * Gets can_merge_organizations
     *
     * @return bool|null
     */
    public function getCanMergeOrganizations()
    {
        return $this->container['can_merge_organizations'];
    }

    /**
     * Sets can_merge_organizations
     *
     * @param bool|null $can_merge_organizations If the user can merge organizations
     *
     * @return self
     */
    public function setCanMergeOrganizations($can_merge_organizations): self
    {
        $this->container['can_merge_organizations'] = $can_merge_organizations;

        return $this;
    }

    /**
     * Gets can_merge_people
     *
     * @return bool|null
     */
    public function getCanMergePeople()
    {
        return $this->container['can_merge_people'];
    }

    /**
     * Sets can_merge_people
     *
     * @param bool|null $can_merge_people If the user can merge people
     *
     * @return self
     */
    public function setCanMergePeople($can_merge_people): self
    {
        $this->container['can_merge_people'] = $can_merge_people;

        return $this;
    }

    /**
     * Gets can_modify_labels
     *
     * @return bool|null
     */
    public function getCanModifyLabels()
    {
        return $this->container['can_modify_labels'];
    }

    /**
     * Sets can_modify_labels
     *
     * @param bool|null $can_modify_labels If the user can modify labels
     *
     * @return self
     */
    public function setCanModifyLabels($can_modify_labels): self
    {
        $this->container['can_modify_labels'] = $can_modify_labels;

        return $this;
    }

    /**
     * Gets can_see_company_wide_statistics
     *
     * @return bool|null
     */
    public function getCanSeeCompanyWideStatistics()
    {
        return $this->container['can_see_company_wide_statistics'];
    }

    /**
     * Sets can_see_company_wide_statistics
     *
     * @param bool|null $can_see_company_wide_statistics If the user can see company-wide statistics
     *
     * @return self
     */
    public function setCanSeeCompanyWideStatistics($can_see_company_wide_statistics): self
    {
        $this->container['can_see_company_wide_statistics'] = $can_see_company_wide_statistics;

        return $this;
    }

    /**
     * Gets can_see_deals_list_summary
     *
     * @return bool|null
     */
    public function getCanSeeDealsListSummary()
    {
        return $this->container['can_see_deals_list_summary'];
    }

    /**
     * Sets can_see_deals_list_summary
     *
     * @param bool|null $can_see_deals_list_summary If the user can see the summary on the deals page
     *
     * @return self
     */
    public function setCanSeeDealsListSummary($can_see_deals_list_summary): self
    {
        $this->container['can_see_deals_list_summary'] = $can_see_deals_list_summary;

        return $this;
    }

    /**
     * Gets can_see_hidden_items_names
     *
     * @return bool|null
     */
    public function getCanSeeHiddenItemsNames()
    {
        return $this->container['can_see_hidden_items_names'];
    }

    /**
     * Sets can_see_hidden_items_names
     *
     * @param bool|null $can_see_hidden_items_names If the user can see the names of hidden items
     *
     * @return self
     */
    public function setCanSeeHiddenItemsNames($can_see_hidden_items_names): self
    {
        $this->container['can_see_hidden_items_names'] = $can_see_hidden_items_names;

        return $this;
    }

    /**
     * Gets can_see_other_users
     *
     * @return bool|null
     */
    public function getCanSeeOtherUsers()
    {
        return $this->container['can_see_other_users'];
    }

    /**
     * Sets can_see_other_users
     *
     * @param bool|null $can_see_other_users If the user can see other users
     *
     * @return self
     */
    public function setCanSeeOtherUsers($can_see_other_users): self
    {
        $this->container['can_see_other_users'] = $can_see_other_users;

        return $this;
    }

    /**
     * Gets can_see_other_users_statistics
     *
     * @return bool|null
     */
    public function getCanSeeOtherUsersStatistics()
    {
        return $this->container['can_see_other_users_statistics'];
    }

    /**
     * Sets can_see_other_users_statistics
     *
     * @param bool|null $can_see_other_users_statistics If the user can see other users' statistics
     *
     * @return self
     */
    public function setCanSeeOtherUsersStatistics($can_see_other_users_statistics): self
    {
        $this->container['can_see_other_users_statistics'] = $can_see_other_users_statistics;

        return $this;
    }

    /**
     * Gets can_see_security_dashboard
     *
     * @return bool|null
     */
    public function getCanSeeSecurityDashboard()
    {
        return $this->container['can_see_security_dashboard'];
    }

    /**
     * Sets can_see_security_dashboard
     *
     * @param bool|null $can_see_security_dashboard If the user can see security dashboard
     *
     * @return self
     */
    public function setCanSeeSecurityDashboard($can_see_security_dashboard): self
    {
        $this->container['can_see_security_dashboard'] = $can_see_security_dashboard;

        return $this;
    }

    /**
     * Gets can_share_filters
     *
     * @return bool|null
     */
    public function getCanShareFilters()
    {
        return $this->container['can_share_filters'];
    }

    /**
     * Sets can_share_filters
     *
     * @param bool|null $can_share_filters If the user can share filters
     *
     * @return self
     */
    public function setCanShareFilters($can_share_filters): self
    {
        $this->container['can_share_filters'] = $can_share_filters;

        return $this;
    }

    /**
     * Gets can_share_insights
     *
     * @return bool|null
     */
    public function getCanShareInsights()
    {
        return $this->container['can_share_insights'];
    }

    /**
     * Sets can_share_insights
     *
     * @param bool|null $can_share_insights If the user can share insights
     *
     * @return self
     */
    public function setCanShareInsights($can_share_insights): self
    {
        $this->container['can_share_insights'] = $can_share_insights;

        return $this;
    }

    /**
     * Gets can_use_api
     *
     * @return bool|null
     */
    public function getCanUseApi()
    {
        return $this->container['can_use_api'];
    }

    /**
     * Sets can_use_api
     *
     * @param bool|null $can_use_api If the user can use API
     *
     * @return self
     */
    public function setCanUseApi($can_use_api): self
    {
        $this->container['can_use_api'] = $can_use_api;

        return $this;
    }

    /**
     * Gets can_use_email_tracking
     *
     * @return bool|null
     */
    public function getCanUseEmailTracking()
    {
        return $this->container['can_use_email_tracking'];
    }

    /**
     * Sets can_use_email_tracking
     *
     * @param bool|null $can_use_email_tracking If the user can use email tracking
     *
     * @return self
     */
    public function setCanUseEmailTracking($can_use_email_tracking): self
    {
        $this->container['can_use_email_tracking'] = $can_use_email_tracking;

        return $this;
    }

    /**
     * Gets can_use_import
     *
     * @return bool|null
     */
    public function getCanUseImport()
    {
        return $this->container['can_use_import'];
    }

    /**
     * Sets can_use_import
     *
     * @param bool|null $can_use_import If the user can use import
     *
     * @return self
     */
    public function setCanUseImport($can_use_import): self
    {
        $this->container['can_use_import'] = $can_use_import;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset): mixed
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    public function jsonSerialize(): mixed
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @throws JsonException
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @throws JsonException
     * @return string
     */
    public function toHeaderValue(): string
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this), JSON_THROW_ON_ERROR);
    }
}


