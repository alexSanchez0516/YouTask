<?php

namespace Controllers;

use MVC\Router;


class PageController
{
    public static function index(Router $router)
    {
        $router->render('pages/inicio', []);
    }

    public static function contact(Router $router)
    {
        $router->render('pages/contact', []);
    }
}
