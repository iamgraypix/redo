<?php

namespace Core\Middleware;

class Auth
{

    public function handle()
    {
        $session = $_SESSION['user'] ?? false;
        if (!$session) {
            header('location: /');
            die();
        }
    }
}
