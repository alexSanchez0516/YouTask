<?php


if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['auth'] ?? false; //si no existe es igual a null

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/build/img/logo_oficial.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../build/css/app.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>YouTask</title>
</head>

<body class="container-fluid">
    <header class="flex-column bg-light-green" data-cy=''>
        <div class="container-fluid m-0">
            <!-- Beginning NAVBAR -->
            <div class="row">
                <nav class="nav d-flex ">
                    <div class="nav_wrapper d-flex">
                        <div class="w-75 d-flex">
                            <a href="/"><img src="/build/img/logo_oficial.png" class="img-responsive w-50 nav__logo my-2 mx-2" alt=""></a>
                        </div>
                        <div class="nav__response">
                            <i class="fas fa-bars h2 "></i>
                        </div>
                    </div>
                    <div class="nav__menu w-50 align-self-center" id="nav-menu">

                        <ul class="nav__list d-flex justify-content-around w-100 mt-3">
                            <li class="nav__item"><a href="/inicio" class="nav__link text-decoration-none text-white" style="font-weight:bold;">Inicio</a></li>
                            <li class="nav__item"><a href="/contacto" class="nav__link text-decoration-none text-white" style="font-weight:bold;">Contacto</a></li>

                            <?php if (!array_key_exists('auth', $_SESSION)) : ?>
                                <li class="nav__item"><a href="/registro" class="nav__link text-decoration-none text-white" style="font-weight:bold;">Crear cuenta</a></li>
                                <li class="nav__item"><a href="/login" class="nav__link text-decoration-none text-white" style="font-weight:bold;">Ingresar</a></li>

                            <?php else : ?>
                                <li class="nav__item"><a href="/panel" class="nav__link text-decoration-none text-white" style="font-weight:bold;">Panel</a></li>
                                <li class="nav__item"><a href="/salir" class="nav__link text-decoration-none text-white" style="font-weight:bold;">Cerrar sesión</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>


                </nav>
            </div>

            <!-- END NAVBAR -->
        </div>



    </header>
    <script src="/build/js/app.js"></script>
    <script src="/build/js/bootstrap.min.js"></script>
    <script src="/build/js/jquery.min.js"></script>


    <div class="cookies m-4">
        <img src="/build/img/cookie.svg" alt="politicas de cookies" class="cookies-img w-25">
        <h3 id="cookies__title">Cookies</h3>
        <p id="cookies__text" class="text-center">Utilizamos cookies propias y de terceros para mejorar nuestros servicios.</p>
        <button class="btn btn-primary" id="btn-aceptar-cookies">De acuerdo</button>
        <a class="enlace" href="politica-cookies.html">Aviso de Cookies</a>
    </div>

    <?php echo $content; ?>


    <footer class="bg-dark d-flex flex-column">
        <div class="container p-0">
            <div class="row d-flex justify-content-between">
                <div class="col-12 col-sm-6 p-2 d-flex flex-column align-items-center">
                    <h5 class="text-light">Sobre YouTask</h3>
                        <hr class="bg-secondary w-20" />
                        <ul>
                            <li><a href="" class="text-decoration-none text-light">Funcionalidades</a></li>
                            <li><a href="" class="text-decoration-none text-light">Blog</a></li>
                            <li><a href="" class="text-decoration-none text-light">Ingresar</a></li>
                            <li><a href="" class="text-decoration-none text-light">Crear cuenta</a></li>
                        </ul>
                </div>
                <div class="col-12 col-sm-6 p-2 d-flex flex-column align-items-center">
                    <h5 class="text-light">¿Necesitas ayuda?</h3>
                        <hr class="bg-secondary w-50" />
                        <ul>
                            <li><a href="" class="text-decoration-none text-light">Funcionalidades</a></li>
                            <li><a href="" class="text-decoration-none text-light">Blog</a></li>
                            <li><a href="" class="text-decoration-none text-light">Ingresar</a></li>
                            <li><a href="" class="text-decoration-none text-light">Crear cuenta</a></li>
                        </ul>
                </div>
            </div>
        </div>
        <div class="darkGreen footer__Copyright">
            <form action="https://www.paypal.com/donate" method="post" class="text-center mt-2" target="_top">
                <input type="hidden" name="hosted_button_id" value="XHQ4DBH5MP7HL" />
                <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_donate_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Botón Donar con PayPal" />
                <img alt="" border="0" src="https://www.paypal.com/es_ES/i/scr/pixel.gif" width="1" height="1" />
            </form>
            <p class="text-dark text-center mt-3">Copyright © 2022 YouTask. All rights reserved. | Desarrollado por <a href="http://www.alexandersanchez.ovh" class=" text-dark ">Alexander Sánchez</a></p>
        </div>
    </footer>

</body>
