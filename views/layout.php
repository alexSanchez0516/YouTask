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
    <link rel="icon" href="/build/img/Favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../build/css/app.css">
    <!-- Primary Meta Tags -->
    <title>YouTask</title>
</head>

<body>
    <header class="" data-cy=''>
    </header>
    <script src="../build/js/app.js"></script>

    <?php echo $content; ?>


    <footer class="">

    </footer>

</body>