var myInput = document.getElementById("password");
var letter = document.getElementById("small");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var symbol = document.getElementById("symbol");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
    document.getElementById("password-rule").style.display = "flex";
    document.getElementById("rule-box").style.display = "flex";
    document.getElementById("content").style.marginBottom = "40px";
    document.getElementById("content").style.marginTop = "40px";
    document.getElementById("login-here").style.marginTop = "10px";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
    document.getElementById("password-rule").style.display = "none";
    document.getElementById("rule-box").style.display = "none";
    document.getElementById("content").style.marginBottom = "10px";
    document.getElementById("content").style.marginTop = "20px";
    document.getElementById("login-here").style.marginTop = "-10px";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if (myInput.value.match(lowerCaseLetters)) {
        letter.classList.remove("invalid");
        letter.classList.add("valid");
    } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
    }

    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if (myInput.value.match(upperCaseLetters)) {
        capital.classList.remove("invalid");
        capital.classList.add("valid");
    } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if (myInput.value.match(numbers)) {
        number.classList.remove("invalid");
        number.classList.add("valid");
    } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
    }

    // Validate symbol
    var symbols = /[!@#$%^&*+*=]/g;
    if (myInput.value.match(symbols)) {
        symbol.classList.remove("invalid");
        symbol.classList.add("valid");
    } else {
        symbol.classList.remove("valid");
        symbol.classList.add("invalid");
    }

    // Validate length
    if (myInput.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
    } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
    }
}