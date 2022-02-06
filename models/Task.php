<?php 
namespace Model;

class Task extends ActiveRecord {
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

    public function createTask(Users $user, $project) {
        if ($this->validateAttributes($this->sanitizeData())) {
            $this->state = "EN PROCESO";
            $this->id = $user->id; 
            debug($this);
            return $this->create();

        }
    }

    public function updateTask() {

    }

    public function deleteTask() {
        
    }
}