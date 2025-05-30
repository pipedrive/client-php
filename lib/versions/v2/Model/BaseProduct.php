<?php
/**
 * BaseProduct
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
 * BaseProduct Class Doc Comment
 *
 * @category Class
 * @package  Pipedrive\versions\v2
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class BaseProduct implements ModelInterface, ArrayAccess, JsonSerializable
{
    use RawData;

    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'BaseProduct';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string>
      * @phpsalm-var array<string, string>
      */
    protected static array $openAPITypes = [
        'id' => 'float',
        'name' => 'string',
        'code' => 'string',
        'unit' => 'string',
        'tax' => 'float',
        'is_deleted' => 'bool',
        'is_linkable' => 'bool',
        'visible_to' => '\Pipedrive\versions\v2\Model\VisibleTo',
        'owner_id' => 'int',
        'custom_fields' => 'array<string,object>',
        'billing_frequency' => '\Pipedrive\versions\v2\Model\BillingFrequency1',
        'billing_frequency_cycles' => 'int'
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
        'name' => null,
        'code' => null,
        'unit' => null,
        'tax' => null,
        'is_deleted' => null,
        'is_linkable' => null,
        'visible_to' => null,
        'owner_id' => null,
        'custom_fields' => null,
        'billing_frequency' => null,
        'billing_frequency_cycles' => null
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
        'name' => 'name',
        'code' => 'code',
        'unit' => 'unit',
        'tax' => 'tax',
        'is_deleted' => 'is_deleted',
        'is_linkable' => 'is_linkable',
        'visible_to' => 'visible_to',
        'owner_id' => 'owner_id',
        'custom_fields' => 'custom_fields',
        'billing_frequency' => 'billing_frequency',
        'billing_frequency_cycles' => 'billing_frequency_cycles'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'name' => 'setName',
        'code' => 'setCode',
        'unit' => 'setUnit',
        'tax' => 'setTax',
        'is_deleted' => 'setIsDeleted',
        'is_linkable' => 'setIsLinkable',
        'visible_to' => 'setVisibleTo',
        'owner_id' => 'setOwnerId',
        'custom_fields' => 'setCustomFields',
        'billing_frequency' => 'setBillingFrequency',
        'billing_frequency_cycles' => 'setBillingFrequencyCycles'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'name' => 'getName',
        'code' => 'getCode',
        'unit' => 'getUnit',
        'tax' => 'getTax',
        'is_deleted' => 'getIsDeleted',
        'is_linkable' => 'getIsLinkable',
        'visible_to' => 'getVisibleTo',
        'owner_id' => 'getOwnerId',
        'custom_fields' => 'getCustomFields',
        'billing_frequency' => 'getBillingFrequency',
        'billing_frequency_cycles' => 'getBillingFrequencyCycles'
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
        $this->container['name'] = $data['name'] ?? null;
        $this->container['code'] = $data['code'] ?? null;
        $this->container['unit'] = $data['unit'] ?? null;
        $this->container['tax'] = $data['tax'] ?? 0;
        $this->container['is_deleted'] = $data['is_deleted'] ?? false;
        $this->container['is_linkable'] = $data['is_linkable'] ?? true;
        $this->container['visible_to'] = $data['visible_to'] ?? null;
        $this->container['owner_id'] = $data['owner_id'] ?? null;
        $this->container['custom_fields'] = $data['custom_fields'] ?? null;
        $this->container['billing_frequency'] = $data['billing_frequency'] ?? null;
        $this->container['billing_frequency_cycles'] = $data['billing_frequency_cycles'] ?? null;
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
     * @return float|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param float|null $id The ID of the product
     *
     * @return self
     */
    public function setId($id): self
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string|null $name The name of the product
     *
     * @return self
     */
    public function setName($name): self
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets code
     *
     * @return string|null
     */
    public function getCode()
    {
        return $this->container['code'];
    }

    /**
     * Sets code
     *
     * @param string|null $code The product code
     *
     * @return self
     */
    public function setCode($code): self
    {
        $this->container['code'] = $code;

        return $this;
    }

    /**
     * Gets unit
     *
     * @return string|null
     */
    public function getUnit()
    {
        return $this->container['unit'];
    }

    /**
     * Sets unit
     *
     * @param string|null $unit The unit in which this product is sold
     *
     * @return self
     */
    public function setUnit($unit): self
    {
        $this->container['unit'] = $unit;

        return $this;
    }

    /**
     * Gets tax
     *
     * @return float|null
     */
    public function getTax()
    {
        return $this->container['tax'];
    }

    /**
     * Sets tax
     *
     * @param float|null $tax The tax percentage
     *
     * @return self
     */
    public function setTax($tax): self
    {
        $this->container['tax'] = $tax;

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
     * @param bool|null $is_deleted Whether this product will be made marked as deleted or not
     *
     * @return self
     */
    public function setIsDeleted($is_deleted): self
    {
        $this->container['is_deleted'] = $is_deleted;

        return $this;
    }

    /**
     * Gets is_linkable
     *
     * @return bool|null
     */
    public function getIsLinkable()
    {
        return $this->container['is_linkable'];
    }

    /**
     * Sets is_linkable
     *
     * @param bool|null $is_linkable Whether this product can be added to a deal or not
     *
     * @return self
     */
    public function setIsLinkable($is_linkable): self
    {
        $this->container['is_linkable'] = $is_linkable;

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
     * @param VisibleTo|null $visible_to Visibility of the product
     *
     * @return self
     */
    public function setVisibleTo($visible_to): self
    {
        $this->container['visible_to'] = $visible_to;

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
     * @param int|null $owner_id Information about the Pipedrive user who owns the product
     *
     * @return self
     */
    public function setOwnerId($owner_id): self
    {
        $this->container['owner_id'] = $owner_id;

        return $this;
    }

    /**
     * Gets custom_fields
     *
     * @return array<string,object>|null
     */
    public function getCustomFields()
    {
        return $this->container['custom_fields'];
    }

    /**
     * Sets custom_fields
     *
     * @param array<string,object>|null $custom_fields An object where each key represents a custom field. All custom fields are referenced as randomly generated 40-character hashes
     *
     * @return self
     */
    public function setCustomFields($custom_fields): self
    {
        $this->container['custom_fields'] = $custom_fields;

        return $this;
    }

    /**
     * Gets billing_frequency
     *
     * @return \Pipedrive\versions\v2\Model\BillingFrequency1|null
     */
    public function getBillingFrequency()
    {
        return $this->container['billing_frequency'];
    }

    /**
     * Sets billing_frequency
     *
     * @param \Pipedrive\versions\v2\Model\BillingFrequency1|null $billing_frequency billing_frequency
     *
     * @return self
     */
    public function setBillingFrequency($billing_frequency): self
    {
        $this->container['billing_frequency'] = $billing_frequency;

        return $this;
    }

    /**
     * Gets billing_frequency_cycles
     *
     * @return int|null
     */
    public function getBillingFrequencyCycles()
    {
        return $this->container['billing_frequency_cycles'];
    }

    /**
     * Sets billing_frequency_cycles
     *
     * @param int|null $billing_frequency_cycles Only available in Advanced and above plans  The number of times the billing frequency repeats for a product in a deal  When `billing_frequency` is set to `one-time`, this field must be `null`  When `billing_frequency` is set to `weekly`, this field cannot be `null`  For all the other values of `billing_frequency`, `null` represents a product billed indefinitely  Must be a positive integer less or equal to 208
     *
     * @return self
     */
    public function setBillingFrequencyCycles($billing_frequency_cycles): self
    {
        $this->container['billing_frequency_cycles'] = $billing_frequency_cycles;

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


