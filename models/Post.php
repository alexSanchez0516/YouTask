<?php

namespace Model;

class Post extends ActiveRecord
{

    protected static $db;
    protected static $colDB = ['id', 'name', 'content', 'create_at', 'id_user'];
    protected static $tabla = 'post';

    protected static array $alerts = [];

    public int $id;
    public int $sumComents;
    public String $name;
    public String $content;
    public $id_user;
    public $create_at;
    public int $likes;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? 0;
        $this->name = $args['name'] ?? '';
        $this->content = $args['content'] ?? '';
        $this->id_user = $args['id_user'] ?? '0';
        $this->create_at = $args['create_at'] ?? '';
        $this->likes = $args['likes'] ?? 0;
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

    public static function getAllC(int $user, int $limit) : Array
    {


        $query = "SELECT post.name, post.content, post.create_at, count(*) as likes FROM post";
        $query .= " left JOIN users ON post.id_user = users.id";
        $query .= " left join post_likes as likes on post_id = post.id";
        $query .= " WHERE users.id = $user";
        $query .= " group by post.id order by post.create_at desc  ";
        if ($limit > 0) {
            $query .= " LIMIT $limit";
        }

        return static::consulSQL($query);
        
    
    }


}
