<?php

namespace Core;

use Exception;

class ValidationException extends Exception
{
    public readonly array $errors;
    public readonly array $attributes;

    public static function throw($errors, $attributes)
    {
        $instance = new static;

        $instance->errors = $errors;
        $instance->attributes =$attributes;

        throw $instance;
    }
}
