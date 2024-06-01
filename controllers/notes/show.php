<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);
$currentUser = 3;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $note = $db->query("SELECT * FROM notes WHERE id = :id", ["id" => $_GET['id']])->findOrFail();
    authorize($note['user_id'] === $currentUser);

    $db->query("DELETE FROM notes WHERE id = :id", ['id' => $_POST['id']]);

    header('location: /notes');

} else {
    $note = $db->query("SELECT * FROM notes WHERE id = :id", ["id" => $_GET['id']])->findOrFail();

    authorize($note['user_id'] === $currentUser);


    view('notes/show.view.php', [
        'heading' => 'Note',
        'note' => $note
    ]);
}
