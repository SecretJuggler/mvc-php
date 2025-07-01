<?php

use Core\App;
use Core\Container;
use Core\Database;
use Services\MailService;

$container = new Container();

$container->bind('Core\Database', function () {
    $config = require base_path('config.php');

    return new Database($config['database']);    
});

$container->bind('Services\MailService', function () {
    $config = require base_path('config.php');

    return new MailService($config['mail']);
});

App::setContainer($container); 
