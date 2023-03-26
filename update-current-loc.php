<?php
    if(!empty($_POST['city-name'])) {
        session_start();
        $_SESSION['current-loc'] = $_POST['city-name'];
        echo '<script>document.location="user-explore.php"</script>';
    }
?>