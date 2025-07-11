<?php
/**
 * DealItem
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  Pipedrive\versions\v2
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Pipedrive API v2
 *
 * No description provided (generated by Openapi Generator https://github.com/openapitools/openapi-generator)
 *
 * The version of the OpenAPI document: 2.0.0
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.3.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Pipedrive\versions\v2\Model;

use ArrayAccess;
use JsonException;
use JsonSerializable;
use Pipedrive\versions\v2\Traits\RawData;
use Pipedrive\versions\v2\ObjectSerializer;

/**
 * DealItem Class Doc Comment
 *
 * @category Class
 * @package  Pipedrive\versions\v2
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class DealItem implements ModelInterface, ArrayAccess, JsonSerializable
{
    use RawData;

    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'DealItem';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string>
      * @phpsalm-var array<string, string>
      */
    protected static array $openAPITypes = [
        'id' => 'int',
        'title' => 'string',
        'owner_id' => 'int',
        'person_id' => 'int',
        'org_id' => 'int',
        'pipeline_id' => 'int',
        'stage_id' => 'int',
        'value' => 'float',
        'currency' => 'string',
        'add_time' => 'string',
        'update_time' => 'string',
        'stage_change_time' => 'string',
        'is_deleted' => 'bool',
        'is_archived' => 'bool',
        'status' => 'string',
        'probability' => 'float',
        'lost_reason' => 'string',
        'visible_to' => 'int',
        'close_time' => 'string',
        'won_time' => 'string',
        'lost_time' => 'string',
        'expected_close_date' => '\DateTime',
        'label_ids' => 'int[]',
        'origin' => 'string',
        'origin_id' => 'string',
        'channel' => 'int',
        'channel_id' => 'string',
        'arr' => 'float',
        'mrr' => 'float',
        'acv' => 'float',
        'custom_fields' => 'array<string,OneOfStringNumberMap>'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'id' => null,
        'title' => null,
        'owner_id' => null,
        'person_id' => null,
        'org_id' => null,
        'pipeline_id' => null,
        'stage_id' => null,
        'value' => null,
        'currency' => null,
        'add_time' => null,
        'update_time' => null,
        'stage_change_time' => null,
        'is_deleted' => null,
        'is_archived' => null,
        'status' => null,
        'probability' => null,
        'lost_reason' => null,
        'visible_to' => null,
        'close_time' => null,
        'won_time' => null,
        'lost_time' => null,
        'expected_close_date' => 'date',
        'label_ids' => null,
        'origin' => null,
        'origin_id' => null,
        'channel' => null,
        'channel_id' => null,
        'arr' => null,
        'mrr' => null,
        'acv' => null,
        'custom_fields' => null
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
        'id' => 'id',
        'title' => 'title',
        'owner_id' => 'owner_id',
        'person_id' => 'person_id',
        'org_id' => 'org_id',
        'pipeline_id' => 'pipeline_id',
        'stage_id' => 'stage_id',
        'value' => 'value',
        'currency' => 'currency',
        'add_time' => 'add_time',
        'update_time' => 'update_time',
        'stage_change_time' => 'stage_change_time',
        'is_deleted' => 'is_deleted',
        'is_archived' => 'is_archived',
        'status' => 'status',
        'probability' => 'probability',
        'lost_reason' => 'lost_reason',
        'visible_to' => 'visible_to',
        'close_time' => 'close_time',
        'won_time' => 'won_time',
        'lost_time' => 'lost_time',
        'expected_close_date' => 'expected_close_date',
        'label_ids' => 'label_ids',
        'origin' => 'origin',
        'origin_id' => 'origin_id',
        'channel' => 'channel',
        'channel_id' => 'channel_id',
        'arr' => 'arr',
        'mrr' => 'mrr',
        'acv' => 'acv',
        'custom_fields' => 'custom_fields'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'title' => 'setTitle',
        'owner_id' => 'setOwnerId',
        'person_id' => 'setPersonId',
        'org_id' => 'setOrgId',
        'pipeline_id' => 'setPipelineId',
        'stage_id' => 'setStageId',
        'value' => 'setValue',
        'currency' => 'setCurrency',
        'add_time' => 'setAddTime',
        'update_time' => 'setUpdateTime',
        'stage_change_time' => 'setStageChangeTime',
        'is_deleted' => 'setIsDeleted',
        'is_archived' => 'setIsArchived',
        'status' => 'setStatus',
        'probability' => 'setProbability',
        'lost_reason' => 'setLostReason',
        'visible_to' => 'setVisibleTo',
        'close_time' => 'setCloseTime',
        'won_time' => 'setWonTime',
        'lost_time' => 'setLostTime',
        'expected_close_date' => 'setExpectedCloseDate',
        'label_ids' => 'setLabelIds',
        'origin' => 'setOrigin',
        'origin_id' => 'setOriginId',
        'channel' => 'setChannel',
        'channel_id' => 'setChannelId',
        'arr' => 'setArr',
        'mrr' => 'setMrr',
        'acv' => 'setAcv',
        'custom_fields' => 'setCustomFields'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'title' => 'getTitle',
        'owner_id' => 'getOwnerId',
        'person_id' => 'getPersonId',
        'org_id' => 'getOrgId',
        'pipeline_id' => 'getPipelineId',
        'stage_id' => 'getStageId',
        'value' => 'getValue',
        'currency' => 'getCurrency',
        'add_time' => 'getAddTime',
        'update_time' => 'getUpdateTime',
        'stage_change_time' => 'getStageChangeTime',
        'is_deleted' => 'getIsDeleted',
        'is_archived' => 'getIsArchived',
        'status' => 'getStatus',
        'probability' => 'getProbability',
        'lost_reason' => 'getLostReason',
        'visible_to' => 'getVisibleTo',
        'close_time' => 'getCloseTime',
        'won_time' => 'getWonTime',
        'lost_time' => 'getLostTime',
        'expected_close_date' => 'getExpectedCloseDate',
        'label_ids' => 'getLabelIds',
        'origin' => 'getOrigin',
        'origin_id' => 'getOriginId',
        'channel' => 'getChannel',
        'channel_id' => 'getChannelId',
        'arr' => 'getArr',
        'mrr' => 'getMrr',
        'acv' => 'getAcv',
        'custom_fields' => 'getCustomFields'
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
        $this->container['id'] = $data['id'] ?? null;
        $this->container['title'] = $data['title'] ?? null;
        $this->container['owner_id'] = $data['owner_id'] ?? null;
        $this->container['person_id'] = $data['person_id'] ?? null;
        $this->container['org_id'] = $data['org_id'] ?? null;
        $this->container['pipeline_id'] = $data['pipeline_id'] ?? null;
        $this->container['stage_id'] = $data['stage_id'] ?? null;
        $this->container['value'] = $data['value'] ?? null;
        $this->container['currency'] = $data['currency'] ?? null;
        $this->container['add_time'] = $data['add_time'] ?? null;
        $this->container['update_time'] = $data['update_time'] ?? null;
        $this->container['stage_change_time'] = $data['stage_change_time'] ?? null;
        $this->container['is_deleted'] = $data['is_deleted'] ?? null;
        $this->container['is_archived'] = $data['is_archived'] ?? null;
        $this->container['status'] = $data['status'] ?? null;
        $this->container['probability'] = $data['probability'] ?? null;
        $this->container['lost_reason'] = $data['lost_reason'] ?? null;
        $this->container['visible_to'] = $data['visible_to'] ?? null;
        $this->container['close_time'] = $data['close_time'] ?? null;
        $this->container['won_time'] = $data['won_time'] ?? null;
        $this->container['lost_time'] = $data['lost_time'] ?? null;
        $this->container['expected_close_date'] = $data['expected_close_date'] ?? null;
        $this->container['label_ids'] = $data['label_ids'] ?? null;
        $this->container['origin'] = $data['origin'] ?? null;
        $this->container['origin_id'] = $data['origin_id'] ?? null;
        $this->container['channel'] = $data['channel'] ?? null;
        $this->container['channel_id'] = $data['channel_id'] ?? null;
        $this->container['arr'] = $data['arr'] ?? null;
        $this->container['mrr'] = $data['mrr'] ?? null;
        $this->container['acv'] = $data['acv'] ?? null;
        $this->container['custom_fields'] = $data['custom_fields'] ?? null;
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
     * Gets id
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param int|null $id The ID of the deal
     *
     * @return self
     */
    public function setId($id): self
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string|null $title The title of the deal
     *
     * @return self
     */
    public function setTitle($title): self
    {
        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets owner_id
     *
     * @return int|null
     */
    public function getOwnerId()
    {
        return $this->container['owner_id'];
    }

    /**
     * Sets owner_id
     *
     * @param int|null $owner_id The ID of the user who owns the deal
     *
     * @return self
     */
    public function setOwnerId($owner_id): self
    {
        $this->container['owner_id'] = $owner_id;

        return $this;
    }

    /**
     * Gets person_id
     *
     * @return int|null
     */
    public function getPersonId()
    {
        return $this->container['person_id'];
    }

    /**
     * Sets person_id
     *
     * @param int|null $person_id The ID of the person linked to the deal
     *
     * @return self
     */
    public function setPersonId($person_id): self
    {
        $this->container['person_id'] = $person_id;

        return $this;
    }

    /**
     * Gets org_id
     *
     * @return int|null
     */
    public function getOrgId()
    {
        return $this->container['org_id'];
    }

    /**
     * Sets org_id
     *
     * @param int|null $org_id The ID of the organization linked to the deal
     *
     * @return self
     */
    public function setOrgId($org_id): self
    {
        $this->container['org_id'] = $org_id;

        return $this;
    }

    /**
     * Gets pipeline_id
     *
     * @return int|null
     */
    public function getPipelineId()
    {
        return $this->container['pipeline_id'];
    }

    /**
     * Sets pipeline_id
     *
     * @param int|null $pipeline_id The ID of the pipeline associated with the deal
     *
     * @return self
     */
    public function setPipelineId($pipeline_id): self
    {
        $this->container['pipeline_id'] = $pipeline_id;

        return $this;
    }

    /**
     * Gets stage_id
     *
     * @return int|null
     */
    public function getStageId()
    {
        return $this->container['stage_id'];
    }

    /**
     * Sets stage_id
     *
     * @param int|null $stage_id The ID of the deal stage
     *
     * @return self
     */
    public function setStageId($stage_id): self
    {
        $this->container['stage_id'] = $stage_id;

        return $this;
    }

    /**
     * Gets value
     *
     * @return float|null
     */
    public function getValue()
    {
        return $this->container['value'];
    }

    /**
     * Sets value
     *
     * @param float|null $value The value of the deal
     *
     * @return self
     */
    public function setValue($value): self
    {
        $this->container['value'] = $value;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return string|null
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param string|null $currency The currency associated with the deal
     *
     * @return self
     */
    public function setCurrency($currency): self
    {
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets add_time
     *
     * @return string|null
     */
    public function getAddTime()
    {
        return $this->container['add_time'];
    }

    /**
     * Sets add_time
     *
     * @param string|null $add_time The creation date and time of the deal
     *
     * @return self
     */
    public function setAddTime($add_time): self
    {
        $this->container['add_time'] = $add_time;

        return $this;
    }

    /**
     * Gets update_time
     *
     * @return string|null
     */
    public function getUpdateTime()
    {
        return $this->container['update_time'];
    }

    /**
     * Sets update_time
     *
     * @param string|null $update_time The last updated date and time of the deal
     *
     * @return self
     */
    public function setUpdateTime($update_time): self
    {
        $this->container['update_time'] = $update_time;

        return $this;
    }

    /**
     * Gets stage_change_time
     *
     * @return string|null
     */
    public function getStageChangeTime()
    {
        return $this->container['stage_change_time'];
    }

    /**
     * Sets stage_change_time
     *
     * @param string|null $stage_change_time The last updated date and time of the deal stage
     *
     * @return self
     */
    public function setStageChangeTime($stage_change_time): self
    {
        $this->container['stage_change_time'] = $stage_change_time;

        return $this;
    }

    /**
     * Gets is_deleted
     *
     * @return bool|null
     */
    public function getIsDeleted()
    {
        return $this->container['is_deleted'];
    }

    /**
     * Sets is_deleted
     *
     * @param bool|null $is_deleted Whether the deal is deleted or not
     *
     * @return self
     */
    public function setIsDeleted($is_deleted): self
    {
        $this->container['is_deleted'] = $is_deleted;

        return $this;
    }

    /**
     * Gets is_archived
     *
     * @return bool|null
     */
    public function getIsArchived()
    {
        return $this->container['is_archived'];
    }

    /**
     * Sets is_archived
     *
     * @param bool|null $is_archived Whether the deal is archived or not
     *
     * @return self
     */
    public function setIsArchived($is_archived): self
    {
        $this->container['is_archived'] = $is_archived;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string|null $status The status of the deal
     *
     * @return self
     */
    public function setStatus($status): self
    {
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets probability
     *
     * @return float|null
     */
    public function getProbability()
    {
        return $this->container['probability'];
    }

    /**
     * Sets probability
     *
     * @param float|null $probability The success probability percentage of the deal
     *
     * @return self
     */
    public function setProbability($probability): self
    {
        $this->container['probability'] = $probability;

        return $this;
    }

    /**
     * Gets lost_reason
     *
     * @return string|null
     */
    public function getLostReason()
    {
        return $this->container['lost_reason'];
    }

    /**
     * Sets lost_reason
     *
     * @param string|null $lost_reason The reason for losing the deal
     *
     * @return self
     */
    public function setLostReason($lost_reason): self
    {
        $this->container['lost_reason'] = $lost_reason;

        return $this;
    }

    /**
     * Gets visible_to
     *
     * @return int|null
     */
    public function getVisibleTo()
    {
        return $this->container['visible_to'];
    }

    /**
     * Sets visible_to
     *
     * @param int|null $visible_to The visibility of the deal
     *
     * @return self
     */
    public function setVisibleTo($visible_to): self
    {
        $this->container['visible_to'] = $visible_to;

        return $this;
    }

    /**
     * Gets close_time
     *
     * @return string|null
     */
    public function getCloseTime()
    {
        return $this->container['close_time'];
    }

    /**
     * Sets close_time
     *
     * @param string|null $close_time The date and time of closing the deal
     *
     * @return self
     */
    public function setCloseTime($close_time): self
    {
        $this->container['close_time'] = $close_time;

        return $this;
    }

    /**
     * Gets won_time
     *
     * @return string|null
     */
    public function getWonTime()
    {
        return $this->container['won_time'];
    }

    /**
     * Sets won_time
     *
     * @param string|null $won_time The date and time of changing the deal status as won
     *
     * @return self
     */
    public function setWonTime($won_time): self
    {
        $this->container['won_time'] = $won_time;

        return $this;
    }

    /**
     * Gets lost_time
     *
     * @return string|null
     */
    public function getLostTime()
    {
        return $this->container['lost_time'];
    }

    /**
     * Sets lost_time
     *
     * @param string|null $lost_time The date and time of changing the deal status as lost
     *
     * @return self
     */
    public function setLostTime($lost_time): self
    {
        $this->container['lost_time'] = $lost_time;

        return $this;
    }

    /**
     * Gets expected_close_date
     *
     * @return \DateTime|null
     */
    public function getExpectedCloseDate()
    {
        return $this->container['expected_close_date'];
    }

    /**
     * Sets expected_close_date
     *
     * @param \DateTime|null $expected_close_date The expected close date of the deal
     *
     * @return self
     */
    public function setExpectedCloseDate($expected_close_date): self
    {
        $this->container['expected_close_date'] = $expected_close_date;

        return $this;
    }

    /**
     * Gets label_ids
     *
     * @return int[]|null
     */
    public function getLabelIds()
    {
        return $this->container['label_ids'];
    }

    /**
     * Sets label_ids
     *
     * @param int[]|null $label_ids The IDs of labels assigned to the deal
     *
     * @return self
     */
    public function setLabelIds($label_ids): self
    {
        $this->container['label_ids'] = $label_ids;

        return $this;
    }

    /**
     * Gets origin
     *
     * @return string|null
     */
    public function getOrigin()
    {
        return $this->container['origin'];
    }

    /**
     * Sets origin
     *
     * @param string|null $origin The way this Deal was created. `origin` field is set by Pipedrive when Deal is created and cannot be changed.
     *
     * @return self
     */
    public function setOrigin($origin): self
    {
        $this->container['origin'] = $origin;

        return $this;
    }

    /**
     * Gets origin_id
     *
     * @return string|null
     */
    public function getOriginId()
    {
        return $this->container['origin_id'];
    }

    /**
     * Sets origin_id
     *
     * @param string|null $origin_id The optional ID to further distinguish the origin of the deal - e.g. Which API integration created this Deal.
     *
     * @return self
     */
    public function setOriginId($origin_id): self
    {
        $this->container['origin_id'] = $origin_id;

        return $this;
    }

    /**
     * Gets channel
     *
     * @return int|null
     */
    public function getChannel()
    {
        return $this->container['channel'];
    }

    /**
     * Sets channel
     *
     * @param int|null $channel The ID of your Marketing channel this Deal was created from. Recognized Marketing channels can be configured in your <a href=\"https://app.pipedrive.com/settings/fields\" target=\"_blank\" rel=\"noopener noreferrer\">Company settings</a>.
     *
     * @return self
     */
    public function setChannel($channel): self
    {
        $this->container['channel'] = $channel;

        return $this;
    }

    /**
     * Gets channel_id
     *
     * @return string|null
     */
    public function getChannelId()
    {
        return $this->container['channel_id'];
    }

    /**
     * Sets channel_id
     *
     * @param string|null $channel_id The optional ID to further distinguish the Marketing channel.
     *
     * @return self
     */
    public function setChannelId($channel_id): self
    {
        $this->container['channel_id'] = $channel_id;

        return $this;
    }

    /**
     * Gets arr
     *
     * @return float|null
     */
    public function getArr()
    {
        return $this->container['arr'];
    }

    /**
     * Sets arr
     *
     * @param float|null $arr Only available in Advanced and above plans  The Annual Recurring Revenue of the deal  Null if there are no products attached to the deal
     *
     * @return self
     */
    public function setArr($arr): self
    {
        $this->container['arr'] = $arr;

        return $this;
    }

    /**
     * Gets mrr
     *
     * @return float|null
     */
    public function getMrr()
    {
        return $this->container['mrr'];
    }

    /**
     * Sets mrr
     *
     * @param float|null $mrr Only available in Advanced and above plans  The Monthly Recurring Revenue of the deal  Null if there are no products attached to the deal
     *
     * @return self
     */
    public function setMrr($mrr): self
    {
        $this->container['mrr'] = $mrr;

        return $this;
    }

    /**
     * Gets acv
     *
     * @return float|null
     */
    public function getAcv()
    {
        return $this->container['acv'];
    }

    /**
     * Sets acv
     *
     * @param float|null $acv Only available in Advanced and above plans  The Annual Contract Value of the deal  Null if there are no products attached to the deal
     *
     * @return self
     */
    public function setAcv($acv): self
    {
        $this->container['acv'] = $acv;

        return $this;
    }

    /**
     * Gets custom_fields
     *
     * @return array<string,OneOfStringNumberMap>|null
     */
    public function getCustomFields()
    {
        return $this->container['custom_fields'];
    }

    /**
     * Sets custom_fields
     *
     * @param array<string,OneOfStringNumberMap>|null $custom_fields A map of custom fields with hash-based keys
     *
     * @return self
     */
    public function setCustomFields($custom_fields): self
    {
        $this->container['custom_fields'] = $custom_fields;

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


