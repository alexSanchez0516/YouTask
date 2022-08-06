<?php if ($projects < 1) : ?>
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
                    <table class="table table-bordered table-light">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tarea</th>
                                <th scope="col">Projecto</th>
                                <th scope="col">Inicio</th>
                                <th scope="col">Fin</th>

                            </tr>
                        </thead>
                        <tbody>


                            <?php foreach ($lastProgress as $project) : ?>
                                <tr>
                                    <th scope="row"><?php echo $project['id']; ?></th>
                                    <td><?php echo $project['name'] ?></td>
                                    <td><?php echo $project['NameProject']; ?></td>
                                    <td><?php echo $project['create_at']; ?></td>
                                    <td><?php echo $project['date_end']; ?></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

                <div class="row justify-content-center mt-3">
                    <div class="col-12 col-sm-4 darkWhiteSpecial mx-2 shadow col-md-3 mt-3 d-flex flex-column">
                        <h3 class="text-center fs-6">Tareas Acabadas</h3>
                        <div class="d-flex w-100 align-items-center">
                            <div class="progress w-100">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo $porcentTasks . '%'; ?>" aria-valuenow="<?php echo $porcentTasks; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $porcentTasks . '%'; ?></div>
                            </div>
                            <span class="mx-2"><?php echo $TaskQuantity; ?></span>
                        </div>
                    </div>
                    <div class="col-12 d-flex darkWhiteSpecial shadow col-sm-4 col-md-3 mt-3 flex-column align-items-center">
                        <span class="mx-2 text-center text-white border bg-success rounded w-30"><?php echo $ProjectsQuantity ?></span>
                        <div class="d-flex w-100 justify-content-evenly align-items-center">
                            <h4 class="text-center fs-6">Cantidad Proyectos</h4>
                            <i class="far fa-chart-bar fs-1 mx-2"></i>
                        </div>
                    </div>


                    <div class="col-12 col-sm-3 darkWhiteSpecial mx-2 shadow col-md-5 mt-3 d-flex flex-column">
                        <h3 class="text-center fs-6">Avance del mes</h3>
                        <div class="d-flex w-100 align-items-center">
                            <div class="progress w-100">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo $porcentTasksMonth . '%'; ?>" aria-valuenow="<?php echo $porcentTasksMonth; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $porcentTasksMonth . '%'; ?></div>
                            </div>
                            <span class="mx-2"><?php echo $taskMonth; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php //debug($tasks); 
    ?>
    <div class="row align-items-center my-3">
        <span class="col-12 text-center my-2 fs-3 text-success">Tareas prioritarias</span>
        <div class="col-12 d-flex flex-column align-items-center">
            <div class="row w-md-75 w-100 d-flex justify-content-center">
                <div class="col-md-10 col-12 d-flex flex-wrap justify-content-center">
                    <?php foreach ($tasks as $task) : ?>
                        <div class="card m-2 shadow border rounded" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title text-primary"><a href="/tarea?id=<?php echo $task['id'] ?>"><?php echo $task['name'] ?></a></h5>
                                <p class="card-text"><strong>Resumen:</strong> <?php echo $task['description'] ?></p>
                                <span><span class="text-danger">Fecha Fin:</span> <?php echo substr($task['date_end'], 0, 11) ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>

    <div class="row align-items-center mt-4">
        <h3 class="text-center text-success my-3">Tareas (MES)</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-dark">
                <thead>
                    <tr>
                        <th scope="col">Prioridad</th>
                        <th width="40%" scope="col">Tarea</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Estado</th>
                        <th scope="col">fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasksMonth as $task) : ?>
                        <?php //debug($task); 
                        ?>
                        <tr>
                            <?php if ($task['priority'] == 'ALTA') : ?>
                                <th class="bg-danger text-white border rounded" scope="row"><?php echo $task['priority']; ?></th>
                            <?php elseif ($task['priority'] == 'MEDIA') : ?>
                                <th class="bg-secondary text-white border rounded" scope="row"><?php echo $task['priority']; ?></th>
                            <?php elseif ($task['priority'] == 'BAJA') : ?>
                                <th class="bg-primary text-white border rounded" scope="row"><?php echo $task['priority']; ?></th>
                            <?php endif; ?>

                            <th class="bg-primary text-white border rounded" scope="row"><?php echo $task['name']; ?></th>
                            <td><?php echo $task['description']; ?></td>


                            <td class="bg-success text-white border rounded"><?php echo $task['state']; ?></td>
                            <td><?php echo $task['date_end']; ?></td>

                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="row">

    </div>

<?php endif; ?>