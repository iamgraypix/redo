<?php

namespace Http\Forms;

use Core\Form;
use Core\Validator;

class LoginForm extends Form
{
    public function __construct($attributes)
    {
        if (!Validator::email($attributes['email'])) {
            $this->error('email', 'Please provide a valid email address');
        }

        if (!Validator::string($attributes['password'])) {
            $this->error('password', 'Please provide a password');
        }
    }
}
