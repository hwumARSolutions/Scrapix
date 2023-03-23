<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>@
        <?php session_start(); echo $_SESSION['username'];?> | Scrapix</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/Scrapix/scrapix/css/user-nav-style.css">
    <link rel="stylesheet" href="/Scrapix/scrapix/css/user-profile-style.css">
    <link rel="stylesheet" href="/Scrapix/scrapix/css/rs-user-profile-style.css">
    <script src="https://kit.fontawesome.com/4c430707bb.js" crossorigin="anonymous"></script>
</head>

<body oncontextmenu="return false">
    <!-- default container for every user page -->
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
            <div class="page-title">
                <button class="page-title-button" type="">Your Profile</button>
                <button class="page-title-button" type=""><a id="edit-profile" href=""><i class="fa-solid fa-pen-to-square" style="margin-right: 10px"></i>Edit Profile</a></button>
            </div>
            <div class="page-content">
                <div class="profile-box">
                    <div class="profile-header">
                        <div class="profile-pic">
                            <img src="/Scrapix/scrapix/images/user-profile.png" width="80" height="80">
                        </div>
                        <div class="profile-username">
                            <p id="username">@<?php echo ($_SESSION['username']); ?>
                            </p>
                            <p id="followers">100 Followers 100 Following</p>
                        </div>
                    </div>
                    <div class="profile-description">
                        <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    </div>
                </div>
                <div class="post-box">
                    <div class="gallery">
                        <?php
                            require_once('connect.php');
                            $username = $_SESSION['username'];
                            $post_data = $mysqli->query("SELECT * FROM post WHERE author_username = '$username' ORDER BY post_id DESC");

                            while($post_row = $post_data->fetch_assoc()) {
                                $post_id = $post_row['post_id']; ?>

                                <div class="post-card">
                                    <div class="time-loc">
                                        <p class="post-time" style="display: inline;">Posted on <?php echo ($post_row['created_on']); ?></p>
                                        <?php if(($post_row['city']) != null) { ?>
                                        <p class="post-loc" style="display: inline;"><i class="fa-solid fa-location-dot"></i>  <?php echo ($post_row['city']); ?></p>
                                        <?php } ?>
                                        <form action="delete_post.php" method="post" style="display: inline;">
                                            <input type="text" id="post_id" name="post_id" style="display: none;" value="<?php echo $post_id ?>">
                                            <button type="submit" class="delete-button" id="delete-button">Delete Post</button>
                                        </form>
                                    </div>
                                    <?php if($post_row['post_content'] != null) { ?>
                                        <div class="post-caption">
                                            <p><?php echo ($post_row['post_content']); ?></p>
                                        </div>
                                    <?php } ?>
                                    <?php if($post_row['image'] != null) { ?>
                                        <div class="post-image">
                                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($post_row['image']); ?>" />
                                        </div>
                                    <?php } ?>
                                    <?php if($post_row['capture_image'] != null) { ?>
                                        <div class="post-image">
                                            <img src="<?php echo ($post_row['capture_image']); ?>">
                                        </div>
                                    <?php } ?>
                                        <div class="likes">
                                            <p id="num-likes"><?php echo $post_row['likes']; ?> likes</p>
                                        </div>
                                    <?php
                                        $comment_data = $mysqli->query("SELECT * FROM post_comment WHERE post_id = '$post_id' ORDER BY comment_id DESC");
                                        if($comment_data->num_rows != 0) { ?>
                                            <div class="comments-display">
                                                <?php 
                                                    while($comment_row = $comment_data->fetch_assoc()) { ?>
                                                        <div class="comment-box">
                                                            <p class="comment-username" style="display: inline;"><?php echo ($comment_row['comment_username']); ?></p>
                                                            <p class="comment-time" style="display: inline;"><?php echo ($comment_row['comment_time']); ?></p>
                                                            <p class="comment-content"><?php echo ($comment_row['comment_content']); ?></p>
                                                        </div>
                                                <?php } ?>
                                            </div>
                                    <?php } ?>
                                </div>
                      <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>