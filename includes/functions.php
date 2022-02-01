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

/*
function configMail($responses, int $type): bool
{
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = '66db1061f0f6da';
    $mail->Password = '00034bee0d0cbe';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 2525;

    $mail->setFrom('support@divisione.es', $responses['name']);
    $mail->addAddress('support@divisione.es', 'BienesRaices.com');
    $mail->Subject = 'Tienes un Nuevo Email';

    $mail->isHTML(TRUE);
    $mail->CharSet = 'UTF-8';



    $contenido = '<html>';
    $contenido .= "<p><strong>¡Tienes un futuro cliente!:</strong></p>";
    $contenido .= "<p>Nombre: " . $responses['name'] . "</p>";
    $contenido .= "<p>Email: " . $responses['email'] . "</p>";

    if ($type == 1) {

        $contenido .= "<p>Compañia: " . $responses['company'] . "</p>";
        $contenido .= "<p>Compañia URL: " . $responses['url'] . "</p>";
        $contenido .= "<p>Contenido principal: " . $responses['content'] . "</p>";
        $contenido .= "<p>Funcionalidad principal: " . $responses['func'] . "</p>";
        $contenido .= "<p>Web STATUS: " . $responses['state'] . "</p>";
        $contenido .= "<p>Experiencia: " . $responses['xp'] . "</p>";
    }

    if ($type == 2) {
        $contenido .= "<p>Compañia: " . $responses['company'] . "</p>";
        $contenido .= "<p>Compañia URL: " . $responses['url'] . "</p>";
        $contenido .= "<p>Contenido principal: " . $responses['content'] . "</p>";
    }

    $contenido .= "<p>Mensage: " . $responses['msg'] . "</p>";

    $contenido .= '</html>';
    $mail->Body = $contenido;
    $mail->AltBody = 'Esto es texto alternativo';


    return $mail->send();
}

*/
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
    return $s;
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
