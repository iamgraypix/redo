<?php

namespace Http\Forms;

use Core\Validator;
use Core\Response;
use Core\ValidationException;

class LoginForm
{

    protected $errors = [];


    public function __construct(public array $attributes)
    {
        if (!Validator::email($attributes['email'])) {
            $this->error('email', 'Please provide a valid email address');
        }

        if (!Validator::string($attributes['password'])) {
            $this->error('password', 'Please provide a password');
        }
    }
    public function error($field, $message)
    {
        $this->errors[$field] = $message;
        return $this;
    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);

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
