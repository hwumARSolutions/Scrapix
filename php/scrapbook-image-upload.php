<?php
// Include the database configuration file
require_once('connect.php');
// If file upload form is submitted
$status = $statusMsg = '';
$imgContent = "";
if(isset($_POST["image-submit"])) {
    $status = 'error';
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

    $insert = $mysqli->query("INSERT INTO scrapbook (username, scrapbook_id, text_content, image_content, page_number) 
    VALUES ('$username', 1, NULL, '$imgContent', 1)");
    $mysqli = NULL;
    

    if($insert) {
        $status = 'success';
        echo '<script>alert("Posted!")
            document.location="user-profile.php"</script>';
    } else {
        echo '<script>alert("File upload failed, please try again.")
        history.back()</script>';
    }
}
?>