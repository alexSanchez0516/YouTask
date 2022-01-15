<?php

namespace Model;

class Users extends ActiveRecord
{

    protected static $db;
    protected static $colDB = ['id', 'username', 'password', 'email', 'lastname', 'validate', 'token', 'admin', 'rol', 'online', 'avatar'];
    protected static $tabla = 'users';

    public String $username;
    public String $lastname;
    public String $password;
    public String $email;
    public String $token;
    public bool $validate;
    public bool $admin;
    public bool $online;
    public String $avatar;
    public int $rol; //idRol

    function __construct($args = [])
    {
        $this->username = $args['username'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->email = $args['email'] ?? '';
    }

    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function login()
    {
        $data = $this->sanitizeData(1);


        if (!$data['username'] || !$data['password']) {
            static::$errors[] = 'Completa correctamente el formulario';
        }
        if (empty(static::$errors)) {
            $user_data =  static::find(null, $data['username']);

            if (isset($user_data)) {

                $auth = password_verify($this->password, $user_data->password);

                if ($auth) {
                    session_start();

                    $_SESSION['username'] = $user_data->username;
                    $_SESSION['login'] = true;

                    header('Location: /admin');
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
        return true;
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
