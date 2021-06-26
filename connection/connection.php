<?php
$dbServer = "localhost";
$dbUserName = 'root';
$dbPassword = "";
// $databaseName = "hospital management system";
$databaseName = "hospital_management_system";


$conn = mysqli_connect($dbServer, $dbUserName, $dbPassword, $databaseName);

if (!$conn) {
    echo "No connection " . mysqli_connect_error($conn);
    // die('Connection failed' . mysqli_connect_error($conn));
}
// mysqli_close($conn);