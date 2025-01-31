<?php
/**
 * VisibleTo
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
use Pipedrive\versions\v2\ObjectSerializer;

/**
 * VisibleTo Class Doc Comment
 *
 * @category Class
 * @package  Pipedrive\versions\v2
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class VisibleTo
{
    /**
     * Possible values of this enum
     */
    const NUMBER_1 = 1;

    const NUMBER_3 = 3;

    const NUMBER_5 = 5;

    const NUMBER_7 = 7;

    /**
     * Gets allowable values of the enum
     * @return (string|int)[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::NUMBER_1,
            self::NUMBER_3,
            self::NUMBER_5,
            self::NUMBER_7
        ];
    }
}


