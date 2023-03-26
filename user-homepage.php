<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@<?php session_start(); echo $_SESSION['username'];?> | Homepage</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="user-nav-style.css">
    <link rel="stylesheet" href="user-homepage-style.css">
    <link rel="stylesheet" href="rs-user-homepage-style.css">
    <script src="https://kit.fontawesome.com/4c430707bb.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/dynamsoft-camera-enhancer@2.1.0/dist/dce.js"></script>
</head>

<body oncontextmenu="return false">
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
            <div class="search-bar">
                <div class="search-box" id="search-box">
                    <button class="search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <input type="text" id='searchbar' name="search" class="search-input" placeholder="Search" onkeyup="search_username()">
                </div> 
                <script src="username-search.js"></script>
            </div>
            <!-- <div class="search-result" id="search-result" style="display: none;">
                <ul id="search-result-list">
                    <?php
                        require_once('connect.php');
                        $users_result = $mysqli->query("SELECT * FROM user");
                        while($user_row = $users_result->fetch_assoc()) { ?>
                        <li class="username-list" style="display: none;"><a href="#"><?php echo ($user_row['username']); ?></a></li>
                    <?php } ?>
                    <li id="no-result" style="display: none;"><a style="cursor: none;">No results found</a></li>
                </ul>
            </div> -->
            <div class="profile-bar">
                <div class="profile-box">
                    <form action="post-upload.php" method="post" enctype="multipart/form-data">
                        <div class="new-post-box">
                            <!-- <div class="profile-pic">
                                <img src="/Scrapix/scrapix/images/user-profile.png">
                            </div> -->
                            <div class="new-post-text-area">
                                <textarea name="post" id="post" cols="82" rows="1" placeholder="What's on your mind?"></textarea>
                                <img id="preview"/>
                                <img id="captured-preview"/>
                            </div>
                            <div class="location-info">
                                <input type="text" style="display:none;" name="latitude" id="latitude">
                                <input type="text" style="display:none;" name="longitude" id="longitude">
                                <input type="text" style="display:none;" name="city-name" id="city-name">
                            </div>
                            <script src="gps-location.js"></script>
                        </div>
                        <div class="new-post-button">
                            <button type="button" id="showCamera">Camera</button>
                            <input type="text" id="imageurl" name="imageurl" style="display: none;">
                            <script src="camera.js"></script>
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
                                        <img src="images/user-profile.png">
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
                                    <!-- <div class="repost-button">
                                        <i class="fa-solid fa-share"></i>
                                        <input type="submit" name="repost-submit" id="repost" value="Repost" />
                                    </div> -->
                                </div>
                            </div>
                        <?php } ?>
                    </div>
            </div>
        </div>
        <div class="right-nav">
            <div class="profile-display">
                <div class="profile-pic">
                    <img src="images/user-profile.png">
                </div>
                <div class="username-display">
                    <p>@<?php echo $_SESSION['username'];?></p>                    
                </div>
            </div>
            <div class="suggestion-container">
                <div class="suggest-text">
                    <p>Suggestions For You</p>
                </div>
                <div class="suggest-content">
                    <ul>
                        <li><img src="images/bepic.jpg">Billie Eilish</li>
                        <li><img src="images/kjpic.jpg">Kendell Jenner</li>
                        <li><img src="images/khalidpic.jpg">Khalid</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>