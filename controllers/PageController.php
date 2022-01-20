<?php

namespace Controllers;

use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;
use Model\Users;


class PageController
{
    public static function index(Router $router)
    {
        $router->render('pages/inicio', []);
    }
}
