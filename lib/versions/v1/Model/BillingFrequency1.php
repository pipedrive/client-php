<?php
/**
 * BillingFrequency1
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
 * BillingFrequency1 Class Doc Comment
 *
 * @category Class
 * @description Only available in Advanced and above plans  How often a customer is billed for access to a service or product
 * @package  Pipedrive\versions\v1
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class BillingFrequency1
{
    /**
     * Possible values of this enum
     */
    const ONE_TIME = 'one-time';

    const ANNUALLY = 'annually';

    const SEMI_ANNUALLY = 'semi-annually';

    const QUARTERLY = 'quarterly';

    const MONTHLY = 'monthly';

    const WEEKLY = 'weekly';

    /**
     * Gets allowable values of the enum
     * @return (string|int)[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::ONE_TIME,
            self::ANNUALLY,
            self::SEMI_ANNUALLY,
            self::QUARTERLY,
            self::MONTHLY,
            self::WEEKLY
        ];
    }
}


