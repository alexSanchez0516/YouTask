<?php 

namespace Controllers;

use Model\Project;

use MVC\Router;

class APIController {
    public static function listProjects() {
        $projects = Project::find('adminID', 15);
        
        echo json_encode($projects);
        
    }

    public static function listTasks() {
        echo "desde api";
    }
}