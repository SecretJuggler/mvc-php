<?php 

namespace Http\Controllers;

use Core\App;
use Core\Database;
use Services\MailService;

class Controller 
{
    protected $db;
    protected $mail;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
        $this->mail = App::resolve(MailService::class);
    }
}