<?php

$email = $username = $password = $repassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pre_pass = $_POST["password"];
    $uppercase = preg_match('@[A-Z]@', $pre_pass);
    $lowercase = preg_match('@[a-z]@', $pre_pass);
    $number = preg_match('@[0-9]@', $pre_pass);
    $specialChars = preg_match('@[^\w]@', $pre_pass);

    if ($pre_pass != ($_POST["re-password"])) {
        echo '<script>alert("Password does not match.")
                history.back()</script>';
    } elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pre_pass) < 8) {
        echo '<script>alert("Password does not match the rules.")
                history.back()</script>';
    } else {

        $email = $_POST["email-address"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $repassword = $_POST["re-password"];

        include_once('connect.php');
        $stmt_email = $mysqli->query("SELECT * FROM user WHERE email = '$email'");
        $stmt_username = $mysqli->query("SELECT * FROM user WHERE username = '$username'");

        if ($stmt_email->num_rows != 0) {
            echo '<script>alert("Sorry... the Email Address has already been registered.")
                history.back()</script>';
        } elseif ($stmt_username->num_rows != 0) {
            echo '<script>alert("Sorry... the Username has already been taken. Please try again!")
                history.back()</script>';
        } else {
            $mysqli->query("INSERT INTO user (username, email, password) 
            VALUES ('$username', '$email', '$password')");
            $mysqli = NULL;

            echo '<script>alert("Sign Up Successfully!")
            document.location="/Scrapix/scrapix/login.html"</script>';
        }
    }
}

?>