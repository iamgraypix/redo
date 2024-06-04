<?php 

use Core\App;
use Core\Database;
use Core\Response;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

// Validate
$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address';
}

if (!Validator::string($password)) {
    $errors['password'] = 'Please provide a password';
}

if (!empty($errors)) {
    http_response_code(Response::BAD_REQUEST);
    return view('auth/login.view.php', [
        'errors' => $errors,
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