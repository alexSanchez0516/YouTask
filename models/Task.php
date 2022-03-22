<?php 
namespace Model;
use interfaces\crud;

class Task extends ActiveRecord implements crud{
    protected static $db;
    protected static $colDB = ['id', 'name', 'description', 'adminID', 'state', 'priority', 'date_end', 'projectID' ];
    protected static $tabla = 'Tasks';

    protected static array $alerts = [];


    public int $id;
    public String $name;
    public String $description;
    public int $adminID;
    public String $state;
    public String $priority;
    public $date_end;
    public int $projectID;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? 0;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->adminID = $args['adminID'] ?? 0;
        $this->state = $args['state'] ?? '';
        $this->priority = $args['priority'] ?? '';
        $this->date_end = $args['date_end'] ?? '';
        $this->projectID = $args['projectID'] ?? 0;
    }

    public function createC(int $project) : bool {
        if ($this->validateAttributes($this->sanitizeData())) {
            $this->state = "EN PROCESO";
            $this->id = $_SESSION['user'];
            
            if ($project > 0) {

            } else {
                $this->projectID = $project;
            }
            
            return $this->create();

        }
    }

    public function updateC(int $user) : bool {
        return true;
    }

    public function deleteC(int $user) : bool {
        return true;
    }

    public function getAllC(int $user) : Array {
        return [];
    }

    public function deleteMemberC(int $user) : bool {
        return true;
    }
}