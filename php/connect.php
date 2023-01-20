<?php
// Basic connection settings
$databaseHost = '127.0.0.1';
$databaseUsername = 'scrapix';
$databasePassword = 'guest123';
$databaseName = 'scrapix';

// Connect to the database
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
