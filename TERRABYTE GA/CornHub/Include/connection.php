<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "terrabyte_database";

$conn=mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, 3306);

if (!$conn) {
    die("Failed to connect to database: " . mysqli_connect_error());
}
?>