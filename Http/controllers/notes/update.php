<?php 
use Core\App;
use Core\Database;
use Core\Response;
use Core\Validator;
use Http\Forms\NoteForm;


$db = App::resolve(Database::class);
$currentUser = $_SESSION['user']['id'];

// Find the note
$note = $db->query("SELECT * FROM notes WHERE id = :id", ["id" => $_POST['id']])->findOrFail();

// Authorize
authorize($note['user_id'] === $currentUser);

// Validate
$form = NoteForm::validate([
    'body' => $_POST['body']
]);


// Update
$db->query("UPDATE notes SET body = :body WHERE id = :id", 
["body" => $_POST['body'], "id" => $_POST['id']]);

// Redirect
redirect('/notes');