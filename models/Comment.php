<?php


namespace Model;


class Comment extends ActiveRecord
{

    protected static $db;
    protected static $colDB = ['id', 'post_id', 'create_at', 'content',  'user_id', 'comment_response'];
    protected static $tabla = 'comments_post';

    protected static array $alerts = [];


    public $id;
    public $post_id;
    public $create_at;
    public $username;
    public $avatar;
    public $content;
    public $user_id;
    public $comment_response;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? 0;
        $this->post_id = $args['post_id'] ?? 0;
        $this->create_at = $args['create_at'] ?? '';
        $this->content = $args['content'] ?? '';
        $this->user_id = $args['user_id'] ?? 0;
        $this->comment_response = $args['comment_response'] ?? 0;
        $this->username = $args['username'] ?? '';
        $this->avatar = $args['avatar'] ?? '';
    }


    public function createC(): bool
    {
        if ($this->comment_response < 1) { //captamos si no hay respuesta de un comentario y lo quitamos de la lista de cols

            unset(static::$colDB[sizeof(static::$colDB) - 1]);
        }


        $valid = false;
        if ($this->validateAttributes($this->sanitizeData())) {
            $valid = true;
        }



        if ($valid) {
            return $this->create();
        }
        return false;
    }

    public function deleteC()
    {
    }

    public function get_img($id_user)
    {
        $query = "SELECT avatar  FROM users where id = $id_user";
        return (static::$db->query($query)->fetch_assoc());
    }


    public function getComments($idPost)
    {
        $query = "SELECT comments_post.id, comments_post.user_id as user_id, comments_post.create_at, content, avatar, username, comment_response FROM comments_post inner join users on comments_post.user_id = users.id WHERE post_id = $idPost order by create_at desc;";

        return static::consulSQL($query);
    }
    public function getDataTheResponse()
    {
        $query = "SELECT post_id ,content, avatar, username FROM comments_post inner join users on comments_post.user_id = users.id WHERE comments_post.id = $this->comment_response";
        return static::consulSQL($query);
        //car autor, foto, content del comentario al quie estamos respondiendo

    }
}
