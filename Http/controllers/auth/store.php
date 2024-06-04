<?php 

use Core\App;
use Core\Database;
use Core\Response;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if (! $form->validate($email, $password)){
    http_response_code(Response::BAD_REQUEST);
    return view('auth/create.view.php', [
        'errors' => $form->errors(),
        'email' => $email,
        'password' => $password
    ]);
}
$db = App::resolve(Database::class);

$user = $db->query("SELECT * FROM users WHERE email = :email", ['email' => $email])->find();

if (! $user){
    http_response_code(Response::BAD_REQUEST);
    return view('auth/login.view.php', [
        'errors' => [
            'email' => 'No account found on that email'
        ],
        'email' => $email,
        'password' => $password
    ]);
}

if (! password_verify($password, $user['password'])){
    http_response_code(Response::BAD_REQUEST);
    return view('auth/login.view.php', [
        'errors' => [
            'email' => 'No account found on that email and password'
        ],
        'email' => $email,
        'password' => $password
    ]);
}

login($user);

header('location: /notes');
die();