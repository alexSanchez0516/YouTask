<?php

namespace Controllers;

use Exception;

use Model\Post;
use Model\Task;
use MVC\Router;
use Model\Users;

use Model\Comment;
use Model\Project;
use Model\Paginator;

class APIController
{
    /**
     * @return [type]
     */
    public static function listProjects()
    {
        header("Access-Control-Allow-Origin: *");

        $projects = Project::find('adminID', 15, true);

        echo json_encode($projects);
    }
    /**
     * @return [type]
     */
    public static function send_resquest_friend()
    {
        header("Access-Control-Allow-Origin: *");

        $receiver = $_POST["receiver"];

        $response = Users::sendRequestFriend($receiver) ? "Enviado correctamente" : "Ya tienes una solicitud pendiente";

        echo json_encode($response);
    }



    /**
     * @return [type]
     */
    public static function listPosts()
    {
        header("Access-Control-Allow-Origin: *");

        $id = $_SESSION['user'];
        echo json_encode(Post::getAllC($id, 0));
    }



    /**
     * @return [type]
     */
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


    /**
     * @return [type]
     */
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


    /**
     * @return [type]
     */
    public static function showChat()
    {
        $sender = $_SESSION['user'];
        $receiver = $_POST['idSelected'];

        $query = "select id, sender, receiver, msg, create_at,  if (group_chat = null, 1, 0 ) as isGroup, if (sender = $sender, 1,0) as isSender from chat where (sender = $sender or receiver = $sender) and (receiver = $receiver or sender = $receiver) ORDER BY create_at desc";
        echo json_encode(Users::getAnyQueryResult($query));
    }

    /**
     * @return [type]
     */
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

    /**
     * @return [type]
     */
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

    /**
     * @return [type]
     */
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

    /**
     * @return [type]
     */
    public static function checkRequestFollower()
    {
        header("Access-Control-Allow-Origin: *");

        $transmitter = $_SESSION['user'];
        $receiver = $_POST['id'];
        $query = "SELECT id, isAccept from requests_friends where (receiver = $receiver and transmitter = $transmitter) OR (transmitter = $receiver and receiver = $transmitter)";
        echo json_encode(Users::getAnyQuery($query));
    }




    /**
     * @return [type]
     */
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

    /**
     * @return [type]
     */
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

    /**
     * @return [type]
     */
    public static function acceptFollower()
    {
        header("Access-Control-Allow-Origin: *");

        $id_request = filter_var($_POST['id_request'], FILTER_VALIDATE_INT);
        $query = "update requests_friends SET isAccept = 1 ";
        $query .= "where id = $id_request LIMIT 1";


        echo json_encode(Users::insertAny($query));
    }

    /**
     * @return [type]
     */
    public static function RejectFollower()
    {
        header("Access-Control-Allow-Origin: *");

        $id_request = filter_var($_POST['id_request'], FILTER_VALIDATE_INT);
        $query = "delete from requests_friends ";
        $query .= "where id = $id_request LIMIT 1";


        echo json_encode(Users::insertAny($query));
    }

    /**
     * @return [type]
     */
    public static function getAllSkills()
    {
        header("Access-Control-Allow-Origin: *");

        $query = "select * from skills";
        echo json_encode(Users::getAnyQueryResult($query));
    }

    /**
     * @return [type]
     */
    public static function checkSkill()
    {
        header("Access-Control-Allow-Origin: *");

        $skill = $_POST['skill'];

        $query = "SELECT id FROM skill_users where id_skill = $skill";
        echo json_encode(Users::getAnyQuery($query));
    }

    /**
     * @return [type]
     */
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

    /**
     * @return [type]
     */
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

    /**
     * @return [type]
     */
    public static function getProjects()
    {
        header("Access-Control-Allow-Origin: *");
        $project = new Project();
        $id = (int) filter_var((int) $_POST['id'], FILTER_SANITIZE_NUMBER_INT);


        echo json_encode($project->getAllC($id));
    }


    /**
     * @return [type]
     */
    public static function getProjectsPaginate()
    {
        $id = $_SESSION['user'];


        $limit        = (isset($_POST['limit'])) ? $_POST['limit'] : 10;
        $page         = (isset($_POST['page'])) ? $_POST['page'] : 1;
        $filter       = (isset($_POST['filter'])) ? $_POST['filter'] : null;
        $value_filter = (isset($_POST['value'])) ? $_POST['value'] : null;
        $date_filter = "desc";

        $query      = "SELECT project.id, adminID, user.id as userID, user.avatar as avatar, project.name, project.description, state, priority, date_end  FROM  Projects as project";
        $query     .= " inner join users as user on project.adminID = user.id  ";
        $query     .= " inner join Members_Projects as member on member.id_project = project.id";
        $query     .= " group by project.id";

        if ($filter != null) {
            if ($filter == 'project.create_at') {
                $date_filter = $value_filter;
            } else {
                $query     .= "and $filter = '$value_filter'";
            }
        } else {
            if ($value_filter != null) {
                $query     .= "AND name LIKE '%$value_filter%'";
            }
        }
        $query     .= " order by project.create_at " . $date_filter;

        $Paginator  = new Paginator($query);

        $results    = $Paginator->getData($limit, $page);
        echo json_encode($results);
    }

    /**
     * @return [type]
     */
    public static function getTasksPaginate()
    {

        $id = $_SESSION['user'];


        $limit        = (isset($_POST['limit'])) ? $_POST['limit'] : 10;
        $page         = (isset($_POST['page'])) ? $_POST['page'] : 1;
        $filter       = (isset($_POST['filter'])) ? $_POST['filter'] : null;
        $value_filter = (isset($_POST['value'])) ? $_POST['value'] : null;
        $date_filter = "desc";
        $id_project = (isset($_POST['id_project'])) ? $_POST['id_project'] : null;


        $query      = "SELECT task.id, task.name, task.state, task.priority, task.date_end,  project.name as Project FROM Tasks as task";
        $query     .= " left join Projects as project on projectID = project.id";
        $query     .= " where task.adminID = $id ";

        if ($id_project != null) {
            $query .= " and task.projectID = $id_project ";
        }


        if ($filter != null) {
            if ($filter == 'create_at') {
                $date_filter = $value_filter;
            } else {
                $query     .= " and $filter = '$value_filter'";
            }
        } else {
            if ($value_filter != null) {
                $query     .= " AND task.name LIKE '%$value_filter%'";
            }
        }
        $query     .= " order by task.create_at " . $date_filter;

        $Paginator  = new Paginator($query);

        $results    = $Paginator->getData($limit, $page);
        echo json_encode($results);
    }

    /**
     * @return boolean
     */
    public static function delete()
    {
        $id = $_POST['id'];
        $id_user = $_POST['id_user'] ?? null;
        $table = $_POST['table'];

        $query = "DELETE FROM $table where ";
        if ($id_user != null) {
            $query     .= "id_user = $id_user";
        } else {
            $query     .= "id = $id";
        }


        try {
            Users::insertAny($query);
            echo json_encode(true);
        } catch (Exception $th) {
            echo json_encode(false);
            //echo json_encode("$th->getMessage()");
        }
    }

    /**
     * @return array
     */
    public static function getMembers()
    {
        $id = $_POST['id'];
        $limit = $_POST['limit'] ?? 0;
        $project = Project::find('id', $id, false);

        $query      = "select distinct avatar, username, user.id, Projects.id as project_id from users as user ";
        $query     .= "inner join Members_Projects as members on id_user = user.id ";
        $query     .= "inner join Projects on members.id_project = Projects.id ";
        $query     .= "where Projects.id = $id group by user.id ";

        $query .= " order by Projects.adminID";
        if ($limit > 0) {
            $query .= " limit $limit";
            echo json_encode(Users::getAnyQueryResult($query));
        } else {
            $project->getMembers();
            echo json_encode($project->members);
        }
    }


    public static function sendMessageProject()
    {
        $user_id    = $_SESSION['user'];
        $msg        = $_POST['msg'];
        $project_id = $_POST['project_id'];


        Project::sanitizeAny($msg);

        $query      = "INSERT INTO msgProjects(msg, user_id, project_id) VALUES('$msg', $user_id, $project_id)";

        try {
            Project::insertAny($query);
            echo json_encode(true);
        } catch (\Throwable $th) {
            echo json_encode(false);
        }
    }


    /**
     * @return [type]
     */
    public static function getMessagesProjects()
    {
        $id = $_POST['id'];


        $query      = "select msgProjects.id, msg, create_at, user.username, user.avatar ";
        $query     .= "from msgProjects inner join users as user ";
        $query     .= "on msgProjects.user_id = user.id ";
        $query     .= "where project_id = $id order by create_at desc";


        echo json_encode(Users::getAnyQueryResult($query));
    }

    /**
     * @return [type]
     */
    public static function getTaskByProject()
    {
        $id = $_POST['id'];
        $project = Project::find('id', $id, false);
        $tasks = $project->getTasks();
        echo json_encode($tasks);
    }

    public static function addTaskByProject()
    {
        $Task = new Task();
        $Task->synchronize($_POST);
        $isCreated = false;

        //COMPROBAR FECHA
        if (Project::validateDate($Task->date_end)) {

            if (strlen($Task->name) < 40) {
                if ($Task->createC($Task->projectID)) {
                    $isCreated = true;
                }
            }
        }
        echo json_encode($isCreated);
    }



    public static function deleteFileByProject()
    {
        $nameFile = $_POST['name'];
        $id = $_POST['id'];
        $project = Project::find('id', $id, false);
        $isDeleted = unlink(FOLDER_PROJECTS . $project->folderURL . '/' . $nameFile);
        echo json_encode($isDeleted);
    }

    public static function getFriendsNotMembersByGroup()
    {
        header("Access-Control-Allow-Origin: *");

        $id = $_SESSION['user'];
        $nameSearch = $_POST['nameSearch'];
        $id_project = $_POST['id_project'];

        $query  =    "select user.id, user.username, avatar from users as user ";
        $query .=   "left join Members_Projects as member on member.id_user = user.id ";
        $query .=   "left join requests_friends as request_t on request_t.transmitter = $id ";
        $query .=   "left join requests_friends as request_r on request_r.receiver = $id ";
        $query .=   "where (id_project != $id_project or id_project is null) ";
        $query .=   "and user.id != $id and (request_r.isAccept = 1 or request_t.isAccept = 1) ";
        $query .=   "and username like '%$nameSearch%' ";
        $query .=   "group by user.id";

        echo json_encode(Users::getAnyQueryResult($query));
    }

    public static function sendInvitationProject()
    {
        $id_project = $_POST['id_project'];
        $id_user = $_POST['id_user'];

        $query      = "INSERT INTO requestMemberProject (id_user, id_project) VALUES ($id_user, $id_project)";

        try {
            Project::insertAny($query);
            echo json_encode(true);
        } catch (\Throwable $th) {
            echo json_encode(false);
        }
    }

    public static function insertAdminByProject()
    {

        header("Access-Control-Allow-Origin: *");

        $id_project = $_POST['id_project'];
        $id_user    = $_POST['id_user'];

        $query      = "INSERT INTO administratorProject (id_user, id_project) VALUES ($id_user, $id_project)";


        try {
            Project::insertAny($query);
            echo json_encode(true);
        } catch (\Throwable $th) {
            echo json_encode(false);
        }
    }

    public static function dismisAdminByProject()
    {
        header("Access-Control-Allow-Origin: *");

        $id_user = $_POST['id_user'];
        $id_project = $_POST['id_project'];

        $query = "DELETE FROM administratorProject WHERE id_project = $id_project AND id_user = $id_user";

        try {
            echo json_encode(Project::deleteAny($query));
        } catch (\Throwable $th) {
            $inCreated = false;
        }
    }

    public static function checkAdminOrCreator()
    {
    }

    public static function sendCommentChat()
    {
        header("Access-Control-Allow-Origin: *");

        $user_id    = $_SESSION['user'];
        $id_task    = $_POST['id_task'];
        $msg        =  $_POST['msg'];

        Task::sanitizeAny($msg);


        $query      = "INSERT INTO msgTask(msg, id_user, id_task) VALUES('$msg', $user_id, $id_task)";


        try {
            Project::insertAny($query);
            echo json_encode(true);
        } catch (\Throwable $th) {
            echo json_encode(false);
        }
    }

    public static function showMessagesTask()
    {

        $id = $_POST['id_task'];

        $query      = "select msgTask.id, msg, create_at, user.username, user.avatar ";
        $query     .= "from msgTask inner join users as user ";
        $query     .= "on msgTask.id_user = user.id ";
        $query     .= "where id_task = $id order by create_at desc";


        echo json_encode(Users::getAnyQueryResult($query));
    }

    public static function getEventsTask()
    {
        $id = $_POST['id_task'];

        $query      = "SELECT Task.name as title, start, end FROM events INNER JOIN Tasks as Task on events.id_task = Task.id ";
        $query     .= "WHERE events.id_task = $id order by create_at desc";

        echo json_encode($query);
        //echo json_encode(Users::getAnyQueryResult($query));
    }

    public static function getEvents()
    {
        $id = $_SESSION['user'];

        $query      = "SELECT events.id as eventID, Task.id as taskID, Task.name as title, Task.description as description ,start, end FROM events INNER JOIN Tasks as Task on events.id_task = Task.id ";
        $query     .= "WHERE Task.adminID = $id and state = 'EN PROCESO' order by events.create_at desc";

        echo json_encode(Users::getAnyQueryResult($query));
    }

    public static function createEventC()
    {
        $id_task = $_POST['id_task'];
        $start = $_POST['start'];
        $end = $_POST['end'];

        $query = "INSERT INTO events (id_task, start, end) VALUES ($id_task, '$start', '$end')";

        try {
            Task::insertAny($query);
            echo json_encode(true);
        } catch (\Throwable $th) {
            echo json_encode(false);
        }
    }
}
