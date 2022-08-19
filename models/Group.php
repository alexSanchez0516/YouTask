<?php
namespace Model;
use interfaces\crud;

class Group extends ActiveRecord implements crud{

    protected static $db;
    protected static $colDB = ['',''];
    protected static $tabla = 'Groups';

    protected static array $alerts = [];


    public String $name;
    public String $description;
    public $adminID;
    public Array $members; //apilar


    public function __construct($args = []) {
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->adminID = $args['adminID'] ?? '0';
    }


    public function createC(int $user) : bool {
        return true;
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
    public function deleteMemberC(int $user) : bool {return true;}

}