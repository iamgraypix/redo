<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = LoginForm::validate([
    'email' => $email,
    'password' => $password
]);

if (! (new Authenticator)->attempt($email, $password)) {
    $form->error('email', 'No account found on that email and password')->throw();
}

redirect('/');


