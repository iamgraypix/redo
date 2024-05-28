<?php

$heading = 'My Notes';

$config = require 'config.php';
$db = new Database($config['database']);


$notes = $db->query("SELECT * FROM notes WHERE user_id = :user", ["user" => 3])->get();


require 'views/notes/index.view.php';
