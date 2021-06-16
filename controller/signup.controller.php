<?php
include('../connection/connection.php');

function createUserTableIfNotExist($connection)
{
    // sql to create table
    $sql = "CREATE TABLE users (
    user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(256) NOT NULL,
    last_name VARCHAR(256) NOT NULL,
    email VARCHAR(256) NOT NUll,
    password VARCHAR(256) NOT NULL,
    gender VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    if (mysqli_query($connection, $sql) === TRUE) {
        echo "Table users created successfully";
    } else {
        echo "Error creating table: " . mysqli_connect_error($connection);
    }
}

// createUserTableIfNotExist($conn);
insertUser($conn);

function insertUser($conn)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo $_POST['email'];
            $data['success'] = false;
            $data['status'] = "invalid";
            $data['message'] = "Invalid Email";
            echo json_encode($data);
        } else {

            $first_name = test_data($_POST['first_name']);
            $last_name = test_data($_POST['last_name']);
            $email = test_data($_POST['email']);
            $password = test_data($_POST['password']);
            $gender = test_data($_POST['gender']);

            $hash = password_hash($password, PASSWORD_DEFAULT);
            echo $hash;
            $query = "INSERT INTO users (first_name, last_name, email, password ,gender) VALUES ('" . mysqli_real_escape_string($conn, $first_name) . "','" . mysqli_real_escape_string($conn, $last_name) . "','" . mysqli_real_escape_string($conn, $email) . "','" . mysqli_real_escape_string($conn, $hash) . "','" . mysqli_real_escape_string($conn, $gender) . "');";
            $result = mysqli_query($conn, $query);
            echo "Result returned" . $result;
            if ($result === 0) {
                $data['success'] = false;
                $data['status'] = "invalid";
                $data['message'] = "Error while creating user";
                echo json_encode($data);
            } else {
                $data['success'] = true;
                $data['status'] = "success";
                $data['message'] = "User created successfully";
                echo json_encode($data);
            }
        }
    } else {
        $data['success'] = false;
        $data['status'] = "invalid";
        $data['message'] = "Error Occured";
        echo json_encode($data);
    }
}

function test_data($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlentities($data);
    return $data;
}