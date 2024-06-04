<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)) {
    if ((new Authenticator)->attempt($email, $password)) {
        login($user);
        redirect('/');
    }

    $form->error('email', 'No account found on that email and password');
}


return view('auth/create.view.php', [
    'errors' => $form->errors(),
    'email' => $email,
    'password' => $password
]);
