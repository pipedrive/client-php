<?php
/**
 * UserAccess
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
 * UserAccess Class Doc Comment
 *
 * @category Class
 * @package  Pipedrive\versions\v1
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class UserAccess implements ModelInterface, ArrayAccess, JsonSerializable
{
    use RawData;

    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'UserAccess';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string>
      * @phpsalm-var array<string, string>
      */
    protected static array $openAPITypes = [
        'app' => 'string',
        'admin' => 'bool',
        'permission_set_id' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'app' => null,
        'admin' => null,
        'permission_set_id' => null
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
        'app' => 'app',
        'admin' => 'admin',
        'permission_set_id' => 'permission_set_id'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'app' => 'setApp',
        'admin' => 'setAdmin',
        'permission_set_id' => 'setPermissionSetId'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'app' => 'getApp',
        'admin' => 'getAdmin',
        'permission_set_id' => 'getPermissionSetId'
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

    const APP__GLOBAL = 'global';
    const APP_SALES = 'sales';
    const APP_CAMPAIGNS = 'campaigns';
    const APP_PROJECTS = 'projects';
    const APP_ACCOUNT_SETTINGS = 'account_settings';
    const APP_PARTNERSHIP = 'partnership';

    /**
     * Gets allowable values of the enum
     *
     * @phpstan-return  array<string|int>
     * @phpsalm-return  array<string|int>
     * @return (string|int)[]
     */
    public function getAppAllowableValues(): array
    {
        return [
            self::APP__GLOBAL,
            self::APP_SALES,
            self::APP_CAMPAIGNS,
            self::APP_PROJECTS,
            self::APP_ACCOUNT_SETTINGS,
            self::APP_PARTNERSHIP,
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
        $this->container['app'] = $data['app'] ?? null;
        $this->container['admin'] = $data['admin'] ?? null;
        $this->container['permission_set_id'] = $data['permission_set_id'] ?? null;
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

        $allowedValues = $this->getAppAllowableValues();
        if (!is_null($this->container['app']) && !in_array($this->container['app'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'app', must be one of '%s'",
                $this->container['app'],
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
     * Gets app
     *
     * @return string|null
     */
    public function getApp()
    {
        return $this->container['app'];
    }

    /**
     * Sets app
     *
     * @param string|null $app app
     *
     * @return self
     */
    public function setApp($app): self
    {
        $allowedValues = $this->getAppAllowableValues();
        if (!is_null($app) && !in_array($app, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'app', must be one of '%s'",
                    $app,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['app'] = $app;

        return $this;
    }

    /**
     * Gets admin
     *
     * @return bool|null
     */
    public function getAdmin()
    {
        return $this->container['admin'];
    }

    /**
     * Sets admin
     *
     * @param bool|null $admin admin
     *
     * @return self
     */
    public function setAdmin($admin): self
    {
        $this->container['admin'] = $admin;

        return $this;
    }

    /**
     * Gets permission_set_id
     *
     * @return string|null
     */
    public function getPermissionSetId()
    {
        return $this->container['permission_set_id'];
    }

    /**
     * Sets permission_set_id
     *
     * @param string|null $permission_set_id permission_set_id
     *
     * @return self
     */
    public function setPermissionSetId($permission_set_id): self
    {
        $this->container['permission_set_id'] = $permission_set_id;

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


