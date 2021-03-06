<?php

namespace Model;


class Action extends ActiveRecord
{

    protected static $db;
    protected static $colDB = ['id', 'user_id', 'action', 'project_id', 'task_id', 'post_id'];
    protected static $tabla = 'activity';

    protected static array $alerts = [];
    public $user_id;
    public String $action;
    public $project_id;
    public $task_id;
    public $post_id;
    public String $create_at;
    public  $project_name;
    public $task_name;
    public $post_name;
    public String $username;

    public function __construct($args = [])
    {
        $this->user_id = $args['user_id'] ?? '';
        $this->action = $args['action'] ?? '';
        $this->project_id = $args['project_id'] ?? '';
        $this->task_id = $args['task_id'] ?? '';
        $this->post_id = $args['post_id'] ?? '';
        $this->create_at = $args['create_at'] ?? '';
        $this->project_name = $args['project_name'] ?? '';
        $this->task_name = $args['task_name'] ?? '';
        $this->post_name = $args['post_name'] ?? '';
        $this->username = $args['username'] ?? '';
    }



    public function createC(): void
    {
    }

    public function getAll(int $user, int $limit, int $type): array
    {
        $query = null;

        switch ($type) {
            case 1: //post
                $query = "SELECT users.username as username, action, post.id as post_id ,post.name as post_name, activity.create_at FROM activity ";
                $query .= "INNER JOIN post ON activity.post_id = post.id ";

                break;
            case 2: //project
                $query = "SELECT users.username as username, action, Projects.id as project_id ,Projects.name as project_name, activity.create_at FROM activity ";
                $query .= "INNER JOIN Projects ON activity.project_id = Projects.id ";
                break;
            case 3: //tasks
                $query = "SELECT users.username as username, action, Tasks.id as task_id ,Tasks.name as task_name, activity.create_at FROM activity ";
                $query .= "INNER JOIN Tasks ON activity.task_id = Tasks.id ";
                break;
            case 4: //all
                $query = "SELECT users.username as username, action, post.id as post_id, Tasks.id as task_id, Projects.id as project_id , post.name as post_name , Tasks.name as task_name, Projects.name as project_name,activity.create_at FROM activity ";
                $query .= "LEFT JOIN post ON activity.post_id = post.id ";
                $query .= "LEFT JOIN Projects ON activity.project_id = Projects.id ";
                $query .= "LEFT JOIN Tasks ON activity.task_id = Tasks.id ";

                break;
        }
        //debug("FIX ITEM_NAME RELATION POST");
        $query .= "LEFT JOIN users ON activity.user_id = users.id ";
        $query .= "WHERE users.id = $user ";
        if ($limit > 0) {
            $query .= " LIMIT $limit";
        }

   
        return static::consulSQL($query);
    }
}
