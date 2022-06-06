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
                                    <li><a class="dropdown-item" href="#">Realizado</a></li>
                                    <li><a class="dropdown-item" href="#">En progreso</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Cancelado</a></li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Prioridad
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Alta</a></li>
                                    <li><a class="dropdown-item" href="#">Media</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Baja</a></li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Fecha
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Mas recientes</a></li>
                                    <li><a class="dropdown-item" href="#">Mas antiguos</a></li>
                                </ul>
                            </li>

                        </ul>
                        <form class="d-flex col-12 col-md-5">
                            <input class="form-control me-2 " type="search" placeholder="Escribe el nombre" aria-label="Search">
                            <button class="btn btn-dark " type="submit">Buscar</button>
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
            <tbody>

                <?php for ($i = 1; $i < count($results->data); $i++) : ?>
                    <tr>


                        <!-- PRIORITY -->
                        <?php if ($results->data[$i]['priority'] == 'ALTA') : ?>
                            <td class="bg-danger text-white border rounded"><?php echo $results->data[$i]['priority']; ?></td>
                        <?php endif; ?>

                        <?php if ($results->data[$i]['priority'] == 'BAJA') : ?>
                            <td class="bg-primary text-white border rounded"><?php echo $results->data[$i]['priority']; ?></td>
                        <?php endif; ?>

                        <?php if ($results->data[$i]['priority'] == 'MEDIA') : ?>
                            <td class="bg-secondary text-white border rounded"><?php echo $results->data[$i]['priority']; ?></td>
                        <?php endif; ?>


                        <td><?php echo $results->data[$i]['name']; ?></td>



                        <!-- SSTATE -->

                        <?php if ($results->data[$i]['state'] == 'REALIZADO') : ?>
                            <td class="bg-success text-white border rounded"><?php echo $results->data[$i]['state']; ?></td>
                        <?php endif; ?>

                        <?php if ($results->data[$i]['state'] == 'EN PROCESO') : ?>
                            <td class="bg-secondary text-white border rounded"><?php echo $results->data[$i]['state']; ?></td>
                        <?php endif; ?>

                        <?php if ($results->data[$i]['state'] == 'CANCELADO') : ?>
                            <td class="bg-danger text-white border rounded"><?php echo $results->data[$i]['state']; ?></td>
                        <?php endif; ?>


                        <!-- NOMBRE PROYECTO -->
                        <td><?php echo $results->data[$i]['Project']; ?></td>

                        <!-- FECHA -->

                        <td><?php echo $results->data[$i]['date_end']; ?></td>


                        <td class=" btn btn-danger bg-danger border rounded"><i class="fa-solid fa-trash-can"></i></td>
                        <td class="btn btn-danger bg-primary border rounded"><i class="fa-solid fa-pen-to-square"></i></td>

                    </tr>
                <?php endfor; ?>

            </tbody>
        </table>
        <?php echo $Paginator->buildLinks(); ?>

    </div>
</div>