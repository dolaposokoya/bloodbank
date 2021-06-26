<?php
// session_start();
try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        include('../connection/connection.php');

        loginUser($conn);
    } else {
        $data['success'] = false;
        $data['status'] = 'error';
        $data['message'] = 'not safe';
    }
} catch (Exception $e) {
    $data['success'] = false;
    $data['status'] = 401;
    $data['message'] = $e->getMessage();
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
    try {

        $email = test_data($_POST['email']);
        $password = test_data($_POST['password']);

        if (!empty($email) && !empty($password)) {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $data['success'] = false;
                $data['status'] = "invalid";
                $data['message'] = "Invalid Email";
            } else {
                $email = strtolower($email);
                $query =  "SELECT * from users WHERE email = '" . mysqli_real_escape_string($conn, $email) . "'";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) == 0) {
                    $data['success'] = false;
                    $data['status'] = 201;
                    $data['message'] = "No such user";
                } else {
                    if ($row = mysqli_fetch_assoc($result)) {
                        if ($row['email'] === $email) {
                            session_start();
                            $hash = $row['password'];
                            $match =  password_verify($password,  $hash);
                            if ($match === true) {
                                $_SESSION["first_name"] = $row['first_name'];
                                $_SESSION["last_name"] = $row['last_name'];
                                $_SESSION["email"] = $row['email'];
                                $_SESSION["user_id"] = $row['user_id'];
                                $data['success'] = true;
                                $data['status'] = 200;
                                $data['message'] = 'Login Successful';
                                $data['data'] = $row;
                            } else {
                                $data['success'] = false;
                                $data['status'] = 200;
                                $data['message'] = 'Email or password do not match';
                            }
                        }
                    }
                }
            }
        } else {
            $data['success'] = false;
            $data['status'] = "invalid";
            $data['message'] = "Error Occured";
        }
    } catch (Exception $e) {
        $data['success'] = false;
        $data['status'] = 401;
        $data['message'] = $e->getMessage();
    }
    echo json_encode($data);
}