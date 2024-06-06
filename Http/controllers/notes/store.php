<?php 

use Core\Database;
use Core\Validator;
use Core\Response;
use Core\App;
use Core\Session;
use Http\Forms\NoteForm;

$db = App::resolve(Database::class);

$body = $_POST['body'];

$form = NoteForm::validate([
    'body' => $body
]);

$db->query('INSERT INTO notes (body, user_id) VALUES(:body, :user)', [
    "body" => $body,
    "user" => Session::get('user')['id']
]);

redirect('/notes');