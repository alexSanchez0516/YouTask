<?php
namespace interfaces;

interface crud {

    public function createC(int $user) : bool;
    public function updateC(int $user) : bool;
    public function deleteC(int $user) : bool;
    public function getAllC(int $user) : Array;
    public function deleteMemberC(int $user) : bool;

}

