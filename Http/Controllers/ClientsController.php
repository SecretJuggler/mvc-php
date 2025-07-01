<?php 

namespace Http\Controllers;

use Core\Session;
use Services\ValidatorService;

class ClientsController extends Controller
{
    public function index()
    {
        $clients = $this->db->query("
            SELECT 
                clients.*, 
                users.first_name AS user_first_name, 
                users.last_name AS user_last_name
            FROM clients
            LEFT JOIN users ON users.id = clients.user_id
        ")->get();

        return view('Clients/index.view.php', [
            'clients' => $clients
        ]);
    }

    public function create()
    {
        $users = $this->db->query("select * from users")->get();

        return view('Clients/create.view.php', [
            'users' => $users
        ]);
    }

    public function store()
    {
        $errors = [];

        $rules = [
            'name' => 'required|string|min:2|max:255',
        ];

        $errors = ValidatorService::validate($_POST, $rules);

        if (!empty($errors)) {
            return view('Clients/create.view.php', [
                'errors' => $errors,
            ]);
        }

        $this->db->query("INSERT INTO clients (name, user_id) VALUES(:name, :user_id)", [
            'name' => $_POST['name'],
            'user_id' => $_POST['user_id']
        ]);

        Session::flash('success', 'Client created successfully.');
    
        header('location: /clients');
        die();
    }

    public function show()
    {
         $client = $this->db->query("
            SELECT 
                clients.*, 
                users.first_name AS user_first_name, 
                users.last_name AS user_last_name
            FROM clients
            LEFT JOIN users ON users.id = clients.user_id
            WHERE clients.id = :id
        ", ['id' => $_GET['id']])->findOrFail();

        return view('Clients/show.view.php', [
            'heading' => 'Client',
            'client' => $client
        ]);
    }

    public function edit()
    {
        $client = $this->db->query("select * from clients where id = :id", ['id' => $_GET['id']])->findOrFail();

        $users = $this->db->query("select * from users")->get();

        return view('Clients/edit.view.php', [
            'heading' => 'Client',
            'client' => $client,
            'errors' => [],
            'users' => $users
        ]);
    }

    public function update()
    {
        $errors = [];

        $client = $this->db->query("select * from clients where id = :id", [
            'id' => $_POST['id']])->findOrFail();

        $rules = [
            'name' => 'required|string|min:2|max:255',
            'user_id' => 'required',
        ];

        $errors = ValidatorService::validate($_POST, $rules);

        if (!empty($errors)) {
            return view('Clients/edit.view.php', [
                'errors' => $errors,
                'client' => $client
            ]);
        }

        $this->db->query('update clients set name = :name, user_id = :user_id where id = :id', [
            'name' => $_POST['name'],
            'id' => $_POST['id'],
            'user_id' => $_POST['user_id']
        ]);

        Session::flash('success', 'Client updated successfully.');
    
        header('location: /clients');
        die();
    }

    public function delete()
    {
        $client = $this->db->query("select * from clients where id = :id", [
            'id' => $_POST['id']])->findOrFail();

        $this->db->query("delete from clients where id = :id", [
            'id' => $_POST['id']
        ]);

        header('location: /clients');
        die();
    }

}   