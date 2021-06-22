<link rel="stylesheet" href="./styles/index.css">
<?php
include('header.php');
session_start();

// Removing session data
if (isset($_SESSION["first_name"]) && isset($_SESSION["last_name"])) {
    header('Location: views/user.php');
} else {
    echo '<div id="alert_box">
    <p class="alert alert-warning" id="alert_warning" role="alert">
        Error
    </p>
</div>
<div class="conatiner-fluid">
    <form class="row" method="post">
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" placeholder="Email">
            <label for="email" class="form-label">Email</label>
        </div>
        <div class="error">
            <p id="emailError"></p>
            <p id="emailInvalidError"></p>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" placeholder="Password">
            <label for="password" class="form-label">Password</label>
        </div>
        <div class="error">
            <p id="passwordError"></p>
            <p id="passwordInvalidError"></p>
        </div>
        <div class="error">
            <p id="genderError"></p>
        </div>
        <div class="form-floating mb-3">
            <button type="button" class="btn btn-outline-primary" id="submit">LOGIN</button>
        </div>
        <div class="form-floating mb-3">
            <p>New here? click <a href="./views/register.php"> here</a> to register</p>
        </div>
    </form>
</div>';
}
?>


<script src="./script/login.js"></script>