
<?php include_once __DIR__ . "/../templates/perfil_header.php"; ?>

<section id="wrap-articles" class="col-md-12 col-lg-12 border shadow mx-2 p-4 mb-2">
        <h2 class="text-uppercase text-center font-weight-bold fs-1 text-secondary text-shadow"> articulos</h2>
        <?php foreach ($posts as $post) : ?>
            <article class="wrap-article m-2">
                <span class="text-right d-block w-100 text-end"><?php echo $post->create_at ?></span>
                <h3><?php echo $post->name ?></h3>
                <p>
                    <?php echo substr($post->content, 0, 500); ?>

                    <a href="#"><svg class="mx-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-lg text-muted pb-3px">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="19" cy="12" r="1"></circle>
                            <circle cx="5" cy="12" r="1"></circle>
                        </svg></a>
                    </span>
                </p>
                <div>
                    <div class="d-flex post-actions">
                        <a href="javascript:;" class="d-flex mx-2 align-items-center text-muted mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart icon-md">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg><span class="text-primary fs-5">(<?php echo $post->likes ?>)</span>
                            <p class="d-none d-md-block mx-2">Like</p>
                        </a>
                        <a href="javascript:;" class="d-flex mx-2 align-items-center text-muted mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square icon-md">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                            <p class="d-none d-md-block mx-2">Comentar</p>
                        </a>
                        <a href="javascript:;" class="d-flex mx-2 align-items-center text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share icon-md">
                                <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                                <polyline points="16 6 12 2 8 6"></polyline>
                                <line x1="12" y1="2" x2="12" y2="15"></line>
                            </svg>
                            <p class="d-none d-md-block ml-2">Compartir</p>
                        </a>
                    </div>
                </div>
            </article>
            <hr />
        <?php endforeach; ?>

    </section>