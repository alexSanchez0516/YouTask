<?php

function connectDB() {
    $db = new MySQLi('localhost', 'root', '1690001299Gr.', 'youtask');

    if (!$db) {
        echo "No hay conexion";
        exit;
    } 

    return $db;
}
