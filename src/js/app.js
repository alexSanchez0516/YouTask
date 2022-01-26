

document.addEventListener('DOMContentLoaded', function () {
    checkPassword();
    checkAlerts();
    showMenuResponse();
});

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
            }, 9000);
        });
    }
}

function showMenuResponse() {
    const burger = document.querySelector('.fa-bars');
    const nav__menu = document.querySelector('.nav__menu');
    const nav__list = document.querySelector('.nav__list');
    
    
    burger.addEventListener('click', () => {
        nav__menu.classList.toggle('d-flex');
        nav__list.classList.toggle('flex-column');
    });
}