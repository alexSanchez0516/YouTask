<?php

namespace Controllers;

use MVC\Router;
use Model\Users;

class LoginController
{


    public static function auth(Router $router)
    {
        $typeAlert = false;

        if ($_SESSION['auth']) {
            header('Location: /');
        }
        //BEGGINING VERIFICATION TOKEN
        if (!empty($_GET['token'])) {
            $token = filter_var(s($_GET['token']), FILTER_SANITIZE_STRING);
            $userToken = Users::find("token", $token, false);

            if (!empty($userToken)) {
                $typeAlert = $userToken->validateUser($typeAlert);
            } else {
                Users::setAlert("Token inválido");
            }
        }
        //END VERIFICATION TOKEN

        $userLogin = new Users();


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userLogin = new Users($_POST);
            $userLogin->login();
        }


        $router->render('auth/login', [
            'alerts' => Users::getAlerts(),
            'user' => $userLogin,
            'typeAlert' => $typeAlert
        ]);
    }

    public static function logout(Router $router)
    {
        Users::logout();
    }

    public static function register(Router $router)
    {
        $userRegister = new Users();
        $typeAlert = null;


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userRegister->synchronize($_POST);
            $typeAlert = $userRegister->createUser();
        }


        $router->render('auth/register', [
            'alerts' => $userRegister->getAlerts(),
            'user' => $userRegister,
            'typeAlert' => $typeAlert,
        ]);
    }



    public static function forgetPassword(Router $router)
    {
        $typeAlert = false;
        $user = new Users();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $typeAlert = $user->forgetPassword($typeAlert);
        }

        $router->render('auth/forgetPassword', [
            'alerts' => Users::getAlerts(),
            'typeAlert' => $typeAlert,
        ]);
    }

    public static function recoveryPassword(Router $router)
    {
        $typeAlert = Users::checkToken();

        if ($typeAlert) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $password = new Users($_POST);
                $user = $_SESSION['user'];
                session_destroy();

                $user->recoveryPassword($password, $typeAlert);
            }
        }


        $router->render('auth/recoveryPassword', [
            'alerts' => Users::getAlerts(),
            'typeAlert' => $typeAlert,
        ]);
    }
}
