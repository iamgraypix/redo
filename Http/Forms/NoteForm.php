<?php

namespace Http\Forms;

use Core\Form;
use Core\Response;
use Core\Validator;

class NoteForm extends Form
{
    public function __construct($atttributes)
    {
        if (!Validator::string($atttributes['body'], 3, 1000)) {
            $this->error('body', 'A body cannot be more than 1,000 characters is required!');
        }
    }
}
