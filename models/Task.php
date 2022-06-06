<?php

namespace Model;

use interfaces\crud;

class Task extends ActiveRecord implements crud
{
    protected static $db;
    protected static $colDB = ['id', 'name', 'description', 'adminID', 'state', 'priority', 'date_end', 'projectID'];
    protected static $tabla = 'Tasks';

    protected static array $alerts = [];


    public int $id;
    public String $name;
    public String $description;
    public int $adminID;
    public String $state;
    public String $priority;
    public $date_end;
    public  $projectID;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? 0;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->adminID = $args['adminID'] ?? 0;
        $this->state = $args['state'] ?? '';
        $this->priority = $args['priority'] ?? '';
        $this->date_end = $args['date_end'] ?? '';
        $this->projectID = $args['projectID'] ?? 'NULL';
    }

    public function createC($project): bool
    {

        if ($this->validateAttributes($this->sanitizeData())) {
            $this->state = "EN PROCESO";
            $this->id = $_SESSION['user'];
            $this->adminID = $_SESSION['user'];


            if ($project == "NULL") {
                array_pop(static::$colDB);
            }



            return $this->create();
        }
    }

    public function updateC(int $user): bool
    {
        return true;
    }

    public function deleteC(int $user): bool
    {
        return true;
    }

    public function getAllC(int $user): array
    {
        return $this->find("adminID", $user, true);
    }

    public function deleteMemberC(int $user): bool
    {
        return true;
    }
}
