<?php
/**
 * ProjectObjectFragment
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
 * ProjectObjectFragment Class Doc Comment
 *
 * @category Class
 * @package  Pipedrive\versions\v1
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class ProjectObjectFragment implements ModelInterface, ArrayAccess, JsonSerializable
{
    use RawData;

    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'ProjectObjectFragment';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string>
      * @phpsalm-var array<string, string>
      */
    protected static array $openAPITypes = [
        'description' => 'string',
        'status' => 'string',
        'owner_id' => 'float',
        'start_date' => '\DateTime',
        'end_date' => '\DateTime',
        'deal_ids' => 'int[]',
        'org_id' => 'float',
        'person_id' => 'float',
        'labels' => 'int[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'description' => null,
        'status' => null,
        'owner_id' => null,
        'start_date' => 'date',
        'end_date' => 'date',
        'deal_ids' => null,
        'org_id' => null,
        'person_id' => null,
        'labels' => null
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
        'description' => 'description',
        'status' => 'status',
        'owner_id' => 'owner_id',
        'start_date' => 'start_date',
        'end_date' => 'end_date',
        'deal_ids' => 'deal_ids',
        'org_id' => 'org_id',
        'person_id' => 'person_id',
        'labels' => 'labels'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'description' => 'setDescription',
        'status' => 'setStatus',
        'owner_id' => 'setOwnerId',
        'start_date' => 'setStartDate',
        'end_date' => 'setEndDate',
        'deal_ids' => 'setDealIds',
        'org_id' => 'setOrgId',
        'person_id' => 'setPersonId',
        'labels' => 'setLabels'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'description' => 'getDescription',
        'status' => 'getStatus',
        'owner_id' => 'getOwnerId',
        'start_date' => 'getStartDate',
        'end_date' => 'getEndDate',
        'deal_ids' => 'getDealIds',
        'org_id' => 'getOrgId',
        'person_id' => 'getPersonId',
        'labels' => 'getLabels'
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
        $this->container['description'] = $data['description'] ?? null;
        $this->container['status'] = $data['status'] ?? null;
        $this->container['owner_id'] = $data['owner_id'] ?? null;
        $this->container['start_date'] = $data['start_date'] ?? null;
        $this->container['end_date'] = $data['end_date'] ?? null;
        $this->container['deal_ids'] = $data['deal_ids'] ?? null;
        $this->container['org_id'] = $data['org_id'] ?? null;
        $this->container['person_id'] = $data['person_id'] ?? null;
        $this->container['labels'] = $data['labels'] ?? null;
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
     * Gets description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description The description of the project
     *
     * @return self
     */
    public function setDescription($description): self
    {
        $this->container['description'] = $description;

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
     * @param string|null $status The status of the project
     *
     * @return self
     */
    public function setStatus($status): self
    {
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets owner_id
     *
     * @return float|null
     */
    public function getOwnerId()
    {
        return $this->container['owner_id'];
    }

    /**
     * Sets owner_id
     *
     * @param float|null $owner_id The ID of a project owner
     *
     * @return self
     */
    public function setOwnerId($owner_id): self
    {
        $this->container['owner_id'] = $owner_id;

        return $this;
    }

    /**
     * Gets start_date
     *
     * @return \DateTime|null
     */
    public function getStartDate()
    {
        return $this->container['start_date'];
    }

    /**
     * Sets start_date
     *
     * @param \DateTime|null $start_date The start date of the project. Format: YYYY-MM-DD.
     *
     * @return self
     */
    public function setStartDate($start_date): self
    {
        $this->container['start_date'] = $start_date;

        return $this;
    }

    /**
     * Gets end_date
     *
     * @return \DateTime|null
     */
    public function getEndDate()
    {
        return $this->container['end_date'];
    }

    /**
     * Sets end_date
     *
     * @param \DateTime|null $end_date The end date of the project. Format: YYYY-MM-DD.
     *
     * @return self
     */
    public function setEndDate($end_date): self
    {
        $this->container['end_date'] = $end_date;

        return $this;
    }

    /**
     * Gets deal_ids
     *
     * @return int[]|null
     */
    public function getDealIds()
    {
        return $this->container['deal_ids'];
    }

    /**
     * Sets deal_ids
     *
     * @param int[]|null $deal_ids An array of IDs of the deals this project is associated with
     *
     * @return self
     */
    public function setDealIds($deal_ids): self
    {
        $this->container['deal_ids'] = $deal_ids;

        return $this;
    }

    /**
     * Gets org_id
     *
     * @return float|null
     */
    public function getOrgId()
    {
        return $this->container['org_id'];
    }

    /**
     * Sets org_id
     *
     * @param float|null $org_id The ID of the organization this project is associated with
     *
     * @return self
     */
    public function setOrgId($org_id): self
    {
        $this->container['org_id'] = $org_id;

        return $this;
    }

    /**
     * Gets person_id
     *
     * @return float|null
     */
    public function getPersonId()
    {
        return $this->container['person_id'];
    }

    /**
     * Sets person_id
     *
     * @param float|null $person_id The ID of the person this project is associated with
     *
     * @return self
     */
    public function setPersonId($person_id): self
    {
        $this->container['person_id'] = $person_id;

        return $this;
    }

    /**
     * Gets labels
     *
     * @return int[]|null
     */
    public function getLabels()
    {
        return $this->container['labels'];
    }

    /**
     * Sets labels
     *
     * @param int[]|null $labels An array of IDs of the labels this project has
     *
     * @return self
     */
    public function setLabels($labels): self
    {
        $this->container['labels'] = $labels;

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


