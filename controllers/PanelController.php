<?php

namespace Controllers;

use MVC\Router;
use Model\Users;
use Model\Project;
use Model\Task;
use Model\ActiveRecord;
use Model\Post;
use Model\Action;
use Model\Comment;

class PanelController
{


    public static function index(Router $router)
    {
        $project = new Project();
        $user = $_SESSION['user'];
        $typeAlert = false;



        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $project->synchronize($_POST);
            if ($project->createC($user)) {
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
            'projects' => $project->getAllC($user)

        ]);
    }

    public static function createProject(Router $router)
    {

        $project = new Project();
        $user = $_SESSION['user'];
        $typeAlert = false;



        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $project->synchronize($_POST);
            debug($project);
            if ($project->createC($user)) {
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
        $Task = new Task();
        $User = $_SESSION['user'];
        $typeAlert = false;
        $idProject = 0; //debemos sacar esto en caso de estar en grupo

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $Task->synchronize($_POST);
            $typeAlert = $Task->createC($idProject);
            if ($typeAlert) {
                $Task->setAlert("Tarea creado correctamente");
            } else {
                $Task->setAlert("Ups tenemos un problema con tu solicitud");
            }
        }
        $router->render('app/createTask', [
            'alerts' => Task::getAlerts(),
            'typeAlert' => $typeAlert,
        ]);
    }



    public static function showPerfil(Router $router)
    {
        $activity = new Action();
        $typeAlert = false;
        $user = Users::find('id', $_SESSION['user'], false);
        $skills = $user->getSkills();
        $posts = Post::getAllC($user->id, 4); //LIMIT 4
        $activities = $activity->getAll($user->id, 4, 4); //LIMIT 4, type 1-post-2project-3task
        $router->render('app/profile', [
            'user' => $user,
            'alerts' => Users::getAlerts(),
            'typeAlert' => $typeAlert,
            'skills' => $skills,
            'posts' => $posts,
            'activities' => $activities,
        ]);
    }

    public static function Calendar(Router $router)
    {
        $router->render('app/calendar');
    }

    public static function showProjects(Router $router)
    {
        $router->render('app/projects');
    }

    public static function showProject(Router $router)
    {
        $router->render('app/project');
    }

    public static function showTasks(Router $router)
    {
        $router->render('app/tasks');
    }

    public static function showTask(Router $router)
    {
        $router->render('app/task');
    }

    public static function showFriends(Router $router)
    {
        $user = Users::find('id', $_SESSION['user'], false);

        $typeAlert = false;

        $router->render('app/friends', [
            'typeAlert' => $typeAlert,
            'alerts' => Users::getAlerts(),
        ]);
    }

    public static function showPosts(Router $router)
    {
        $user = Users::find('id', $_SESSION['user'], false);
        $posts = Post::getAllC($user->id, 0); //LIMIT 0

        $router->render('app/posts', [
            'posts' => $posts,

        ]);
    }

    public static function showPost(Router $router)
    {



        $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        $post = Post::find('id', $id, false);
        $quantity = $post->getQuantityComments();
        $comment = new Comment();
        $typeAlert = true;
        $data = array();
        $comments = $comment->getComments($post->id);


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $data['content'] = $_POST['content'];
            $data['post_id'] = $post->id;
            $data['user_id'] = (int) $_SESSION['user'];

            if (array_key_exists('response', $_POST)) {
                $data['comment_response'] = $_POST['response'];
            }


            $comment = new Comment($data);

            if (!$comment->createC()) {
                $typeAlert = false;
            } else {
                header("Refresh: 1");
                Comment::setAlert('Comentario creado correctamente');
            }
        }

        $router->render('app/post', [
            'post' => $post,
            'comments' => $comments,
            'quantity' => $quantity,
            'typeAlert' => $typeAlert,
            'alerts' => Comment::getAlerts(),
        ]);
    }


    public static function create_post(Router $router)
    {

        $post = new Post();

        $user = $_SESSION['user'];
        $typeAlert = false;



        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $typeAlert = $post->validateAttributes($_POST);

            if ($typeAlert) {
                $post->synchronize($_POST);

                if ($post->createC($user)) {
                    header('location: /posts');
                }
            }
        }

        $router->render('app/create_post', [
            'typeAlert' => $typeAlert,
            'alerts' => Post::getAlerts(),
        ]);
    }

    public static function update_post(Router $router)
    {

        $id_post = validateOrRedirect("/");

        $post = Post::find('id', $id_post, false);

        $typeAlert = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $typeAlert = $post->validateAttributes($_POST);

            if ($typeAlert) {
                $post->synchronize($_POST);
                $post->updateC() ? Post::setAlert("Guardado correctamente") : Post::setAlert("No ha podido ser creado");
                $typeAlert = true;

                header('location: /posts');
            }
        }


        $router->render('app/update_post', [
            'post' => $post,
            'alerts' => Post::getAlerts(),
            'typeAlert' => $typeAlert,
        ]);
    }


    public static function editProfile(Router $router)
    {
        $user = Users::find('id', $_SESSION['user'], false);
        $typeAlert = false;


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //debug(strlen($_POST['skill_name']));
            $typeAlert = $user->alterUser();
        }

        $router->render('app/edit_profile', [
            'user' => $user,
            'alerts' => Users::getAlerts(),
            'typeAlert' => $typeAlert,
        ]);
    }

    public static function showActivity(Router $router)
    {
        $user = Users::find('id', $_SESSION['user'], false);
        $activity = new Action();

        $activities = $activity->getAll($user->id, 0, 4); //LIMIT 4, type 1-post-2project-3task

        //debug("queck que nno ponga tu nombre, que ponga has echo o escrito etc el la activity");

        $router->render('app/activity', [
            'activities' => $activities,
        ]);
    }

    public static function showFriend(Router $router)
    {

        $id = validateOrRedirect('/amigos');
        $limit = 5;
        $user = Users::find('id', $id, false);
        $skills = $user->getSkills();
        $friends =  $user->getFriends();


        $posts = Post::getAllC($user->id, $limit); //LIMIT 5

        $router->render('app/friend', [
            'user' => $user,
            'skills' => $skills,
            'posts' => $posts,
            'friends' => $friends,
        ]);
    }

    public static function showMessages(Router $router)
    {




        $router = $router->render('app/messages', []);
    }
}
