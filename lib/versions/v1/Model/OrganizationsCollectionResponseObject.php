<?php
/**
 * OrganizationsCollectionResponseObject
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
 * OrganizationsCollectionResponseObject Class Doc Comment
 *
 * @category Class
 * @package  Pipedrive\versions\v1
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class OrganizationsCollectionResponseObject implements ModelInterface, ArrayAccess, JsonSerializable
{
    use RawData;

    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'OrganizationsCollectionResponseObject';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string>
      * @phpsalm-var array<string, string>
      */
    protected static array $openAPITypes = [
        'address' => 'string',
        'address_subpremise' => 'string',
        'address_street_number' => 'string',
        'address_route' => 'string',
        'address_sublocality' => 'string',
        'address_locality' => 'string',
        'address_admin_area_level_1' => 'string',
        'address_admin_area_level_2' => 'string',
        'address_country' => 'string',
        'address_postal_code' => 'string',
        'address_formatted_address' => 'string',
        'id' => 'int',
        'active_flag' => 'bool',
        'owner_id' => 'int',
        'name' => 'string',
        'update_time' => 'string',
        'delete_time' => 'string',
        'add_time' => 'string',
        'visible_to' => 'string',
        'label' => 'int',
        'label_ids' => 'int[]',
        'cc_email' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'address' => null,
        'address_subpremise' => null,
        'address_street_number' => null,
        'address_route' => null,
        'address_sublocality' => null,
        'address_locality' => null,
        'address_admin_area_level_1' => null,
        'address_admin_area_level_2' => null,
        'address_country' => null,
        'address_postal_code' => null,
        'address_formatted_address' => null,
        'id' => null,
        'active_flag' => null,
        'owner_id' => null,
        'name' => null,
        'update_time' => null,
        'delete_time' => null,
        'add_time' => null,
        'visible_to' => null,
        'label' => null,
        'label_ids' => null,
        'cc_email' => null
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
        'address' => 'address',
        'address_subpremise' => 'address_subpremise',
        'address_street_number' => 'address_street_number',
        'address_route' => 'address_route',
        'address_sublocality' => 'address_sublocality',
        'address_locality' => 'address_locality',
        'address_admin_area_level_1' => 'address_admin_area_level_1',
        'address_admin_area_level_2' => 'address_admin_area_level_2',
        'address_country' => 'address_country',
        'address_postal_code' => 'address_postal_code',
        'address_formatted_address' => 'address_formatted_address',
        'id' => 'id',
        'active_flag' => 'active_flag',
        'owner_id' => 'owner_id',
        'name' => 'name',
        'update_time' => 'update_time',
        'delete_time' => 'delete_time',
        'add_time' => 'add_time',
        'visible_to' => 'visible_to',
        'label' => 'label',
        'label_ids' => 'label_ids',
        'cc_email' => 'cc_email'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'address' => 'setAddress',
        'address_subpremise' => 'setAddressSubpremise',
        'address_street_number' => 'setAddressStreetNumber',
        'address_route' => 'setAddressRoute',
        'address_sublocality' => 'setAddressSublocality',
        'address_locality' => 'setAddressLocality',
        'address_admin_area_level_1' => 'setAddressAdminAreaLevel1',
        'address_admin_area_level_2' => 'setAddressAdminAreaLevel2',
        'address_country' => 'setAddressCountry',
        'address_postal_code' => 'setAddressPostalCode',
        'address_formatted_address' => 'setAddressFormattedAddress',
        'id' => 'setId',
        'active_flag' => 'setActiveFlag',
        'owner_id' => 'setOwnerId',
        'name' => 'setName',
        'update_time' => 'setUpdateTime',
        'delete_time' => 'setDeleteTime',
        'add_time' => 'setAddTime',
        'visible_to' => 'setVisibleTo',
        'label' => 'setLabel',
        'label_ids' => 'setLabelIds',
        'cc_email' => 'setCcEmail'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'address' => 'getAddress',
        'address_subpremise' => 'getAddressSubpremise',
        'address_street_number' => 'getAddressStreetNumber',
        'address_route' => 'getAddressRoute',
        'address_sublocality' => 'getAddressSublocality',
        'address_locality' => 'getAddressLocality',
        'address_admin_area_level_1' => 'getAddressAdminAreaLevel1',
        'address_admin_area_level_2' => 'getAddressAdminAreaLevel2',
        'address_country' => 'getAddressCountry',
        'address_postal_code' => 'getAddressPostalCode',
        'address_formatted_address' => 'getAddressFormattedAddress',
        'id' => 'getId',
        'active_flag' => 'getActiveFlag',
        'owner_id' => 'getOwnerId',
        'name' => 'getName',
        'update_time' => 'getUpdateTime',
        'delete_time' => 'getDeleteTime',
        'add_time' => 'getAddTime',
        'visible_to' => 'getVisibleTo',
        'label' => 'getLabel',
        'label_ids' => 'getLabelIds',
        'cc_email' => 'getCcEmail'
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
        $this->container['address'] = $data['address'] ?? null;
        $this->container['address_subpremise'] = $data['address_subpremise'] ?? null;
        $this->container['address_street_number'] = $data['address_street_number'] ?? null;
        $this->container['address_route'] = $data['address_route'] ?? null;
        $this->container['address_sublocality'] = $data['address_sublocality'] ?? null;
        $this->container['address_locality'] = $data['address_locality'] ?? null;
        $this->container['address_admin_area_level_1'] = $data['address_admin_area_level_1'] ?? null;
        $this->container['address_admin_area_level_2'] = $data['address_admin_area_level_2'] ?? null;
        $this->container['address_country'] = $data['address_country'] ?? null;
        $this->container['address_postal_code'] = $data['address_postal_code'] ?? null;
        $this->container['address_formatted_address'] = $data['address_formatted_address'] ?? null;
        $this->container['id'] = $data['id'] ?? null;
        $this->container['active_flag'] = $data['active_flag'] ?? null;
        $this->container['owner_id'] = $data['owner_id'] ?? null;
        $this->container['name'] = $data['name'] ?? null;
        $this->container['update_time'] = $data['update_time'] ?? null;
        $this->container['delete_time'] = $data['delete_time'] ?? null;
        $this->container['add_time'] = $data['add_time'] ?? null;
        $this->container['visible_to'] = $data['visible_to'] ?? null;
        $this->container['label'] = $data['label'] ?? null;
        $this->container['label_ids'] = $data['label_ids'] ?? null;
        $this->container['cc_email'] = $data['cc_email'] ?? null;
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
     * Gets address
     *
     * @return string|null
     */
    public function getAddress()
    {
        return $this->container['address'];
    }

    /**
     * Sets address
     *
     * @param string|null $address The full address of the organization
     *
     * @return self
     */
    public function setAddress($address): self
    {
        $this->container['address'] = $address;

        return $this;
    }

    /**
     * Gets address_subpremise
     *
     * @return string|null
     */
    public function getAddressSubpremise()
    {
        return $this->container['address_subpremise'];
    }

    /**
     * Sets address_subpremise
     *
     * @param string|null $address_subpremise The sub-premise of the organization location
     *
     * @return self
     */
    public function setAddressSubpremise($address_subpremise): self
    {
        $this->container['address_subpremise'] = $address_subpremise;

        return $this;
    }

    /**
     * Gets address_street_number
     *
     * @return string|null
     */
    public function getAddressStreetNumber()
    {
        return $this->container['address_street_number'];
    }

    /**
     * Sets address_street_number
     *
     * @param string|null $address_street_number The street number of the organization location
     *
     * @return self
     */
    public function setAddressStreetNumber($address_street_number): self
    {
        $this->container['address_street_number'] = $address_street_number;

        return $this;
    }

    /**
     * Gets address_route
     *
     * @return string|null
     */
    public function getAddressRoute()
    {
        return $this->container['address_route'];
    }

    /**
     * Sets address_route
     *
     * @param string|null $address_route The route of the organization location
     *
     * @return self
     */
    public function setAddressRoute($address_route): self
    {
        $this->container['address_route'] = $address_route;

        return $this;
    }

    /**
     * Gets address_sublocality
     *
     * @return string|null
     */
    public function getAddressSublocality()
    {
        return $this->container['address_sublocality'];
    }

    /**
     * Sets address_sublocality
     *
     * @param string|null $address_sublocality The sub-locality of the organization location
     *
     * @return self
     */
    public function setAddressSublocality($address_sublocality): self
    {
        $this->container['address_sublocality'] = $address_sublocality;

        return $this;
    }

    /**
     * Gets address_locality
     *
     * @return string|null
     */
    public function getAddressLocality()
    {
        return $this->container['address_locality'];
    }

    /**
     * Sets address_locality
     *
     * @param string|null $address_locality The locality of the organization location
     *
     * @return self
     */
    public function setAddressLocality($address_locality): self
    {
        $this->container['address_locality'] = $address_locality;

        return $this;
    }

    /**
     * Gets address_admin_area_level_1
     *
     * @return string|null
     */
    public function getAddressAdminAreaLevel1()
    {
        return $this->container['address_admin_area_level_1'];
    }

    /**
     * Sets address_admin_area_level_1
     *
     * @param string|null $address_admin_area_level_1 The level 1 admin area of the organization location
     *
     * @return self
     */
    public function setAddressAdminAreaLevel1($address_admin_area_level_1): self
    {
        $this->container['address_admin_area_level_1'] = $address_admin_area_level_1;

        return $this;
    }

    /**
     * Gets address_admin_area_level_2
     *
     * @return string|null
     */
    public function getAddressAdminAreaLevel2()
    {
        return $this->container['address_admin_area_level_2'];
    }

    /**
     * Sets address_admin_area_level_2
     *
     * @param string|null $address_admin_area_level_2 The level 2 admin area of the organization location
     *
     * @return self
     */
    public function setAddressAdminAreaLevel2($address_admin_area_level_2): self
    {
        $this->container['address_admin_area_level_2'] = $address_admin_area_level_2;

        return $this;
    }

    /**
     * Gets address_country
     *
     * @return string|null
     */
    public function getAddressCountry()
    {
        return $this->container['address_country'];
    }

    /**
     * Sets address_country
     *
     * @param string|null $address_country The country of the organization location
     *
     * @return self
     */
    public function setAddressCountry($address_country): self
    {
        $this->container['address_country'] = $address_country;

        return $this;
    }

    /**
     * Gets address_postal_code
     *
     * @return string|null
     */
    public function getAddressPostalCode()
    {
        return $this->container['address_postal_code'];
    }

    /**
     * Sets address_postal_code
     *
     * @param string|null $address_postal_code The postal code of the organization location
     *
     * @return self
     */
    public function setAddressPostalCode($address_postal_code): self
    {
        $this->container['address_postal_code'] = $address_postal_code;

        return $this;
    }

    /**
     * Gets address_formatted_address
     *
     * @return string|null
     */
    public function getAddressFormattedAddress()
    {
        return $this->container['address_formatted_address'];
    }

    /**
     * Sets address_formatted_address
     *
     * @param string|null $address_formatted_address The formatted organization location
     *
     * @return self
     */
    public function setAddressFormattedAddress($address_formatted_address): self
    {
        $this->container['address_formatted_address'] = $address_formatted_address;

        return $this;
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
     * @param int|null $id The ID of the organization
     *
     * @return self
     */
    public function setId($id): self
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets active_flag
     *
     * @return bool|null
     */
    public function getActiveFlag()
    {
        return $this->container['active_flag'];
    }

    /**
     * Sets active_flag
     *
     * @param bool|null $active_flag Whether the organization is active or not
     *
     * @return self
     */
    public function setActiveFlag($active_flag): self
    {
        $this->container['active_flag'] = $active_flag;

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
     * @param int|null $owner_id The ID of the owner
     *
     * @return self
     */
    public function setOwnerId($owner_id): self
    {
        $this->container['owner_id'] = $owner_id;

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
     * @param string|null $name The name of the organization
     *
     * @return self
     */
    public function setName($name): self
    {
        $this->container['name'] = $name;

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
     * @param string|null $update_time The last updated date and time of the organization. Format: YYYY-MM-DD HH:MM:SS
     *
     * @return self
     */
    public function setUpdateTime($update_time): self
    {
        $this->container['update_time'] = $update_time;

        return $this;
    }

    /**
     * Gets delete_time
     *
     * @return string|null
     */
    public function getDeleteTime()
    {
        return $this->container['delete_time'];
    }

    /**
     * Sets delete_time
     *
     * @param string|null $delete_time The date and time this organization was deleted. Format: YYYY-MM-DD HH:MM:SS
     *
     * @return self
     */
    public function setDeleteTime($delete_time): self
    {
        $this->container['delete_time'] = $delete_time;

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
     * @param string|null $add_time The date and time when the organization was added/created. Format: YYYY-MM-DD HH:MM:SS
     *
     * @return self
     */
    public function setAddTime($add_time): self
    {
        $this->container['add_time'] = $add_time;

        return $this;
    }

    /**
     * Gets visible_to
     *
     * @return string|null
     */
    public function getVisibleTo()
    {
        return $this->container['visible_to'];
    }

    /**
     * Sets visible_to
     *
     * @param string|null $visible_to The visibility group ID of who can see the organization
     *
     * @return self
     */
    public function setVisibleTo($visible_to): self
    {
        $this->container['visible_to'] = $visible_to;

        return $this;
    }

    /**
     * Gets label
     *
     * @return int|null
     */
    public function getLabel()
    {
        return $this->container['label'];
    }

    /**
     * Sets label
     *
     * @param int|null $label The label assigned to the organization. When the `label` field is updated, the `label_ids` field value will be overwritten by the `label` field value.
     *
     * @return self
     */
    public function setLabel($label): self
    {
        $this->container['label'] = $label;

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
     * @param int[]|null $label_ids The IDs of labels assigned to the organization. When the `label_ids` field is updated, the `label` field value will be set to the first value of the `label_ids` field.
     *
     * @return self
     */
    public function setLabelIds($label_ids): self
    {
        $this->container['label_ids'] = $label_ids;

        return $this;
    }

    /**
     * Gets cc_email
     *
     * @return string|null
     */
    public function getCcEmail()
    {
        return $this->container['cc_email'];
    }

    /**
     * Sets cc_email
     *
     * @param string|null $cc_email The BCC email associated with the organization
     *
     * @return self
     */
    public function setCcEmail($cc_email): self
    {
        $this->container['cc_email'] = $cc_email;

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


