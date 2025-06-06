<?php
/**
 * AddLeadRequest
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
 * AddLeadRequest Class Doc Comment
 *
 * @category Class
 * @package  Pipedrive\versions\v1
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class AddLeadRequest implements ModelInterface, ArrayAccess, JsonSerializable
{
    use RawData;

    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'addLeadRequest';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string>
      * @phpsalm-var array<string, string>
      */
    protected static array $openAPITypes = [
        'title' => 'string',
        'owner_id' => 'int',
        'label_ids' => 'string[]',
        'person_id' => 'int',
        'organization_id' => 'int',
        'value' => '\Pipedrive\versions\v1\Model\LeadValue',
        'expected_close_date' => '\DateTime',
        'visible_to' => '\Pipedrive\versions\v1\Model\VisibleTo',
        'was_seen' => 'bool',
        'origin_id' => 'string',
        'channel' => 'int',
        'channel_id' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'title' => null,
        'owner_id' => null,
        'label_ids' => 'uuid',
        'person_id' => null,
        'organization_id' => null,
        'value' => null,
        'expected_close_date' => 'date',
        'visible_to' => null,
        'was_seen' => null,
        'origin_id' => null,
        'channel' => null,
        'channel_id' => null
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
        'title' => 'title',
        'owner_id' => 'owner_id',
        'label_ids' => 'label_ids',
        'person_id' => 'person_id',
        'organization_id' => 'organization_id',
        'value' => 'value',
        'expected_close_date' => 'expected_close_date',
        'visible_to' => 'visible_to',
        'was_seen' => 'was_seen',
        'origin_id' => 'origin_id',
        'channel' => 'channel',
        'channel_id' => 'channel_id'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'title' => 'setTitle',
        'owner_id' => 'setOwnerId',
        'label_ids' => 'setLabelIds',
        'person_id' => 'setPersonId',
        'organization_id' => 'setOrganizationId',
        'value' => 'setValue',
        'expected_close_date' => 'setExpectedCloseDate',
        'visible_to' => 'setVisibleTo',
        'was_seen' => 'setWasSeen',
        'origin_id' => 'setOriginId',
        'channel' => 'setChannel',
        'channel_id' => 'setChannelId'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'title' => 'getTitle',
        'owner_id' => 'getOwnerId',
        'label_ids' => 'getLabelIds',
        'person_id' => 'getPersonId',
        'organization_id' => 'getOrganizationId',
        'value' => 'getValue',
        'expected_close_date' => 'getExpectedCloseDate',
        'visible_to' => 'getVisibleTo',
        'was_seen' => 'getWasSeen',
        'origin_id' => 'getOriginId',
        'channel' => 'getChannel',
        'channel_id' => 'getChannelId'
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
        $this->container['title'] = $data['title'] ?? null;
        $this->container['owner_id'] = $data['owner_id'] ?? null;
        $this->container['label_ids'] = $data['label_ids'] ?? null;
        $this->container['person_id'] = $data['person_id'] ?? null;
        $this->container['organization_id'] = $data['organization_id'] ?? null;
        $this->container['value'] = $data['value'] ?? null;
        $this->container['expected_close_date'] = $data['expected_close_date'] ?? null;
        $this->container['visible_to'] = $data['visible_to'] ?? null;
        $this->container['was_seen'] = $data['was_seen'] ?? null;
        $this->container['origin_id'] = $data['origin_id'] ?? null;
        $this->container['channel'] = $data['channel'] ?? null;
        $this->container['channel_id'] = $data['channel_id'] ?? null;
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

        if ($this->container['title'] === null) {
            $invalidProperties[] = "'title' can't be null";
        }
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
     * Gets title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string $title The name of the lead
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
     * @param int|null $owner_id The ID of the user which will be the owner of the created lead. If not provided, the user making the request will be used.
     *
     * @return self
     */
    public function setOwnerId($owner_id): self
    {
        $this->container['owner_id'] = $owner_id;

        return $this;
    }

    /**
     * Gets label_ids
     *
     * @return string[]|null
     */
    public function getLabelIds()
    {
        return $this->container['label_ids'];
    }

    /**
     * Sets label_ids
     *
     * @param string[]|null $label_ids The IDs of the lead labels which will be associated with the lead
     *
     * @return self
     */
    public function setLabelIds($label_ids): self
    {
        $this->container['label_ids'] = $label_ids;

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
     * @param int|null $person_id The ID of a person which this lead will be linked to. If the person does not exist yet, it needs to be created first. This property is required unless `organization_id` is specified.
     *
     * @return self
     */
    public function setPersonId($person_id): self
    {
        $this->container['person_id'] = $person_id;

        return $this;
    }

    /**
     * Gets organization_id
     *
     * @return int|null
     */
    public function getOrganizationId()
    {
        return $this->container['organization_id'];
    }

    /**
     * Sets organization_id
     *
     * @param int|null $organization_id The ID of an organization which this lead will be linked to. If the organization does not exist yet, it needs to be created first. This property is required unless `person_id` is specified.
     *
     * @return self
     */
    public function setOrganizationId($organization_id): self
    {
        $this->container['organization_id'] = $organization_id;

        return $this;
    }

    /**
     * Gets value
     *
     * @return \Pipedrive\versions\v1\Model\LeadValue|null
     */
    public function getValue()
    {
        return $this->container['value'];
    }

    /**
     * Sets value
     *
     * @param \Pipedrive\versions\v1\Model\LeadValue|null $value value
     *
     * @return self
     */
    public function setValue($value): self
    {
        $this->container['value'] = $value;

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
     * @param \DateTime|null $expected_close_date The date of when the deal which will be created from the lead is expected to be closed. In ISO 8601 format: YYYY-MM-DD.
     *
     * @return self
     */
    public function setExpectedCloseDate($expected_close_date): self
    {
        $this->container['expected_close_date'] = $expected_close_date;

        return $this;
    }

    /**
     * Gets visible_to
     *
     * @return VisibleTo|null
     */
    public function getVisibleTo()
    {
        return $this->container['visible_to'];
    }

    /**
     * Sets visible_to
     *
     * @param VisibleTo|null $visible_to The visibility of the lead. If omitted, the visibility will be set to the default visibility setting of this item type for the authorized user. Read more about visibility groups <a href=\"https://support.pipedrive.com/en/article/visibility-groups\" target=\"_blank\" rel=\"noopener noreferrer\">here</a>.<h4>Essential / Advanced plan</h4><table><tr><th style=\"width: 40px\">Value</th><th>Description</th></tr><tr><td>`1`</td><td>Owner &amp; followers</td><tr><td>`3`</td><td>Entire company</td></tr></table><h4>Professional / Enterprise plan</h4><table><tr><th style=\"width: 40px\">Value</th><th>Description</th></tr><tr><td>`1`</td><td>Owner only</td><tr><td>`3`</td><td>Owner's visibility group</td></tr><tr><td>`5`</td><td>Owner's visibility group and sub-groups</td></tr><tr><td>`7`</td><td>Entire company</td></tr></table>
     *
     * @return self
     */
    public function setVisibleTo($visible_to): self
    {
        $this->container['visible_to'] = $visible_to;

        return $this;
    }

    /**
     * Gets was_seen
     *
     * @return bool|null
     */
    public function getWasSeen()
    {
        return $this->container['was_seen'];
    }

    /**
     * Sets was_seen
     *
     * @param bool|null $was_seen A flag indicating whether the lead was seen by someone in the Pipedrive UI
     *
     * @return self
     */
    public function setWasSeen($was_seen): self
    {
        $this->container['was_seen'] = $was_seen;

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
     * @param string|null $origin_id The optional ID to further distinguish the origin of the lead - e.g. Which API integration created this lead. If omitted, `origin_id` will be set to null.
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
     * @param int|null $channel The ID of Marketing channel this lead was created from. Provided value must be one of the channels configured for your company. You can fetch allowed values with <a href=\"https://developers.pipedrive.com/docs/api/v1/DealFields#getDealField\" target=\"_blank\" rel=\"noopener noreferrer\">GET /v1/dealFields</a>. If omitted, channel will be set to null.
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
     * @param string|null $channel_id The optional ID to further distinguish the Marketing channel. If omitted, `channel_id` will be set to null.
     *
     * @return self
     */
    public function setChannelId($channel_id): self
    {
        $this->container['channel_id'] = $channel_id;

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


