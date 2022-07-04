<?php

namespace Model;

use Classes\Email;
use Model\Group;
use Controllers\APIController;

class Users extends ActiveRecord
{

    protected static $db;
    protected static $colDB = ['id', 'username', 'password', 'email', 'validate', 'token', 'admin', 'avatar', 'description', 'rol', 'apellidos', 'isSocials', 'instagram', 'github', 'linkedin', 'gen'];
    protected static $tabla = 'users';



    public  $id;
    public  $username;
    public  $password;
    public  $email;
    public  $token;
    public  $validate;
    public  $admin;
    public  $avatar;
    public  $description;
    public  $rol;
    public $apellidos;
    public $isSocials;
    public $instagram;
    public $github;
    public $linkedin;
    public $skills;
    function __construct($args = [])
    {
        $this->id = $args['id'] ?? '0';
        $this->username = $args['username'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->validate = $args['validate'] ?? '0';
        $this->token = $args['token'] ?? '';
        $this->admin = $args['admin'] ?? '0';

        $this->description = $args['description'] ?? '';
        $this->rol = $args['rol'] ?? '';
        $this->apellidos = $args['apellidos'] ?? '';
        $this->isSocials = $args['isSocial'] ?? '0';
        $this->instagram = $args['instagram'] ?? '';
        $this->github = $args['github'] ?? '';
        $this->linkedin = $args['linkedin'] ?? '';
        $this->skills = $args['skills'] ?? '';

        $this->gen = $args['gen'] ?? '0';

        if ($args['gen'] == '0') { //mujer
            $this->avatar = $args['avatar'] ?? 'fem.png';
        } else { //hombre
            $this->avatar = $args['avatar'] ?? 'male.png';
        }
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
            $user_data =  static::find('email', $data['email'], false);
            if (isset($user_data) && $user_data->validate === "1") {
                //pasword-->hash
                $auth = password_verify($this->password, $user_data->password);
                if ($auth) {
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['user'] = $user_data->id;
                    $_SESSION['avatar'] = $user_data->avatar;
                    $_SESSION['auth'] = true;
                    $_SESSION['username'] = $user_data->username;
                    $_SESSION['rol'] = $user_data->rol;


                    header('Location: /panel');
                } else {
                    static::$alerts[] = 'Credenciales erróneas';
                }
            } else {
                static::$alerts[] = 'El usuario no existe o no está verificado';
            }
        }
    }

    public function createUser(): bool
    {
        $typeAlert = false;
        if ($this->validateAttributes($_POST)) {
            $this->sanitizeData();
            $this->createToken();

            $email = new Email($this->token, $this->username, $this->email);
            $this->encryptPassword();
            if ($this->save()) {
                if ($email->sendConfirmation()) {
                    $typeAlert = true;
                } else {
                    $this->setAlert("Lo sentimos estamos teniendo un problema técnico, inténtalo más tarde");
                }

                $this->setAlert("Hemos enviado las intrucciones para confimar tu cuenta a tu e-mail");
            } else {
                $this->setAlert('Solo puedes tener una cuenta por correo');
            }
        }

        return $typeAlert; //ha sido o no ha sido creado correctamente
    }


    public function createToken()
    {
        $this->token = uniqid();
    }


    public static function logout()
    {
        session_start();

        $_SESSION = [];

        header('Location: /');
    }


    public function encryptPassword(): void
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }


    public function checkPassword($password): bool
    {

        return password_verify($password, $this->password);
    }


    public function deleteAccount(): bool
    {
        return true;
    }

    public function recoveryPassword($password, $typeAlert): bool
    {

        if ($password->validateAttributes($_POST)) {
            $password->sanitizeData();
            $this->password = '';
            $this->token = '';


            $password->password = password_hash($password->password, PASSWORD_BCRYPT);
            $this->password = $password->password;
            if ($this->save()) {
                $typeAlert = true;
                $this->setAlert("Tu contraseña ha sido cambiada con éxito");
            }
        }

        return $typeAlert;
    }



    public function validateUser($typeAlert): bool
    {

        $this->validate = "1";
        $this->token = "";

        if ($this->save()) {
            $typeAlert = true;
            $this->setAlert("Tu Cuenta ha sido verificada con exito");
        } else {
            $this->setAlert("Hay un error con la verificación, intentalo más tarde");
        }
        return $typeAlert;
    }


    public static function checkToken(): bool
    {
        $typeAlert = true;

        $token = s($_GET['token'] ?? null);
        $user = NULL;


        if (!empty($token)) {
            $user = Users::find('token', $token, false);
            if (!empty($user)) {
                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['user'] = $user;
            } else {
                $typeAlert = false;
                Users::setAlert("Token is invalid");
            }
        }


        return $typeAlert;
    }

    public function forgetPassword($typeAlert): bool
    {
        if ($this->validateAttributes($_POST)) {
            $this->synchronize($_POST);
            $this->sanitizeData();
            $user = $this->find("email", $this->email, false);
            if (!empty($user)) {
                if ($user->validate === '1') {
                    $user->createToken();
                    $email = new Email($user->token, $user->username, $user->email);
                    if ($user->save() && $email->sendTokenRecovery()) {
                        $typeAlert = true;
                        $user->setAlert("Hemos enviado las intrucciones para confimar tu cuenta a tu e-mail");
                    } else {
                        $user->setAlert("Lo sentimos estamos teniendo un problema técnico, inténtalo más tarde");
                    }
                } else {
                    $user->setAlert("Esta cuenta aun no ha sido verificada");
                }
            } else {
                static::$alerts[] = "Este email no está registrado";
            }
        }
        return $typeAlert;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function alterUser()
    {
        $typeAlert = false;


        //debug($_POST);

        if ($this->validateAttributes($_POST)) {
            if ($this->checkPassword($_POST['password'])) { //check current password    
                $typeAlert = true;
                unset($_POST['password']);
                $this->synchronize($_POST);
                if (strlen($_FILES['avatar']['name']) > 0) {

                    if (strlen($this->avatar) > 0) { //Comprobamos si hay imagen
                        $imgDelete = $this->avatar;
                    }
                    $this->uploadImg($_FILES['avatar'], $imgDelete, true);

                    /*
                    ERROR : GD Library extension not available with this PHP installation.
                    sudo apt-get install php8.1-gd replace ;extension=gd with extension=gd restart apache
                    */
                }
                $this->saveSkills($this->skills);
                $this->save() ? $this->setAlert("Cambios guardados correctamente") : false;
            } else {
                $this->setAlert("Contraseña incorrecta");
            }
        }
        return $typeAlert;
    }


    private function saveSkills($skills)
    {

        $id_user = $_SESSION['user'];
        $query = "DELETE FROM skill_users WHERE id_user = $id_user";

        if (Users::$db->query($query)) {
            if (!empty($skills)) {
                $query = "INSERT INTO skill_users (id_user, id_skill) VALUES ";
                foreach ($skills as $skill) {
                    $query .= " ($id_user, $skill),";
                }
                $query = substr($query, 0, -1);

                Users::$db->query($query);
            }
        }
    }

    public function addPermissionsGroup(Group $group): bool
    {
        return true;
    }

    public static function sendRequestFriend($receiver)
    {
        $transmitter = $_SESSION['user'];
        $query = "INSERT INTO requests_friends (transmitter, receiver) VALUES ($transmitter, $receiver)";
        $valid = true; //Cayo en excepcion?
        try {
            static::$db->query($query);
        } catch (\Throwable $th) {
            $valid = false;
        }
        return $valid;
    }

    public function setSkill(String $skill): void
    {
    }
    public function getSkills(): array
    {
        $query = "SELECT skills.name FROM skill_users ";
        $query .= " INNER JOIN skills on skill_users.id_skill = skills.id";
        $query .= " WHERE id_user = $this->id";

        return Users::getAnyQueryResult($query);
    }

    public function getFriends(): array
    {
        $query = "select DISTINCT user.id, username, avatar";
        $query .= " from users as user";
        $query .= " inner join requests_friends as request on user.id = request.transmitter or user.id = request.receiver";
        $query .= " where isAccept = 1 and user.id != $this->id ";

        $data = static::$db->query($query); //puede dar false 

        $friends = [];

        if ($data) {
            while ($record = $data->fetch_array(MYSQLI_ASSOC)) {
                $friends[] = $record;
            }
            $data->free(); //Liberar memoria
        }

        return $friends;
    }

    public function getQuantityFriends(): int
    {
        $query = "
        select  count(*) as quantity from 
        (select  username from users as user
        inner join requests_friends as request
        on user.id = request.transmitter or user.id = request.receiver where isAccept = 1 and user.id != $this->id
        group by user.id) as data
        ";
        return ((int)static::$db->query($query)->fetch_array(MYSQLI_ASSOC)['quantity']);
    }

    public function deleteFriend($id): bool
    {
        $query = "DELETE FROM requests_friends ";
        $query .= "WHERE (transmitter = $id OR receiver = $id) and ";
        $query .= "(transmitter = $this->id OR receiver = $this->id) LIMIT 1";

        return static::$db->query($query);
    }
}
