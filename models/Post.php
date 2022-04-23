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
    public $username;
    public $create_at;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? 0;
        $this->name = $args['name'] ?? '';
        $this->content = $args['content'] ?? '';
        $this->id_user = $args['id_user'] ?? 0;
        $this->username = $args['username'] ?? '';
        $this->create_at = $args['create_at'] ?? '';
    }


    public function createC(int $user): bool
    {
        $this->id_user = $user;
        return $this->save();
    }
    public function updateC(): bool
    {
        return $this->save();
    }

    

    public static function getAllC(int $user, int $limit) : Array
    {


        $query = "SELECT post.id , post.name, users.username, post.content, post.create_at FROM post";
        $query .= " left JOIN users ON post.id_user = users.id";
        $query .= " WHERE users.id = $user";
        $query .= " group by post.id order by post.create_at desc  ";
        if ($limit > 0) {
            $query .= " LIMIT $limit";
        }

        return static::consulSQL($query);
        
    
    }

    public function getComments($idPost) {
        $query = "SELECT comments_post.id, comments_post.user_id as id_user, comments_post.create_at, content, avatar, username, comment_response FROM comments_post inner join users on comments_post.user_id = users.id WHERE post_id = $idPost;";
        return static::consulSQL($query);
        
    }
    public function getQuantityComments() {
        $query = "
        SELECT 
        count(*) as totalComments
        FROM comments_post 
        WHERE post_id = {$this->id}
        ";

        return(static::$db->query($query)->fetch_assoc()['totalComments']);
    }

  

    

   



}
