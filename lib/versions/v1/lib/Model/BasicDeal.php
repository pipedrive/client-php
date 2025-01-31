<?php
/**
 * BasicDeal
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
 * BasicDeal Class Doc Comment
 *
 * @category Class
 * @package  Pipedrive\versions\v1
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class BasicDeal implements ModelInterface, ArrayAccess, JsonSerializable
{
    use RawData;

    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'BasicDeal';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string>
      * @phpsalm-var array<string, string>
      */
    protected static array $openAPITypes = [
        'won_time' => 'string',
        'lost_time' => 'string',
        'close_time' => 'string',
        'expected_close_date' => '\DateTime',
        'probability' => 'float',
        'lost_reason' => 'string',
        'visible_to' => '\Pipedrive\versions\v1\Model\VisibleTo'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'won_time' => null,
        'lost_time' => null,
        'close_time' => null,
        'expected_close_date' => 'date',
        'probability' => null,
        'lost_reason' => null,
        'visible_to' => null
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
        'won_time' => 'won_time',
        'lost_time' => 'lost_time',
        'close_time' => 'close_time',
        'expected_close_date' => 'expected_close_date',
        'probability' => 'probability',
        'lost_reason' => 'lost_reason',
        'visible_to' => 'visible_to'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'won_time' => 'setWonTime',
        'lost_time' => 'setLostTime',
        'close_time' => 'setCloseTime',
        'expected_close_date' => 'setExpectedCloseDate',
        'probability' => 'setProbability',
        'lost_reason' => 'setLostReason',
        'visible_to' => 'setVisibleTo'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'won_time' => 'getWonTime',
        'lost_time' => 'getLostTime',
        'close_time' => 'getCloseTime',
        'expected_close_date' => 'getExpectedCloseDate',
        'probability' => 'getProbability',
        'lost_reason' => 'getLostReason',
        'visible_to' => 'getVisibleTo'
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
        $this->container['won_time'] = $data['won_time'] ?? null;
        $this->container['lost_time'] = $data['lost_time'] ?? null;
        $this->container['close_time'] = $data['close_time'] ?? null;
        $this->container['expected_close_date'] = $data['expected_close_date'] ?? null;
        $this->container['probability'] = $data['probability'] ?? null;
        $this->container['lost_reason'] = $data['lost_reason'] ?? null;
        $this->container['visible_to'] = $data['visible_to'] ?? null;
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
     * @param string|null $won_time The optional date and time of changing the deal status as won in UTC. Format: YYYY-MM-DD HH:MM:SS. Can be set only when deal `status` is already Won. Can not be used together with `lost_time`.
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
     * @param string|null $lost_time The optional date and time of changing the deal status as lost in UTC. Format: YYYY-MM-DD HH:MM:SS. Can be set only when deal `status` is already Lost. Can not be used together with `won_time`.
     *
     * @return self
     */
    public function setLostTime($lost_time): self
    {
        $this->container['lost_time'] = $lost_time;

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
     * @param string|null $close_time The optional date and time of closing the deal in UTC. Format: YYYY-MM-DD HH:MM:SS.
     *
     * @return self
     */
    public function setCloseTime($close_time): self
    {
        $this->container['close_time'] = $close_time;

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
     * @param \DateTime|null $expected_close_date The expected close date of the deal. In ISO 8601 format: YYYY-MM-DD.
     *
     * @return self
     */
    public function setExpectedCloseDate($expected_close_date): self
    {
        $this->container['expected_close_date'] = $expected_close_date;

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
     * @param float|null $probability The success probability percentage of the deal. Used/shown only when `deal_probability` for the pipeline of the deal is enabled.
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
     * @param string|null $lost_reason The optional message about why the deal was lost (to be used when status = lost)
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
     * @return VisibleTo|null
     */
    public function getVisibleTo()
    {
        return $this->container['visible_to'];
    }

    /**
     * Sets visible_to
     *
     * @param VisibleTo|null $visible_to The visibility of the deal. If omitted, the visibility will be set to the default visibility setting of this item type for the authorized user. Read more about visibility groups <a href=\"https://support.pipedrive.com/en/article/visibility-groups\" target=\"_blank\" rel=\"noopener noreferrer\">here</a>.<h4>Essential / Advanced plan</h4><table><tr><th style=\"width:40px\">Value</th><th>Description</th></tr><tr><td>`1`</td><td>Owner &amp; followers</td><tr><td>`3`</td><td>Entire company</td></tr></table><h4>Professional / Enterprise plan</h4><table><tr><th style=\"width:40px\">Value</th><th>Description</th></tr><tr><td>`1`</td><td>Owner only</td><tr><td>`3`</td><td>Owner's visibility group</td></tr><tr><td>`5`</td><td>Owner's visibility group and sub-groups</td></tr><tr><td>`7`</td><td>Entire company</td></tr></table>
     *
     * @return self
     */
    public function setVisibleTo($visible_to): self
    {
        $this->container['visible_to'] = $visible_to;

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


