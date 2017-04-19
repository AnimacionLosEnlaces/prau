<?php

/*
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prau";
*/

$servername = "localhost";
$username = "prau";
$password = "3spartaco";
$dbname = "inaem43";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>