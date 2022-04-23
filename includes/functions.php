<?php

use PHPMailer\PHPMailer\PHPMailer;


define('TEMPLATES_URL', __DIR__ .  '/templates');
define('FUNCIONES_URL', '/includes/funciones.php');
define('FOLDER_IMG', $_SERVER['DOCUMENT_ROOT'] . '/build/img/');


function includeTemplate($name)
{
    include TEMPLATES_URL . "/${name}.php";
}

function isAuth(): void
{
    session_start();

    //login es true
    if (!$_SESSION['login']) {
        header('Location: /');
    }
}

function paginateContent($page)
{
    //mostrar 5
    //si hay mas de 5 paginas
    //si pulsa siguiente limpiar div y mostrar limit + 5
    //calcular las 5 a mostrar limit - 5 => de la 5 a la 10
    //mostrar
}
function checkString($text)
{
    // Patrón para usar en expresiones regulares (admite letras acentuadas y espacios):
    $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";


    return preg_match($patron_texto, $text);
}



function debug($item)
{
    echo "<pre>";
    var_dump($item);
    echo "</pre>";
    exit;
}

function s($html): string
{
    $s = htmlspecialchars($html);
    return trim($s);
}

function validateOrRedirect(String $url)
{
    $id = null;

    if ($_GET['id']) {
        $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    }




    if (!$id) {
        header("Location: ${url}");
    }

    return $id;
}
