<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@
        <?php session_start(); echo $_SESSION['username'];?> | Explore</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/4c430707bb.js" crossorigin="anonymous"></script>
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        min-height: 100vh;
        margin: 0 auto;
        background: #242424;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .container {
        width: 25%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: white;
        border: solid transparent;
        border-radius: 12px;
        border-width: 0 0 4px;
        min-width: 250px;
        min-height: 250px;
    }

    .form {
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
        align-items: center;
        height: 80%;
    }

    h2 {
        font-size: 18px;
    }
    
    input {
        border: solid transparent;
        border-radius: 12px;
        border-width: 0 0 4px;
        margin-top: 10px;
    }
    
    input[type=submit] {
        width: 100px;
        height: 40px;
        font-size: 15px;
        font-weight: bold;
        background-color: #949494;
        cursor: pointer;
        color: white;
    }
    
    input[type=text] {
        width: fit-content;
        height: 50px;
        background-color: #f2f0f0;
        padding: 6px 15px;
        box-sizing: border-box;
        color: black;
        text-align: center;
        font-size: 16px;
        cursor: default;
    }
</style>

<body oncontextmenu="return false">
    <div class="container">
        <div class="modal" id="modal">
            <div class="modal-content">
                <form action="update-current-loc.php" method="post" id="post-location" class="form">
                    <input type="text" style="display:none;" name="latitude" id="latitude">
                    <input type="text" style="display:none;" name="longitude" id="longitude">
                    <h2>Your Current Location</h2>
                    <input type="text" name="city-name" id="city-name" readonly>
                    <script src="/Scrapix/scrapix/javascript/gps-location.js"></script>
                    <input type="submit" name="submit-loc" id="submit-loc" value="OK">
                </form>
            </div>
        </div>
    </div>
</body>