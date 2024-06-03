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

if (!Validator::string($password, 8, 255)) {
    $errors['password'] = 'Please provide atleast 8 characters';
}

if (!empty($errors)) {
    http_response_code(Response::BAD_REQUEST);
    return view('users/create.view.php', [
        'errors' => $errors,
        'email' => $email,
        'password' => $password
    ]);
}

// Email already exist?
$db = App::resolve(Database::class);
$user = $db->query("SELECT * FROM users WHERE email = :email", ['email' => $email])->find();

if ($user) {
    header('location: /');
    die();
}

// If not create
$db->query("INSERT INTO users (email, password) VALUES(:email, :password)", [
    'email' => $email,
    'password' => password_hash($password, PASSWORD_BCRYPT)
]);

// Set session
$_SESSION['user'] = [
    'email' => $email
];

// Redirect
header('location: /notes');
die();
