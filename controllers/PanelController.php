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
            $typeAlert = $Task->createTask($User, $Project->getProjects($User));
            if ($typeAlert) {
                $Task->setAlert("Tarea creado correctamente");
            } else {
                $Task->setAlert("Ups tenemos un problema con tu solicitud");
            }
        }
        $router->render('app/createTask', [
            'alerts' => Task::getAlerts(),
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

        $router->render('app/profile', [
            'user' => $user,
            'alerts' => Users::getAlerts(),
            'typeAlert' => $typeAlert,
        ]);
    }

    public static function Calendar(Router $router) {
        $router->render('app/calendar');
    }

    public static function showProjects(Router $router) {
        $router->render('app/projects');
    }

    public static function showProject(Router $router) {
        $router->render('app/project');
    }

    public static function showTasks(Router $router) {
        $router->render('app/tasks');
    }

    public static function showTask(Router $router) {
        $router->render('app/task');
    }

    public static function showFriends(Router $router) {
        $router->render('app/friends');
    }

    public static function editProfile(Router $router) {
        $router->render('app/edit_profile');
    }
}
