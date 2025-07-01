<?php 

namespace Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.view.php', [
            'user' => $_SESSION['user']
        ]);
    }

    public function handleLogin()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->db->query('SELECT * FROM users WHERE email = :email AND password = :password', [
            'email' => $email,
            'password' => $password
        ])->find();

        if ($user) {
            $_SESSION['user'] = [
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'email' => $email
            ];
            header('location: /');
            exit();
            
        } else {
            header('location: /');
            exit();
        }
    }
}