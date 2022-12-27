var check = function() {
    if (document.getElementById('password').value ==
        document.getElementById('re-password').value) {
        document.getElementById('message').style.display = "none";
    } else {
        document.getElementById('message').innerHTML = 'Password does not match!';
        document.getElementById('message').style.display = "block";
    }
}