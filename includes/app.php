<?php


require 'functions.php';
require 'config/db.php';
require __DIR__ . '/../vendor/autoload.php';

$db = connectDB();
use Model\ActiveRecord;
use Model\Users;
use Model\Project;
use Model\Task;

ActiveRecord::setDB($db);
Users::setDB($db);
Project::setDB($db);
Task::setDB($db);