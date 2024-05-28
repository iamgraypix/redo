<?php 

$heading = 'Create Note';
$config = require 'config.php';
$db = new Database($config['database']);

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $body = $_POST['body'];
    $errors = [];

    if (empty(trim($body))){
        http_response_code(400);
        $errors['body'] = 'A body is required!'; 
    }

    if (strlen($body) > 1000){
        http_response_code(400);
        $errors['body'] = 'A body cannot be more than 1,000 characters!';
    }

    if (strlen(trim($body)) <= 3){
        http_response_code(400);
        $errors['body'] = 'A body cannot be less than 3 characters!';
    }

    if (empty($errors)){
        $db->query('INSERT INTO notes (body, user_id) VALUES(:body, :user)', [
            "body" => $body,
            "user" => 3
        ]);
        $body = null;
    }

    
}




require 'views/note-create.view.php';