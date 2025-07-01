<?php 

namespace Http\Controllers;

use Core\Session;
use Services\ValidatorService;

class UsersController extends Controller
{
    public function index()
    {
        $currentUserId = 1;

        $users = $this->db->query("select * from users")->get();

        return view('Users/index.view.php', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('Users/create.view.php');
    }

    public function store()
    {
        $errors = [];

        $rules = [
            'first_name' => 'required|string|min:2|max:100',
            'last_name'  => 'required|string|min:2|max:100',
            'email'      => 'required|email|max:255',
        ];

        $errors = ValidatorService::validate($_POST, $rules);

        if (!empty($errors)) {
            return view('Users/create.view.php', [
                'errors' => $errors,
            ]);
        }

        $user = $this->db->query('SELECT * from USERS where email = :email', [
            'email' => $_POST['email']
        ])->find(); 

        if ($user) {
            return view('Users/create.view.php', [
                'errors' => ['email' => 'User already exists with this email'],
                'user' => $_POST
            ]);
        }
        $newPassword = generateRandomString();

        $this->db->query("INSERT INTO users (first_name, last_name, email, password) VALUES(:first_name, :last_name, :email, :password)", [
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
            'password' => password_hash($newPassword, PASSWORD_BCRYPT),
        ]); 
        
        $this->mail->sendTemplateEmail(
            $_POST['email'],
            'Welcome to our app!',
            'welcome',
            [
                'name' => $_POST['first_name'],
                'email' => $_POST['email'],
                'password' => $newPassword
            ]
        );

        Session::flash('success', 'User created successfully and a welcome has been sent to the user.');
    
        header('location: /users');
        die();
    }

    public function show()
    {
        $user = $this->db->query("select * from users where id = :id", ['id' => $_GET['id']])->findOrFail();

        return view('Users/show.view.php', [
            'heading' => 'User',
            'user' => $user
        ]);
    }

    public function edit()
    {
        $user = $this->db->query("select * from users where id = :id", ['id' => $_GET['id']])->findOrFail();

        return view('Users/edit.view.php', [
            'heading' => 'User',
            'user' => $user,
            'errors' => []
        ]);
    }

    public function update()
    {
        $errors = [];

        $user = $this->db->query("select * from users where id = :id", [
            'id' => $_POST['id']])->findOrFail();

        $rules = [
            'first_name' => 'required|string|min:2|max:100',
            'last_name'  => 'required|string|min:2|max:100',
            'email'      => 'required|email|max:255',
        ];

        $errors = ValidatorService::validate($_POST, $rules);

        if (!empty($errors)) {
            return view('Users/edit.view.php', [
                'errors' => $errors,
                'user' => $user
            ]);
        }

        $this->db->query('update users set first_name = :first_name, last_name = :last_name, email = :email where id = :id', [
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
            'id' => $_POST['id']
        ]);

        Session::flash('success', 'User updated successfully.');
    
        header('location: /users');
        die();
    }

    public function delete()
    {
        $user = $this->db->query("select * from users where id = :id", [
            'id' => $_POST['id']])->findOrFail();

        $this->db->query("delete from users where id = :id", [
            'id' => $_POST['id']
        ]);

        header('location: /users');
        die();
        
    }
}   