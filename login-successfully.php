<?php
    
    $username = $password = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        $username = $_POST["username"];
        $password = $_POST["password"];

        include_once('connect.php');
        $stmt = $mysqli->query("SELECT * FROM scrapix.user WHERE username='$username' AND password='$password'");
        if ($stmt->num_rows == 0) {
            echo '<script>alert("Invalid username and/or password. Please try again.")
                document.location="login.html"</script>';
        } else {
            $row = $stmt->fetch_assoc();
            $_SESSION['username'] = $row['username'];
            echo '<script>document.location="user-homepage.php"</script>';
        }
    }
    
?>