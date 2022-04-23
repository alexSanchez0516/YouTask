<?php


require 'functions.php';
require 'config/db.php';
require __DIR__ . '/../vendor/autoload.php';

$db = connectDB();

use Model\ActiveRecord;
use Model\Users;
use Model\Project;
use Model\Task;
use Model\Group;
use Model\Post;
use Model\Action;
use Model\Comment;

ActiveRecord::setDB($db);
Users::setDB($db);
Project::setDB($db);
Task::setDB($db);
Group::setDB($db);
Post::setDB($db);
Action::setDB($db);
Comment::setDB($db);
