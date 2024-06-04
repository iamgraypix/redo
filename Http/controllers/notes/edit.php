<?php

use Core\Database;
use Core\App;

$db = App::resolve(Database::class);
$currentUser = 3;


$note = $db->query("SELECT * FROM notes WHERE id = :id", ["id" => $_GET['id']])->findOrFail();

authorize($note['user_id'] === $currentUser);


view('notes/edit.view.php', [
    'heading' => 'Edit Note',
    'note' => $note
]);
