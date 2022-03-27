document.addEventListener('DOMContentLoaded', function () {
    checkPassword();
    checkAlerts();
    showMenuResponse();
    showCreateProject();
    close_activity_perfil();
    showFriends();
    deleteFriend();
});

function deleteFriend() { 
    $(document).on('click', '.delete_friend', (element) => {
        if (confirm("Estas seguro que quieres eliminar este amigo")) {
            let id_element = element.target.parentElement.parentElement.children[2].textContent;
        
            $.post('http://127.0.0.1:8080/api/friends/delete', {id_element}, (response) => {
                showFriends();
            });
        }
    });
} 


function close_activity_perfil() { 
    const close_activity_perfil = document.querySelector('#close_activity_perfil');
    const  activity_perfil = document.querySelectorAll('.activity_perfil');

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
  

    try {
        
        const url = "http://127.0.0.1:8080/api/friends";
        const result = await fetch(url);
        const friends = await result.json();
        

        createFriendsList(friends[1], friends[0]);

    } catch (error) {
        console.log(error);
    }
}


function createFriendsList(friends, count) { 
    const container_friends = document.querySelector('#container_friends');
    const countFriends = document.querySelector('#countFriends');

    countFriends.textContent = "Lista de amigos (" + count + ")";

    let template = "";

    if (friends.length > 0) {

        friends.forEach( (friend) => {
            console.log(friend);
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