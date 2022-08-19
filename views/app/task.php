<?php include_once __DIR__ . "/../templates/alerts.php" ?>

<div class="content ">
    <div class="container">
        <div class="row border rounded d-flex justify-content-center align-items-center">
            <div class="col-lg-8">
                <div class="card-box task-detail">
                    <?php if ($admin) :
                    ?>
                        <button type="button" style="float:right;" onclick="window.location='/actualizar-tarea?id=<?php echo $Task->id; ?>'" class="btn btn-sm btn-default pull-right"><i class="fa-solid fa-pen-to-square"></i> Editar</button>
                    <?php endif;
                    ?>

                    <button onclick="window.location.href='/tareas?limit=10&page=1'" type=" button" class="btn btn-secondary"><i class="fa-solid fa-arrow-rotate-left"></i></button>

                    <h2 class="m-b-20 fg-posts_title my-4 text-center text-uppercase"><?php echo $Task->name; ?></h4>

                        <div class="row my-4">
                            <h3 class="text-primary">General Info</h3>
                            <p class="fs-5">
                                <?php echo $Task->description; ?>
                            </p>
                        </div>
                        <ul class="list-inline task-dates m-b-0 mt-5">
                            <li>
                                <h5 class="m-b-5">Start</h5>
                                <p><small class="text-muted"><?php echo $Task->create_at; ?> </small></p>
                            </li>
                            <li>
                                <h5 class="m-b-5">End</h5>
                                <p><small class="text-muted"><?php echo $Task->date_end; ?></small></p>
                            </li>
                        </ul>
                        <div class="clearfix"></div>

                        <div class="row my-3">
                            <?php if ($Task->priority == "ALTA") : ?>
                                <h3>Prioridad: <span class="badge bg-danger"><?php echo $Task->priority; ?></span></h3>
                            <?php elseif ($Task->priority == "MEDIA") : ?>
                                <h3>Prioridad: <span class="badge bg-secondary"><?php echo $Task->priority; ?></span></h3>
                            <?php else : ?>
                                <h3>Prioridad: <span class="badge bg-primary"><?php echo $Task->priority; ?></span></h3>

                            <?php endif; ?>

                            <h3 class="my-4">Estado: <span class="badge bg-secondary"><?php echo $Task->state; ?></span></h3>
                        </div>

                        <div class="row mt-4">
                            <h3>Proyecto: <a href="/proyecto?id=<?php echo $Project->id . '&limit=5&page=1'; ?>"><?php echo $Project->name; ?></a></h3>
                        </div>


                        <div class="widget-content border rounded p-2 my-4" style="height: 200px;overflow-y: scroll;">
                            <h3 class="fg-posts_title">Ficheros</h3>
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

            </div>

            <!-- end col -->
            <div class="col-lg-12">
                <div class="card-box d-flex flex-column align-items-center">
                    <h4 class="header-title m-b-30">Comentarios (<?php echo $TotalComents ?>)</h4>

                    <div class="row">

                        <div class=" col-12 my-4">
                            <input id="msgTask" type="text" class="form-control input-sm" placeholder="Aporta tu granito de arena...">
                            <div class="mt-2 text-right">
                                <button type="button" onclick="sendMessageTask();" class="btn btn-outline-success">Enviar</button>
                            </div>
                        </div>
                    </div>

                    <div id="container__msgs_task">


                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- container -->
</div>