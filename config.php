<?php 

return [
    'database' => [
        'host' => $_ENV['DB_HOST'],
        'port' => $_ENV['DB_PORT'],
        'dbname' => $_ENV['DB_NAME'],
        'user' => $_ENV['DB_USERNAME'],
        'password' => $_ENV['DB_PASSWORD']
    ],
    'settings' => [
        'folder' => parse_url($_SERVER['REQUEST_URI'])['path']
    ],
    'mail' => [
        'host' => $_ENV['MAIL_HOST'],
        'username' => $_ENV['MAIL_USERNAME'],
        'password' => $_ENV['MAIL_PASSWORD'],
        'port' => $_ENV['MAIL_PORT'],
        'encryption' => PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS,
        'from_email' => $_ENV['MAIL_FROMADDRESS'],
        'from_name' => $_ENV['MAIL_FROMNAME'],
    ],
    'app' => [
        'url' => 'http://localhost:8888/'
    ]
];