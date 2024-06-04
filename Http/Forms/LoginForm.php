<?php

namespace Http\Forms;

use Core\Validator;
use Core\Response;

class LoginForm
{

    protected $errors = [];

    public function error($field, $message)
    {
        http_response_code(Response::BAD_REQUEST);
        $this->errors[$field] = $message;
    }

    public function validate($email, $password)
    {

        if (!Validator::email($email)) {
            $this->error('email', 'Please provide a valid email address');
        }

        if (!Validator::string($password)) {
            $this->error('password', 'Please provide a password');
        }

        return empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }


}
