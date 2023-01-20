<?php
// Include the database configuration file
require_once('connect.php');
// If file upload form is submitted
$status = $statusMsg = '';
$imgContent = "";
if(isset($_POST["post-submit"])) {
    $status = 'error';
    if((!empty($_FILES["image"]["name"])) || (!empty($_POST['post']))) {
        if(!empty($_FILES["image"]["name"])) {
            // Get file info
            $fileName = basename($_FILES["image"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    
            // Allow certain file formats
            $allowTypes = array('jpg','png','jpeg','gif');
            if(in_array($fileType, $allowTypes)) { 
    
                // $exp = explode(".", $fileName);
                // $ext = end($exp);
                // $image = time().'.'.$ext;
                $image = $_FILES['image']['tmp_name'];
                $imgContent = addslashes(file_get_contents($image));
                
            } else {
                echo '<script>alert("Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.")
                    history.back()</script>';
            }
        }
    
        // Insert content into database
        session_start();
        $username = $_SESSION['username'];
        $post_content = htmlspecialchars($_POST['post']);

        if(!empty($_POST['city-name'])) {
            $lat = $_POST['latitude'];
            $lng = $_POST['longitude'];
            $city = $_POST['city-name'];

            $insert = $mysqli->query("INSERT INTO post (author_username, post_content, image, created_on, latitude, longitude, city) 
            VALUES ('$username', '$post_content', '$imgContent', NOW(), '$lat', '$lng', '$city')");
            $mysqli = NULL;
        } else {
            $insert = $mysqli->query("INSERT INTO post (author_username, post_content, image, created_on, latitude, longitude, city) 
            VALUES ('$username', '$post_content', '$imgContent', NOW(), NULL, NULL, NULL)");
            $mysqli = NULL;
        }
        
    
        if($insert) {
            $status = 'success';
            echo '<script>alert("Posted!")
                document.location="user-homepage.php"</script>';
        } else {
            echo '<script>alert("File upload failed, please try again.")
            history.back()</script>';
        }
    } else {
        echo '<script>alert("Please do not leave blank!")
                document.location="user-homepage.php"</script>';
    }
}
?>