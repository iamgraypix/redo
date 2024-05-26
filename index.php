<?php

require 'functions.php';
require 'Database.php';
// require 'router.php';

$config = require 'config.php';

$db = new Database($config['database']);

$id = $_GET['id'];

$posts = $db->query("select * from posts where id = :id", 
["id" => $id])->fetchAll();

foreach ($posts as $post) {
    echo "<li>{$post['title']}</li>";
}
