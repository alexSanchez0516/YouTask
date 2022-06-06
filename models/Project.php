<?php

namespace Model;

use interfaces\crud;


class Project extends ActiveRecord implements crud
{
    protected static $db;
    protected static $colDB = ['id', 'name', 'description', 'adminID', 'state', 'priority', 'date_end'];
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


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? 0;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->adminID = $args['adminID'] ?? '0';

        $this->state = $args['state'] ?? '';
        $this->priority = $args['priority'] ?? '';
        $this->date_end = $args['date_end'] ?? '';
    }

    public function createC(int $user): bool
    {
        if ($this->validateAttributes($this->sanitizeData())) {
            $this->state = "EN PROCESO";
            $this->adminID = $user;


            return $this->create();
        }
    }



    public function deleteC(int $user): bool
    {
        return true;
    }

    public function updateC(int $user): bool
    {
        return true;
    }

    public  function getAllC(int $user): array
    {
        return $this->find("adminID", $user, true);
    }

    public function getID()
    {
        return $this->id;
    }

    public function getName()
    {
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

    public function getCreatedAt()
    {
        return $this->create_at;
    }

    public function getDateEnd()
    {
        return $this->date_end;
    }

    public function deleteMemberC(int $user): bool
    {
        return true;
    }

    public function addMember(int $user_id, int $id_project)
    {
        $query = "INSERT INTO Members_Projects(id_project, id_user) VALUES ($user_id, $id_project)";
        debug($query);
    }

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
        //debug($query);
        try {
            static::$db->query($query);
        } catch (\Throwable $th) {

            $valid = false;
        }

        return $valid;
    }
}
