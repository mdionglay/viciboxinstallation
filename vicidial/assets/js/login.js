document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.login-form');
    if (!form) return;

    form.addEventListener('submit', function (event) {
        const username = document.getElementById('username');
        const password = document.getElementById('password');

        if (!username || !password) return;
        if (username.value.trim() === '' || password.value.trim() === '') {
            event.preventDefault();
            alert('Username and password are required.');
        }
    });
});
