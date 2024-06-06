<?php

use Core\Database;
use Core\App;

$db = App::resolve(Database::class);
$currentUser = $_SESSION['user']['id'];


$note = $db->query("SELECT * FROM notes WHERE id = :id", ["id" => $_POST['id']])->findOrFail();
authorize($note['user_id'] === $currentUser);

$db->query("DELETE FROM notes WHERE id = :id", ['id' => $_POST['id']]);

redirect('/notes');