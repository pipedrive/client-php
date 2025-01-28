<?php
/**
 * UpdateDealProductRequestBody
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
 * UpdateDealProductRequestBody Class Doc Comment
 *
 * @category Class
 * @package  Pipedrive\versions\v2
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class UpdateDealProductRequestBody implements ModelInterface, ArrayAccess, JsonSerializable
{
    use RawData;

    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'UpdateDealProductRequestBody';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string>
      * @phpsalm-var array<string, string>
      */
    protected static array $openAPITypes = [
        'product_id' => 'int',
        'item_price' => 'float',
        'quantity' => 'float',
        'tax' => 'float',
        'comments' => 'string',
        'discount' => 'float',
        'is_enabled' => 'bool',
        'tax_method' => 'string',
        'discount_type' => 'string',
        'product_variation_id' => 'int',
        'billing_frequency' => '\Pipedrive\versions\v2\Model\BillingFrequency',
        'billing_frequency_cycles' => 'int',
        'billing_start_date' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'product_id' => null,
        'item_price' => null,
        'quantity' => null,
        'tax' => null,
        'comments' => null,
        'discount' => null,
        'is_enabled' => null,
        'tax_method' => null,
        'discount_type' => null,
        'product_variation_id' => null,
        'billing_frequency' => null,
        'billing_frequency_cycles' => null,
        'billing_start_date' => 'YYYY-MM-DD'
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
        'product_id' => 'product_id',
        'item_price' => 'item_price',
        'quantity' => 'quantity',
        'tax' => 'tax',
        'comments' => 'comments',
        'discount' => 'discount',
        'is_enabled' => 'is_enabled',
        'tax_method' => 'tax_method',
        'discount_type' => 'discount_type',
        'product_variation_id' => 'product_variation_id',
        'billing_frequency' => 'billing_frequency',
        'billing_frequency_cycles' => 'billing_frequency_cycles',
        'billing_start_date' => 'billing_start_date'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'product_id' => 'setProductId',
        'item_price' => 'setItemPrice',
        'quantity' => 'setQuantity',
        'tax' => 'setTax',
        'comments' => 'setComments',
        'discount' => 'setDiscount',
        'is_enabled' => 'setIsEnabled',
        'tax_method' => 'setTaxMethod',
        'discount_type' => 'setDiscountType',
        'product_variation_id' => 'setProductVariationId',
        'billing_frequency' => 'setBillingFrequency',
        'billing_frequency_cycles' => 'setBillingFrequencyCycles',
        'billing_start_date' => 'setBillingStartDate'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'product_id' => 'getProductId',
        'item_price' => 'getItemPrice',
        'quantity' => 'getQuantity',
        'tax' => 'getTax',
        'comments' => 'getComments',
        'discount' => 'getDiscount',
        'is_enabled' => 'getIsEnabled',
        'tax_method' => 'getTaxMethod',
        'discount_type' => 'getDiscountType',
        'product_variation_id' => 'getProductVariationId',
        'billing_frequency' => 'getBillingFrequency',
        'billing_frequency_cycles' => 'getBillingFrequencyCycles',
        'billing_start_date' => 'getBillingStartDate'
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

    const TAX_METHOD_EXCLUSIVE = 'exclusive';
    const TAX_METHOD_INCLUSIVE = 'inclusive';
    const TAX_METHOD_NONE = 'none';
    const DISCOUNT_TYPE_PERCENTAGE = 'percentage';
    const DISCOUNT_TYPE_AMOUNT = 'amount';

    /**
     * Gets allowable values of the enum
     *
     * @phpstan-return  array<string|int>
     * @phpsalm-return  array<string|int>
     * @return (string|int)[]
     */
    public function getTaxMethodAllowableValues(): array
    {
        return [
            self::TAX_METHOD_EXCLUSIVE,
            self::TAX_METHOD_INCLUSIVE,
            self::TAX_METHOD_NONE,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @phpstan-return  array<string|int>
     * @phpsalm-return  array<string|int>
     * @return (string|int)[]
     */
    public function getDiscountTypeAllowableValues(): array
    {
        return [
            self::DISCOUNT_TYPE_PERCENTAGE,
            self::DISCOUNT_TYPE_AMOUNT,
        ];
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
        $this->container['product_id'] = $data['product_id'] ?? null;
        $this->container['item_price'] = $data['item_price'] ?? null;
        $this->container['quantity'] = $data['quantity'] ?? null;
        $this->container['tax'] = $data['tax'] ?? 0;
        $this->container['comments'] = $data['comments'] ?? null;
        $this->container['discount'] = $data['discount'] ?? 0;
        $this->container['is_enabled'] = $data['is_enabled'] ?? true;
        $this->container['tax_method'] = $data['tax_method'] ?? null;
        $this->container['discount_type'] = $data['discount_type'] ?? 'percentage';
        $this->container['product_variation_id'] = $data['product_variation_id'] ?? null;
        $this->container['billing_frequency'] = $data['billing_frequency'] ?? null;
        $this->container['billing_frequency_cycles'] = $data['billing_frequency_cycles'] ?? null;
        $this->container['billing_start_date'] = $data['billing_start_date'] ?? null;
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

        $allowedValues = $this->getTaxMethodAllowableValues();
        if (!is_null($this->container['tax_method']) && !in_array($this->container['tax_method'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'tax_method', must be one of '%s'",
                $this->container['tax_method'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getDiscountTypeAllowableValues();
        if (!is_null($this->container['discount_type']) && !in_array($this->container['discount_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'discount_type', must be one of '%s'",
                $this->container['discount_type'],
                implode("', '", $allowedValues)
            );
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
     * Gets product_id
     *
     * @return int|null
     */
    public function getProductId()
    {
        return $this->container['product_id'];
    }

    /**
     * Sets product_id
     *
     * @param int|null $product_id The ID of the product
     *
     * @return self
     */
    public function setProductId($product_id): self
    {
        $this->container['product_id'] = $product_id;

        return $this;
    }

    /**
     * Gets item_price
     *
     * @return float|null
     */
    public function getItemPrice()
    {
        return $this->container['item_price'];
    }

    /**
     * Sets item_price
     *
     * @param float|null $item_price The price value of the product
     *
     * @return self
     */
    public function setItemPrice($item_price): self
    {
        $this->container['item_price'] = $item_price;

        return $this;
    }

    /**
     * Gets quantity
     *
     * @return float|null
     */
    public function getQuantity()
    {
        return $this->container['quantity'];
    }

    /**
     * Sets quantity
     *
     * @param float|null $quantity The quantity of the product
     *
     * @return self
     */
    public function setQuantity($quantity): self
    {
        $this->container['quantity'] = $quantity;

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
     * @param float|null $tax The product tax
     *
     * @return self
     */
    public function setTax($tax): self
    {
        $this->container['tax'] = $tax;

        return $this;
    }

    /**
     * Gets comments
     *
     * @return string|null
     */
    public function getComments()
    {
        return $this->container['comments'];
    }

    /**
     * Sets comments
     *
     * @param string|null $comments The comments of the product
     *
     * @return self
     */
    public function setComments($comments): self
    {
        $this->container['comments'] = $comments;

        return $this;
    }

    /**
     * Gets discount
     *
     * @return float|null
     */
    public function getDiscount()
    {
        return $this->container['discount'];
    }

    /**
     * Sets discount
     *
     * @param float|null $discount The value of the discount. The `discount_type` field can be used to specify whether the value is an amount or a percentage
     *
     * @return self
     */
    public function setDiscount($discount): self
    {
        $this->container['discount'] = $discount;

        return $this;
    }

    /**
     * Gets is_enabled
     *
     * @return bool|null
     */
    public function getIsEnabled()
    {
        return $this->container['is_enabled'];
    }

    /**
     * Sets is_enabled
     *
     * @param bool|null $is_enabled Whether this product is enabled for the deal  Not possible to disable the product if the deal has installments associated and the product is the last one enabled  Not possible to enable the product if the deal has installments associated and the product is recurring
     *
     * @return self
     */
    public function setIsEnabled($is_enabled): self
    {
        $this->container['is_enabled'] = $is_enabled;

        return $this;
    }

    /**
     * Gets tax_method
     *
     * @return string|null
     */
    public function getTaxMethod()
    {
        return $this->container['tax_method'];
    }

    /**
     * Sets tax_method
     *
     * @param string|null $tax_method The tax option to be applied to the products. When using `inclusive`, the tax percentage will already be included in the price. When using `exclusive`, the tax will not be included in the price. When using `none`, no tax will be added. Use the `tax` field for defining the tax percentage amount. By default, the user setting value for tax options will be used. Changing this in one product affects the rest of the products attached to the deal
     *
     * @return self
     */
    public function setTaxMethod($tax_method): self
    {
        $allowedValues = $this->getTaxMethodAllowableValues();
        if (!is_null($tax_method) && !in_array($tax_method, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'tax_method', must be one of '%s'",
                    $tax_method,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['tax_method'] = $tax_method;

        return $this;
    }

    /**
     * Gets discount_type
     *
     * @return string|null
     */
    public function getDiscountType()
    {
        return $this->container['discount_type'];
    }

    /**
     * Sets discount_type
     *
     * @param string|null $discount_type The value of the discount. The `discount_type` field can be used to specify whether the value is an amount or a percentage
     *
     * @return self
     */
    public function setDiscountType($discount_type): self
    {
        $allowedValues = $this->getDiscountTypeAllowableValues();
        if (!is_null($discount_type) && !in_array($discount_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'discount_type', must be one of '%s'",
                    $discount_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['discount_type'] = $discount_type;

        return $this;
    }

    /**
     * Gets product_variation_id
     *
     * @return int|null
     */
    public function getProductVariationId()
    {
        return $this->container['product_variation_id'];
    }

    /**
     * Sets product_variation_id
     *
     * @param int|null $product_variation_id The ID of the product variation
     *
     * @return self
     */
    public function setProductVariationId($product_variation_id): self
    {
        $this->container['product_variation_id'] = $product_variation_id;

        return $this;
    }

    /**
     * Gets billing_frequency
     *
     * @return \Pipedrive\versions\v2\Model\BillingFrequency|null
     */
    public function getBillingFrequency()
    {
        return $this->container['billing_frequency'];
    }

    /**
     * Sets billing_frequency
     *
     * @param \Pipedrive\versions\v2\Model\BillingFrequency|null $billing_frequency billing_frequency
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
     * Gets billing_start_date
     *
     * @return string|null
     */
    public function getBillingStartDate()
    {
        return $this->container['billing_start_date'];
    }

    /**
     * Sets billing_start_date
     *
     * @param string|null $billing_start_date Only available in Advanced and above plans  The billing start date. Must be between 10 years in the past and 10 years in the future
     *
     * @return self
     */
    public function setBillingStartDate($billing_start_date): self
    {
        $this->container['billing_start_date'] = $billing_start_date;

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


