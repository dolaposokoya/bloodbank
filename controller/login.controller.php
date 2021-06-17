<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    include('../connection/connection.php');

    $response = createUserTableIfNotExist($conn);
    if ($response === true) {
        insertUser($conn);
    } else {
        $data['success'] = false;
        $data['status'] = 200;
        $data['message'] = "Error Occured";
    }
} else {
    $data['success'] = false;
    $data['status'] = 'error';
    $data['message'] = 'not safe';
}

function test_data($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlentities($data);
    return $data;
}




function insertUser($conn)
{
    $email = test_data($_POST['email_v']);
    $password = test_data($_POST['pwd_v']);


    if (!empty($email) && !empty($password)) { //check if all the required values are not empty
        if (!filter_var($_POST['email_v'], FILTER_VALIDATE_EMAIL)) {
            $data['success'] = false;
            $data['status'] = "invalid";
            $data['message'] = "Invalid Email";
        } else {

            $hash = password_hash($password, PASSWORD_DEFAULT);
            $result = password_hash($password, PASSWORD_DEFAULT);
            if ($result === 0) {
                $data['success'] = false;
                $data['status'] = "invalid";
                $data['message'] = "Error while creating user";
            } else {
                $data['success'] = true;
                $data['status'] = "success";
                $data['message'] = "User login successfully";
                header("Location: index.php");
            }
        }
    } else {
        $data['success'] = false;
        $data['status'] = "invalid";
        $data['message'] = "Error Occured";
    }

    echo json_encode($data);
}