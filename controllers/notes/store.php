<?php 

use Core\Database;
use Core\Validator;
use Core\Response;

$config = require base_path('config.php');
require base_path('Core/Validator.php');
$db = new Database($config['database']);

$body = $_POST['body'];
$errors = [];

if (!Validator::string($body, 3, 1000)) {
    http_response_code(Response::BAD_REQUEST);
    $errors['body'] = 'A body cannot be more than 1,000 characters is required!';
}

if ($errors) {
    view('notes/create.view.php', [
        'heading' => 'Create Note',
        'errors' => $errors,
        'body' => $body
    ]);
}

$db->query('INSERT INTO notes (body, user_id) VALUES(:body, :user)', [
    "body" => $body,
    "user" => 3
]);

header('location: /notes');
die();