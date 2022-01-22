

<main class="wrap d-flex flex-column">
    <section class="ftco-section m-4">
        <div class="container">
            <div class="row justify-content-center d-flex">
                <div class="col-md-6 text-center mb-3">
                    <h2 class="heading-section">Auteticación</h2>
                </div>
            </div>
            <div class="row justify-content-center alerts m-2 p-2 ">
                <?php foreach($alerts as $alert): ?>
                    <span class="fs-5 text-center text-danger errors"><?php echo $alert ?></span>
                <?php endforeach; ?>
            </div>
            <div class="row justify-content-center ">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last darkGreen">
                            <div class="text w-100">
                                <h2>Bienvenido a YouTask</h2>
                                <p>¿No tienes una cuenta?</p>
                                <a href="/register" class="btn btn-dark btn-outline-white">Crear cuenta</a>
                            </div>
                        </div>
                        <div class="login-wrap p-4 p-lg-5 shadow">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Iniciar</h3>
                                </div>
                            </div>
                            <form action="/login" class="signin-form" method="post">
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Email</label>
                                    <input type="email" class="form-control" value="<?php echo s($user->email)?> "name="email" placeholder="email" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Contraseña</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-dark submit px-3">Ingresar</button>
                                </div>
                                <div class="form-group d-md-flex mt-2">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0">Recuerdame
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="w-50 text-md-right">
                                        <a href="/forget-password">¿Has olvidado tu contraseña?</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<main>