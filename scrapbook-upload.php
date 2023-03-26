<?php
// Include the database configuration file
require_once('connect.php');
// If file upload form is submitted
$status = $statusMsg = '';

session_start();
$username = $_SESSION['username'];
$scrapImg = $_POST['scrap-blob'];
$scrapCaption = $_POST['scrap-caption'];
$scrapTitle = $_POST['title'];

$lat = $_POST['latitude'];
$lng = $_POST['longitude'];
$city = $_POST['city-name'];

if(isset($_POST["export"])) {
    $status = 'error';
    
    $insert1 = $mysqli->query("INSERT INTO scrapbook (username, image_content, created_on, title) 
    VALUES ('$username', '$scrapImg', NOW(), '$scrapTitle')");
    $insert2 = $mysqli->query("INSERT INTO post (author_username, post_content, image, capture_image, created_on, latitude, longitude, city) 
    VALUES ('$username', '$scrapCaption', NULL, '$scrapImg', NOW(), '$lat', '$lng', '$city')");
    $mysqli = NULL;

    if($insert1 && $insert2) {
        $status = 'success';
        echo '<script>alert("Posted!")
        document.location="user-scrapbook.php"</script>';
    } else {
        echo '<script>alert("Failed, please try again.")
        history.back()</script>';
    }
}
?>



            