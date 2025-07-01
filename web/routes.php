<?php

use Http\Controllers\AuthenticationController;
use Http\Controllers\ClientsController;
use Http\Controllers\DashboardController;
use Http\Controllers\UsersController;

$router->get('/login', [AuthenticationController::class, 'login'])->only('guest');
$router->post('/auth/login', [AuthenticationController::class, 'handleLogin'])->only('guest');

$router->get('/logout', [AuthenticationController::class, 'logout'])->only('auth');
$router->delete('/logout', [AuthenticationController::class, 'logout'])->only('auth');

$router->get('/reset-password', [AuthenticationController::class, 'resetPassword'])->only('reset-password');
$router->patch('/reset-password', [AuthenticationController::class, 'handleResetPassword'])->only('reset-password');

$router->get('/', [DashboardController::class, 'index'])->only('auth');

$router->get('/users', [UsersController::class, 'index'])->only('auth');
$router->get('/users/create', [UsersController::class, 'create'])->only('auth'); 
$router->post('/users/create', [UsersController::class, 'store'])->only('auth'); 
$router->get('/user', [UsersController::class, 'show'])->only('auth'); 
$router->get('/user/edit', [UsersController::class, 'edit'])->only('auth'); 
$router->patch('/user', [UsersController::class, 'update'])->only('auth'); 
$router->delete('/user', [UsersController::class, 'delete'])->only('auth'); 

$router->get('/clients', [ClientsController::class, 'index'])->only('auth');
$router->get('/clients/create', [ClientsController::class, 'create'])->only('auth'); 
$router->post('/clients/create', [ClientsController::class, 'store'])->only('auth'); 
$router->get('/client', [ClientsController::class, 'show'])->only('auth'); 
$router->get('/client/edit', [ClientsController::class, 'edit'])->only('auth'); 
$router->patch('/client', [ClientsController::class, 'update'])->only('auth'); 
$router->delete('/client', [ClientsController::class, 'delete'])->only('auth'); 