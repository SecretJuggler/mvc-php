<?php

use Core\Enums\StatusCodes;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = 404) 
{
    http_response_code($code);
    
    $errorPage = base_path("Views/StatusPages/$code.php");

    if (file_exists($errorPage)) {
        require $errorPage;
    } else {
        require view("StatusPages/error.php");
    }

    die();
}

function authorize($condition, $status = StatusCodes::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [], $layout = 'app-layout')
{
    extract($attributes);
    ob_start();
    require base_path('views/' . $path);
    $content = ob_get_clean();

    require base_path("views/layouts/{$layout}.php");
}

function generateRandomString($length = 8) 
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
}

function redirect($path) 
{
    header("location: {$path}");
    exit();
}

function old($key, $default = '')
{
    return Core\Session::get('old')[$key] ?? $default;
}