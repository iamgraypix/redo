<?php

use Core\Response;
use Core\Session;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    die();
    echo "</pre>";
}

function urlIs($value)
{
    return  $_SERVER['REQUEST_URI'] === $value;
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }
}

function abort($code = 404)
{
    http_response_code($code);
    require base_path("views/{$code}.view.php");
    die();
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);
    require base_path('views/' . $path);
}

function login($user)
{
    $_SESSION['user'] = [
        'id' => $user['id'],
        'email' => $user['email']
    ];

    session_regenerate_id(true);
}

function logout()
{
    Session::destroy();
}

function redirect($path)
{
    header("location: {$path}");
    die();
}

function old($key, $default = '')
{
    return Session::get('old')[$key] ?? $default;
}

function errors($field, $default = '')
{
    return Session::get('errors')[$field] ?? $default;
}
