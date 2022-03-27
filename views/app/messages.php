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
        <ul class="users">
            <li class="person my-3  d-flex" data-chat="person1">
                <div class="user  w-20">
                    <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" class="raidius_max w-100 " alt="Retail Admin">
                    <span class="status busy"></span>
                </div>
                <p class="name-time align-self-center text-primary mx-2">
                    <span class="name">Steve Bangalter</span>
                    <span class="time">15/02/2019</span>
                </p>
            </li>
            <li class="person my-3 d-flex" data-chat="person1">
                <div class="user  w-20">
                    <img src="https://www.bootdey.com/img/Content/avatar/avatar1.png" class="raidius_max w-100 " alt="Retail Admin">
                    <span class="status offline"></span>
                </div>
                <p class="name-time align-self-center mx-2">
                    <span class="name">Steve Bangalter</span>
                    <span class="time">15/02/2019</span>
                </p>
            </li>
            <li class="person my-3  d-flex active-user" data-chat="person2">
                <div class="user w-20">
                    <img src="https://www.bootdey.com/img/Content/avatar/avatar2.png" class="raidius_max w-100 " alt="Retail Admin">
                    <span class="status away"></span>
                </div>
                <p class="name-time align-self-center mx-2">
                    <span class="name">Peter Gregor</span>
                    <span class="time">12/02/2019</span>
                </p>
            </li>

            <li class="person my-3  d-flex active-user" data-chat="person2">
                <div class="user w-20">
                    <img src="https://www.bootdey.com/img/Content/avatar/avatar2.png" class="raidius_max w-100 " alt="Retail Admin">
                    <span class="status away"></span>
                </div>
                <p class="name-time align-self-center mx-2">
                    <span class="name">Peter Gregor</span>
                    <span class="time">12/02/2019</span>
                </p>
            </li>
            <li class="person my-3  d-flex active-user" data-chat="person2">
                <div class="user w-20">
                    <img src="https://www.bootdey.com/img/Content/avatar/avatar2.png" class="raidius_max w-100 " alt="Retail Admin">
                    <span class="status away"></span>
                </div>
                <p class="name-time align-self-center mx-2">
                    <span class="name">Peter Gregor</span>
                    <span class="time">12/02/2019</span>
                </p>
            </li>

        </ul>
    </div>

    <!-- LIST CONTACTS-->

    <!-- INIT CHAT -->

    <div class="col-8">
        <div class="selected-user">
            <span>To: <span class="name">Emily Russell</span></span>
        </div>
        <hr />
        <div class="chat-container">
            <ul class="chat-box chatContainerScroll">

                <!-- REQUEST -->
                <li class="chat-left d-flex align-items-center my-2">
                    <div class="chat-avatar w-10">
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" class="raidius_max w-100" alt="Retail Admin">
                        <div class="chat-name">Russell</div>
                    </div>
                    <div class="chat-text mb-2 mx-2">Hello, I'm Russell.
                        <br>How can I help you today?
                    </div>
                    <div class="chat-hour">08:55 <span class="fa fa-check-circle"></span></div>
                </li>
                <!-- END-REQUEST -->

                <!-- RESPONSE -->
                <li class="chat-right d-flex justify-content-end my-2">
                    <div class="chat-hour mx-2">08:56 <span class="fa fa-check-circle"></span></div>
                    <div class="chat-text">Hi, Russell
                        <br> I need more information about Developer Plan.
                    </div>
                    <div class="chat-avatar mx-2 w-10">
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar4.png" class="raidius_max w-100" alt="Retail Admin">
                        <div class="chat-name">Sam</div>
                    </div>
                </li>
                <!-- END-RESPONSE -->


                <!-- REQUEST -->
                <li class="chat-left d-flex align-items-center my-2">
                    <div class="chat-avatar w-10">
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" class="raidius_max w-100" alt="Retail Admin">
                        <div class="chat-name">Russell</div>
                    </div>
                    <div class="chat-text mb-2 mx-2">Hello, I'm Russell.
                        <br>How can I help you today?
                    </div>
                    <div class="chat-hour">08:55 <span class="fa fa-check-circle"></span></div>
                </li>
                <!-- END-REQUEST -->

                <!-- RESPONSE -->
                <li class="chat-right d-flex justify-content-end my-2">
                    <div class="chat-hour mx-2">08:56 <span class="fa fa-check-circle"></span></div>
                    <div class="chat-text">Hi, Russell
                        <br> I need more information about Developer Plan.
                    </div>
                    <div class="chat-avatar mx-2 w-10">
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar4.png" class="raidius_max w-100" alt="Retail Admin">
                        <div class="chat-name">Sam</div>
                    </div>
                </li>
                <!-- END-RESPONSE -->

                <!-- REQUEST -->
                <li class="chat-left d-flex align-items-center my-2">
                    <div class="chat-avatar w-10">
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" class="raidius_max w-100" alt="Retail Admin">
                        <div class="chat-name">Russell</div>
                    </div>
                    <div class="chat-text mb-2 mx-2">Hello, I'm Russell.
                        <br>How can I help you today?
                    </div>
                    <div class="chat-hour">08:55 <span class="fa fa-check-circle"></span></div>
                </li>
                <!-- END-REQUEST -->

                <!-- RESPONSE -->
                <li class="chat-right d-flex justify-content-end my-2">
                    <div class="chat-hour mx-2">08:56 <span class="fa fa-check-circle"></span></div>
                    <div class="chat-text">Hi, Russell
                        <br> I need more information about Developer Plan.
                    </div>
                    <div class="chat-avatar mx-2 w-10">
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar4.png" class="raidius_max w-100" alt="Retail Admin">
                        <div class="chat-name">Sam</div>
                    </div>
                </li>
                <!-- END-RESPONSE -->

                <!-- REQUEST -->
                <li class="chat-left d-flex align-items-center my-2">
                    <div class="chat-avatar w-10">
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" class="raidius_max w-100" alt="Retail Admin">
                        <div class="chat-name">Russell</div>
                    </div>
                    <div class="chat-text mb-2 mx-2">Hello, I'm Russell.
                        <br>How can I help you today?
                    </div>
                    <div class="chat-hour">08:55 <span class="fa fa-check-circle"></span></div>
                </li>
                <!-- END-REQUEST -->

                <!-- RESPONSE -->
                <li class="chat-right d-flex justify-content-end my-2">
                    <div class="chat-hour mx-2">08:56 <span class="fa fa-check-circle"></span></div>
                    <div class="chat-text">Hi, Russell
                        <br> I need more information about Developer Plan.
                    </div>
                    <div class="chat-avatar mx-2 w-10">
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar4.png" class="raidius_max w-100" alt="Retail Admin">
                        <div class="chat-name">Sam</div>
                    </div>
                </li>
                <!-- END-RESPONSE -->

                <!-- REQUEST -->
                <li class="chat-left d-flex align-items-center my-2">
                    <div class="chat-avatar w-10">
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" class="raidius_max w-100" alt="Retail Admin">
                        <div class="chat-name">Russell</div>
                    </div>
                    <div class="chat-text mb-2 mx-2">Hello, I'm Russell.
                        <br>How can I help you today?
                    </div>
                    <div class="chat-hour">08:55 <span class="fa fa-check-circle"></span></div>
                </li>
                <!-- END-REQUEST -->

                <!-- RESPONSE -->
                <li class="chat-right d-flex justify-content-end my-2">
                    <div class="chat-hour mx-2">08:56 <span class="fa fa-check-circle"></span></div>
                    <div class="chat-text">Hi, Russell
                        <br> I need more information about Developer Plan.
                    </div>
                    <div class="chat-avatar mx-2 w-10">
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar4.png" class="raidius_max w-100" alt="Retail Admin">
                        <div class="chat-name">Sam</div>
                    </div>
                </li>
                <!-- END-RESPONSE -->

                <!-- REQUEST -->
                <li class="chat-left d-flex align-items-center my-2">
                    <div class="chat-avatar w-10">
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" class="raidius_max w-100" alt="Retail Admin">
                        <div class="chat-name">Russell</div>
                    </div>
                    <div class="chat-text mb-2 mx-2">Hello, I'm Russell.
                        <br>How can I help you today?
                    </div>
                    <div class="chat-hour">08:55 <span class="fa fa-check-circle"></span></div>
                </li>
                <!-- END-REQUEST -->

                <!-- RESPONSE -->
                <li class="chat-right d-flex justify-content-end my-2">
                    <div class="chat-hour mx-2">08:56 <span class="fa fa-check-circle"></span></div>
                    <div class="chat-text">Hi, Russell
                        <br> I need more information about Developer Plan.
                    </div>
                    <div class="chat-avatar mx-2 w-10">
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar4.png" class="raidius_max w-100" alt="Retail Admin">
                        <div class="chat-name">Sam</div>
                    </div>
                </li>
                <!-- END-RESPONSE -->



            </ul>
            <form action="" class="my-2" method="post">
                <div class="form-group mt-3 mb-0">
                    <textarea class="form-control" rows="3" placeholder="Type your message here..."></textarea>
                    <input type="submit" class="btn btn-primary my-2"value="Enviar">
                </div>
            </form>

        </div>
    </div>
</div>


</div>