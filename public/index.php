<?php

require_once __DIR__ . '../../includes/app.php'; 


use MVC\Router;
use Controllers\LoginController;
use Controllers\PageController;
use Controllers\PanelController;
$router = new Router();


//PAGES
$router->post('/', [PageController::class, 'index']);
$router->get('/', [PageController::class, 'index']);
$router->get('/inicio', [PageController::class, 'index']);
$router->post('/inicio', [PageController::class, 'index']);


//Login
$router->get('/login', [LoginController::class, 'auth']);
$router->post('/login', [LoginController::class, 'auth']);

$router->get('/register', [LoginController::class, 'register']);
$router->post('/register', [LoginController::class, 'register']);

//Send EMAIL request
$router->get('/forget-password', [LoginController::class, 'forgetPassword']); //OlvidePaswword
$router->post('/forget-password', [LoginController::class, 'forgetPassword']); //OlvidePaswword

$router->get('/recovery-password', [LoginController::class, 'recoveryPassword']); //
$router->post('/recovery-password', [LoginController::class, 'recoveryPassword']); //add new password

$router->get('/panel', [PanelController::class, 'index']); 




$router->checkRutes();
