<?php

namespace Model;

use interfaces\crud;


class Project extends ActiveRecord implements crud
{
    protected static $db;
    protected static $colDB = ['id', 'name', 'description', 'adminID', 'state', 'priority', 'date_end', 'folderURL'];
    protected static $tabla = 'Projects';

    protected static array $alerts = [];

    public int $id;
    public String $name;
    public String $description;
    public  $adminID;
    public String $state;
    public String $priority;
    public $date_end;

    public $members = [];
    public $folderURL;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? 0;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->adminID = $args['adminID'] ?? '0';

        $this->state = $args['state'] ?? '';
        $this->priority = $args['priority'] ?? '';
        $this->date_end = $args['date_end'] ?? '';
        $this->folderURL = $args['folderURL'] ?? '';
    }

    public function createC(int $user): bool
    {
        if ($this->validateAttributes($this->sanitizeData())) {
            $this->state = "EN PROCESO";
            $this->adminID = $user;

            $directory = substr($this->name, 0, 3) . '-' . uniqid();
            $path = FOLDER_PROJECTS . $directory;
            $this->folderURL = $directory;
            $created =  $this->create();
            if ($created) {
                $this->createFolder($path);
            }
            return $created;
        }
    }

    public static function getLastProgress($limit)
    {
        $user_id    = $_SESSION['user'];
        $query      = "select Tasks.id, Tasks.name, Tasks.create_at, Tasks.date_end, Projects.name as NameProject ";
        $query     .= "from Tasks,Projects where (Tasks.state = 'REALIZADO' AND Tasks.adminID = $user_id) ";
        $query     .= "AND Projects.id = Tasks.projectID limit $limit";
        return Users::getAnyQueryResult($query);
    }

    /**
     * @return Array
     */
    public static function getTaskFinishQuantity()
    {
        $user_id    = $_SESSION['user'];
        $query      = "select count(*) as quantity from Tasks where (Tasks.state = 'REALIZADO' AND Tasks.adminID = $user_id) ";
        return Users::getAnyQueryResult($query);
    }

    /**
     * @return Array
     */
    public static function getTaskQuantity()
    {
        $user_id    = $_SESSION['user'];
        $query      = "select count(*) as quantity from Tasks where (Tasks.adminID = $user_id) ";
        return Users::getAnyQueryResult($query);
    }



    /**
     * @return Array
     */
    public static function getProjectsQuantity()
    {
        $user_id    = $_SESSION['user'];
        $query      = "select count(*) as quantity from Projects where (Projects.adminID = $user_id) ";
        return Users::getAnyQueryResult($query);
    }

    /**
     * @return Array
     */
    public static function getTasksFinishedCurrentMonth($month)
    {
        $user_id    = $_SESSION['user'];
        $query      = "select count(*) as quantity from Tasks where (Tasks.adminID = $user_id and month(date_end)=$month and Tasks.state = 'REALIZADO' ) ";
        return Users::getAnyQueryResult($query);
    }


    /**
     * @return Array
     */
    public static function getTasksCurrentMonth($month)
    {
        $user_id    = $_SESSION['user'];
        $query      = "select count(*) as quantity from Tasks where (Tasks.adminID = $user_id and month(date_end)=$month) ";
        return Users::getAnyQueryResult($query);
    }

    /**
     * @return Array
     */
    public static function getProjectFinishQuantity()
    {
    }


    /**
     * @return int
     */
    public static function getNewProjectsCountMonth()
    {
    }

    /**
     * @return int
     */
    public static function getProgressMonth()
    {
    }

    /**
     * @return Array
     */
    public static function getTaskInDays()
    {
    }


    /**
     * @return Array
     */
    public static function getTaskWeekend()
    {
    }

    /**
     * @param mixed $path
     * 
     * @return [type]
     */
    private function createFolder($path)
    {

        if (!mkdir($path, 0777, true)) {
            die('Fallo al crear las carpetas...');
        }
    }

    /**
     * @return [type]
     */
    public function getTasks()
    {
        $query = "select  id, name, state from Tasks where projectID = $this->id group by id order by create_at desc";
        return Project::getAnyQueryResult($query);
    }



    public function deleteC(int $user): bool
    {
        return true;
    }

    /**
     * @return [type]
     */
    public function uploadFiles()
    {
        foreach ($_FILES["filesUpload"]['tmp_name'] as $key => $tmp_name) {
            //Si el archivo existe
            if ($_FILES["filesUpload"]["name"][$key]) {


                // Nombres de archivos de temporales
                $archivonombre = $_FILES["filesUpload"]["name"][$key];
                $fuente = $_FILES["filesUpload"]["tmp_name"][$key];


                $carpeta = FOLDER_PROJECTS . $this->folderURL . "/"; //Carpeta donde guardamos los archivos


                //Si no existe la carpeta
                if (!file_exists($carpeta)) {
                    //Se crea o se genera un error.
                    mkdir($carpeta, 0777) or die("Hubo un error al crear la carpeta");
                }

                //Abrimos la conexion con la carpeta destino
                $dir = opendir($carpeta);


                //Verificamos si el archivo se ha subido
                if (move_uploaded_file($fuente, $carpeta . '/' . $archivonombre)) {
                    Project::setAlert("El archivo $archivonombre se ha cargado de forma correcta");
                } else {
                    $typeAlert = false;
                    Project::setAlert("Se ha producido un error, intentelo de nuevo");
                }
                //Cerramos la conexion con la carpeta destino
                closedir($dir);
            }
        }
    }

    public function updateC(int $user): bool
    {
        return true;
    }

    /**
     * @param int $user
     * 
     * @return array
     */
    public  function getAllC(int $user): array
    {
        return $this->find("adminID", $user, true);
    }

    public function getID()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNameAdministrator()
    {
        $query = "SELECT username FROM users inner join Projects as project on users.id = adminID WHERE project.id = $this->id";
        $name = Users::getAnyQueryResult($query);
        return ($name[0]['username']);
    }

    public function getName()
    {
        return $this->name;
    }


    /**
     * @param String $name
     * 
     * @return [type]
     */
    public function setName(String $name)
    {
        $this->name = $name;
    }

    /**
     * @param String $description
     * 
     * @return void
     */
    public function setDescription(String $description): void
    {
        $this->description = $description;
    }

    /**
     * @param int $adminID
     * 
     * @return void
     */
    public function setAdminID(int $adminID): void
    {
        $this->adminID = $adminID;
    }

    /**
     * @param String $state
     * 
     * @return void
     */
    public function setState(String $state): void
    {
        $this->state = $state;
    }

    /**
     * @param String $priority
     * 
     * @return void
     */
    public function setPriority(String $priority): void
    {
        $this->priority = $priority;
    }

    /**
     * @param mixed $date_end
     * 
     * @return void
     */
    public function setDate_end($date_end): void
    {
        $this->date_end = $date_end;
    }

    /**
     * @return [type]
     */
    public function getQuantityMessages()
    {

        $query      = "select count(*) as total ";
        $query     .= "from msgProjects ";
        $query     .= "where project_id = $this->id ";

        $count = Project::getAnyQueryResult($query);

        return $count[0]['total'];
    }

    /**
     * @return [type]
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function getAdmin()
    {
        return $this->adminID;
    }

    public function getState()
    {
    }

    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @return Array
     */
    public function getCreatedAt()
    {
        $query = "SELECT create_at FROM  Projects as project WHERE project.id = $this->id";
        $created = Users::getAnyQueryResult($query);
        return ($created[0]['create_at']);
    }

    public function getDateEnd()
    {
        return $this->date_end;
    }

    public function deleteMemberC(int $user): bool
    {
        return true;
    }

    /**
     * @param int $user_id
     * @param int $id_project
     * 
     * @return [type]
     */
    public function addMember(int $user_id, int $id_project)
    {
        $query = "INSERT INTO Members_Projects(id_project, id_user) VALUES ($id_project, $user_id)";
        $inCreated = true;
        try {
            static::$db->query($query);
        } catch (\Throwable $th) {
            $inCreated = false;
        }
        return $inCreated;
    }

    /**
     * @param array $users
     * @param int $id_project
     * 
     * @return bool
     */
    public function addMembers(array $users,  int $id_project): bool
    {
        $valid = true;
        //debug($users);
        $id_user = null;
        $query = "INSERT INTO Members_Projects(id_project, id_user) VALUES ";

        foreach ($users as $user) {

            $id_user = (int) $user;
            $query .= " ($id_project, $id_user),";
        }
        $query = substr($query, 0, -1);
        try {
            static::$db->query($query);
        } catch (\Throwable $th) {

            $valid = false;
        }

        return $valid;
    }

    /**
     * @return [type]
     */
    public function getMembers()
    {
        $query      = "select distinct avatar, username, user.id, Projects.id as project_id, ";
        $query     .= "administrator.id as id_admin from users as user ";
        $query     .= "inner join Members_Projects as members on id_user = user.id ";
        $query     .= "inner join Projects on members.id_project = Projects.id ";
        $query     .= "left join administratorProject as administrator on administrator.id_user = user.id ";
        $query     .= "where Projects.id = $this->id ";
        //debug($query);

        $members = Project::getAnyQueryResult($query);


        if (count($members) > 0) {
            $this->members = $members;
        }
    }



    /**
     * @param mixed $id_user
     * 
     * @return bool
     */
    public function addAdministrator($id_user): bool
    {
        $query = "INSERT INTO administratorProject(id_user, id_project) VALUES ($id_user, $this->id)";
        $inCreated = true;
        try {
            static::$db->query($query);
        } catch (\Throwable $th) {
            $inCreated = false;
        }
        return $inCreated;
    }
    /**
     * @return Array
     */
    public function getAdministrators()
    {
        $query = "SELECT administrator.id, administrator.id_user,administrator.id_project,username ";
        $query .= "from administratorProject as administrator inner join users as user on user.id = administrator.id_user ";
        $query .= "where id_project = $this->id";

        return Project::getAnyQueryResult($query);
    }

    /**
     * @param mixed $id
     * 
     * @return bool
     */
    public static function checkAdminOrCreator($id): bool
    {
        $id_user = $_SESSION['user'];
        $query = "select true from Projects where adminID = $id_user and id = $id";
        $data = static::$db->query($query);
        $isOrNo = false;
        if ($data->num_rows > 0) {
            $isOrNo  = true;
        } else {
            $query = "select true from administratorProject where id_project = $id and id_user = $id_user";
            $data = static::$db->query($query);
            if ($data->num_rows > 0) {
                $isOrNo =  true;
            }
        }
        return $isOrNo;
    }

    public  function getEvents()
    {

        $query      = "SELECT events.id as eventID, Task.id as taskID, Task.name as title, Task.description as description ,start, end FROM events INNER JOIN Tasks as Task on events.id_task = Task.id ";
        $query     .= "WHERE Task.projectID = $this->id and state = 'EN PROCESO' order by events.create_at desc";

        return Project::getAnyQueryResult($query);
    }
}
