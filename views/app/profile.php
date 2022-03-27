<?php include_once __DIR__ . "/../templates/perfil_header.php"; ?>

<div class="row mt-3">
    <div class="activity_perfil col">
        <div class="d-flex flex-column">
            <h3 class="text-center text-secondary mb-2">Actividad Reciente </h3>
        </div>
    </div>
    <div class="col d-flex justify-content-end">
        <button type="button" id="close_activity_perfil" class="btn btn-primary mb-2">Ocultar</button>
    </div>
</div>

<div class="table-responsive activity_perfil">
    <table class="table">
        <tbody>

            <?php foreach ($activities as $activity) : ?>

                <?php


                $item_name = null;

                if ($activity->project_name != null) {
                    $item_name = $activity->project_name;
                }

                if ($activity->task_name != null) {
                    $item_name = $activity->task_name;
                }

                if ($activity->post_name != null) {
                    $item_name = $activity->post_name;
                }

                ?>

                <tr>
                    <td class="text-center">
                        <i class="fa fa-comment"></i>
                    </td>
                    <td>
                        <?php echo $activity->username . " ";
                        echo $activity->action;

                        ?> <a href="#"><?php echo $item_name; ?></a> .
                    </td>
                    <td>
                        <?php echo $activity->create_at; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
    <div class="d-flex justify-content-center mb-4">
        <button class="btn btn-secondary" onclick="window.location.href='/actividad'">Ver más</button>
    </div>
</div>



<div class="row w-100 justify-content-center mb-2 mx-2">
    <div class="col-md-12 col-lg-3  mx-2 mb-2">
        <div class="row">
            <span class="border shadow p-2 mb-4"><strong>Sobre mi</strong> <a href="editar-perfil"><svg class="mx-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-lg text-muted pb-3px">
                        <circle cx="12" cy="12" r="1"></circle>
                        <circle cx="19" cy="12" r="1"></circle>
                        <circle cx="5" cy="12" r="1"></circle>
                    </svg></a> <br> <?php echo $user->description; ?>
            </span>
            <div class="col mt-2 border shadow p-2">
                <h3 class="bg-grey p-2">Skills <i class="fa fa-trophy fs-4"></i></h3>

                <?php foreach ($skills as $skill) : ?>
                    <span class="badge bg-primary"><?php echo $skill ?></span>
                <?php endforeach; ?>

            </div>

        </div>

    </div>

    <section id="wrap-articles" class="col-md-12 col-lg-6 border shadow mx-2 p-4 mb-2">
        <h2 class="text-uppercase font-weight-bold fs-1 text-secondary text-shadow">Últimos articulos</h2>
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
                            </svg>
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
        <div class="d-flex justify-content-center mt-5">
            <button class="btn btn-secondary" onclick="window.location.href='/posts'">Ver más</button>
        </div>
    </section>

    <?php if ($user->isSocials = "1") : ?>
        <div class="col-md-12 col-lg-2  mx-2">
            <div class="row border shadow p-4">
                <strong class="mb-2">Redes Sociales</strong>
                <div class="col">
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                </div>
                <div class="col ">
                    <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                </div>
                <div class="col">
                    <a href="#"><i class="fa-brands fa-github"></i></a>
                </div>
            </div>
        </div>

    <?php endif; ?>

</div>