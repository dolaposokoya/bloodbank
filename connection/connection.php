<?php
$dbServer = "localhost";
$dbUserName = 'root';
$dbPassword = "";
$databaseName = "bloodbank";


$conn = mysqli_connect($dbServer, $dbUserName, $dbPassword, $databaseName);

if (!$conn) {
    echo "No connection " . mysqli_connect_error($conn);
    // die('Connection failed' . mysqli_connect_error($conn));
}


// mysqli_close($conn);