<?php

namespace Pipedrive\Utils;

class CamelCaseHelper
{
    public static function keysToCamelCase($input)
    {
        if ($input instanceof \DateTime) {
            return $input;
        }

        if (is_object($input)) {
            // If the input object is not an instance of any SDK model then use the JsonSerializer class
            // so that json_encode() would use snake_case keys from the raw response.
            // Otherwise, use the mapped model class where the snake_case keys are assigned by generated code.
            if ($input instanceof \stdClass) {
                $obj = new JsonSerializer($input);
            } else {
                $className = get_class($input);
                $obj = new $className;
            }
        }

        $arr = [];

        foreach ($input as $key => $value) {
            $key = preg_replace_callback(
                '/_([^_])/',
                function (array $m) {
                    return ucfirst($m[1]);
                },
                $key
            );

            if (is_array($value) || is_object($value)) {
                $value = CamelCaseHelper::keysToCamelCase($value);
            }

            if (is_object($input)) {
                $obj->{$key} = $value;
            } else {
                $arr[$key] = $value;
            }
        }

        return is_object($input) ? $obj : $arr;
    }
}