<?php 

class User extends Model 
{
    public $id;
    public $email;
    public $password;

    private $dbc;

    public function __construct($dbc)
    {
        $this->dbc = $dbc;
    }

    public function findByEmail($email) 
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute(['email' => $email]);

        $data = $stmt->fetch();
    }

    public function getUsers()
    {
        $stmt = "SELECT * from users";
        $sql = $this->dbc->prepare($stmt);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}