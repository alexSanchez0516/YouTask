<?php


require 'functions.php';
require 'config/db.php';
require __DIR__ . '/../vendor/autoload.php';

$db = connectDB();
use Model\ActiveRecord;
use Model\Users;

ActiveRecord::setDB($db);
Users::setDB($db);