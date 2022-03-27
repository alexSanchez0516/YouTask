<?php 

namespace Controllers;
use Model\Users;

use Model\Project;

use MVC\Router;

class APIController {
    public static function listProjects() {
        $projects = Project::find('adminID', 15, true);
        
        echo json_encode($projects);
        
    }

    public static function listTasks() {
        echo "desde api";
    }

    public static function listFriends() {
        
        header("Access-Control-Allow-Origin: *");
     
        $user = Users::find('id', $_SESSION['user'], false);
        $countFriends = $user->getQuantityFriends();
        $response = [$countFriends, $user->getFriends()];
        
        echo json_encode($response);
    }

    public static function deleteFriend() {
        $user = Users::find('id', $_SESSION['user'], false);
        $id = (int) filter_var((int) $_POST['id_element'], FILTER_SANITIZE_NUMBER_INT);
        

        if($user->deleteFriend($id)) {
            echo json_encode("Eliminado correctamente");
        } else {
            echo json_encode("no ha podido ser eliminado");
        }

    }
}