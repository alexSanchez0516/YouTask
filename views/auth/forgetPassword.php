<main class="container ">
    <div class="row d-flex align-items-center">
        <?php include_once __DIR__ . "/../templates/alerts.php" ?>

        <picture class="col-12 col-md-6 ">
            <img src="/build/img/banner-recuperar-contraseña.webp" alt="" class="img-fluid" />
        </picture>
        <section class="col-12 col-md-6 ">
            <h1>Cambiar contraseña</h1>
            <form method="post" class="d-flex flex-column " action="/recuperar-password">
                <div class="d-flex">
                    <label for="email" class="w-15 m-1">Email</label>
                    <input type="email" name="email" class="w-75" placeholder="Escribe tu email" required />
                </div>
                <div class="form-check d-flex justify-content-center my-2">
                    <input class="form-check-input me-2" type="checkbox" required value="si" id="privacity" />
                    <label class="form-check-label" for="form2Example3">
                        Acepto todas las declaraciones en los <a href="#!">Terminos del servicio</a>
                    </label>
                </div>
                <input type="submit" class="btn btn-primary w-50 my-2 align-self-center" value="Enviar intrucciones">
            </form>
        </section>
    </div>
</main>