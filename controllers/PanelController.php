<?php

namespace Controllers;
use MVC\Router;
use Model\Users;

class PanelController {

    
    public static function index(Router $router) {
        $errors = [];
        
        $user = $_SESSION['user'];

       
        $router->render('app/panel', [
            'errors' => $errors,
        ]);
    }

    public static function showPerfil(Router $router) {

        $user = $_SESSION['user'];

       
        $router->render('app/perfil', [
            'user' => $user
        ]);
    }
}