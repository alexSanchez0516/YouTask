<?php

namespace Controllers;

use MVC\Router;
use Model\Users;
use Classes\Email;

class LoginController
{


    public static function auth(Router $router)
    {
        $typeAlert = false;

        //BEGGINING VERIFICATION TOKEN
        if (!empty($_GET['token'])) {
            $token = filter_var(s($_GET['token']), FILTER_SANITIZE_STRING);
            $userToken = Users::find("token", $token);
            if ($userToken != null) {
                $userToken->validate = "1";
                $userToken->token = "";

                if ($userToken->save()) {
                    $typeAlert = true;
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
        $typeAlert = false;


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userRegister->synchronize($_POST);

            $validate = $userRegister->validateAttributes($_POST);

            if ($validate) {
                $userRegister = new Users($_POST);
                $userRegister->createToken();

                $email = new Email($userRegister->token, $userRegister->username, $userRegister->email);

                $userRegister->password = password_hash($userRegister->password, PASSWORD_BCRYPT);
                if ($userRegister->save()) {
                    if ($email->sendConfirmation()) {
                        $typeAlert = true;
                    } else {
                        $userRegister->setAlert("Lo sentimos estamos teniendo un problema técnico, inténtalo más tarde");
                        $typeAlert = false;;
                    }

                    $userRegister->setAlert("Hemos enviado las intrucciones para confimar tu cuenta a tu e-mail");
                } else {
                    $userRegister->setAlert('Solo puedes tener una cuenta por correo');
                }
            }
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

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new Users($_POST);
            if ($validate = $user->validateAttributes($_POST)) {
                $user->sanitizeData();
                $user = $user->find("email", $user->email);
                if (!empty($user)) {
                    if ($user->validate === '1') {
                        $user->createToken();
                        $email = new Email($user->token, $user->username, $user->email);
                        if ($user->save() && $email->sendTokenRecovery()) {
                            $typeAlert = true;
                            $user->setAlert("Hemos enviado las intrucciones para confimar tu cuenta a tu e-mail");
                        } else {
                            $user->setAlert("Lo sentimos estamos teniendo un problema técnico, inténtalo más tarde");
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
        $typeAlert = false;

        $token = filter_var(s($_GET['token'] ?? null), FILTER_SANITIZE_STRING);
        $user = NULL;

        if (!empty($token)) {
            $typeAlert = true;
            $user = Users::find('token', $token);

            if (!empty($user)) {
                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['user'] = $user;
            } else {
                $typeAlert = false;
                Users::setAlert("Token is invalid");
            }
        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $password = new Users($_POST);
            $user = $_SESSION['user'];
            session_destroy();


            if ($password->validateAttributes($_POST)) {
                $password->sanitizeData();
                $user->password = '';
                $user->token = '';


                $password->password = password_hash($password->password, PASSWORD_BCRYPT);
                $user->password = $password->password;
                if ($user->save()) {
                    $user->setAlert("Tu contraseña ha sido cambiada con éxito");
                    header('Location: /login');
                }
            }
        }




        $router->render('auth/recoveryPassword', [
            'alerts' => Users::getAlerts(),
            'typeAlert' => $typeAlert,
        ]);
    }
}
