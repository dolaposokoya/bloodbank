<?php include('header.php') ?>
<link rel="stylesheet" href="./styles/index.css">
<div class="conatiner-fluid">
    <form class="row" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="first_name" placeholder="First Name">
            <label for="first_name" class="form-label">First Name</label>
        </div>
        <div class="error">
            <p id="first_nameError"></p>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="last_name" placeholder="Last Name">
            <label for="last_name" class="form-label">Last Name</label>
        </div>
        <div class="error">
            <p id="last_nameError"></p>
        </div>
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
        <div class="form-floating mb-3">
            <input class="form-control" list="datalistOptions" id="gender" placeholder="Type to search...">
            <label for="gender" class="form-label">Gender</label>
            <datalist id="datalistOptions">
                <option value="Male">
                <option value="Female">
                <option value="Others">
            </datalist>
        </div>
        <div class="error">
            <p id="genderError"></p>
        </div>
        <div class="form-floating mb-3">
            <button type="button" class="btn btn-outline-primary" id="submit">SUBMIT</button>
        </div>
    </form>
</div>
<script src="./script/signup.js"></script>