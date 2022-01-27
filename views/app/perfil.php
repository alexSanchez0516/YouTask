<main class="wrap d-flex flex-column vh-100">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <h1 class="text-center my-2">Configuración de la cuenta</h1>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-center">
                <form action="/perfil" class="d-flex flex-column w-100" method="post">
                    <div class="row d-flex justify-content-center my-5">
                        <div class="col-12 col-md-8 m-2 d-flex flex-column">
                            <label for="username">Nombre</label>
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


                            <label for="avatar" class="mt-2">Foto</label>
                            <input type="file" name="avatar" class="w-100" id="avatar">

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Guardar cambios
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>