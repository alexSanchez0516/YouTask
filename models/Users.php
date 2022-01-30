<?php

namespace Model;

class Users extends ActiveRecord
{

    protected static $db;
    protected static $colDB = ['id', 'username', 'password', 'email', 'validate', 'token', 'admin', 'avatar', 'description'];
    protected static $tabla = 'users';



    public int $id;
    public String $username;
    public String $password;
    public String $email;
    public String $token;
    public  $validate;
    public  $admin;
    public String $avatar;
    public String $description;

    function __construct($args = [])
    {
        $this->id = $args['id'] ?? 0;
        $this->username = $args['username'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->validate = $args['validate'] ?? '0';
        $this->token = $args['token'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->avatar = $args['avatar'] ?? '';
        $this->description = $args['description'] ?? '';
    }

    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function login()
    {

        $data = $this->sanitizeData();

        if (!$data['email'] || !$data['password']) {
            static::$alerts[] = 'Completa correctamente el formulario';
        }
        if (empty(static::$alerts)) {
            $user_data =  static::find('email', $data['email']);

            if (isset($user_data) && $user_data->validate === "1") {
                $auth = password_verify($this->password, $user_data->password);
                if ($auth) {
                    session_start();
                    $_SESSION['user'] = $user_data;
                   
                    $_SESSION['auth'] = true;


                    header('Location: /panel');
                } else {
                    static::$alerts[] = 'Credenciales erróneas';
                }
            } else {
                static::$alerts[] = 'El usuario no existe o no está verificado';
            }
        }
    }




    public function createToken()
    {
        $this->token = uniqid();
    }


    public static function logout()
    {
        session_start();

        $_SESSION = [];

        header('Location: /login');
    }

    public function changePassword(String $password): bool
    {
        return true;
    }



    public function deleteUser(): bool
    {
        return true;
    }
}
