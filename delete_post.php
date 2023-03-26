<?php

$post_id = $_POST['post_id'];

require_once('connect.php');
$sql = "DELETE FROM post WHERE post_id = '$post_id'";
$result = $mysqli->query($sql);

if ($result === TRUE) {
    echo '<script>alert("Deleted!")
    document.location="user-profile.php"</script>';
} else {
    echo '<script>alert("Failed, please try again.")
    history.back()</script>';
}

$mysqli->close();

?>