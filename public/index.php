<?php

require_once __DIR__ . '../../includes/app.php'; 


use MVC\Router;
use Controllers\PageController;

$router = new Router();


//PAGES
$router->post('/', [PageController::class, 'index']);
$router->get('/', [PageController::class, 'index']);
$router->get('/inicio', [PageController::class, 'index']);
$router->post('/inicio', [PageController::class, 'index']);

$router->checkRutes();
