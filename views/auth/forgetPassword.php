<main class="container ">
    <div class="row d-flex align-items-center">
        <div class="col-12 d-flex justify-content-center alerts m-2 p-2 ">
            <?php foreach ($alerts as $alert) : ?>
                <?php if ($typeAlert): ?>
                    <span class="fs-5 text-center text-primary errors"><?php echo $alert ?></span>
                <?php elseif (!$typeAlert): ?>
                    <span class="fs-5 text-center text-danger errors"><?php echo $alert ?></span>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <picture class="col-12 col-md-6 ">
            <img src="/build/img/banner-recuperar-contraseña.webp" alt="" class="img-fluid" />
        </picture>
        <section class="col-12 col-md-6 ">
            <h1>Recuperar contraseña</h1>
            <form method="post" class="d-flex flex-column " action="/recuperar-password">
                <div class="d-flex">
                    <label for="email" class="w-15 m-1">Email</label>
                    <input name="email" class="w-75" placeholder="Escribe tu email" required />
                </div>
                <input type="submit" class="btn btn-primary w-50 my-2 align-self-center" value="Enviar intrucciones">
            </form>
        </section>
    </div>
</main>