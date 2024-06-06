<?php

namespace Core;

class Form
{
    protected $errors = [];
    protected $attributes = [];

    public function error($field, $message)
    {
        $this->errors[$field] = $message;
        return $this;
    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);
        $instance->attributes = $attributes;

        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function throw()
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }

    public function failed()
    {
        return count($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }
}
