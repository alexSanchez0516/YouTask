<?php include_once __DIR__ . "/../templates/menuTopPanel.php"; ?>

<div class="row align-items-center mt-4 justify-content-center">
    <div class="col-6 d-flex justify-content-center align-items-center">
        <h3 class="text-center text-dark fs-2 my-5 text-uppercase ">Tareas</h3>
        <i class="fas fa-tasks text-dark fs-1 mx-3"></i>
    </div>
    <div class="col-12 bg-white border rounded shadow p-3 w-100">
        <div class="row align-items-center justify-content-center w-100">
            <nav class="navbar navbar-expand navbar-light bg-light">
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
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Prioridad</th>
                    <th width="40%" scope="col">Tarea</th>
                    <th scope="col">Miembros</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Proyecto</th>
                    <th scope="col">fecha</th>
                </tr>
            </thead>
            <tbody>
                <tr onclick="window.location.href='/tarea'">
                    <th class="bg-danger text-white border rounded" scope="row">Alta</th>
                    <td>Validation HTML</td>
                    <td>juan, andres, pedro</td>
                    <td class="bg-warning text-white border rounded">En Progreso</td>
                    <td class="bg-info text-white border rounded">Divisione</td>
                    <td class="bg-danger text-white border rounded">15-02-2021</td>

                </tr>
                <tr>
                    <th class="bg-success text-white border rounded" scope="row">Baja</th>
                    <td>Fixed DB Error</td>
                    <td>Thornton</td>
                    <td class="bg-success text-white border rounded">Acabada</td>
                    <td class="bg-info text-white border rounded">Divisione</td>
                    <td>15-02-2021</td>

                </tr>
                <tr>
                    <th class="text-white bg-secondary border rounded" scope="row">Media</th>
                    <td>Configure apache</td>
                    <td>Juan, messi, kids</td>
                    <td class="bg-warning text-white border rounded">En Progreso</td>
                    <td class="bg-info text-white border rounded">Divisione</td>
                    <td>15-02-2021</td>

                </tr>
                <tr>
                    <th class="bg-danger text-white border rounded" scope="row">Alta</th>
                    <td>Validation HTML</td>
                    <td>juan, andres, pedro</td>
                    <td class="bg-warning text-white border rounded">En Progreso</td>
                    <td class="bg-info text-white border rounded">Divisione</td>
                    <td>15-02-2021</td>

                </tr>
                <tr>
                    <th class="bg-success text-white border rounded" scope="row">Baja</th>
                    <td>Fixed DB Error</td>
                    <td>Thornton</td>
                    <td class="bg-success text-white border rounded">Acabada</td>
                    <td class="bg-info text-white border rounded">Divisione</td>
                    <td>15-02-2021</td>

                </tr>
                <tr>
                    <th class="text-white bg-secondary border rounded" scope="row">Media</th>
                    <td>Configure apache</td>
                    <td>Juan, messi, kids</td>
                    <td class="bg-warning text-white border rounded">En Progreso</td>
                    <td class="bg-info text-white border rounded">Divisione</td>
                    <td>15-02-2021</td>

                </tr>
                <tr>
                    <th class="bg-danger text-white border rounded" scope="row">Alta</th>
                    <td>Validation HTML</td>
                    <td>juan, andres, pedro</td>
                    <td class="bg-warning text-white border rounded">En Progreso</td>
                    <td class="bg-info text-white border rounded">Divisione</td>
                    <td>15-02-2021</td>

                </tr>
                <tr>
                    <th class="bg-success text-white border rounded" scope="row">Baja</th>
                    <td class="">Fixed DB Error</td>
                    <td>Thornton</td>
                    <td class="bg-success text-white border rounded">Acabada</td>
                    <td class="bg-info text-white border rounded">Divisione</td>
                    <td>15-02-2021</td>

                </tr>
                <tr>
                    <th class="text-white bg-secondary border rounded" scope="row">Media</th>
                    <td>Configure apache</td>
                    <td>Juan, messi, kids</td>
                    <td class="bg-warning text-white border rounded">En Progreso</td>
                    <td class="bg-info text-white border rounded">Divisione</td>
                    <td>15-02-2021</td>

                </tr>
            </tbody>
        </table>
        <nav aria-label="...">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Anterior</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Siguiente</a>
                </li>
            </ul>
        </nav>
    </div>
</div>