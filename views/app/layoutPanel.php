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
    <title>YouTask Panel</title>
</head>


<body class="container-fluid">
    <header class="flex-column bg-dark" data-cy=''>
        <div class="container-fluid ">
            <div class="row">
                <picture class="col-6">
                    <i class="fas text-white fa-crop fs-1"></i>
                </picture>
                <nav class="col-6 my-4 d-flex justify-content-end">
                    <div class="row nav_wrap_panel">
                        <div class="nav__panel col-12 align-self-center" id="nav-menu">

                            <ul class="nav__list  d-flex justify-content-around w-100">
                                <li class="nav__item"><i class="fas fa-bell text-white fs-2"></i></li>
                                <li class="nav__item"><i class="fas fa-cog text-white fs-2"></i></li>
                                <li class="nav__item"><a href="/perfil" class="text-decoration-none text-white"><i class="far fa-user text-white fs-2"></i></a></li>

                            </ul>

                        </div>

                    </div>
                </nav>

            </div>
        </div>
    </header>
    <script src="/build/js/app.js"></script>
    <script src="/build/js/bootstrap.min.js"></script>
    <script src="/build/js/jquery.min.js"></script>


    <?php echo $content; ?>
    <footer class="bg-dark d-flex flex-column">
        <div class=" footer__Copyright">
            <p class="text-dark text-center mt-3 text-white ">Copyright © 2022 YouTask. All rights reserved. | Desarrollado por <a href="http://www.alexandersanchez.ovh" class=" text-dark ">Alexander Sánchez</a></p>
        </div>
    </footer>

</body>