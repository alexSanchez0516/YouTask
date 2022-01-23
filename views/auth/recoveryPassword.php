<main class="container ">
    <div class="row d-flex align-items-center">
        <?php include_once __DIR__ . "/../templates/alerts.php" ?>

        <picture class="col-12 col-md-6 ">
            <img src="/build/img/banner-recuperar-contraseña.webp" alt="" class="img-fluid" />
        </picture>
        <section class="col-12 col-md-6 ">
            <h1 class="text-center">Cambiar contraseña</h1>
            <?php if ($typeAlert) : ?>
                <form method="post" class="d-flex flex-column " action="/recovery-password">
                    <div class="d-flex flex-column align-items-center">
                        <input type="password" minlength=8 name="password" class="w-75 mb-2" placeholder="Escribe tu nueva contraseña" required />
                        <input type="password" minlength=8 name="repeatPassword" class="w-75" placeholder="Repita tu nueva contraseña" required />
                    </div>
                    <div class="form-check d-flex justify-content-center my-2">
                        <input class="form-check-input me-2" type="checkbox" required value="si" id="privacity" />
                        <label class="form-check-label" for="form2Example3">
                            Acepto todas las declaraciones en los <a href="#!">Terminos del servicio</a>
                        </label>
                    </div>
                    <input type="submit" class="btn btn-primary w-40 my-2 align-self-center" value="Cambiar">
                </form>
            <?php elseif (!$typeAlert) : ?>
                <div class="d-flex flex-column align-items-center">
                    <span><strong>¿Necesitas recuperar la contraseña?</strong></span>
                    <span><a href="/recuperar-password">Pincha aquí</a></span>
                </div>

            <?php endif ?>
        </section>
    </div>
</main>