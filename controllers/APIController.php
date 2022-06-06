<?php

namespace Controllers;

use Model\Users;

use Model\Project;
use Model\Post;
use Model\Comment;
use Model\Paginator;

use MVC\Router;

class APIController
{
    public static function listProjects()
    {
        header("Access-Control-Allow-Origin: *");

        $projects = Project::find('adminID', 15, true);

        echo json_encode($projects);
    }
    public static function send_resquest_friend()
    {
        header("Access-Control-Allow-Origin: *");

        $receiver = $_POST["receiver"];

        $response = Users::sendRequestFriend($receiver) ? "Enviado correctamente" : "Ya tienes una solicitud pendiente";

        echo json_encode($response);
    }



    public static function listTasks()
    {
        echo "desde api";
    }


    public static function listPosts()
    {
        header("Access-Control-Allow-Origin: *");

        $id = $_SESSION['user'];
        echo json_encode(Post::getAllC($id, 0));
    }



    public static function deletePost()
    {
        header("Access-Control-Allow-Origin: *");

        $id = (int) filter_var((int) $_POST['id_element'], FILTER_SANITIZE_NUMBER_INT);
        $post = Post::find('id', $id, false);

        if ($post->delete()) {
            echo json_encode("Eliminado correctamente");
        } else {
            echo json_encode("No ha podido ser eliminado");
        }
    }


    public static function listFriends()
    {

        header("Access-Control-Allow-Origin: *");
        $user = Users::find('id', $_SESSION['user'], false);
        $countFriends = $user->getQuantityFriends();

        if ($countFriends == null) {
            $countFriends = 0;
        }
        $response = [$countFriends, $user->getFriends()];

        echo json_encode($response);
    }


    public static function showChat()
    {
        $sender = $_SESSION['user'];
        $receiver = $_POST['idSelected'];

        $query = "select id, sender, receiver, msg, create_at,  if (group_chat = null, 1, 0 ) as isGroup, if (sender = $sender, 1,0) as isSender from chat where (sender = $sender or receiver = $sender) and (receiver = $receiver or sender = $receiver) ORDER BY create_at desc";
        echo json_encode(Users::getAnyQueryResult($query));
    }

    public static function deleteFriend()
    {
        header("Access-Control-Allow-Origin: *");

        $user = Users::find('id', $_SESSION['user'], false);
        $id = (int) filter_var((int) $_POST['id_element'], FILTER_SANITIZE_NUMBER_INT);


        if ($user->deleteFriend($id)) {
            echo json_encode("Eliminado correctamente");
        } else {
            echo json_encode("no ha podido ser eliminado");
        }
    }

    public static function show_comments()
    {
        header("Access-Control-Allow-Origin: *");

        $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        $post = Post::find('id', $id, false);
        $quantity = $post->getQuantityComments();
        $comment = new Comment();
        $typeAlert = true;
        $data = array();
        $comments = $comment->find('post_id', $post->id, true);
    }

    public static function search_friends_for_name()
    {
        header("Access-Control-Allow-Origin: *");

        $username =   s($_POST['search']);
        if (true) {
            echo json_encode(Users::findLike('username',  $username, true));
        } else {

            Users::setAlert("Datos de entrada inválidos");
            echo json_encode("No hay coincidencias");
        }
    }

    public static function checkRequestFollower()
    {
        header("Access-Control-Allow-Origin: *");

        $transmitter = $_SESSION['user'];
        $receiver = $_POST['id'];
        $query = "SELECT id, isAccept from requests_friends where (receiver = $receiver and transmitter = $transmitter) OR (transmitter = $receiver and receiver = $transmitter)";
        echo json_encode(Users::getAnyQuery($query));
    }




    public static function send_response_comment()
    {
        header("Access-Control-Allow-Origin: *");

        $comment = new Comment($_POST);
        $comment->comment_response = (int) $_POST['id_comment_response'];
        $comment->user_id = (int) $_SESSION['user'];

        echo json_encode($comment);

        if ($comment->createC()) {
            Comment::setAlert("Creado con exito");
            echo json_encode("creado con exito");
        } else {
            echo json_encode("no pudo ser creado");
        }
    }

    public static function getRequestsFollow()
    {
        header("Access-Control-Allow-Origin: *");

        $current_user = (int) $_SESSION['user'];

        $query = "select requests_friends.id as id_request, username, users.id from requests_friends ";
        $query .= "inner join users on transmitter = users.id ";
        $query .= "where receiver = $current_user and (isAccept = 0 or isAccept is null)  ";
        $query .= "order by create_at desc";



        echo json_encode(Users::getAnyQueryResult($query));
    }

    public static function acceptFollower()
    {
        header("Access-Control-Allow-Origin: *");

        $id_request = filter_var($_POST['id_request'], FILTER_VALIDATE_INT);
        $query = "update requests_friends SET isAccept = 1 ";
        $query .= "where id = $id_request LIMIT 1";


        echo json_encode(Users::insertAny($query));
    }

    public static function RejectFollower()
    {
        header("Access-Control-Allow-Origin: *");

        $id_request = filter_var($_POST['id_request'], FILTER_VALIDATE_INT);
        $query = "delete from requests_friends ";
        $query .= "where id = $id_request LIMIT 1";


        echo json_encode(Users::insertAny($query));
    }

    public static function getAllSkills()
    {
        header("Access-Control-Allow-Origin: *");

        $query = "select * from skills";
        echo json_encode(Users::getAnyQueryResult($query));
    }

    public static function checkSkill()
    {
        header("Access-Control-Allow-Origin: *");

        $skill = $_POST['skill'];

        $query = "SELECT id FROM skill_users where id_skill = $skill";
        echo json_encode(Users::getAnyQuery($query));
    }

    public static function createSkill()
    {
        header("Access-Control-Allow-Origin: *");

        $skill = filter_var(s($_POST['skill']));
        $query = "INSERT INTO skills (name) VALUES ('$skill')";
        try {
            Users::insertAny($query);
            echo json_encode(true);
        } catch (\Throwable $th) {
            echo json_encode(false);
        }
    }

    public static function sendMessage()
    {
        header("Access-Control-Allow-Origin: *");
        $sender = $_SESSION['user'];
        $receiver = $_POST['receiver'];
        $message = $_POST['message'];
        $query = "INSERT INTO chat(sender, receiver, msg) VALUES ($sender, $receiver, '$message')";
        try {
            Users::insertAny($query);
            echo json_encode(true);
        } catch (\Throwable $th) {
            echo json_encode(false);
        }
    }

    public static function getProjects()
    {
        header("Access-Control-Allow-Origin: *");
        $project = new Project();
        $id = (int) filter_var((int) $_POST['id'], FILTER_SANITIZE_NUMBER_INT);


        echo json_encode($project->getAllC($id));
    }


    public static function getTasks()
    {
        header("Access-Control-Allow-Origin: *");

        echo json_encode("hola desde api");
    }
}
