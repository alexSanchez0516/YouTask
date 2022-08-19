<div class="row " id="cover-profile" data-id="<?php echo $_SESSION['user'] ?>">
    <div class="col-5 col-sm-4 col-md-2">
        <img src="/build/img/<?php echo $_SESSION['avatar'] ?>" class="img-fluid " alt=""></img>
    </div>
    <div class="col-7 d-flex flex-column justify-content-center">
        <span class="text-white"><?php echo $_SESSION['username'] ?></span><br>
        <span class="text-white"><?php echo $_SESSION['rol'] ?></span>
        <a href="/editar-perfil" class="text-decoration-underline mt-2 text-white">Editar Perfil</a>
    </div>
</div>

<nav class="mt-2 d-flex justify-content-center" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/actividad" class="text-decoration-none ">Actividad</a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="/perfil" class="breadcrumb-item  text-decoration-none">Perfil</a></li>
        <li class="breadcrumb-item"><a href="/posts" class="text-decoration-none ">Post</a></li>
        <li class="breadcrumb-item"><a href="/seguidores" class="text-decoration-none ">Seguidores</a></li>
    </ol>
</nav>
