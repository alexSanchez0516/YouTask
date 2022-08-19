<?php include_once __DIR__ . "/../templates/perfil_header.php"; ?>

<div>
    <h1 class="text-center text-primary">Chat</h1>
</div>

<div class="row d-flex mx-2 flex-column flex-md-row align-items-center align-items-md-baseline" id=" container_messages">
    <h2 class="fs-3">Contactos</h2>
    <div class="col-md-4 col-12 px-2 border">
        <form action="" method="POST">
            <input type="text" class="form-control my-2" name="username" id="" placeholder="Buscar..." />
        </form>
        <ul class="users" id="container__users">

            <!-- AQUI SE PINTAN LOS SEGUIDORES -->

        </ul>
    </div>

    <!-- LIST CONTACTS-->

    <!-- INIT CHAT -->

    <div class="col-12 col-md-8">
        <div id="selected-user">
            <span class="name" id="selected-user"></span>
        </div>
        <hr />
        <div id="chat-container w-100 d-flex flex-column">
            <ul class="p-3 border radius" id="chat__box__container">
                <img src="/build/img/chat.jpg" alt="" class="img-fluid " style="height: 40vh;">
                <!-- REQUEST -->

                <!-- END-REQUEST -->

                <!-- RESPONSE -->

                <!-- END-RESPONSE -->
            </ul>
            <form id="send_message" action="" class="my-2 w-100" method="post">
                <div class="form-group mt-3 mb-0 w-100 d-flex flex-column">
                    <textarea id="msg" class="form-control" rows="3" placeholder="Escribe tu mensaje..."></textarea>
                    <button type="button" onclick="sendMessage($('#msg').val());" class="btn btn-primary my-2 w-50 align-self-center">Enviar</button>
                </div>
            </form>

        </div>
    </div>
</div>


</div>