<?php 

namespace Core\Middleware;

class Auth
{
    public function handle()
    {
        if (!$_SESSION['user'] ?? false) {
            header('location: /login');
            exit();
        }

        if ($_SESSION['reset_password'] ?? false) {
            header('location: /reset-password');
            exit();
        }
    }
}