<?php

/**
 * RawData
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

namespace Pipedrive\versions\v1\Traits;

/**
 * PHP version 7.3
 *
 * @category Class
 * @package  Pipedrive\versions\v1
 */
trait RawData
{
    /**
     * @var mixed
     */
    private mixed $rawData;

    /**
     * Get raw data
     *
     * @return mixed
     */
    public function getRawData(): mixed
    {
        return $this->rawData;
    }

    /**
     * Set raw data
     *
     * @param mixed $rawData
     * @return void
     */
    public function setRawData(mixed $rawData): void
    {
        $this->rawData = is_object($rawData) && property_exists($rawData, 'data') ? $rawData->data : $rawData;
    }
}
