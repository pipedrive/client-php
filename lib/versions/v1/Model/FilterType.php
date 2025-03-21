<?php
/**
 * FilterType
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
use Pipedrive\versions\v1\ObjectSerializer;

/**
 * FilterType Class Doc Comment
 *
 * @category Class
 * @package  Pipedrive\versions\v1
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class FilterType
{
    /**
     * Possible values of this enum
     */
    const DEALS = 'deals';

    const LEADS = 'leads';

    const ORG = 'org';

    const PEOPLE = 'people';

    const PRODUCTS = 'products';

    const ACTIVITY = 'activity';

    const PROJECTS = 'projects';

    /**
     * Gets allowable values of the enum
     * @return (string|int)[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::DEALS,
            self::LEADS,
            self::ORG,
            self::PEOPLE,
            self::PRODUCTS,
            self::ACTIVITY,
            self::PROJECTS
        ];
    }
}


