<?php

namespace Pipedrive\Utils;

class CamelCaseHelper
{
    public static function keysToCamelCase($input)
    {
        $obj = new \stdClass();
        $arr = [];

        foreach ($input as $key => $value) {
            $key = preg_replace_callback(
                '/_([^_])/',
                function (array $m) {
                    return ucfirst($m[1]);
                },
                $key
            );

            if (is_array($value) || is_object($value))
                $value = CamelCaseHelper::keysToCamelCase($value);

            if (is_object($input)) {
               $obj->{$key} = $value;
            } else {
                $arr[$key] = $value;
            }
        }

        return is_object($input) ? $obj : $arr;
    }
}