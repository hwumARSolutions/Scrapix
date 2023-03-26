<?php
require_once('connect.php');

if(isset($_GET["comment-submit"])) {
    if(!empty($_GET['comment-input'])) {
        session_start();
        $username = $_SESSION['username'];
        $post_id = $_GET['post-id'];
        $comment_content = htmlspecialchars($_GET['comment-input']);
        $insert_comment = $mysqli->query("INSERT INTO post_comment (post_id, comment_username, comment_content, comment_time) 
                    VALUES ('$post_id', '$username', '$comment_content', NOW())");

        echo '<script>document.location="user-homepage.php"</script>';
    }
}
?>