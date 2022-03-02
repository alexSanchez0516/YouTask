<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public static $currentUrl;
    public static $urlsProtected;
    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function checkRutes()
    {

        session_start();

        $auth = $_SESSION['auth'] ?? null;

        self::$urlsProtected = ['/panel', '/perfil', '/crear-proyecto', '/crear-tarea', '/calendario', '/proyectos', '/proyecto', '/tareas', '/tarea'];

        self::$currentUrl = $_SERVER['REQUEST_URI'] ?? '/';
        for ($i = 0; $i < strlen(self::$currentUrl); $i++) {
            # code...
            if (self::$currentUrl === '?') {
               
                self::$currentUrl = substr(self::$currentUrl, 0, $i);
                break;
            }
        }



        $method = $_SERVER['REQUEST_METHOD'];


        if ($method === 'GET') {
            //debug(self::$currentUrl);
            $fn = $this->getRoutes[self::$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[self::$currentUrl] ?? null;
        }

        if (in_array(self::$currentUrl, self::$urlsProtected) && !$auth) {
            header('Location: /');
        }
        if ($fn) {
            // Call user fn va a llamar una función cuando no sabemos cual sera
            call_user_func($fn, $this); // This es para pasar argumentos
        } else {
            header('Location: /404.php');
        }
    }

    public function render($view, $datos = [])
    {
        // Leer lo que le pasamos  a la vista
        foreach ($datos as $key => $value) {
            $$key = $value;  // Doble signo de dolar significa: variable variable, básicamente nuestra variable sigue siendo la original, pero al asignarla a otra no la reescribe, mantiene su valor, de esta forma el nombre de la variable se asigna dinamicamente
        }

        ob_start(); // Almacenamiento en memoria durante un momento...

        // entonces incluimos la vista en el layout

        include_once __DIR__ . "/views/$view.php";
        $content = ob_get_clean(); // Limpia el Buffer

        if (array_key_exists('auth', $_SESSION)) {
            if ($_SESSION['auth']) {
                if (in_array(self::$currentUrl, self::$urlsProtected)) {
    
                    include_once __DIR__ . '/views/app/layoutPanel.php';
                } else {
                    include_once __DIR__ . '/views/layout.php';
                }
        }
        
        } else {
            include_once __DIR__ . '/views/layout.php';
        }
    }
}
