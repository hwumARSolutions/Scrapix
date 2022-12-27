<?php

$email = $username = $password = $repassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pre_pass = $_POST["password"];
    $uppercase = preg_match('@[A-Z]@', $pre_pass);
    $lowercase = preg_match('@[a-z]@', $pre_pass);
    $number = preg_match('@[0-9]@', $pre_pass);
    $specialChars = preg_match('@[^\w]@', $pre_pass);

    if (empty($_POST["email-address"])) {
        echo '<script>alert("Email Address is required.")
                history.back()</script>';
    } elseif (empty($_POST["username"])) {
        echo '<script>alert("Username is required.")
                history.back()</script>';
    } elseif (empty($_POST["password"])) {
        echo '<script>alert("Password is required.")
                history.back()</script>';
    } elseif (empty($_POST["re-password"])) {
        echo '<script>alert("Please repeat your password.")
                history.back()</script>';
    } elseif (!isset($_POST['agree-term'])) {
        echo '<script>alert("Please agree all statements in Terms of Service.")
                history.back()</script>';
    } elseif ($pre_pass != ($_POST["re-password"])) {
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
        $stmt_email = $file_db->prepare("SELECT * FROM user WHERE email = '$email'");
        $stmt_email->execute();
        $stmt_username = $file_db->prepare("SELECT * FROM user WHERE username = '$username'");
        $stmt_username->execute();

        if ($stmt_email->fetchColumn() != 0) {
            echo '<script>alert("Sorry... the Email Address has already been registered.")
                history.back()</script>';
        } elseif ($stmt_username->fetchColumn() != 0) {
            echo '<script>alert("Sorry... the Username has already been taken. Please try again!")
                history.back()</script>';
        } else {
            $file_db->exec("INSERT INTO 'user' ('username', 'email', 'password') 
            VALUES ('$username', '$email', '$password')");
            $file_db = NULL;

            echo '<script>alert("Sign Up Successfully!")
                history.back()</script>';
        }
    }
}

?>