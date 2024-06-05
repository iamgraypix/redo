<?php

namespace Core;

use Core\Middleware\Auth;
use Core\Middleware\Guest;
use Core\Middleware\Middleware;

class Router
{
    protected $routes = [];

    public function add($method, $url, $controller)
    {
        $this->routes[] = [
            'url' => $url,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];

        return $this;
    }

    public function only($key)
    {
       $this->routes[array_key_last($this->routes)]['middleware'] = $key;
       return $this;
    }

    public function get($url, $controller)
    {
       return $this->add('GET', $url, $controller);
    }

    public function post($url, $controller)
    {
        return $this->add('POST', $url, $controller);
    }

    public function put($url, $controller)
    {
        return $this->add('PUT', $url, $controller);
    }

    public function patch($url, $controller)
    {
        return $this->add('PATCH', $url, $controller);
    }

    public function delete($url, $controller)
    {
        return $this->add('DELETE', $url, $controller);
    }


    public function route($url, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['url'] === $url && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);
                return require base_path('http/controllers/' . $route['controller']);
            }
        }

        $this->abort();
    }

    public function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }

    function abort($code = 404)
    {
        http_response_code($code);
        require base_path("views/{$code}.view.php");
        die();
    }
}