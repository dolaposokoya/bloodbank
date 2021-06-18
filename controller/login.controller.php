<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include('../connection/connection.php');

    // loginUser($conn);
    $email = test_data($_POST['email']);
    $password = test_data($_POST['password']);

    if (!empty($email) && !empty($password)) {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $data['success'] = false;
            $data['status'] = "invalid";
            $data['message'] = "Invalid Email";
        } else {
            $query =  "SELECT * from `user` WHERE `email` = '" . mysqli_real_escape_string($conn, $email) . "'";
            $result = mysqli_query($conn, $query);
            // $row = mysqli_fetch_assoc($result);
            // printf("%s (%s)\n", $row["first_name"], $row["last_name"]);
            /* fetch associative array */
            while ($row = mysqli_fetch_assoc($result)) {
                printf("%s (%s)\n", $row["first_name"], $row["last_name"]);
            }
            $data['success'] = true;
            $data['status'] = "success";
            $data['message'] = "['first_name']";
            // $data['message'] = $row['first_name'];
        }
    } else {
        $data['success'] = false;
        $data['status'] = "invalid";
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




function loginUser($conn)
{
    $email = test_data($_POST['email']);
    $password = test_data($_POST['password']);


    if (!empty($email) && !empty($password)) {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $data['success'] = false;
            $data['status'] = "invalid";
            $data['message'] = "Invalid Email";
        } else {
            $query =  "Select * from users where email = '" . $email . "";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            printf("%s (%s)\n", $row["first_name"], $row["last_name"]);
            $data['success'] = true;
            $data['status'] = "success";
            $data['message'] = $row['first_name'];
            // while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            // $data['first_name'] = $row['first_name'];
            // $data['success'] = true;
            // $data['status'] = "success";
            // $data['message'] = $row['first_name'];
            // }
            // $hash = password_hash($password, PASSWORD_DEFAULT);
            // if ($hash === 0) {
            //     $data['success'] = false;
            //     $data['status'] = "invalid";
            //     $data['message'] = "Error while creating user";
            // } else {
            //     $data['success'] = true;
            //     $data['status'] = "success";
            //     $data['message'] = "User login successfully";
            //     header("Location: index.php");
            // }
        }
    } else {
        $data['success'] = false;
        $data['status'] = "invalid";
        $data['message'] = "Error Occured";
    }

    echo json_encode($data);
}