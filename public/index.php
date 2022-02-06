<?php

require_once __DIR__ . '../../includes/app.php'; 


use MVC\Router;
use Controllers\LoginController;
use Controllers\PageController;
use Controllers\PanelController;
use Controllers\APIController;
$router = new Router();


//PAGES
$router->post('/', [PageController::class, 'index']);
$router->get('/', [PageController::class, 'index']);
$router->get('/inicio', [PageController::class, 'index']);
$router->post('/inicio', [PageController::class, 'index']);


//AUTH
$router->get('/login', [LoginController::class, 'auth']);
$router->post('/login', [LoginController::class, 'auth']);

$router->get('/registro', [LoginController::class, 'register']);
$router->post('/registro', [LoginController::class, 'register']);

//Send EMAIL request
$router->get('/recuperar-password', [LoginController::class, 'forgetPassword']); //OlvidePaswword
$router->post('/recuperar-password', [LoginController::class, 'forgetPassword']); //OlvidePaswword

$router->get('/recovery-password', [LoginController::class, 'recoveryPassword']); //
$router->post('/recovery-password', [LoginController::class, 'recoveryPassword']); //add new password


//PANEL
$router->get('/panel', [PanelController::class, 'index']); 
$router->post('/panel', [PanelController::class, 'index']); 


$router->get('/perfil', [PanelController::class, 'showPerfil']);
$router->post('/perfil', [PanelController::class, 'showPerfil']);


$router->get('/crear-proyecto', [PanelController::class, 'createProject']); 
$router->post('/crear-proyecto', [PanelController::class, 'createProject']); 

$router->get('/crear-tarea', [PanelController::class, 'createTask']); 
$router->post('/crear-tarea', [PanelController::class, 'createTask']); 


//debug("LEER DOCUMENTO WORD");

//API
$router->get('/api/proyects', [APIController::class, 'listProjects']);
$router->get('/api/tasks', [APIController::class, 'listTasks']);


$router->checkRutes();
