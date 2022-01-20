<?php

namespace Controllers;
use MVC\Router;
use Model\Users;

class PanelController {

    
    public static function index(Router $router) {
        $errors = [];

        $router->render('app/panel', [
            'errors' => $errors,
        ]);
    }
}