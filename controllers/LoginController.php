<?php

namespace Controllers;

use MVC\Router;
use Model\Users;
use Classes\Email;

class LoginController
{


    public static function auth(Router $router)
    {
        //BEGGINING VERIFICATION TOKEN
        if (!empty($_GET['token'])) {
            $token = filter_var($_GET['token'], FILTER_SANITIZE_STRING);
            $userToken = Users::find("token", $token);
            if ($userToken != null) {
                $userToken->validate = "1";
                $userToken->token = "";

                if ($userToken->save()) {
                    $userToken->setAlert("Tu Cuenta ha sido verificada con exito");
                } else {
                    $userToken->setAlert("Hay un error con la verificación, intentalo más tarde");
                }
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
            'alerts' => $userLogin->getAlerts(),
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
        $msg = NULL;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userRegister->synchronize($_POST);

            $validate = $userRegister->validateAttributes($_POST);

            if ($validate) {
                $userRegister = new Users($_POST);
                $userRegister->createToken();

                $email = new Email($userRegister->token, $userRegister->username, $userRegister->email);

                if ($email->sendConfirmation()) {
                    $userRegister->password = password_hash($userRegister->password, PASSWORD_BCRYPT);
                    if ($userRegister->save()) {
                        $msg = "Hemos enviado las intrucciones para confimar tu cuenta a tu e-mail";
                    } else {
                        $userRegister->setAlert('Solo puedes tener una cuenta por correo');
                    }
                }
            }
        }


        $router->render('auth/register', [
            'alerts' => $userRegister->getAlerts(),
            'user' => $userRegister,
            'msg' => $msg
        ]);
    }



    public static function forgetPassword(Router $router)
    {
        $typeAlert = false;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new Users($_POST);
            if ($validate = $user->validateAttributes($_POST)) {
                $user->sanitizeData();
                $user = $user->find("email", $user->email);
                if (!empty($user)) {
                    if ($user->validate === '1') {
                        $user->createToken();
                        $email = new Email($user->token, $user->username, $user->email);
                        if ($email->sendTokenRecovery()) {
                            $typeAlert = true;
                            $user->setAlert("Hemos enviado las intrucciones para confimar tu cuenta a tu e-mail");
                        }
                    } else {
                        $user->setAlert("Esta cuenta aun no ha sido verificada");
                    }
                    
                } else {
                    $user->setAlert("Este email no está registrado");
                }
            }
        }

        $router->render('auth/forgetPassword', [
            'alerts' => Users::getAlerts(),
            'typeAlert' => $typeAlert,
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
