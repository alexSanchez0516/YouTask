<?php include_once __DIR__ . "/../templates/nav_perfil.php"; ?>
<form method="post" class=" mt-2" enctype="multipart/form-data">
    <div class="row flex-lg-nowrap">
        <div class="col">
            <div class="row">
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="e-profile">
                                <div class="row">
                                    <div class="col-12 col-sm-auto mb-3">
                                        <div class="mx-auto" style="width: 140px;">
                                            <div class="d-flex justify-content-center align-items-center rounded">
                                                <img src="/build/img/<?php echo $user->avatar ?>" id="current_img" alt="avatar" class="w-75">
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                        <div class="text-center text-sm-left mb-2 mb-sm-0">
                                            <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php echo s($user->username); ?></h4>
                                            <button class="bg-white border-0 w-25" onclick="openFileDialog();" type="button">
                                                <i class="fa fa-fw fa-camera text-dark"></i>
                                                <input class="form-control w-100" type="file" id="image_avatar" hiden name="avatar" accept="image/jpeg, image/png, image/webp" />
                                            </button>
                                        </div>
                                        <div class="text-center text-sm-right">
                                            <div class="text-muted"><small><?php echo date("Y-m-d h:i:s A") ?></small></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-content pt-3">
                                    <div class="tab-pane active">
                                        <div class="form">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Nombre</label>
                                                                <input class="form-control" minlength="3" type="text" name="username" value="<?php echo s($user->username) ?>" />
                                                            </div>
                                                        </div>
                                                        <div class=" col">
                                                            <div class="form-group">
                                                                <label>Apellidos</label>
                                                                <input class="form-control" minlength="3" type="text" name="apellidos" value="<?php echo s($user->apellidos) ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row my-2">
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label>Rol</label>
                                                                <input class="form-control" minlength="3" name="rol" type="text" value="<?php echo s($user->rol) ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row my-2">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Instagram</label>
                                                                <input class="form-control" minlength="3" name="instagram" type="text" placeholder="https://www.instagram.com/" value="<?php echo s($user->instagram) ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>GitHub</label>
                                                                <input class="form-control" minlength="3" name="gitHub" type="text" placeholder="https://github.com/" value="<?php echo s($user->github) ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>LinkedIn</label>
                                                                <input class="form-control" minlength="3" name="linkedin" type="text" placeholder="https://www.linkedin.com/" value="<?php echo s($user->linkedin) ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <div class="form-group">
                                                                <label>Descripción</label>
                                                                <textarea class="form-control" name="description" id="descripcion" minlength="3" rows="5"><?php echo s($user->description); ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-6 mb-3">
                                                    <div class="row my-2">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Contraseña Actual</label>
                                                                <input class="form-control" required name="password" type="password" placeholder="••••••">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12" id="container_skills">
                                                    <label for="members[]">Skills</label>

                                                    <!-- MODAL -->
                                                    <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#skills" data-bs-whatever="@mdo">Crear nueva skill</button>
                                                    <div class="modal fade" id="skills" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Crear skill</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="skill_name" class="col-form-label">Escribe la skill</label>
                                                                        <input type="text" name="skill_name" class="form-control" id="skill_name">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" id="btn_close_skill_user" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                    <button type="button" onclick="createSkill();" class="btn btn-primary">Crear</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- END MODAL -->

                                                    <!-- AQUI SE PINTAN LAS SKILLS-->

                                                </div>
                                                <div class="col-12 col-sm-5 offset-sm-1 mt-4 mb-3">
                                                    <div class="mb-2"><b>Mostrar Redes</b></div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="custom-controls-stacked px-2">

                                                                <div class="custom-control custom-checkbox">
                                                                    <?php if ($user->isSocials == "1") : ?>
                                                                        <input type="checkbox" name="isSocials" class="custom-control-input" value="0" id="notifications-news" checked />
                                                                    <?php else : ?>
                                                                        <input type="checkbox" name="isSocials" class="custom-control-input" value="1" id="notifications-news" />
                                                                    <?php endif; ?>
                                                                    <label class="custom-control-label" for="notifications-news">Si</label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col d-flex justify-content-end">
                                                    <button class="btn btn-primary" type="submit">Guardar Cambios</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-3 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title font-weight-bold">Soporte</h6>
                            <p class="card-text">Obtenga ayuda rápida y gratuita.</p>
                            <button type="button" class="btn btn-primary">Contacto</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>