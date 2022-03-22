document.addEventListener('DOMContentLoaded', function () {
    checkPassword();
    checkAlerts();
    showMenuResponse();
    showCreateProject();
    close_activity_perfil();
});

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