<?php

namespace Pipedrive\Utils;

use JsonSerializable;

class JsonSerializer implements JsonSerializable
{
    private $args;

    public function __construct($input)
    {
        $this->args = $input;
    }

    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        return $this->args;
    }
}