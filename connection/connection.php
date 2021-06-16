<?php
$dbServer = "localhost";
$dbUserName = 'root';
$dbPassword = "";


$conn = mysqli_connect($dbServer, $dbUserName, $dbPassword);

if (!$conn) {
    die('Connection failed' . mysqli_connect_error($conn));
}

$sql = "Create Database bloodbank";

if (mysqli_query($conn, $sql)) {
    return true;
} else {
    return false;
}

mysqli_close($conn);