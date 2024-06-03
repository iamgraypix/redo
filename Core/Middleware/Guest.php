<?php

namespace Core\Middleware;

class Guest
{

    public function handle()
    {
        $session = $_SESSION['user'] ?? false;
        if ($session) {
            header('location: /');
            die();
        }
    }
}
