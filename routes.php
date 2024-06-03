<?php

$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

$router->get('/notes', 'controllers/notes/index.php')->only('auth');
$router->get('/note', 'controllers/notes/show.php')->only('auth');


$router->get('/note/edit', 'controllers/notes/edit.php')->only('auth');
$router->patch('/notes/update', 'controllers/notes/update.php')->only('auth');

$router->delete('/note', 'controllers/notes/destroy.php')->only('auth');

$router->get('/notes/create', 'controllers/notes/create.php')->only('auth');
$router->post('/notes', 'controllers/notes/store.php')->only('auth');

$router->get('/register', 'controllers/users/create.php')->only('guest');
$router->post('/register', 'controllers/users/store.php')->only('guest');