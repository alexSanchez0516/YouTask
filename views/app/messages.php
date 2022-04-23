<?php include_once __DIR__ . "/../templates/perfil_header.php"; ?>

<div>
    <h1 class="text-center text-primary">Chat</h1>
</div>

<div class="row mx-2" id="container_messages">
    <h2 class="fs-3">Contactos</h2>
    <div class="col-4 px-2 border">
        <form action="" method="POST">
            <input type="text" class="form-control my-2" name="username" id="" placeholder="Buscar..." />
        </form>
        <ul class="users" id="container__users">

            <!-- AQUI SE PINTAN LOS SEGUIDORES -->

        </ul>
    </div>

    <!-- LIST CONTACTS-->

    <!-- INIT CHAT -->

    <div class="col-8">
        <div id="selected-user">
            <span class="name" id="selected-user"></span>
        </div>
        <hr />
        <div class="chat-container">
            <ul class="chat-box chatContainerScroll d-flex flex-column align-items-center" id="chat__box__container">
                <img src="/build/img/chat.jpg" alt="" class="img-fluid " style="height: 30vh;">
                <!-- REQUEST -->

                <!-- END-REQUEST -->

                <!-- RESPONSE -->

                <!-- END-RESPONSE -->
            </ul>
            <form action="" class="my-2" method="post">
                <div class="form-group mt-3 mb-0">
                    <textarea class="form-control" rows="3" placeholder="Type your message here..."></textarea>
                    <input type="submit" class="btn btn-primary my-2" value="Enviar">
                </div>
            </form>

        </div>
    </div>
</div>


</div>