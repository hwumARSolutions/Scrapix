<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@
        <?php session_start(); echo $_SESSION['username'];?> | Scrapbook</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="user-nav-style.css">
    <link rel="stylesheet" href="user-scrapbook-style.css">
    <link rel="stylesheet" href="rs-user-scrapbook-style.css">
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
        <?php
		    // Connect to MySQL database
            require_once('connect.php');
            $username = $_SESSION['username'];
		    // Fetch images from database
		    $sql = "SELECT * FROM scrapbook WHERE username = '$username'";
		    $result = mysqli_query($mysqli, $sql);
		    $num_images = mysqli_num_rows($result);

		    // Store data in a JavaScript array
		    $data_array = array();
            $title_array = array();

		    if (mysqli_num_rows($result) > 0) {
		        while($row = mysqli_fetch_assoc($result)) {
		            $data_array[] = $row['image_content'];
                    $title_array[] = $row['title'];
		        }
		    }

	    ?>
        <div class="side-nav" id="side-nav">
            <div class="page-title">
                <button class="page-title-button" type="">Your Scrapbook</button>
                <button class="page-title-button" type=""><a id="scrapbook-explore" href="user-scrap-explore.php"><i class="fa-solid fa-users" style="margin-right: 10px"></i>Explore</a></button>
                <button class="page-title-button" type=""><a id="new-scrap" href="scrapbook-canvas.html"><i class="fa-solid fa-plus" style="margin-right: 10px"></i>New Page</a></button>
            </div>
            <div class="page-content">
                <div class="scrap-title">
                    <div class="scrap-small-title">
                        <span type="text" id="scrap-title" name="scrap-title"></span>
                    </div>
                </div>
                <div class="scrap-content" id="scrap-content">
                    <div class="prev-button-class">
                        <a class="previous round" id="prev-button"><i class="fa-solid fa-angle-left"></i></a>
                    </div>
                    <div class="image">
                        <img id="image-preview" src="">
                    </div>
                    <div class="next-button-class">
                        <a class="next round" id="next-button"><i class="fa-solid fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="add-scrapbook" id="add-scrapbook">
                    <p>Add your new scrapbook now!</p>
                </div>
            </div>
        </div>
        <script>
            // Access the array elements
            var images =
                <?php echo json_encode($data_array); ?>;

            var titles = <?php echo json_encode($title_array); ?>;
            console.log(titles);
            // Initialize the current image index to 0
            let currentIndex = 0;
            // Get references to the image element and the previous/next buttons
            const titleDisplay = document.getElementById('scrap-title');
            const imagePreview = document.getElementById('image-preview');
            const prevButton = document.getElementById('prev-button');
            const nextButton = document.getElementById('next-button');

            if(images.length === 0) {
                document.getElementById('scrap-title').style.display = "none";
                document.getElementById('scrap-content').style.display = "none";
                document.getElementById('add-scrapbook').style.display = "block";
            } else {
                document.getElementById('scrap-title').style.display = "flex";
                document.getElementById('scrap-content').style.display = "flex";
                document.getElementById('add-scrapbook').style.display = "none";
            }
            // Show the initial image
            showImage(currentIndex);
            // Add event listeners to the previous/next buttons
            prevButton.addEventListener('click', showPrevImage);
            nextButton.addEventListener('click', showNextImage);
            function showImage(index) {
                // Set the src attribute of the image element to the corresponding image
                imagePreview.src = images[index];
                titleDisplay.textContent = titles[index];
            }
            function showPrevImage() {
                // Decrement the current index by 1
                currentIndex--;
                // If the index is less than 0, wrap around to the end of the array
                if (currentIndex < 0) {
                    currentIndex = images.length - 1;
                }
                // Show the corresponding image
                showImage(currentIndex);
            }
            function showNextImage() {
                // Increment the current index by 1
                currentIndex++;
                // If the index is greater than or equal to the length of the array, wrap around to the beginning
                if (currentIndex >= images.length) {
                    currentIndex = 0;
                }
                // Show the corresponding image
                showImage(currentIndex);
            }
        </script>
    </div>
</body>

</html>