<div id="rs-team" class="rs-team fullwidth-team pt-100 pb-70">
    <div class="container">

        <div class="col-md-12">
            <h1 id="title_team" class="text-center text-uppercase fg-posts_title "><?php echo $project_name; ?> TEAM</h1>
        </div>
        <div class="col-md-12">
            <a title="Añadir" data-bs-toggle="modal" data-bs-target="#modal__profiles" class="btn btn-link btn-remove"><i class="fa-solid fa-plus h1"></i></a>
        </div>
        <div class="row" id="container__members__pag" data-id="<?php echo $creator; ?>">


        </div>
        <div class="d-flex justify-content-end">
            <button onclick="window.location.href='/proyecto?id=<?php echo $_GET['id'] . '&limit=10&page=1'; ?>'" type="button" class="btn btn-primary">Ir atrás</button>

        </div>

    </div>
    <?php echo $Paginator->buildLinks('tareas'); ?>

    <!-- Modal -->
    <div class="modal fade" id="modal__profiles" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Búsqueda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="current_id_user" class="modal-body" data-id=<?php echo $id_user ?>>
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

    <!-- .container-fullwidth -->
</div>