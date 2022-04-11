<?php 

namespace Controllers;
use Model\Users;

use Model\Project;
use Model\Post;

use MVC\Router;

class APIController {
    public static function listProjects() {
        $projects = Project::find('adminID', 15, true);
        
        echo json_encode($projects);
        
    }

    public static function listTasks() {
        echo "desde api";
    }


    public static function listPosts() {
        $id = $_SESSION['user']; //id      
        echo json_encode(Post::getAllC($id, 0));

    }

    public static function deletePost() {
        $id = (int) filter_var((int) $_POST['id_element'], FILTER_SANITIZE_NUMBER_INT);
        $post = Post::find('id', $id,false);

        if ($post->delete()) {
            echo json_encode("Eliminado correctamente");
        } else {
            echo json_encode("No ha podido ser eliminado"); 
        }
    }


    public static function listFriends() {
        
        header("Access-Control-Allow-Origin: *");
     
        $user = Users::find('id', $_SESSION['user'], false);
        $countFriends = $user->getQuantityFriends();

        if ($countFriends == null){
            $countFriends = 0;
        }
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