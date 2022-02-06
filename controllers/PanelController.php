<?php

namespace Controllers;

use MVC\Router;
use Model\Users;
use Model\Project;
use Model\Task;

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

    public static function createProject(Router $router)
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

        $router->render('app/createProject', [
            'alerts' => Project::getAlerts(),
            'typeAlert' => $typeAlert,
        ]);
    }

    public static function createTask(Router $router)
    {
        $Project = new Project();
        $Task = new Task();
        $User = $_SESSION['user'];
        $typeAlert = false;


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $Task->synchronize($_POST);
            if ($Task->createTask($User, $Project->getProjects($User))) {
                $typeAlert = true;
                $Task->setAlert("Proyecto creado correctamente");
            } else {
                $Task->setAlert("Ups tenemos un problema con tu solicitud");
            }
        }
        $router->render('app/createTask', [
            'alerts' => Project::getAlerts(),
            'typeAlert' => $typeAlert,
            'projects' => $Project->getProjects($User)
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
