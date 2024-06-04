<?php 

namespace Core;

class Authenticator
{
    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)->query("SELECT * FROM users WHERE email = :email", ['email' => $email])->find();
        
        if ($user && password_verify($password, $user['password'])){
            return true;
        }

        return false;
    }
}