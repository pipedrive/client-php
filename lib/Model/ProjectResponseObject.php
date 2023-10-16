<?php
/**
 * ProjectResponseObject
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  Pipedrive
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

namespace Pipedrive\Model;

use ArrayAccess;
use JsonException;
use JsonSerializable;
use Pipedrive\ObjectSerializer;

/**
 * ProjectResponseObject Class Doc Comment
 *
 * @category Class
 * @package  Pipedrive
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class ProjectResponseObject implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'ProjectResponseObject';

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
        'board_id' => 'float',
        'phase_id' => 'float',
        'description' => 'string',
        'status' => 'string',
        'owner_id' => 'float',
        'start_date' => '\DateTime',
        'end_date' => '\DateTime',
        'deal_ids' => 'int[]',
        'org_id' => 'float',
        'person_id' => 'float',
        'labels' => 'int[]',
        'add_time' => 'string',
        'update_time' => 'string',
        'status_change_time' => 'string',
        'archive_time' => 'string'
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
        'board_id' => null,
        'phase_id' => null,
        'description' => null,
        'status' => null,
        'owner_id' => null,
        'start_date' => 'date',
        'end_date' => 'date',
        'deal_ids' => null,
        'org_id' => null,
        'person_id' => null,
        'labels' => null,
        'add_time' => null,
        'update_time' => null,
        'status_change_time' => null,
        'archive_time' => null
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
        'board_id' => 'board_id',
        'phase_id' => 'phase_id',
        'description' => 'description',
        'status' => 'status',
        'owner_id' => 'owner_id',
        'start_date' => 'start_date',
        'end_date' => 'end_date',
        'deal_ids' => 'deal_ids',
        'org_id' => 'org_id',
        'person_id' => 'person_id',
        'labels' => 'labels',
        'add_time' => 'add_time',
        'update_time' => 'update_time',
        'status_change_time' => 'status_change_time',
        'archive_time' => 'archive_time'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'title' => 'setTitle',
        'board_id' => 'setBoardId',
        'phase_id' => 'setPhaseId',
        'description' => 'setDescription',
        'status' => 'setStatus',
        'owner_id' => 'setOwnerId',
        'start_date' => 'setStartDate',
        'end_date' => 'setEndDate',
        'deal_ids' => 'setDealIds',
        'org_id' => 'setOrgId',
        'person_id' => 'setPersonId',
        'labels' => 'setLabels',
        'add_time' => 'setAddTime',
        'update_time' => 'setUpdateTime',
        'status_change_time' => 'setStatusChangeTime',
        'archive_time' => 'setArchiveTime'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'title' => 'getTitle',
        'board_id' => 'getBoardId',
        'phase_id' => 'getPhaseId',
        'description' => 'getDescription',
        'status' => 'getStatus',
        'owner_id' => 'getOwnerId',
        'start_date' => 'getStartDate',
        'end_date' => 'getEndDate',
        'deal_ids' => 'getDealIds',
        'org_id' => 'getOrgId',
        'person_id' => 'getPersonId',
        'labels' => 'getLabels',
        'add_time' => 'getAddTime',
        'update_time' => 'getUpdateTime',
        'status_change_time' => 'getStatusChangeTime',
        'archive_time' => 'getArchiveTime'
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
        $this->container['board_id'] = $data['board_id'] ?? null;
        $this->container['phase_id'] = $data['phase_id'] ?? null;
        $this->container['description'] = $data['description'] ?? null;
        $this->container['status'] = $data['status'] ?? null;
        $this->container['owner_id'] = $data['owner_id'] ?? null;
        $this->container['start_date'] = $data['start_date'] ?? null;
        $this->container['end_date'] = $data['end_date'] ?? null;
        $this->container['deal_ids'] = $data['deal_ids'] ?? null;
        $this->container['org_id'] = $data['org_id'] ?? null;
        $this->container['person_id'] = $data['person_id'] ?? null;
        $this->container['labels'] = $data['labels'] ?? null;
        $this->container['add_time'] = $data['add_time'] ?? null;
        $this->container['update_time'] = $data['update_time'] ?? null;
        $this->container['status_change_time'] = $data['status_change_time'] ?? null;
        $this->container['archive_time'] = $data['archive_time'] ?? null;
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
     * @param int|null $id The ID of the project, generated when the task was created
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
     * @param string|null $title The title of the project
     *
     * @return self
     */
    public function setTitle($title): self
    {
        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets board_id
     *
     * @return float|null
     */
    public function getBoardId()
    {
        return $this->container['board_id'];
    }

    /**
     * Sets board_id
     *
     * @param float|null $board_id The ID of the board this project is associated with
     *
     * @return self
     */
    public function setBoardId($board_id): self
    {
        $this->container['board_id'] = $board_id;

        return $this;
    }

    /**
     * Gets phase_id
     *
     * @return float|null
     */
    public function getPhaseId()
    {
        return $this->container['phase_id'];
    }

    /**
     * Sets phase_id
     *
     * @param float|null $phase_id The ID of the phase this project is associated with
     *
     * @return self
     */
    public function setPhaseId($phase_id): self
    {
        $this->container['phase_id'] = $phase_id;

        return $this;
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
     * @param string|null $add_time The creation date and time of the project in UTC. Format: YYYY-MM-DD HH:MM:SS.
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
     * @param string|null $update_time The update date and time of the project in UTC. Format: YYYY-MM-DD HH:MM:SS.
     *
     * @return self
     */
    public function setUpdateTime($update_time): self
    {
        $this->container['update_time'] = $update_time;

        return $this;
    }

    /**
     * Gets status_change_time
     *
     * @return string|null
     */
    public function getStatusChangeTime()
    {
        return $this->container['status_change_time'];
    }

    /**
     * Sets status_change_time
     *
     * @param string|null $status_change_time The status changed date and time of the project in UTC. Format: YYYY-MM-DD HH:MM:SS.
     *
     * @return self
     */
    public function setStatusChangeTime($status_change_time): self
    {
        $this->container['status_change_time'] = $status_change_time;

        return $this;
    }

    /**
     * Gets archive_time
     *
     * @return string|null
     */
    public function getArchiveTime()
    {
        return $this->container['archive_time'];
    }

    /**
     * Sets archive_time
     *
     * @param string|null $archive_time The archived date and time of the project in UTC. Format: YYYY-MM-DD HH:MM:SS. If not archived then 'null'.
     *
     * @return self
     */
    public function setArchiveTime($archive_time): self
    {
        $this->container['archive_time'] = $archive_time;

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


