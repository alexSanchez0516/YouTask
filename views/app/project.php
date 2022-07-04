<div class="container primary-content">
    <!-- PRIMARY CONTENT HEADING -->

    <?php include_once __DIR__ . "/../templates/alerts.php" ?>


    <div id="current_id_user" data-id="<?php echo $id_user ?>" class="primary-content-heading clearfix">
        <h2><?php echo $project->name; ?></h2>
        <hr style="border:1px solid #fff">


    </div>
    <!-- END PRIMARY CONTENT HEADING -->
    <div class="row">
        <div class="col-md-8">
            <div class="project-section general-info">
                <h3>General Info</h3>

                <?php if ($admin) : ?>
                    <button type="button" onclick="window.location='/actualizar-proyecto?id=<?php echo $project->id; ?>'" class="btn btn-sm btn-default pull-right"><i class="fa-solid fa-pen-to-square"></i> Editar</button>
                <?php endif; ?>

                <p><?php echo $project->description; ?></p>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-6 my-2">
                                <strong>Administrador: </strong> <span><?php echo $project->getNameAdministrator(); ?></span>
                            </div>
                            <div class="col-md-6 my-2">
                                <strong>Creado el: </strong> <span><?php echo $project->getCreatedAt(); ?></span>
                            </div>
                            <div class="col-md-6 my-2">
                                <strong>Estado: </strong> <span class="text-success"><?php echo $project->state; ?></span>
                            </div>
                            <div class="col-md-6 my-2">
                                <strong>Mensajes: </strong> <span><?php echo $countMessages ?></span>
                            </div>

                            <div class="col-md-6 my-2">
                                <strong>Progreso: </strong>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?php echo $progress ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress ?>%"></div>
                                </div>
                            </div>

                            <div class="col-md-12 my-4">
                                <div class="d-flex flex-column align-items-center">
                                    <strong>TEAM: </strong> <a title="Añadir" data-bs-toggle="modal" data-bs-target="#modal__profiles" class="btn btn-link btn-remove"><i class="fa-solid fa-plus"></i></a>

                                    <ul class="d-flex flex-wrap justify-content-center " id="teams__container">

                                    </ul>
                                    <button type="button" onclick="window.location.href='/miembros-proyecto?id=<?php echo $project->id ?>&limit=10&page=1'" class="btn btn-outline-primary">Ver todos</button>
                                </div>
                            </div>
                            <div id="container__all__tasks" class="col-md-12 my-4">


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="project-section activity">



            </div>
        </div>
        <div class="col-md-4">
            <!-- MY TODO LIST -->
            <div class="widget">
                <div class="widget-header clearfix">
                    <h3><i class="fa fa-calendar"></i> <span>MY TO DO LIST</span></h3>
                    <div class="btn-group widget-header-toolbar">
                        <a href="#" title="Expand/Collapse" class="btn btn-link btn-toggle-expand"><i class="fa fa-ios-arrow-up"></i></a>
                        <a title="Añadir" data-bs-toggle="modal" data-bs-target="#newTaskByProject" href="#" class="btn btn-link btn-remove"><i class="fa-solid fa-plus"></i></a>
                    </div>
                </div>

                <!-- MODAL FOR NEW TASK -->
                <div class="modal fade" id="newTaskByProject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nueva Tarea</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Nombre</label>
                                        <input type="text" id="name__task__by__project" required minlength="1" name="name" class="form-control" id="name">
                                    </div>


                                    <div class="col-10">
                                        <label for="description" class="form-label">Descripcion</label>
                                        <textarea name="description" id="description__task__by__project" minlength="3" required class="form-control" rows="10" id="description" placeholder="Describe tu tarea"></textarea>
                                    </div>


                                    <div class="col-md-4">
                                        <label for="priority" class="form-label">Prioridad</label>
                                        <select id="pririty__task__by__project" name="priority" required class="form-select">
                                            <option value="BAJA" selected>Baja</option>
                                            <option value="MEDIA">Media</option>
                                            <option value="ALTA">Alta</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 my-2">
                                        <label for="projectID" class="form-label">Proyecto</label>

                                        <select id="projectID" name="projectID" class="form-select">
                                            <option value="<?php echo $project->id; ?>"><?php echo $project->name; ?></option>
                                        </select>
                                    </div>
                                    <div class="col-md-8 ">
                                        <label for="date_end" class="form-label text-danger">Fecha Fin</label>

                                        <input type="datetime-local" id="create_end_task__by__project" required class="form-control" name="date_end" value="Ejemplo: <?php echo date("Y-m-d H:i:s") ?>" min="" max="">
                                    </div>
                                    <div class="col-md-8 my-4">
                                        <input type="buttton" onclick="validateDataTask();" data-bs-dismiss="modal" class="btn btn-primary" value="Crear" />

                                    </div>
                                    <div class="col-md-8 my-4">
                                        <input id="adminID" name="adminID" type="hidden" value="<?php echo $id_user ?>">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="widget-content" style="max-height: 400px;overflow-y: scroll;" data-bs-spy="scroll">
                    <ul class="list-unstyled simple-todo-list" id="todo__list">


                    </ul>
                </div>
            </div>
            <!-- END MY TODO LIST -->
            <!-- RECENT FILES -->
            <div class="widget">
                <div class="widget-header clearfix">
                    <h3><i class="fa fa-document"></i> <span>FILES</span></h3>
                    <div class="btn-group widget-header-toolbar">
                        <a title="Expand/Collapse" class="btn btn-link btn-toggle-expand"><i class="fa fa-ios-arrow-up"></i></a>
                        <a title="Ver todos" href="#" class="btn btn-link btn-remove"><i class="fa-solid fa-folder"></i></a>
                    </div>
                </div>
                <div class="widget-content" style="height: 200px;overflow-y: scroll;">
                    <ul class=" recent-file-list bottom-30px">
                        <?php foreach ($directory as $file) : ?>
                            <?php if ($file != "." && $file != "..") : ?>
                                <li><i class="fa-solid fa-file mx-2"></i><a href="Projects/<?php echo $folder_URL . "/" . $file; ?>" download="" target="_blank" data-id=""><?php echo $file; ?></a><a title="Eliminar" class="btn btn-link text-danger btn-remove"><i onclick="deleteFileByProject('<?php echo $file; ?>');" class="fa-solid fa-trash-can"></i></a></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <form method="post" action="" enctype="multipart/form-data">

                        <button class="bg-white border-0 w-25" onclick="openFileDialog();" type="button">
                            <i class="fa fa-upload"></i>
                            <input class="form-control w-100" type="file" id="image_avatar" multiple="multiple" hiden name="filesUpload[]" accept="image/*, .webp , .pdf, .doc, .xml, .html, .css, .php, .js, , .zip , .rar , .py, .ts , .docx, application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
                        </button>

                        <button id="bnt__upload__Files" onclick="" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-upload"></i> Subir</button>
                    </form>
                </div>
            </div>
            <!-- END RECENT FILES -->




        </div>
    </div>
</div>



<h3 class="text-center">TAREAS</h3>

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
            </tr>
        </thead>
        <tbody id="content__tasks">


        </tbody>
    </table>
    <?php echo $Paginator->buildLinks('proyecto?id=' . $project->id); ?>

</div>

<hr />


<div class="d-flex col-sm-6 col-12 align-self-center justify-content-center">
    <a class="mx-2 text-decoration-none toogle_response btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#response_comment_Project" href="">Escribir</a>

    <!-- Modal -->
    <div class="modal fade" id="response_comment_Project" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo comentario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="response_comment" method="post">
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Mensaje:</label>
                            <textarea class="form-control" required minlength="3" name="msg" id="msg_project"></textarea>


                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="sendMessagesProject();" data-bs-dismiss="modal" class="btn btn-primary respose-btn mt-2">Enviar</button>

                    <button type="button" class="btn-response btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- container list activy -->
<ul class="list-unstyled mt-4 project-activity-list w-75 d-flex flex-column align-items-center align-self-center" style="height: 600px;overflow-y: scroll;scrollbar-width: none;" id="project__msg__list">
</ul>











<div class="modal fade" id="modal_send_message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enviar mensaje</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Mensaje:</label>
                        <textarea class="form-control" id="msg_page_members" name="msg" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="send_msg_members_page" data-bs-dismiss="modal" class="btn btn-primary">Enviar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal__profiles" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Búsqueda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row w-100 justify-content-center mb-5">
                    <form class="d-flex flex-column col-10 col-sm-5 col-lg-4 my-2 my-lg-0">
                        <input class="form-control mb-2 mr-sm-2" minlength="3" name="profile" type="text" id="member_project" placeholder="Search">
                        <button id="btn__search__friends" class="btn btn-outline-dark mb-2 my-2 my-sm-0" data-bs-toggle="modal" data-bs-target="#modal__profiles" type="button">Search</button>
                    </form>
                </div>


                <div id="content__profiles">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>