<?php

$config = require base_path('config.php');
require base_path('Core/Validator.php');
$db = new Database($config['database']);

$errors = [];
$body = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = $_POST['body'];


    if (!Validator::string($body, 3, 1000)) {
        http_response_code(400);
        $errors['body'] = 'A body cannot be more than 1,000 characters is required!';
    }

    if (empty($errors)) {
        $db->query('INSERT INTO notes (body, user_id) VALUES(:body, :user)', [
            "body" => $body,
            "user" => 3
        ]);
        $body = null;
    }
}


view('notes/create.view.php', [
    'heading' => 'Create Note',
    'errors' => $errors,
    'body' => $body
]);
