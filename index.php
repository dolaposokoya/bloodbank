<?php include('header.php') ?>
<link rel="stylesheet" href="./styles/index.css">
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
            <a href="./views/register.php">New here click here</a>
        </div>
    </form>
</div>
<script src="./script/login.js"></script>