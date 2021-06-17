<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") { //validate request method because its ajax

    include('../connection/connection.php');

    //dont check for table exist, it will confuse and slow ure code..just create table manually and run insertuser function
    //error will come when u try to insert data inside the table
    $response = createUserTableIfNotExist($conn);
    if ($response === true) {
        // checkIfUserExist($conn);
        // $userExist = checkIfUserExist($conn);
        // if ($userExist === true) {
        //     $data['success'] = $userExist;
        //     $data['status'] = 200;
        //     $data['message'] = "User with that email already exist";
        // } else {
        insertUser($conn);
        //     $data['success'] = $userExist;
        //     $data['status'] = 200;
        //     $data['message'] = "User with that email not exist";
        // }
    } else {
        $data['success'] = $response;
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

function checkIfUserExist($conn)
{
    // sql to create table
    $email = test_data($_POST['email_v']);
    $sql = "SELECT first_name,email FROM users";
    $result = mysqli_query($conn, $sql);
    $db_first_name = array();
    // $sql = "SELECT enail FROM users WHERE email='$email'";
    if (mysqli_num_rows($result) == 0) {
        $data['success'] = true;
        $data['status'] = 200;
        $data['message'] = 'No user found';
    } else {
        while ($row = $result->fetch_assoc()) {
            array_push($db_first_name, $row["first_name"]);
        }
        $data['success'] = true;
        $data['status'] = 200;
        $data['message'] = $db_first_name['first_name'];
    }
}

function createUserTableIfNotExist($conn)
{
    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS users (
    user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(256) NOT NULL,
    last_name VARCHAR(256) NOT NULL,
    email VARCHAR(256) NOT NUll,
    password VARCHAR(256) NOT NULL,
    gender VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    if (mysqli_query($conn, $sql) === TRUE) {
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

    if (!empty($first_name) && !empty($last_name)) { //check if all the required values are not empty
        if (!filter_var($_POST['email_v'], FILTER_VALIDATE_EMAIL)) {
            $data['success'] = false;
            $data['status'] = "invalid";
            $data['message'] = "Invalid Email";
        } else {

            $hash = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (first_name, last_name, email, password ,gender) VALUES ('" . mysqli_real_escape_string($conn, $first_name) . "','" . mysqli_real_escape_string($conn, $last_name) . "','" . mysqli_real_escape_string($conn, $email) . "','" . mysqli_real_escape_string($conn, $hash) . "','" . mysqli_real_escape_string($conn, $gender) . "');";
            $result = mysqli_query($conn, $query);
            if ($result === 0) {
                $data['success'] = false;
                $data['status'] = "invalid";
                $data['message'] = "Error while creating user";
            } else {
                $data['success'] = true;
                $data['status'] = "success";
                $data['message'] = "User created successfully";
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