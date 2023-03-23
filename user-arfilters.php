<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@
        <?php session_start(); echo $_SESSION['username'];?> | AR Filters</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/Scrapix/scrapix/css/user-nav-style.css">
    <link rel="stylesheet" href="/Scrapix/scrapix/css/user-arfilters-style.css">
    <link rel="stylesheet" href="/Scrapix/scrapix/css/rs-user-arfilters-style.css">
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
        <div class="side-nav" id="side-nav">
            <div class="page-title">
                <button class="page-title-button" type="">AR Filters</button>
            </div>
            <div class="page-content">
                <div class="canvas-left" id="canvas-left">
                    <div id="loader-wrapper">
                        <h3 class="load_img_description">Upload your image and apply the AR Filter!</h3>
                        <span class="loader"></span>
                    </div>
                    <canvas class="deepar" id="deepar-canvas" oncontextmenu="event.preventDefault()"></canvas>
                </div>
                <div class="control-buttons">
                    <button id="upload" onclick="document.getElementById('image').click();"><span>Upload Image</span></button>
                    <input type="file" style="display:none;" id="image" name="image" onchange="loadImage(event)">
                    <script>
                        var loadImage = function(event) {
                            document.getElementById('deepar-canvas').style.display = "block";
                            processPhoto(URL.createObjectURL(event.target.files[0]));
                        };
                    </script>

                    <button id="switch-filter"><span>Apply & Switch Filter</span></button>
                    <button id="remove-makeup-filter"><span>Remove Filter</span></button>
                    <button id="download-photo"><span>Download Image</span></button>
                </div>
            </div>
            <script type="text/javascript" src="lib/js/deepar.js"></script>
            <script type="text/javascript" src="javascript/filters.js"></script>
        </div>
    </div>
</body>

</html>