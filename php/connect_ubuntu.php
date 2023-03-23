<?php
// Basic connection settings
$databaseHost = '152.32.219.126';
$databaseUsername = 'guest';
$databasePassword = 'guest123';
$databaseName = 'scrapix';

// Connect to the database
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
