<?php


if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false; //si no existe es igual a null

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/build/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../build/css/app.css">

    <!-- Primary Meta Tags -->
    <title>YouTask</title>
</head>

<body>
    <header class="flex-column" data-cy=''>

        <!-- Beginning NAVBAR -->
        <nav class="nav d-flex ">
            <div class="w-50 d-flex">
                <a class="nav__logo" href="#"><img src="/build/img/logo.png" id="logo" class="" alt="logo"></img></a>
                <p class="align-self-center  fs-3 fw-bold text-primary text-uppercase">YouTask.</p>
            </div>
            <div class="nav__menu w-50 align-self-center" id="nav-menu">
                <ul class="nav__list d-flex justify-content-around ">
                    <li class="nav__item"><a href="/inicio" class="nav__link text-decoration-none">Inicio</a></li>
                    <li class="nav__item"><a href="" class="nav__link text-decoration-none">Blog</a></li>
                    <li class="nav__item"><a href="" class="nav__link text-decoration-none">Contacto</a></li>
                    <li class="nav__item"><a href="/register" class="nav__link text-decoration-none">Crear cuenta</a></li>
                    <li class="nav__item"><a href="/login" class="nav__link text-decoration-none">Ingresar</a></li>
                </ul>
            </div>


            
        </nav>

        <!-- END NAVBAR -->

    </header>

    <script src="/build/js/app.js"></script>
    <script src="/build/js/bootstrap.bundle.js"></script>

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