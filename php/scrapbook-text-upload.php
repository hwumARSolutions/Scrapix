<?php
require_once('connect.php');
if(isset($_POST["text-submit"])) {

    session_start();
    $username = $_SESSION['username'];
    $post_content = htmlspecialchars($_POST['text']);

    $insert = $mysqli->query("INSERT INTO scrapbook (username, scrapbook_id, text_content, image_content, page_number) 
    VALUES ('$username', 1, '$post_content', NULL, 1)");
    $mysqli = NULL;

    echo '<script>alert("Posted!")
            document.location="user-profile.php"</script>';
}
?>