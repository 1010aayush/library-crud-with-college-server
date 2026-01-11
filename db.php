<?php
// Update these credentials if your college server uses different username/password
$dbHost = 'localhost';
$dbUser = 'np02cs4s250005';
$dbPass = 'u2lGhOQ5n5';
$dbName = 'np02cs4s250005';

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
?>
