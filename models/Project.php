<?php 
namespace Model;


class Project extends ActiveRecord {
    protected static $db;
    protected static $colDB = ['id', 'name', 'description', 'adminID', 'state', 'priority', 'date_end' ];
    protected static $tabla = 'Projects';

    protected static array $alerts = [];

    public int $id;
    public String $name;
    public String $description;
    public int $adminID;
    public String $state;
    public String $priority;
    public $date_end;


    public function __construct($args = []) {
        $this->id = $args['id'] ?? 0;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->adminID = $args['adminID'] ?? 0;
        $this->state = $args['state'] ?? '';
        $this->priority = $args['priority'] ?? '';
        $this->date_end = $args['date_end'] ?? '';
    }

    public function createProject(Users $user) : bool {
        if ($this->validateAttributes($this->sanitizeData())) {
            $this->state = "EN PROCESO";
            $this->id = $user->id; 
            
            return $this->create();

        }
            
                
    }

    public function deleteProject() {

    }

    public function alterProject() {

    }

    public static function getProjects() {

    }

    public function getID() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
      

    public function setName(String $name)
    {
        $this->name = $name;
    }

    public function setDescription(String $description): void
    {
        $this->description = $description;
    }

    public function setAdminID(int $adminID): void
    {
        $this->adminID = $adminID;
    }

    public function setState(String $state): void
    {
        $this->state = $state;
    }

    public function setPriority(String $priority): void
    {
        $this->priority = $priority;
    }

    public function setDate_end($date_end): void
    {
        $this->date_end = $date_end;
    }

        

    public function getDescription() {
        return $this->description;
    }

    public function getAdmin() {
        return $this->adminID;
    }

    public function getState() {

    }

    public function getPriority() {
        return $this->priority;
    }

    public function getCreatedAt() {
        return $this->create_at;
    }

    public function getDateEnd() {
        return $this->date_end;
    }

       
}