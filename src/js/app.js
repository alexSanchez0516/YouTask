document.addEventListener('DOMContentLoaded', function () {
    checkPassword();
    checkAlerts();
    showMenuResponse();
    showCreateProject();
});

function showCreateProject() {
    const create_project = document.querySelector('#create_project');
    const create_task = document.querySelector('#create_task');
    const wrap_initials = document.querySelector('#wrap_initials');
    const wrap_create_project = document.querySelector('#wrap_create_project');

    console.log(wrap_create_project);
    if (create_project != null) {
        create_project.addEventListener('click', () => {
            wrap_initials.remove();
            wrap_create_project.classList.add('show_wrap_create_project');
        });
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