<?php
require_once('connect.php');

if(isset($_GET['unliked'])) {
    session_start();
    $username = $_SESSION['username'];
    $post_id = $_GET['post-id'];
    $result = $mysqli->query("SELECT * FROM post WHERE post_id=$post_id");
	$row = mysqli_fetch_array($result);
    $n = $row['likes'];
    $insert_like = $mysqli->query("INSERT INTO post_likes (post_id, likes_username) VALUES ('$post_id', '$username')");
    $add_like = $mysqli->query("UPDATE post SET likes=$n+1 WHERE post_id=$post_id");
} 

if(isset($_GET['liked'])) {
    session_start();
    $username = $_SESSION['username'];
    $post_id = $_GET['post-id'];
    $result = $mysqli->query("SELECT * FROM post WHERE post_id=$post_id");
	$row = mysqli_fetch_array($result);
    $n = $row['likes'];
    $delete_like = $mysqli->query("DELETE FROM post_likes WHERE post_id=$post_id AND likes_username='$username'");
    $minus_like = $mysqli->query("UPDATE post SET likes=$n-1 WHERE post_id=$post_id");
}

echo '<script>document.location="user-homepage.php"</script>';

?>