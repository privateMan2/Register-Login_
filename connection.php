<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "user_db";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection error: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "UTF8");
?>
