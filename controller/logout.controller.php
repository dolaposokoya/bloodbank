<?php
session_start();
session_destroy();
$data['success'] = true;
$data['status'] = 200;
$data['message'] = "Logging Out Succesful";
// header('Location: ../index.php');


echo json_encode($data);