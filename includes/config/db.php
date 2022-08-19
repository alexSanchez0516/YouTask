<?php

function connectDB() {
    $db = new MySQLi($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_DB']);
//	debug($_ENV);
    if (!$db) {
        echo "No hay conexion";
        exit;
    } 

    return $db;
}
