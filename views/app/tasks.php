<?php include_once __DIR__ . "/../templates/menuTopPanel.php"; ?>

<div class="row align-items-center mt-4 justify-content-center">
    <div class="col-6 d-flex justify-content-center align-items-center">
        <h3 class="text-center text-dark fs-2 my-5 text-uppercase ">Tareas</h3>
        <i class="fas fa-tasks text-dark fs-1 mx-3"></i>
    </div>
    <div class="col-12 bg-white border rounded shadow p-3 w-100">
        <div class="row align-items-center justify-content-center w-100">
            <nav class="navbar navbar-expand navbar-light ">
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <div class="row w-100">
                        <ul class="navbar-nav col-12 col-md-7 justify-content-center">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Estado
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a onclick="getTasksPaginate('task.state','REALIZADO');" class="dropdown-item">Realizado</a></li>
                                    <li><a onclick="getTasksPaginate('task.state','EN PROCESO');" class="dropdown-item">En progreso</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a onclick="getTasksPaginate('task.state','CANCELADO');" class="dropdown-item">Cancelado</a></li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Prioridad
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a onclick="getTasksPaginate('task.priority','ALTA');" class="dropdown-item">Alta</a></li>
                                    <li><a onclick="getTasksPaginate('task.priority','MEDIA');" class="dropdown-item">Media</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a onclick="getTasksPaginate('task.priority','BAJA');" class="dropdown-item">Baja</a></li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Fecha
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a onclick="getTasksPaginate('create_at','desc');" class="dropdown-item">Mas recientes</a></li>
                                    <li><a onclick="getTasksPaginate('create_at','asc');" class="dropdown-item">Mas antiguos</a></li>
                                </ul>
                            </li>

                        </ul>
                        <form class="d-flex col-12 col-md-5">
                            <input class="form-control me-2 " id="search" type="search" placeholder="Escribe el nombre" aria-label="Search">
                        </form>
                    </div>

                </div>
            </nav>

        </div>
    </div>
    <div class="table-responsive  m-3 bg-white w-100 rounded">
        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">Prioridad</th>
                    <th width="40%" scope="col">Tarea</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Proyecto</th>
                    <th scope="col">Cierre</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="content__tasks">


            </tbody>
        </table>
        <?php echo $Paginator->buildLinks('tareas'); ?>

    </div>
</div>