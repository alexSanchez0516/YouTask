<?php

namespace Model;

class Post extends ActiveRecord
{

    protected static $db;
    protected static $colDB = ['', ''];
    protected static $tabla = 'post';

    protected static array $alerts = [];


    public String $name;
    public String $content;
    public $adminID;
    public $create_at;


    public function __construct($args = [])
    {
        $this->name = $args['name'] ?? '';
        $this->content = $args['content'] ?? '';
        $this->adminID = $args['adminID'] ?? '0';
        $this->create_at = $args['create_at'] ?? '';
    }


    public function createC(int $user): bool
    {
        return true;
    }
    public function updateC(int $user): bool
    {
        return true;
    }

    public function deleteC(int $user): bool
    {
        return true;
    }

    public static function getAllC(int $user, int $limit): array
    {


        $query = "SELECT post.name, post.content, post.create_at FROM post";
        $query .= " INNER JOIN users ON post.id_user = users.id";
        $query .= " WHERE users.id = $user";
        if ($limit > 0) {
            $query .= " LIMIT $limit";
        }

        return static::consulSQL($query);
        //return static::$db->query($query)->fetch_array(MYSQLI_ASSOC);
    
    }
}
