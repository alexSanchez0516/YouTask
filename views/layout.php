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
    <link rel="icon" href="/build/img/seo.webp" type="image/x-icon">
    <link rel="stylesheet" href="../build/css/app.css">

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
                            <a class="nav__logo mx-2" href=""><i class="fas text-white fa-crop fs-1 "></i></a>
                            <p class="align-self-center  fs-4 fw-bold text-white text-uppercase ">YouTask.</p>
                        </div>
                        <div class="nav__response">
                            <i class="fas fa-bars h2 "></i>
                        </div>
                    </div>
                    <div class="nav__menu w-50 align-self-center" id="nav-menu">

                        <ul class="nav__list d-flex justify-content-around w-100 mt-3">
                            <li class="nav__item"><a href="/inicio" class="nav__link text-decoration-none text-white" style="font-weight:bold;">Inicio</a></li>
                            <li class="nav__item"><a href="" class="nav__link text-decoration-none text-white" style="font-weight:bold;">Blog</a></li>
                            <li class="nav__item"><a href="" class="nav__link text-decoration-none text-white" style="font-weight:bold;">Contacto</a></li>
                            <?php if (!array_key_exists('auth', $_SESSION)): ?>
                                <li class="nav__item"><a href="/registro" class="nav__link text-decoration-none text-white" style="font-weight:bold;">Crear cuenta</a></li>
                                <li class="nav__item"><a href="/login" class="nav__link text-decoration-none text-white" style="font-weight:bold;">Ingresar</a></li>
                            
                            <?php else: ?>
                                <li class="nav__item"><a href="/panel" class="nav__link text-decoration-none text-white" style="font-weight:bold;">Panel</a></li>
                                <li class="nav__item"><a href="/logout" class="nav__link text-decoration-none text-white" style="font-weight:bold;">Cerrar sesión</a></li>
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
            <p class="text-dark text-center mt-3">Copyright © 2022 YouTask. All rights reserved. | Desarrollado por <a href="http://www.alexandersanchez.ovh" class=" text-dark ">Alexander Sánchez</a></p>
        </div>
    </footer>

</body>