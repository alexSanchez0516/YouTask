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
$router->get('/salir', [LoginController::class, 'logout']);



//Send EMAIL request
$router->get('/recuperar-password', [LoginController::class, 'forgetPassword']); //OlvidePaswword
$router->post('/recuperar-password', [LoginController::class, 'forgetPassword']); //OlvidePaswword

$router->get('/recovery-password', [LoginController::class, 'recoveryPassword']); //
$router->post('/recovery-password', [LoginController::class, 'recoveryPassword']); //add new password


//PANEL
$router->get('/panel', [PanelController::class, 'index']);
$router->post('/panel', [PanelController::class, 'index']);

$router->get('/seguidores', [PanelController::class, 'showFriends']);
$router->post('/seguidores', [PanelController::class, 'showFriends']);


$router->get('/perfil', [PanelController::class, 'showPerfil']);
$router->post('/perfil', [PanelController::class, 'showPerfil']);


$router->get('/editar-perfil', [PanelController::class, 'editProfile']);
$router->post('/editar-perfil', [PanelController::class, 'editProfile']);



$router->get('/crear-proyecto', [PanelController::class, 'createProject']);
$router->post('/crear-proyecto', [PanelController::class, 'createProject']);

$router->get('/crear-tarea', [PanelController::class, 'createTask']);
$router->post('/crear-tarea', [PanelController::class, 'createTask']);

$router->get('/calendario', [PanelController::class, 'Calendar']);

$router->get('/proyectos', [PanelController::class, 'showProjects']);

$router->get('/proyecto', [PanelController::class, 'showProject']);

$router->get('/tareas', [PanelController::class, 'showTasks']);
$router->post('/tarea', [PanelController::class, 'showTask']);

//POST
$router->get('/posts', [PanelController::class, 'showPosts']);
$router->post('/posts', [PanelController::class, 'showPosts']);

$router->get('/post', [PanelController::class, 'showPost']);
$router->post('/post', [PanelController::class, 'showPost']);

$router->get('/crear-post', [PanelController::class, 'create_post']);
$router->post('/crear-post', [PanelController::class, 'create_post']);

$router->get('/modificar-post', [PanelController::class, 'update_post']);
$router->post('/modificar-post', [PanelController::class, 'update_post']);



$router->get('/actividad', [PanelController::class, 'showActivity']);


$router->get('/seguidor', [PanelController::class, 'showFriend']);
$router->post('/seguidor', [PanelController::class, 'showFriend']);


$router->get('/mensajes', [PanelController::class, 'showMessages']);
$router->post('/mensajes', [PanelController::class, 'showMessages']);


//API

$router->get('/api/posts', [APIController::class, 'listPosts']);
$router->post('/api/posts', [APIController::class, 'listPosts']);

$router->get('/api/post/delete', [APIController::class, 'deletePost']);
$router->post('/api/post/delete', [APIController::class, 'deletePost']);

$router->post('/api/post/update', [APIController::class, 'updatePost']);
$router->get('/api/post/update', [APIController::class, 'updatePost']);



$router->get('/api/friends', [APIController::class, 'listFriends']);
$router->post('/api/friends/delete', [APIController::class, 'deleteFriend']);
$router->post('/api/friends/update', [APIController::class, 'updateFriend']);

$router->get('/api/proyects', [APIController::class, 'listProjects']);
$router->get('/api/tasks', [APIController::class, 'listTasks']);

$router->get('/api/send_response_comment', [APIController::class, 'send_response_comment']);
$router->post('/api/send_response_comment', [APIController::class, 'send_response_comment']);


$router->post('/api/search-friends-for-name', [APIController::class, 'search_friends_for_name']);
$router->post('/api/send-resquest-friend', [APIController::class, 'send_resquest_friend']);



$router->get('/api/check-request-follower', [APIController::class, 'checkRequestFollower']);
$router->post('/api/check-request-follower', [APIController::class, 'checkRequestFollower']);


$router->post('/api/show-requests-followers', [APIController::class, 'getRequestsFollow']);
$router->get('/api/show-requests-followers', [APIController::class, 'getRequestsFollow']);


$router->post('/api/accept-follower', [APIController::class, 'acceptFollower']);
$router->post('/api/accept-reject', [APIController::class, 'RejectFollower']);



$router->get('/api/get-skills', [APIController::class, 'getAllSkills']);
$router->post('/api/check-skill', [APIController::class, 'checkSkill']);


$router->post('/api/create-skill', [APIController::class, 'createSkill']);


$router->post('/api/chat/app', [APIController::class, 'showChat']);


$router->checkRutes();
