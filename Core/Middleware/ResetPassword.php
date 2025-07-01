<?php 

namespace Core\Middleware;

class ResetPassword
{
    public function handle()
    {
        if (!$_SESSION['user'] ?? false) {
            header('location: /login');
            exit();
        }
    }
}