<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    include('../connection/connection.php');

    $response = createUserTableIfNotExist($conn);
    if ($response == 1) {
        $userExist = checkIfUserExist($conn);
        if ($userExist == 1) {
            $data['success'] = false;
            $data['status'] = 200;
            $data['message'] = "User with that email already exist";
            echo json_encode($data);
        } else {
            insertUser($conn);
        }
    } else {
        $data['success'] = $response;
        $data['status'] = 200;
        $data['message'] = "Error Occured";
        echo json_encode($data);
    }
} else {
    $data['success'] = false;
    $data['status'] = 'error';
    $data['message'] = 'not safe';
    echo json_encode($data);
}

function test_data($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlentities($data);
    return $data;
}

function checkIfUserExist($conn)
{
    $email = test_data($_POST['email_v']);
    $email = strtolower($email);
    $query =  "SELECT * from users WHERE email = '" . mysqli_real_escape_string($conn, $email) . "'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 0) {
        return false;
    } elseif ($row = mysqli_fetch_assoc($result)) {
        if ($row['email'] === $email) {
            return true;
        } else {
            return false;
        }
    }
}

function createUserTableIfNotExist($conn)
{
    // -- user_id INT(6) UNSIGNED PRIMARY KEY,
    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS users (
    user_id INT(20) UNSIGNED AUTO_INCREMENT  PRIMARY KEY NOT NULL,
    first_name VARCHAR(256) NOT NULL,
    last_name VARCHAR(256) NOT NULL,
    email VARCHAR(256) NOT NUll,
    password VARCHAR(256) NOT NULL,
    gender VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    if (mysqli_query($conn, $sql) == 1) {
        return true;
    } else {
        return false;
    }
}


function insertUser($conn)
{
    $first_name = test_data($_POST['fname_v']);
    $last_name = test_data($_POST['lname_v']);
    $email = test_data($_POST['email_v']);
    $password = test_data($_POST['pwd_v']);
    $gender = test_data($_POST['gender_v']);
    if (!empty($first_name) && !empty($last_name)) {
        if (!filter_var($_POST['email_v'], FILTER_VALIDATE_EMAIL)) {
            $data['success'] = false;
            $data['status'] = "invalid";
            $data['message'] = "Invalid Email";
        } else {

            $hash = password_hash($password, PASSWORD_DEFAULT);
            $email = strtolower($email);
            $user_id = random_bytes(20);
            $user_id = bin2hex($user_id);
            $query = "INSERT INTO users (first_name, last_name, email, password ,gender) VALUES ('" . mysqli_real_escape_string($conn, $first_name) . "','" . mysqli_real_escape_string($conn, $last_name) . "','" . mysqli_real_escape_string($conn, $email) . "','" . mysqli_real_escape_string($conn, $hash) . "','" . mysqli_real_escape_string($conn, $gender) . "');";
            $result = mysqli_query($conn, $query);
            if ($result == 0) {
                $data['success'] = false;
                $data['status'] = "invalid";
                $data['message'] = "Error while creating user";
            } else {
                $data['success'] = true;
                $data['status'] = "success";
                $data['message'] = "User created successfully";
            }
        }
    } else {
        $data['success'] = false;
        $data['status'] = "invalid";
        $data['message'] = "Error Occured";
    }

    echo json_encode($data);
}