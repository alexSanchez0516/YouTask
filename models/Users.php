<?php

namespace Model;

class Users extends ActiveRecord
{

    protected static $db;
    protected static $colDB = ['id', 'username', 'password', 'email', 'validate', 'token', 'admin', 'avatar'];
    protected static $tabla = 'users';

    protected static array $errors = [];


    public int $id;
    public String $username;
    public String $password;
    public String $email;
    public String $token;
    public  $validate;
    public  $admin;
    public String $avatar;

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
        if (empty(static::$errors)) {
            $user_data =  static::find('email', $data['email']);
            
            if (isset($user_data) && $user_data->validate === "1") {
                $auth = password_verify($this->password, $user_data->password);
                if ($auth) {
                    session_start();
                    $_SESSION['username'] = $user_data->username;
                    $_SESSION['email'] = $user_data->email;
                    $_SESSION['id'] = $user_data->id;
                    $_SESSION['auth'] = true;

                    if ($user_data->admin === "1") {
                        debug("es admin");
                    } else {
                        debug("This is client");
                    }

                    header('Location: /panel');
                } else {
                    static::$alerts[] = 'Credenciales erróneas';
                }
            } else {
                static::$alerts[] = 'El usuario no existe o no está verificado';
            }
        }
    }


    public function validateAttributes($attributes): bool
    {

        foreach ($attributes as $key => $value) {
            $this->$key = trim($value);

            if ($key == 'email') {
                if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                    self::$alerts[] = 'Correo inválido';
                }
            }


            if ($key == 'password') {
                $repeatPassword = trim($attributes['repeatPassword']);
                if (strlen($this->$key) < 8) {
                    self::$alerts[] = 'La contraseña debe tener minimo 8 carácteres';
                }
                if ($repeatPassword != $this->password) {
                    self::$alerts[] = 'No coinciden las contraseñas';
                }
            }

            if ($key == 'username') {
                if (strlen($this->$key) < 5) {
                    self::$alerts[] = 'Tu usuario debe tener minimo 5 carácteres';
                }
            }

            
        }
        return empty(self::$alerts);
    }

    public function createToken() {
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
