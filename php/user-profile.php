<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>@
        <?php session_start(); echo $_SESSION['username'];?> | Scrapix</title>
    <link rel="stylesheet" href="/Scrapix/scrapix/css/user-nav-style.css">
    <link rel="stylesheet" href="/Scrapix/scrapix/css/user-profile-style.css">
    <script src="https://kit.fontawesome.com/4c430707bb.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- default container for every user page -->
    <?php 
        require_once('connect.php');
        $username = $_SESSION['username'];
        $scrapbook_data = $mysqli->query("SELECT * FROM scrapbook WHERE username='$username' ORDER BY scrapbook_element_id");
    ?>
    <dialog id="scrapbook-dialog">
        <span class="close-scrapbook" id="close">&times;</span>
        <form method="dialog" class="scrapbook-open">
            <div class="scrapbook-content">
                <ul>
                <?php
                    while($scrap_element = $scrapbook_data->fetch_assoc()) { 
                        if($scrap_element['image_content'] != null) { ?>
                            <li class="scrap-element">
                                <div class="element-image">
                                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($scrap_element['image_content']); ?>" />
                                </div>
                            </li>
                        <?php } ?>
                        <?php if($scrap_element['text_content'] != null) { ?>
                            <li class="post-card">
                                <div class="element-text">
                                    <p><?php echo ($scrap_element['text_content']); ?></p>
                                </div>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
            <div class="scrapbook-button">
                <form action="" style="display: none;" method="post">
                </form>
                <form action="scrapbook-text-upload.php" method="post">
                    <input type="text" id="text" name="text">
                    <button type="submit" id="text-submit" name="text-submit">Upload Text</button>
                </form>
                <form action="scrapbook-image-upload.php" method="post" enctype="multipart/form-data">
                    <input type="file" id="image" name="image">
                    <button type="submit" id="image-submit" name="image-submit">Upload Image</button>
                </form>
            </div>
        </form>
    </dialog>
    <div class="container">
        <div class="ver-nav" id="ver-nav">
            <h1>Scrapix</h1>
            <ul>
                <li><i class="fa-sharp fa-solid fa-house"></i><a href="user-homepage.php">Home</a></li>
                <li><i class="fa-sharp fa-solid fa-compass"></i><a href="get-current-loc.php">Explore</a></li>
                <li><i class="fa-solid fa-bell"></i><a href="#notification">Notification</a></li>
                <li><i class="fa-solid fa-inbox"></i><a href="#messages">Messages</a></li>
                <li><i class="fa-solid fa-user"></i><a href="user-profile.php">Profile</a></li>
                <li><i class="fa-solid fa-bars"></i><a href="#more">More</a></li>
                <li><i class="fa-solid fa-right-from-bracket"></i><a href="/Scrapix/scrapix/index.html">Logout</a></li>
            </ul>
        </div>
        <div class="side-nav">
            <div class="upper-box">
                <div class="profile-box">
                    <div class="profile-pic">
                        <img src="/Scrapix/scrapix/images/user-profile.png">
                    </div>
                    <div class="details-box">
                        <div class="box-1 box">
                            <div class="username">
                                <p>
                                    <?php echo $_SESSION['username'];?>
                                </p>
                            </div>
                            <div class="edit-profile">
                                <button><i class="fa-solid fa-pen-to-square"></i>Edit Profile</button>
                            </div>
                        </div>
                        <div class="box-2 box">
                            <div class="followers">
                                <p>100 Followers</p>
                            </div>
                            <div class="following">
                                <p>100 Following</p>
                            </div>
                        </div>
                        <div class="box-3 box">
                            <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lower-box">
                <div class="box-4">
                    <div class="scrapbook-tab-button">
                        <button id="showScrapbook"><i class="fa-solid fa-book"></i>Scrapbook</button>
                    </div>
                    <div class="tagged-tab-button">
                        <button><i class="fa-solid fa-tag"></i>Tagged</button>
                    </div>
                </div>
                <!-- <div class="scrapbook-box">
                    <button id="showDialog">Show the dialog</button>
                </div> -->
                <script src="/Scrapix/scrapix/javascript/scrapbook.js"></script>
            </div>
        </div>
    </div>
</body>

</html>