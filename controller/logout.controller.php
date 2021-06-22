<?php
session_start();
session_destroy();
$data['success'] = true;
$data['status'] = 200;
$data['message'] = "Logout successful";


echo json_encode($data);