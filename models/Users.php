<?php

namespace Model;

class Users extends ActiveRecord
{

    protected static $db;
    protected static $colDB = ['id', 'username', 'password', 'email', 'validate', 'token', 'admin', 'avatar'];
    protected static $tabla = 'users';



    public int $id;
    public String $username;
    public String $password;
    public String $email;
    public String $token;
    public bool $validate;
    public bool $admin;
//    public bool $online;
    public String $avatar;

    function __construct($args = [])
    {
        $this->username = $args['id'] ?? '';
        $this->username = $args['username'] ?? '';
        $this->lastname = $args['lastname'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->validate = $args['validate'] ?? false;
        $this->admin = $args['admin'] ?? false;
        //$this->online = $args['online'] ?? false;
        $this->avatar = $args['avatar'] ?? '';


    }

    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function login()
    {            

        $data = $this->sanitizeData();
    
        if (!$data['email'] || !$data['password']) {
            static::$errors[] = 'Completa correctamente el formulario';
        }
        if (empty(static::$errors)) {
            $user_data =  static::find(null, $data['email']);
            if (isset($user_data)) {
                $auth = password_verify($this->password, $user_data->password);
                if ($auth) {
                    session_start();

                    $_SESSION['username'] = $user_data->username;
                    $_SESSION['login'] = true;

                    header('Location: /panel');
                } else {
                    static::$errors[] = 'Credenciales erróneas';
                }
            } else {
                static::$errors[] = 'El usuario no existe';
            }
        }
    }

    public function register(): bool
    {
        $this->admin = 0;
        $this->validate = 0;
        $data = $this->sanitizeData(); //Scape String
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);


        $query = "INSERT INTO users(";
        $query .= join(",", array_keys($data));
        $query .= ") VALUES (";
        $query .= "'{$this->username}', '{$this->password}' , '{$this->email}', false";
        $query .= ", '{$this->token}', false, '{$this->avatar}' )";
        
        
        return static::$db->query($query);
       
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
