<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@<?php session_start(); echo $_SESSION['username'];?> | Homepage</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/Scrapix/scrapix/css/user-nav-style.css">
    <link rel="stylesheet" href="/Scrapix/scrapix/css/user-homepage-style.css">
    <script src="https://kit.fontawesome.com/4c430707bb.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/dynamsoft-camera-enhancer@2.1.0/dist/dce.js"></script>
</head>

<body>
    <!-- default container for every user page -->
    <dialog id="cameraDialog">
        <!-- <span class="close-camera" id="close">&times;</span> -->
        <form method="dialog" class="cameraOpen">
            <div class="camera-content">
                <div id="enhancerUIContainer"></div>
                <button id="capture" name="capture">Capture</button>
            </div>
        </form>
    </dialog>
    <div class="container">
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
            <div class="search-bar">
                <div class="search-box" id="search-box">
                    <button class="search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <input type="text" id='searchbar' name="search" class="search-input" placeholder="Search" onkeyup="search_username()">
                </div> 
                <script src="/Scrapix/scrapix/javascript/username-search.js"></script>
            </div>
            <div class="search-result" id="search-result" style="display: none;">
                <ul id="search-result-list">
                    <?php
                        require_once('connect.php');
                        $users_result = $mysqli->query("SELECT * FROM user");
                        while($user_row = $users_result->fetch_assoc()) { ?>
                        <li class="username-list" style="display: none;"><a href="#"><?php echo ($user_row['username']); ?></a></li>
                    <?php } ?>
                    <li id="no-result" style="display: none;"><a style="cursor: none;">No results found</a></li>
                </ul>
                </div>
            <div class="profile-bar">
                <div class="profile-box">
                    <form action="post-upload.php" method="post" enctype="multipart/form-data">
                        <div class="new-post-box">
                            <div class="profile-pic">
                                <img src="/Scrapix/scrapix/images/user-profile.png">
                            </div>
                            <div class="new-post-text-area">
                                <textarea name="post" id="post" cols="70" rows="5" placeholder="Write something..."></textarea>
                                <img id="preview"/>
                                <img id="captured-preview"/>
                            </div>
                            <div class="location-info">
                                <input type="text" style="display:none;" name="latitude" id="latitude">
                                <input type="text" style="display:none;" name="longitude" id="longitude">
                                <input type="text" style="display:none;" name="city-name" id="city-name">
                            </div>
                            <script src="/Scrapix/scrapix/javascript/gps-location.js"></script>
                        </div>
                        <div class="new-post-button">
                            <button type="button" id="showCamera">Camera</button>
                            <input type="text" id="imageurl" name="imageurl" style="display: none;">
                            <script src="/Scrapix/scrapix/javascript/camera.js"></script>
                            <button type="button" id="upload" onclick="document.getElementById('image').click();">Upload</button>
                            <input type="file" style="display:none;" id="image" name="image" onchange="loadFile(event)">
                            <script>
                                var loadFile = function(event) {
                                    var output = document.getElementById('preview');
                                    output.src = URL.createObjectURL(event.target.files[0]);
                                    output.onload = function() {
                                        URL.revokeObjectURL(output.src) // free memory
                                    }
                                };
                            </script>
                            <button type="submit" name="post-submit">Post</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="news-feed">
                <?php 
                    $post_data = $mysqli->query("SELECT * FROM post ORDER BY post_id DESC");
                ?>
                    <div class="gallery">
                        <?php while($post_row = $post_data->fetch_assoc()) { 
                            $post_id = $post_row['post_id'];
                            $username = $_SESSION['username'];
                            ?>
                            <div class="post-box">
                                <div class="post-header">
                                    <div class="post-profile-pic">
                                        <img src="/Scrapix/scrapix/images/user-profile.png">
                                    </div>
                                    <div class="username-time-loc">
                                        <p class="post-username"><?php echo ($post_row['author_username']); ?></p>
                                        <div class="time-loc">
                                            <p class="post-time" style="display: inline;">Posted on <?php echo ($post_row['created_on']); ?></p>
                                            <?php if(($post_row['city']) != null) { ?>
                                            <p class="post-loc" style="display: inline;"><i class="fa-solid fa-location-dot"></i>  <?php echo ($post_row['city']); ?></p>
                                            <?php } ?>
                                        </div>
                                    </div>
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
                                <?php
                                    $comment_data = $mysqli->query("SELECT * FROM post_comment WHERE post_id = '$post_id' ORDER BY comment_id ASC");
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
                                <div class="comment-modal" id="commentModal">
                                    <div class="comment-modal-content">
                                        <form action="comment-upload.php" method="get" enctype="multipart/form-data">
                                            <!-- <img src="/Scrapix/scrapix/images/user-profile.png"> -->
                                            <input type="text" name="post-id" id="post-id" style="display: none;" value="<?php echo ($post_id); ?>">
                                            <input type="text" name="comment-input" id="comment-input" placeholder="Write a comment...">
                                            <div class="comment-button">
                                                <i class="fa-solid fa-comment"></i>
                                                <input type="submit" name="comment-submit" id="comment" value="Comment" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="post-buttons">
                                    <?php
                                        $like_result = $mysqli->query("SELECT * FROM post_likes WHERE likes_username='$username' AND post_id='$post_id'");

                                        if (mysqli_num_rows($like_result) == 1) { ?>
                                            <div class="like-button" style="color: #4267B2;">
                                                <form action="like-upload.php" method="get" id="like-form">
                                                    <input type="text" name="post-id" id="post-id" style="display: none;" value="<?php echo ($post_id); ?>">
                                                    <i class="fa-solid fa-thumbs-up"></i>
                                                    <input type="submit" id="liked" name="liked" value="Liked <?php echo($post_row['likes']); ?>" style="color: #4267B2; font-weight: bold;">
                                                </form>  
                                            </div>
                                    <?php } else { ?>
                                            <div class="like-button" style="color: black;">
                                                <form action="like-upload.php" method="get" id="like-form">
                                                    <input type="text" name="post-id" id="post-id" style="display: none;" value="<?php echo ($post_id); ?>">
                                                    <i class="fa-solid fa-thumbs-up"></i>
                                                    <input type="submit" id="unliked" name="unliked" value="Like <?php echo($post_row['likes']); ?>" style="color: black;">
                                                </form>
                                            </div>
                                    <?php } ?>
                                    <div class="repost-button">
                                        <i class="fa-solid fa-share"></i>
                                        <input type="submit" name="repost-submit" id="repost" value="Repost" />
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
            </div>
        </div>
        <div class="right-nav">
            <p>hi</p>
        </div>
    </div>
</body>

</html>