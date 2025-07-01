<?php 

namespace Http\Controllers;

use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;
use Services\ValidatorService;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('Authentication/login.view.php', [
            'errors' => Session::get('errors')
        ], 'auth-layout');
    }

    public function handleLogin()
    {
        $form = LoginForm::validate($attributes = [
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ]);

        $loggedIn = new Authenticator()->attempt(
            $attributes['email'], $attributes['password']
        );

        if (!$loggedIn) {
            $form->addError(
                'email', 'No matching account found for that email address and password'
                )->throw();
        }

        redirect('/');
    }

    public function resetPassword()
    {
        return view('Authentication/reset-password.view.php', [
            'user' => $_SESSION['user']
        ], 'auth-layout');
    }

    public function handleResetPassword()
    {
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        $errors = [];

        $rules = [
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|same:password|min:8'
        ];

        $messages = [
            'password.required' => 'Please provide a valid password.',
            'confirm_password.required' => 'Please confirm the password.',
            'confirm_password.same' => 'Passwords do not match.',
        ];

        $errors = ValidatorService::validate($_POST, $rules, $messages);

        if (!empty($errors)) {
            return view('Authentication/reset-password.view.php', [
                'errors' => $errors
            ], 'auth-layout');
        }

        $user = $this->db->query('SELECT * FROM users WHERE id = :id', [
            'id' => $_SESSION['user']['id']
        ])->find();

        if ($user) {
            $this->db->query("UPDATE users set password = :password, reset_password = :reset_password WHERE id = :id", [
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'reset_password' => 0,
                'id' => $user['id']
            ]);

            unset($_SESSION['reset_password']);

            header('location: /');
            exit();
        }     
    }

    public function logout()
    {
        Session::destroy();
        header('location: /');
        exit();

    }
}