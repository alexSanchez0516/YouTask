<?php

namespace Controllers;

use MVC\Router;
use Model\Users;
use Model\Project;

class PanelController
{


    public static function index(Router $router)
    {
        $project = new Project();
        $user = $_SESSION['user'];
        $typeAlert = false;

      

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $project->synchronize($_POST);
            if ($project->createProject($user)) {
                $typeAlert = true;
                $project->setAlert("Proyecto creado correctamente");
            } else {
                $project->setAlert("Web fuera de servicio temporalmente");
            }
            
        }


        $router->render('app/panel', [
            'user' => $user,
            'alerts' => Project::getAlerts(),
            'typeAlert' => $typeAlert,
            'projects' => $project->getProjects($user)

        ]);
    }

    public static function createProject(Router $router) {
        $router->render('app/createProject', [
            'alerts' => Project::getAlerts(),
            'typeAlert' => false
        ]);
    }



    public static function showPerfil(Router $router)
    {
        $typeAlert = false;
        $user = $_SESSION['user'];
        $imgDelete = NULL;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $typeAlert = $user->alterUser($typeAlert);
        }

        $router->render('app/perfil', [
            'user' => $user,
            'alerts' => Users::getAlerts(),
            'typeAlert' => $typeAlert,
        ]);
    }
}
