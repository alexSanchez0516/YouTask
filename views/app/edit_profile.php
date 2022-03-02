<nav class="mt-3 d-flex justify-content-center" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#" class="text-decoration-none ">Actividad</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="/perfil" class="breadcrumb-item active text-decoration-none">Perfil</a></li>
        <li class="breadcrumb-item"><a href="#" class="text-decoration-none ">Post</a></li>
        <li class="breadcrumb-item"><a href="/amigos" class="text-decoration-none ">Amigos</a></li>
    </ol>
</nav>
<div class=" mt-2">
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
                                            <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                                                <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                        <div class="text-center text-sm-left mb-2 mb-sm-0">
                                            <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">John Smith</h4>
                                            <p class="mb-0">@johnny.s</p>
                                            <div class="text-muted"><small>Last seen 2 hours ago</small></div>
                                            <div class="mt-2">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fa fa-fw fa-camera"></i>
                                                    <span>Cambiar Foto</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="text-center text-sm-right">
                                            <div class="text-muted"><small><?php echo date("Y-m-d ") ?></small></div>
                                        </div>
                                    </div>
                                </div>
       
                                <div class="tab-content pt-3">
                                    <div class="tab-pane active">
                                        <form class="form" novalidate="">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Nombre</label>
                                                                <input class="form-control" type="text" name="name" placeholder="John Smith" value="John Smith">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Apellidos</label>
                                                                <input class="form-control" type="text" name="username" placeholder="johnny.s" value="johnny.s">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row my-2">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input class="form-control" type="email" placeholder="user@example.com">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Rol</label>
                                                                <input class="form-control" type="text" placeholder="Programador...">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row my-2">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Instagram</label>
                                                                <input class="form-control" type="text" placeholder="https://www.instagram.com/">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>GitHub</label>
                                                                <input class="form-control" type="text" placeholder="https://github.com/alexSanchez0516/">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>LinkedIn</label>
                                                                <input class="form-control" type="text" placeholder="https://www.linkedin.com/in/alexander-sanchez-423260184/">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <div class="form-group">
                                                                <label>Descripción</label>
                                                                <textarea class="form-control" rows="5" placeholder="My Bio"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-6 mb-3">
                                                    <div class="mb-2"><b>Cambiar Contraseña</b></div>
                                                    <div class="row my-2">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Contraseña Actual</label>
                                                                <input class="form-control" type="password" placeholder="••••••">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Nueva Contraseña</label>
                                                                <input class="form-control" type="password" placeholder="••••••">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row my-2">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Confirma <span class="d-none d-xl-inline">Contraseña</span></label>
                                                                <input class="form-control" type="password" placeholder="••••••">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-5 offset-sm-1 mb-3">
                                                    <div class="mb-2"><b>Mostrar Redes</b></div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="custom-controls-stacked px-2">

                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="notifications-news" checked="">
                                                                    <label class="custom-control-label" for="notifications-news">Instagram</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="notifications-offers" checked="">
                                                                    <label class="custom-control-label" for="notifications-offers">GitHub</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="notifications-offers" checked="">
                                                                    <label class="custom-control-label" for="notifications-offers">LinkedIn</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col d-flex justify-content-end">
                                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                                </div>
                                            </div>
                                        </form>

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
</div>