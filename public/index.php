<?php

use Core\Session;
use Core\ValidationException;

session_start();

const BASE_PATH = __DIR__ . '../../';
require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {
    require base_path("{$class}.php");
});

require base_path('boostrap.php');

$router = new Core\Router();

require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];


try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    Session::flash('errors',$exception->errors);
    Session::flash('old', $exception->attributes);
    redirect($router->previousUrl());
}


Session::unflash();
