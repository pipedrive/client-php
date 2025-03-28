<?php

/**
 * AnyOfRecents
 * PHP version 7.3
 *
 * @category Class
 * @package  Pipedrive\versions\v1
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

/**
 * AnyOfRecents Class Doc Comment
 * PHP version 7.3
 *
 * @category Class
 * @package  Pipedrive\versions\v1
 */
class AnyOfRecents {
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'AnyOfRecents';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @phpstan-return array<string, string>
     * @psalm-return array<string, string>
     * @return array
     */
    public static function openAPITypes(): array
    {
        return [
            'id' => 'int',
            'item' => 'string',
            'data' => 'array'
        ];
    }

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
        return [
            'id' => 'id',
            'item' => 'item',
            'data' => 'data'
        ];
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
        return [
            'id' => 'setId',
            'item' => 'setItem',
            'data' => 'setData'
        ];
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
        return [
            'id' => 'getId',
            'item' => 'getItem',
            'data' => 'getData'
        ];
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
     * @param array|null $data Associated array of property values initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['id'] = $data['id'] ?? null;
        $this->container['item'] = $data['item'] ?? null;
        $this->container['data'] = $data['data'] ?? null;
    }

    /**
     * Gets id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param int $id The id of an item
     *
     * @return self
     */
    public function setId(int $id): self
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets item
     *
     * @return string
     */
    public function getItem(): string
    {
        return $this->container['item'];
    }

    /**
     * Sets item
     *
     * @param string $item The type of the item
     *
     * @return self
     */
    public function setItem(string $item): self
    {
        $this->container['item'] = $item;

        return $this;
    }

    /**
     * Gets data
     *
     *  @return array<string, mixed>
     */
    public function getData(): array
    {
        return $this->container['data'];
    }

    /**
     * Sets id
     *
     * @param array<string, mixed> $data The data about the item
     *
     * @return self
     */
    public function setData(array $data): self
    {
        $this->container['data'] = $data;

        return $this;
    }
}