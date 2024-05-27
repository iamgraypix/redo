<?php 

$heading = 'Create Note';
$config = require 'config.php';
$db = new Database($config['database']);

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $db->query('INSERT INTO notes (body, user_id) VALUES(:body, :user)', [
        "body" => $_POST['body'],
        "user" => 3
    ]);
}




require 'views/note-create.view.php';