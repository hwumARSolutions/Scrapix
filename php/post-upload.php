<?php
// Include the database configuration file
require_once('connect.php');
// If file upload form is submitted
$status = $statusMsg = '';
$imgContent = "";

session_start();
$username = $_SESSION['username'];
$imgPost = $_FILES["image"]["name"];
$captionPost = htmlspecialchars($_POST['post']);
$capturePost = $_POST['imageurl'];

$lat = $_POST['latitude'];
$lng = $_POST['longitude'];
$city = $_POST['city-name'];

$hasImg = $hasCaption = $hasCapture = false;

if(isset($_POST["post-submit"])) {
    $status = 'error';
    if((!empty($imgPost)) || (!empty($captionPost)) || (!empty($capturePost))) {

        if(!empty($imgPost)) {
            // Get file info
            $fileName = basename($_FILES["image"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    
            // Allow certain file formats
            $allowTypes = array('jpg','png','jpeg','gif');
            if(in_array($fileType, $allowTypes)) { 
                $image = $_FILES['image']['tmp_name'];
                $imgContent = addslashes(file_get_contents($image));
                $hasImg = true;
            } else {
                echo '<script>alert("Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.")
                    history.back()</script>';
            }
        } else if(!empty($captionPost)) {
            $hasCaption = true;
        } else if(!empty($capturePost)) {
            $hasCapture = true;
        }

    } else {
        echo '<script>alert("Please do not leave blank!")
        document.location="user-homepage.php"</script>';
    }

    if($hasImg || $hasCaption || $hasCapture) {
        // Insert content into database
        if(!empty($city)) {
            $lat = $_POST['latitude'];
            $lng = $_POST['longitude'];
            $city = $_POST['city-name'];
        
            $insert = $mysqli->query("INSERT INTO post (author_username, post_content, image, capture_image, created_on, latitude, longitude, city) 
            VALUES ('$username', '$captionPost', '$imgContent', '$capturePost', NOW(), '$lat', '$lng', '$city')");
            $mysqli = NULL;
        } else {
            $insert = $mysqli->query("INSERT INTO post (author_username, post_content, image, capture_image, created_on, latitude, longitude, city) 
            VALUES ('$username', '$captionPost', '$imgContent', '$capturePost', NOW(), NULL, NULL, NULL)");
            $mysqli = NULL;
        }

        if($insert) {
            $status = 'success';
            echo '<script>alert("Posted!")
            document.location="user-homepage.php"</script>';
        } else {
            echo '<script>alert("Failed, please try again.")
            history.back()</script>';
        }
    }
}
?>

