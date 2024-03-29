<main class="wrap d-flex flex-column">
    <!-- Sign up form -->

    <?php include_once __DIR__ . "/../templates/alerts.php" ?>

    <section class=" shadow">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black mt-2" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <p class="text-center h1 mb-5 mx-1 mx-md-4 mt-4">Crear Cuenta</p>
                                    <form class="mx-1 mx-md-4" method="post" action="/registro">
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="form3Example1c" name="username" required class="form-control" />
                                                <label class="form-label" for="form3Example1c">Tu nombre de usuario</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="form3Example1c" name="apellidos" required class="form-control" />
                                                <label class="form-label" for="form3Example1c">Tus apellidos</label>
                                            </div>
                                        </div>


                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <select name="gen" id="" required class="form-control">
                                                    <option value="0">Mujer</option>
                                                    <option value="1">Hombre</option>
                                                </select>
                                                <label class="form-label" for="form3Example1c">Genero</label>
                                            </div>
                                        </div>


                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="email" id="form3Example3c" name="email" name="email" required class="form-control" />
                                                <label class="form-label" for="form3Example3c">Email</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" minlength="5" required id="password" name="repeatPassword" class="form-control" />
                                                <label class="form-label" for="form3Example4c">Contraseña</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" minlength="5" required id="repeatPassword" name="password" class="form-control" />
                                                <label class="form-label" for="form3Example4cd">Repite tu Contraseña</label>
                                            </div>
                                        </div>
                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <input class="form-check-input me-2" type="checkbox" required value="si" id="privacity" />
                                            <label class="form-check-label" for="form2Example3">
                                                Acepto todas las declaraciones en los <a href="#!">Terminos del servicio</a>
                                            </label>
                                        </div>
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" id="btn-register" class="btn btn-primary btn-lg">Registrarme</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp" class="img-fluid" alt="Sample image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>