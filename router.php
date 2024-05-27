<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = require 'routes.php';

function abort($code = 404)
{
    http_response_code($code);
    require "views/{$code}.view.php";
    die();
}

function routeToController($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        abort();
    }
}

routeToController($uri, $routes);
