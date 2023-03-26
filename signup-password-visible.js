const togglePassword1 = document.querySelector('#togglePassword');
const togglePassword2 = document.querySelector('#togglerePassword');
const password = document.querySelector('#password');
const repassword = document.querySelector('#re-password');

togglePassword1.addEventListener('click', function(e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});

togglePassword2.addEventListener('click', function(e) {
    // toggle the type attribute
    const type = repassword.getAttribute('type') === 'password' ? 'text' : 'password';
    repassword.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});