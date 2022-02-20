<?php if (empty($projects)) : ?>
    <div class="d-flex flex-column w-100 align-items-center mt-5" id="wrap_initials">
        <h1 class="w-100"><span class="badge bg-success w-100">Bienvenido a YouTask</span></h1>
        <div class="d-flex w-75 flex-column mt-4 justify-content-center">
            <button type="button" id="create_project" class="btn btn-success my-2 mx-2 w-100">Crear proyecto</button>
            <button type="button" id="create_task" class="btn btn-success my-2 mx-2 w-100">Crear tarea</button>
        </div>
        <div class="w-75 mt-2">
            <p class="w-100">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime ullam, eum itaque, id minima corrupti labore dicta iste nemo voluptatum est? Error veniam cupiditate non, ipsam lorem ipsum dolor sit ametlorem lorem quidem odio aut. Officia!Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam veritatis atque incidunt minus eum maiores voluptatibus dignissimos aliquid! Eligendi nobis corporis assumenda voluptatem autem fugiat, neque eius quae animi alias. Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt repudiandae, sapiente vitae praesentium, tenetur consequatur itaque rerum quo pariatur voluptatibus alias saepe sunt, sit doloremque ipsa possimus vel fuga. Placeat. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo magnam natus tempora, unde nam sed amet aliquid consequuntur, modi eum at. Facere aperiam earum sint voluptatem dolore neque, ipsum amet. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam sequi adipisci unde iure, accusantium tempore minima exercitationem repellat tenetur aperiam beatae quasi assumenda temporibus officia voluptas? Blanditiis iste soluta beatae. Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat incidunt maiores omnis nostrum temporibus veritatis sequi consectetur sed fuga neque commodi voluptates laborum, quis nihil officia soluta veniam laboriosam qui. Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus error nisi laborum? Odit ipsa veniam beatae atque quod? Totam ratione iusto velit eos similique dicta alias quia hic possimus quam! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cumque commodi dignissimos omnis natus minima facilis assumenda necessitatibus quod impedit eligendi vel possimus, dolore non odio eum, accusantium architecto a suscipit! lorem </p>
        </div>
    </div>
    <!-- COMPONENT CREATE PROJECTS ADD TASK-->
    <div class="" id="wrap_create_project">
        <h2 class="mb-4 mt-2">Crear proyecto</h2>
        <form class="row g-3 justify-content-center" action="/panel" method="POST" enctype="multipart/form-data">
            <?php include_once __DIR__ . "/../templates/createProject.php"; ?>
        </form>
    </div>

<?php else : ?>

    <?php include_once __DIR__ . "/../templates/menuTopPanel.php"; ?>

    <div class="row align-items-center mt-5">
        <div class="col-12 d-flex flex-column align-items-center">
            <h2 class="text-uppercase text-success">Últimos avances</h2>
            <div class="row w-100">
                <div class="table-responsive">
                    <table class="table table-bordered table-info">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tarea</th>
                                <th scope="col">Projecto</th>
                                <th scope="col">Inicio</th>
                                <th scope="col">FIN</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Mark</td>
                                <td>15-02-2021</td>
                                <td>15-02-2021</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Mark</td>
                                <td>15-02-2021</td>
                                <td>15-02-2021</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry the Bird</td>
                                <td>Mark</td>
                                <td>15-02-2021</td>
                                <td>15-02-2021</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row justify-content-center mt-3">
                    <div class="col-12 col-sm-4 darkWhiteSpecial mx-2 shadow col-md-3 mt-3 d-flex flex-column">
                        <h3 class="text-center fs-6">Tareas Acabadas</h3>
                        <div class="d-flex w-100 align-items-center">
                            <div class="progress w-100">
                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                            </div>
                            <span class="mx-2">14</span>
                        </div>
                    </div>
                    <div class="col-12 d-flex darkWhiteSpecial shadow col-sm-4 col-md-3 mt-3 flex-column align-items-center">
                        <span class="mx-2 text-center text-white border bg-success rounded w-30">564</span>
                        <div class="d-flex w-100 justify-content-evenly align-items-center">
                            <h4 class="text-center fs-6">Nuevos Proyectos</h4>
                            <!--<img src="build/img/graph.webp" alt="" class="img-responsive" style="width: 70px;">-->
                            <i class="far fa-chart-bar fs-1 mx-2"></i>
                        </div>
                    </div>


                    <div class="col-12 col-sm-3 darkWhiteSpecial mx-2 shadow col-md-5 mt-3 d-flex flex-column">
                        <h3 class="text-center fs-6">Avance del mes</h3>
                        <div class="d-flex w-100 align-items-center">
                            <div class="progress w-100">
                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                            </div>
                            <span class="mx-2">14</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row align-items-center my-3">
        <span class="col-12 text-center my-2 fs-3">Tareas diarias</span>
        <div class="col-12 d-flex flex-column align-items-center">
            <div class="row">
                <div class="d-flex flex-column align-items-center">
                    <span class="w-100 text-center my-2">10:00</span>
                    <div class="d-flex w-100 justify-content-center align-items-center">
                        <div class="d-flex flex-column p-2 rounded w-100 align-items-center mx-2 bg-danger">
                            <span class="w-100 text-center">Design meeting</span>
                            <span class="w-100 text-center">11:00 - 11:30</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column align-items-center mt-3">
                    <span class="w-100 text-center my-3">11:00</span>
                    <div class="d-flex w-100">
                        <div class="d-flex flex-column p-2 rounded w-100 align-items-center bg-info">
                            <span class="w-100 text-center">Design meeting</span>
                            <span class="w-100 text-center">11:00 - 11:30</span>
                        </div>
                        <div class="d-flex flex-column p-2 rounded w-100 align-items-center mx-2 bg-success">
                            <span class="w-100 text-center">Design meeting</span>
                            <span class="w-100 text-center">11:00 - 11:30</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column align-items-center mt-3">
                    <span class="w-100 text-center my-3">11:00</span>
                    <div class="d-flex w-100">
                        <div class="d-flex flex-column p-2 rounded w-100 align-items-center bg-secondary">
                            <span class="w-100 text-center">Design meeting</span>
                            <span class="w-100 text-center">11:00 - 11:30</span>
                        </div>
                        <div class="d-flex flex-column p-2 rounded w-100 align-items-center mx-2 bg-primary">
                            <span class="w-100 text-center">Design meeting</span>
                            <span class="w-100 text-center">11:00 - 11:30</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="row align-items-center mt-4">
        <h3 class="text-center text-success my-3">Tareas Semanal</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-info">
                <thead>
                    <tr>
                        <th scope="col">Prioridad</th>
                        <th width="40%" scope="col">Tarea</th>
                        <th scope="col">Miembros</th>
                        <th scope="col">Estado</th>
                        <th scope="col">fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="bg-danger text-white border rounded" scope="row">Alta</th>
                        <td>Validation HTML</td>
                        <td>juan, andres, pedro</td>
                        <td class="bg-warning text-white border rounded">En Progreso</td>
                        <td>15-02-2021</td>

                    </tr>
                    <tr>
                        <th class="bg-success text-white border rounded" scope="row">Baja</th>
                        <td>Fixed DB Error</td>
                        <td>Thornton</td>
                        <td class="bg-success text-white border rounded">Acabada</td>
                        <td>15-02-2021</td>

                    </tr>
                    <tr>
                        <th class="text-white bg-secondary border rounded" scope="row">Media</th>
                        <td>Configure apache</td>
                        <td>Juan, messi, kids</td>
                        <td class="bg-warning text-white border rounded">En Progreso</td>
                        <td>15-02-2021</td>

                    </tr>
                    <tr>
                        <th class="bg-danger text-white border rounded" scope="row">Alta</th>
                        <td>Validation HTML</td>
                        <td>juan, andres, pedro</td>
                        <td class="bg-warning text-white border rounded">En Progreso</td>
                        <td>15-02-2021</td>

                    </tr>
                    <tr>
                        <th class="bg-success text-white border rounded" scope="row">Baja</th>
                        <td>Fixed DB Error</td>
                        <td>Thornton</td>
                        <td class="bg-success text-white border rounded">Acabada</td>
                        <td>15-02-2021</td>

                    </tr>
                    <tr>
                        <th class="text-white bg-secondary border rounded" scope="row">Media</th>
                        <td>Configure apache</td>
                        <td>Juan, messi, kids</td>
                        <td class="bg-warning text-white border rounded">En Progreso</td>
                        <td>15-02-2021</td>

                    </tr>
                    <tr>
                        <th class="bg-danger text-white border rounded" scope="row">Alta</th>
                        <td>Validation HTML</td>
                        <td>juan, andres, pedro</td>
                        <td class="bg-warning text-white border rounded">En Progreso</td>
                        <td>15-02-2021</td>

                    </tr>
                    <tr>
                        <th class="bg-success text-white border rounded" scope="row">Baja</th>
                        <td class="">Fixed DB Error</td>
                        <td>Thornton</td>
                        <td class="bg-success text-white border rounded">Acabada</td>
                        <td>15-02-2021</td>

                    </tr>
                    <tr>
                        <th class="text-white bg-secondary border rounded" scope="row">Media</th>
                        <td>Configure apache</td>
                        <td>Juan, messi, kids</td>
                        <td class="bg-warning text-white border rounded">En Progreso</td>
                        <td>15-02-2021</td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>



<?php endif; ?>