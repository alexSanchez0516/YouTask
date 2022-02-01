<form action="/perfil" class="d-flex flex-column w-100 m-2" method="post" enctype="multipart/form-data">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 col-12 px-2 shadow  mx-2 border d-flex flex-column">
            <?php include_once __DIR__ . "/../templates/alerts.php" ?>

            <h1 class="text-center">Mi cuenta</h1>

            <label for="username" class="mt-2">Nombre</label>
            <input type="text" name="username" class="w-100" value="<?php echo $user->username; ?>" id="username" placeholder="">

            <label for="username" class="mt-2">Descripción</label>
            <textarea name="description" rows="4" class="w-100" id="description" placeholder=""><?php echo $user->description; ?></textarea>

            <button type="button" class="btn btn-danger my-2" onclick="window.location.href='/recuperar-password'">Cambiar contraseña</button>



            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Grupo: XyMinDTeam
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Abandonar grupo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Tu grupo es: XYMINDTEAM
                            ¿Quieres dejar el grupo?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Si</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Guardar cambios
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Información</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Quieres guardar los cambios?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-md-4 col-12 ">
            <img src="/build/img/<?php echo $user->avatar ?>" class="img-fluid" alt=""></img>

            <div class="custom-input-file col-md-6 col-sm-6 col-xs-6">
                <input type="file" name="avatar" id="fichero-tarifas" class="input-file" value="">
                <?php if (strlen($user->avatar) > 0) : ?>
                    Cambiar imagen...
                <?php elseif (strlen($user->avatar) == 0) : ?>
                    Añadir imagen...
                <?php endif; ?>
            </div>

        </div>
    </div>

</form>