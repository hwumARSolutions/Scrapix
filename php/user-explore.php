<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@<?php session_start(); echo $_SESSION['username'];?> | Explore</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/Scrapix/scrapix/css/user-nav-style.css">
    <link rel="stylesheet" href="/Scrapix/scrapix/css/user-explore-style.css">
    <script src="https://kit.fontawesome.com/4c430707bb.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <script src="/Scrapix/scrapix/javascript/current-loc-modal.js"></script>
        <div class="ver-nav">
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
            <?php 
                require_once('connect.php');
                $city = $_SESSION['current-loc'];
                $explore_data = $mysqli->query("SELECT * FROM post WHERE city = '$city' ORDER BY post_id DESC");
            ?>
            <div class="current-loc-display">
                <p id="p1">YOUR CURRENT LOCATION</p>
                <p id="p2"><?php echo($city); ?></p>
            </div>
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
                                            <img src="/Scrapix/scrapix/images/user-profile.png">
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
</body>

</html>