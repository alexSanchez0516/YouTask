<?php

namespace Controllers;

use MVC\Router;
use Model\Users;

class PanelController
{


    public static function index(Router $router)
    {
        $errors = [];

        $user = $_SESSION['user'];


        $router->render('app/panel', [
            'errors' => $errors,
        ]);
    }

    public static function showPerfil(Router $router)
    {
        $typeAlert = false;
        $user = $_SESSION['user'];
        $imgDelete = NULL;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($user->validateAttributes($_POST)) {
                $typeAlert = true;
                $user->username = $_POST['username'];
                $user->description = $_POST['description'];
                if (strlen($_FILES['avatar']['name']) > 0) {
                    if (strlen($user->avatar) > 0) { //Comprobamos si hay imagen
                        $imgDelete = $user->avatar;
                    }
                    $user->uploadImg($_FILES['avatar'], $imgDelete);
                }

                $user->save() ? $user->setAlert("Cambios guardados correctamente") : false;
            }
        }

        $router->render('app/perfil', [
            'user' => $user,
            'alerts' => Users::getAlerts(),
            'typeAlert' => $typeAlert,
        ]);
    }
}
