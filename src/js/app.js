document.addEventListener('DOMContentLoaded', function () {
    checkPassword();
    checkAlerts();
    showMenuResponse();
    showCreateProject();
    close_activity_perfil();
    showFriends();
    deleteFriend();
    listPosts();
    deletePost();
    update_post();

});


function deletePost() {
    $(document).on('click', '#delete_post', (element) => {
        if (confirm("¿Seguro que quieres eliminar este post?")) {
            let id_element = element.target.dataset.id;
            $.post('http://127.0.0.1:8080/api/post/delete', { id_element }, (response) => {
                listPosts();
            });
        }
    })
}

function update_post() {
    $(document).on('click', '#update_post', (element) => {

        let id_element = element.target.dataset.id;
        window.location.href=`http://127.0.0.1:8080/modificar-post?id=${id_element}`
        console.log(id_element);

    })
}


function deleteFriend() {
    $(document).on('click', '.delete_friend', (element) => {
        if (confirm("¿Estas seguro que quieres eliminar este amigo?")) {
            let id_element = element.target.parentElement.parentElement.children[2].textContent;

            $.post('http://127.0.0.1:8080/api/friends/delete', { id_element }, (response) => {
                showFriends();
            });
        }
    });
}


function close_activity_perfil() {
    const close_activity_perfil = document.querySelector('#close_activity_perfil');
    const activity_perfil = document.querySelectorAll('.activity_perfil');

    if (close_activity_perfil != null) {
        close_activity_perfil.addEventListener('click', function () {
            activity_perfil.forEach(element => {
                element.classList.toggle('d-none')
                if (element.classList.contains('d-none')) {
                    close_activity_perfil.textContent = "mostrar";
                } else {
                    close_activity_perfil.textContent = "ocultar";
                }
            });
        });


    }

}

async function showFriends() {



    let currentURL = window.location.pathname;

    //if (currentURL == '/amigos') {


    //Debemos pasar el id del usuario a mostrar todo
    try {

        const url = "http://127.0.0.1:8080/api/friends";
        const result = await fetch(url);
        const friends = await result.json();


        createFriendsList(friends[1], friends[0]);

    } catch (error) {
        console.log(error);
    }

    //}


}

function copyToClipboard() {

    const share = document.querySelector('.share');
    let url = share.dataset.text;

    share.addEventListener('click', () => {
        navigator.clipboard.writeText(url)
            .then(() => {
                alert("Copiado correctamente");
            });
    });
}


async function listPosts() {


    let currentURL = window.location.pathname;

    if (currentURL == '/posts' || currentURL == '/perfil') {

        try {
            const url = "http://127.0.0.1:8080/api/posts";
            const result = await fetch(url);

            const posts = await result.json();
            const wrap_articles = document.querySelector('#wrap-articles');


            template = '';


            if (posts.length > 0) {


                posts.forEach((post) => {
                    let url = `https://www.youtask.es/post?id=${post.id}`;
                    template += `
                    <article class="wrap-article m-2 d-flex flex-column">
                        
                        <div class="align-self-end">
                            <button id="update_post" data-id="${post.id}" type="button" class="btn  my-2 btn-primary text-right text-end  " >Modificar</button>
                            <button id="delete_post" data-id="${post.id}" type="button" class="btn  my-2 btn-danger text-right text-end" >Eliminar</button>
                            
                        </div>
                        
                        
                        <span class="text-right d-block w-100 text-end">${post.create_at}</span>
                        <h3><a class="text-decoration-none text-dark text-capitalize" href="/post?id=${post.id}">${post.name}</a></h3>
                        <p>
                            ${post.content.substring(0, 500)}


                            <a  href="/post?id=${post.id}"><svg class="mx-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-lg text-muted pb-3px">
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
                                    </svg><span class="text-dark fs-5">(${post.likes})</span>
                                    <p class="d-none d-md-block mx-2"></p>
                                </a>
                                <a href="javascript:;" class="d-flex mx-2 align-items-center text-muted mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square icon-md">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                    </svg>
                                    <p class="d-none d-md-block mx-2"></p>
                                </a>
                                <a href="javascript:;" class="d-flex mx-2 align-items-center text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share icon-md">
                                        <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                                        <polyline points="16 6 12 2 8 6"></polyline>
                                        <line x1="12" y1="2" x2="12" y2="15"></line>
                                    </svg>
                                    <p class="d-none share d-md-block ml-2" data-text="${url}" onclick="copyToClipboard();">Compartir</p>
                                </a>
                            </div>
                        </div>
                    </article>
                    <hr/>
                    `;
                });
            } else {
                template = `<div><span>No hay artículos</span></div>`;
            }

            if (location.pathname === '/perfil') {
                template += ` 
                <div class="d-flex justify-content-center mt-5">
                    <button class="btn btn-secondary" onclick="window.location.href='/posts'">Ver más</button>
                </div>
                `;
            }

            wrap_articles.innerHTML = template;

        } catch (error) {
            console.log(error);
        }

    }
}


function createFriendsList(friends, count) {
    const container_friends = document.querySelector('#container_friends') ?? 0;
    const countFriends = document.querySelector('#countFriends') ?? 0;

    countFriends.textContent = "Lista de amigos (" + count + ")";

    let template = "";

    if (friends.length > 0) {

        friends.forEach((friend) => {
            template += `
            <div class="col-12 col-md-5 border shadow m-2">
                <div class="row">
                    <div class="col-3" id="">
                        <img id="avatar" src="/build/img/${friend.avatar}" alt="avatar" srcset="" class="img-fluid m-2">
                    </div>
                    <div class="col-4 d-flex justify-content-center align-items-center">
                        <span id="friend_username">${friend.username}</span>
                    </div>
                    <div class="col-5 d-flex">
                        <nav class="navbar navbar-expand-sm">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Acciones
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="/amigo?id=${friend.id}">Ver Perfil</a></li>
                                        <li><a class="dropdown-item delete_friend" href="#">Eliminar</a></li>
                                        <li class="d-none">${friend.id}</li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Enviar mensaje</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            `;
        });
    } else {
        template = `<p class="text-center text-danger">No tienes amigos agregados</p>`
    }

    container_friends.innerHTML = template;
}

function showCreateProject() {

    const create_project = document.querySelector('#create_project');
    const wrap_initials = document.querySelector('#wrap_initials');
    const wrap_create_project = document.querySelector('#wrap_create_project');


    if (document.querySelector('#create_project') != null) {

        if (create_project != null) {
            create_project.addEventListener('click', () => {
                wrap_initials.remove();
                wrap_create_project.classList.add('show_wrap_create_project');
            });
        } else {
            wrap_create_project.classList.add('show_wrap_create_project');
        }
    } else {
        if (document.querySelector('#wrap_create_project') != null) {
            wrap_create_project.classList.add('show_wrap_create_project');

        }
    }


}

function checkPassword() {
    const password = document.querySelector('#password');
    const repeatPassword = document.querySelector('#repeatPassword');
    const btn_register = document.querySelector('#btn-register');
    const privacity = document.querySelector('#privacity');

    if (privacity != null) {
        privacity.addEventListener('change', function () {
            if (privacity.checked) {
                if (password.value == repeatPassword.value) {
                    btn_register.classList.toggle('d-flex');
                }
            }

        });
    }


}

function checkAlerts() {
    if (document.querySelectorAll('.alerts')) {
        const alerts = document.querySelectorAll('.alerts');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.remove();
            }, 6000);
        });
    }
}

function showMenuResponse() {
    const burger = document.querySelector('.fa-bars');
    const nav__menu = document.querySelector('.nav__menu');
    const nav__list = document.querySelector('.nav__list');

    if (burger != null) {
        burger.addEventListener('click', () => {
            nav__menu.classList.toggle('d-flex');
            nav__list.classList.toggle('flex-column');
        });
    }

}