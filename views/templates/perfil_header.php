<div class="row " id="cover-profile">
    <div class="col-5 col-sm-4 col-md-2">
        <img src="/build/img/<?php echo $_SESSION['user']->avatar ?>" class="img-fluid " alt=""></img>
    </div>
    <div class="col-7 d-flex flex-column justify-content-center">
        <span>Alexander Sanchez</span><br>
        <span>UXUI + Frontend Developer</span>
        <a href="/editar-perfil" class="text-decoration-none mt-2">Editar Perfil</a>
    </div>
</div>

<nav class="mt-2 d-flex justify-content-center" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#" class="text-decoration-none ">Actividad</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="/perfil" class="breadcrumb-item active text-decoration-none">Perfil</a></li>
        <li class="breadcrumb-item"><a href="#" class="text-decoration-none ">Post</a></li>
        <li class="breadcrumb-item"><a href="/amigos" class="text-decoration-none ">Amigos</a></li>
    </ol>
</nav>