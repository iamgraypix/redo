<?php

$heading = 'Note';

$config = require 'config.php';
$db = new Database($config['database']);
$currentUser = 3;

$note = $db->query("SELECT * FROM notes WHERE id = :id", ["id" => $_GET['id']])->fetch();

if (!$note) {
    abort();
}

if ($note['user_id'] !== $currentUser) {
    abort(Response::FORBIDDEN);
}


require 'views/note.view.php';
