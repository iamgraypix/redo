<?php

$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

$router->get('/notes', 'notes/index.php')->only('auth');
$router->get('/note', 'notes/show.php')->only('auth');


$router->get('/note/edit', 'notes/edit.php')->only('auth');
$router->patch('/notes/update', 'notes/update.php')->only('auth');

$router->delete('/note', 'notes/destroy.php')->only('auth');

$router->get('/notes/create', 'notes/create.php')->only('auth');
$router->post('/notes', 'notes/store.php')->only('auth');

$router->get('/register', 'users/create.php')->only('guest');
$router->post('/register', 'users/store.php')->only('guest');

$router->get('/login', 'auth/create.php')->only('guest');
$router->post('/login', 'auth/store.php')->only('guest');

$router->delete('/logout', 'auth/destroy.php')->only('auth');