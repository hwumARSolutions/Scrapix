<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@<?php session_start(); echo $_SESSION['username'];?> | Scrapbook Explore</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/Scrapix/scrapix/css/user-nav-style.css">
    <link rel="stylesheet" href="/Scrapix/scrapix/css/user-scrap-explore-style.css">
    <link rel="stylesheet" href="/Scrapix/scrapix/css/rs-scrap-explore-style.css">
    <script src="https://kit.fontawesome.com/4c430707bb.js" crossorigin="anonymous"></script>
</head>

<body oncontextmenu="return false">
    <div class="container">
        <div class="ver-nav">
            <div class="ver-nav-title">
                <p>Scrapix</p>
            </div>
            <div class="ver-nav-content">
            <a id="a-top" href="/Scrapix/scrapix/php/user-homepage.php"><i class="fa-sharp fa-solid fa-house"></i><p>Home</p></a>
                <a href="/Scrapix/scrapix/php/get-current-loc.php"><i class="fa-sharp fa-solid fa-compass"></i><p>Explore</p></a>
                <a href="/Scrapix/scrapix/user-arfilters.php"><i class="fa-solid fa-wand-magic-sparkles"></i><p>AR Filters</p></a>
                <a href="/Scrapix/scrapix/php/user-scrapbook.php"><i class="fa-solid fa-book"></i><p>Scrapbook</p></a>
                <a href="/Scrapix/scrapix/php/user-profile.php"><i class="fa-solid fa-user"></i><p>Profile</p></a>
                <a d="a-bottom" href="/Scrapix/scrapix/index.html"><i class="fa-solid fa-right-from-bracket"></i><p>Logout</p></a>
            </div>
        </div>
        <div class="side-nav">
            <?php 
                require_once('connect.php');
                $explore_data = $mysqli->query("SELECT * FROM scrapbook ORDER BY scrapbook_id DESC");
            ?>
            <div class="page-title">
                <button class="page-title-button">Scrapbook Explore</button>
                <button class="page-title-button" type=""><a id="your-scrapbook" href="user-scrapbook.php"><i class="fa-solid fa-book" style="margin-right: 10px; margin-left: 0px;"></i>Your Scrapbook</a></button>
            </div>
            <div class="page-content">
                <ul class="explore-news-feed" id="explore-news-feed">
                    <?php
                        if($explore_data->num_rows == 0) {
                            echo "<p>No any posts yet</p>";
                        } else {
                            while($post_card = $explore_data->fetch_assoc()) { 
                                if($post_card['image_content'] != null) { ?>
                                    <li class="post-card">
                                        <div class="post-image">
                                            <img src="<?php echo ($post_card['image_content']); ?>" />
                                        </div>
                                        <div class="post-header">
                                            <div class="post-profile-pic">
                                                <img src="/Scrapix/scrapix/images/user-profile.png">
                                            </div>
                                            <div class="username-time-loc">
                                                <p class="post-username"><?php echo ($post_card['username']); ?></p>
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