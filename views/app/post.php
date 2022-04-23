<?php include_once __DIR__ . "/../templates/perfil_header.php"; ?>
<div class="container-fluid" id="container_post" data-id="<?php echo $post->id ?>">
    <section class="row">
        <article class="col-12">
            <div class="row">
                <div class="col-12 col-md-8">
                    <h2 class="w-100 text-center text-primary text-capitalize"><?php echo $post->name ?></h2>
                </div>
                <span class="col-12 col-md-4 text-center "><?php echo $post->create_at ?></span>


                <div class="col-12 my-4">
                    <p class="w-100 p-2"><?php echo $post->content ?></p>
                </div>
            </div>
        </article>
        <div class="col-12">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <form class="d-flex flex-column" method="post">
                            <div class="d-flex justify-content-between">
                                <span class="fs-5 fw-bolder">Nuevo Commentario</span>
                                <button type="submit" class="btn btn-light mb-2">Crear</button>
                            </div>
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-2 col-lg-2 hidden-xs">
                                        <img class="w-100" src="/build/img/<?php echo $_SESSION['avatar'] ?>" alt="">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                        <textarea class="form-control" id="message" name="content" placeholder="Your message" required></textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <div class="d-flex flex-column mt-4">
                            <span class="fs-5 fw-bolder"><?php echo $quantity ?> Comentarios</span>
                            <?php foreach ($comments as $comment) : ?>

                                <?php


                                if ($comment->comment_response > 0) {
                                    $data_response = $comment->getDataTheResponse()[0];
                                }

                                ?>

                                <div class="row mt-4 comments">
                                    <div class="col-12 col-md-2 ">
                                        <img class="w-50 " src="/build/img/<?php echo $comment->avatar ?>" alt="">
                                    </div>
                                    <div class="col-md-10 col-12 d-flex flex-column">
                                        <h4><?php echo $comment->username ?></h4>

                                        <?php if ($comment->comment_response > 0) : ?>
                                            <div class="w-100 d-flex flex-column border bg-light p-2 rounded">
                                                <cite>Cita de: <strong><?php echo $data_response->username ?></strong></cite>
                                                <p><?php echo $data_response->content ?></p>
                                            </div>
                                        <?php endif; ?>


                                        <p><?php echo $comment->content ?></p>

                                        <div class="row justify-content-between ">
                                            <div class="d-flex col-sm-6 col-12">
                                                <i class="fa fa-calendar mx-2"></i><?php echo $comment->create_at ?>
                                            </div>
                                            <div class="d-flex justify-content-around col-sm-6 col-12">
                                                <a class="mx-2 text-decoration-none toogle_response" data-bs-toggle="modal" data-id="<?php echo $comment->id ?>" data-bs-target="#response_comment" href="">Responder</a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="response_comment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Responder Comentario</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="response_comment" method="post">
                                                                    <div class="mb-3">
                                                                        <label for="message-text" class="col-form-label">Message:</label>
                                                                        <textarea class="form-control" required minlength="3" name="content" id="content"></textarea>

                                                                        <input type="submit" class="btn btn-primary respose-btn mt-2" value="Crear" />

                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn-response btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>