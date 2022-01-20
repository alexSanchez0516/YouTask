document.addEventListener('DOMContentLoaded', function () {
    checkPassword();
});

function checkPassword() {
    const password = document.querySelector('#password');
    const repeatPassword = document.querySelector('#repeatPassword');
    const btn_register = document.querySelector('#btn-register');
    const privacity = document.querySelector('#privacity');


    privacity.addEventListener('change', function () {
        if (privacity.checked) {
            if (password.value == repeatPassword.value) {
                btn_register.classList.toggle('d-flex');
            }
        } 

    });

}