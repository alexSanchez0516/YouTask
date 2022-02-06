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
    <header class="flex-column" data-cy=''>
        <div class="container-fluid ">
            <div class="row">
                <picture class="col-1 col-sm-4 col-md-6">
                    <a href="/"><i class="fas text-dark fa-crop fs-1"></i></a>
                </picture>
                <nav class="col-11 col-sm-8 col-md-6 my-4 d-flex justify-content-end">
                    <div class="row nav_wrap_panel w-100">
                        <div class="nav__panel col-12 align-self-center" id="nav-menu">

                            <ul class="nav__list  d-flex justify-content-center w-100">
                                <li class="nav__item"><i class="fas fa-bell text-dark fs-2 mx-4"></i></li>
                                <li><a href="#" class="text-decoration-none text-dark"><i class="fas fa-users fs-2 mx-4"></i></a>

                                <li><a href="#" class="text-decoration-none text-dark"><i class="fas fa-user-friends fs-2 mx-4"></i></a>
                                <li class="nav__item"><a href="/perfil" class="text-decoration-none text-dark"><i class="far fa-user text-dark fs-2"></i></a></li>

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



    <main class="wrap d-flex flex-column">
        <div class="container-fluid">
            <div class="row">
                <div class="col-1 " id="menu-left-panel">
                    <ul class="d-flex flex-column align-items-center">
                        <li class="nav__item my-5"><a href="/panel"><i class="fas fa-chart-line text-dark fs-1"></i></a></li>
                        <li class="nav__item my-5"><i class="far fa-calendar-check text-dark fs-1"></i></li>
                        <li class="nav__item my-5"><i class="fas fa-project-diagram text-dark fs-1"></i></li>
                        <li class="nav__item my-5"><i class="fas fa-tasks text-dark fs-1"></i></li>
                        <li class="nav__item my-5"><i class="fas fa-sign-out-alt text-dark fs-1"></i></li>

                    </ul>
                </div>
                <div class="col-10 mx-2 d-flex border shadow flex-column " style="border-radius:1em";>
                    <?php include_once __DIR__ . "/../templates/alerts.php"; ?>

                    <?php echo $content; ?>
                </div>
            </div>
        </div>
    </main>


    <footer class=" d-flex flex-column">
        <div class=" footer__Copyright">
            <p class="text-dark text-center mt-3 text-dark ">Copyright © 2022 YouTask. All rights reserved. | Desarrollado por <a href="http://www.alexandersanchez.ovh" class=" text-dark ">Alexander Sánchez</a></p>
        </div>
    </footer>

</body>