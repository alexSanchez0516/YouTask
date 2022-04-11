<?php include_once __DIR__ . "/../templates/perfil_header.php"; ?>

<div class="container-fluid">
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
                        <form class="d-flex flex-column">
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
                                        <textarea class="form-control" id="message" placeholder="Your message" required=""></textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <div class="d-flex flex-column mt-4">
                            <span class="fs-5 fw-bolder">4 Comentarios</span>
                            <?php foreach ($comments as $comment): ?>
                                <div  class="row mt-4 comments">
                                    <div class="col-12 col-md-2 ">
                                        <img class="w-50 " src="/build/img/<?php echo $comment['avatar']?>" alt="">
                                    </div>
                                    <div class="col-md-10 col-12 d-flex flex-column">
                                        <h4><?php echo $comment['username']?></h4>
                                        <p><?php echo $comment['content'] ?></p>

                                        <div class="row justify-content-between ">
                                            <div class="d-flex col-sm-6 col-12">
                                                <i class="fa fa-calendar mx-2"></i><?php echo $comment['create_at'] ?>
                                            </div>
                                            <div class="d-flex justify-content-around col-sm-6 col-12">
                                                <a class="mx-2" href="">Responder</a>
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