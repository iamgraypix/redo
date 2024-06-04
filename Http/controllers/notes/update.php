<?php 
use Core\Database;
use Core\App;
use Core\Response;
use Core\Validator;


$db = App::resolve(Database::class);
$currentUser = 3;

// Find the note
$note = $db->query("SELECT * FROM notes WHERE id = :id", ["id" => $_POST['id']])->findOrFail();

// Authorize
authorize($note['user_id'] === $currentUser);

// Validate
$errors = [];
if (!Validator::string($_POST['body'], 3, 1000)) {
    http_response_code(Response::BAD_REQUEST);
    $errors['body'] = 'A body cannot be more than 1,000 characters is required!';
}

if (! empty($errors)){
    return view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);
}

// Update
$db->query("UPDATE notes SET body = :body WHERE id = :id", 
["body" => $_POST['body'], "id" => $_POST['id']]);

// Redirect
header('location: /notes');
die();