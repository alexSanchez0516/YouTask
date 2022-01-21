<?php

namespace Controllers;

use MVC\Router;
use Model\Users;

class LoginController
{


    public static function auth(Router $router)
    {
        $userLogin = new Users();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userLogin = new Users($_POST);
            $userLogin->login();
        }

        $router->render('auth/login', [
            'errors' => $userLogin->getErrors(),
            'user' => $userLogin
        ]);
    }

    public static function logout(Router $router)
    {
        Users::logout();
    }

    public static function register(Router $router)
    {
        $userRegister = new Users();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $userRegister->synchronize($_POST);

            $validate = $userRegister->validateAttributes($_POST);
            
            if ($validate) {
                if (trim($_POST['repeatPassword']) == $userRegister->password) {
                    $userRegister = new Users($_POST);

                    if ($userRegister->register()) {
                        header('Location: /login?state=1');
                    } else {
                        $userRegister->setError('Solo puedes tener una cuenta por correo');
                    }
                } else {
                    $userRegister->setError("No coinciden las contraseñas");
                }
            } 
        }
    

        $router->render('auth/register', [
            'errors' => $userRegister->getErrors(),
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
