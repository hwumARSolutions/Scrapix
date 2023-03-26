<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@<?php session_start(); echo $_SESSION['username'];?> | Explore</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="user-nav-style.css">
    <link rel="stylesheet" href="user-explore-style.css">
    <link rel="stylesheet" href="rs-user-explore-style.css">
    <script src="https://kit.fontawesome.com/4c430707bb.js" crossorigin="anonymous"></script>
</head>

<body oncontextmenu="return false">
    <div class="container">
        <div class="ver-nav">
            <div class="ver-nav-title">
                <p>Scrapix</p>
            </div>
            <div class="ver-nav-content">
                <a id="a-top" href="user-homepage.php"><i class="fa-sharp fa-solid fa-house"></i><p>Home</p></a>
                <a href="get-current-loc.php"><i class="fa-sharp fa-solid fa-compass"></i><p>Explore</p></a>
                <a href="user-arfilters.php"><i class="fa-solid fa-wand-magic-sparkles"></i><p>AR Filters</p></a>
                <a href="user-scrapbook.php"><i class="fa-solid fa-book"></i><p>Scrapbook</p></a>
                <a href="user-profile.php"><i class="fa-solid fa-user"></i><p>Profile</p></a>
                <a d="a-bottom" href="index.html"><i class="fa-solid fa-right-from-bracket"></i><p>Logout</p></a>
            </div>
        </div>
        <div class="side-nav">
            <?php 
                require_once('connect.php');
                $city = $_SESSION['current-loc'];
                $explore_data = $mysqli->query("SELECT * FROM post WHERE city = '$city' ORDER BY post_id DESC");
            ?>
            <div class="page-title">
                <button class="page-title-button" id="p1">YOUR CURRENT LOCATION:</button>
                <button class="page-title-button" id="p2"><span><?php echo($city); ?></span></button>
            </div>
            <div class="page-content">
                <ul class="explore-news-feed" id="explore-news-feed">
                    <?php
                        if($explore_data->num_rows == 0) {
                            echo "<p>No any posts yet</p>";
                        } else {
                            while($post_card = $explore_data->fetch_assoc()) { 
                                if($post_card['image'] != null) { ?>
                                    <li class="post-card">
                                        <div class="post-image">
                                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($post_card['image']); ?>" />
                                        </div>
                                        <div class="post-header">
                                            <div class="post-profile-pic">
                                                <img src="images/user-profile.png">
                                            </div>
                                            <div class="username-time-loc">
                                                <p class="post-username"><?php echo ($post_card['author_username']); ?></p>
                                                <!-- <p class="post-time">Posted on <?php echo ($post_card['created_on']); ?></p> -->
                                                <p class="post-loc"><i class="fa-solid fa-location-dot"></i>  <?php echo ($post_card['city']); ?></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php } 
                                if($post_card['capture_image'] != null) { ?>
                                    <li class="post-card">
                                        <div class="post-image">
                                            <img src="<?php echo ($post_card['capture_image']); ?>" />
                                        </div>
                                        <div class="post-header">
                                            <div class="post-profile-pic">
                                                <img src="images/user-profile.png">
                                            </div>
                                            <div class="username-time-loc">
                                                <p class="post-username"><?php echo ($post_card['author_username']); ?></p>
                                                <!-- <p class="post-time">Posted on <?php echo ($post_card['created_on']); ?></p> -->
                                                <p class="post-loc"><i class="fa-solid fa-location-dot"></i>  <?php echo ($post_card['city']); ?></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>                  
                        <?php } ?>
                    <?php   } ?>        
                </ul>
            </div>
        </div>
    </div>
</body>

</html>