<?php

namespace Controllers;

use MVC\Router;
use Model\Users;

class LoginController
{


    public static function auth(Router $router)
    {
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

    public static function logout(Router $router)
    {
        Users::logout();
    }

    public static function register(Router $router)
    {
        $errors = [];
        $valid = true;
        $userRegister = new Users();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            foreach ($_POST as $key => $value) {
                $_POST[$key] = trim($value);


                if (strlen($_POST[$key]) < 5) {
                    $valid = false;

                    if ($key == 'password') {
                        $errors[] = 'La contraseña debe tener minimo 5 carácteres';
                    }
                    if ($key == 'email') {
                        $errors[] = 'Correo inválido';
                    }
                    if ($key == 'username') {
                        $errors[] = 'Tu usuario debe tener minimo 5 carácteres';
                    }
                }
            }
            $userRegister->synchronize($_POST);


            if ($valid) {
                if ($_POST['repeatPassword'] == $_POST['password']) {
                    $userRegister = new Users($_POST);

                    if ($userRegister->register()) {
                        header('Location: /login?state=1');
                    } else {
                        $errors[] = 'Solo puedes tener una cuenta por correo';
                    }
                } else {
                    $errors[] = "No coinciden las contraseñas";
                }
            } 
        }

        $router->render('auth/register', [
            'errors' => $errors,
            'user' => $userRegister
        ]);
    }

    public static function forgetPassword(Router $router)
    {
        $errors = [];

        $router->render('auth/forgetPassword', [
            'errors' => $errors,
        ]);
    }

    public static function recoveryPassword(Router $router)
    {
        $errors = [];

        $router->render('auth/recoveryPassword', [
            'errors' => $errors,
        ]);
    }
}
