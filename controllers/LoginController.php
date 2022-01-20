<?php

namespace Controllers;
use MVC\Router;
use Model\Users;

class LoginController {


    public static function auth(Router $router) {
        $errors = ['s'];
        $userLogin = new Users();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userLogin = new Users($_POST);
            $userLogin->login();
            //$errors = $userLogin->getErrors();
        }

        $router->render('auth/login', [
            'errors' => $errors,
            'user' => $userLogin
        ]);
    }

    public static function logout(Router $router) {
        Users::logout();   
    }

    public static function register(Router $router) {
        $errors = [];

        $userRegister = new Users();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userRegister = new Users($_POST);
            
            if ($userRegister->register()) {
                header('Location: /panel');
            } else {
                $errors[] = 'Solo puedes tener una cuenta por correo';
            }


        }

        $router->render('auth/register', [
            'errors' => $errors,
            'user' => $userRegister
        ]);
    }

    public static function forgetPassword(Router $router) {
        $errors = [];

        $router->render('auth/forgetPassword', [
            'errors' => $errors,
        ]);
    }

    public static function recoveryPassword(Router $router) {
        $errors = [];

        $router->render('auth/recoveryPassword', [
            'errors' => $errors,
        ]);
    }

}