<?php

use Core\Session;
use Core\ValidationException;

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);

$dotenv->load();

session_start();

require BASE_PATH . 'Core/functions.php';

$config = require base_path('config.php');

$_SESSION['app_base_url'] = $config['app']['url'];

require base_path('bootstrap.php');

$router = new \Core\Router();

$routes = require base_path('web/routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    return redirect($router->previousUrl());
}

Session::unsetFlash();  