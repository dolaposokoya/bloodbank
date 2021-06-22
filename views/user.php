<?php
include('../header.php');
session_start();
?>
<!-- <link rel="stylesheet" href="../styles/index.css"> -->
<div id="alert_box">
    <p class="alert alert-warning" id="warning_alert" role="alert">

    </p>
</div>
<div class="conatiner-fluid">
    <?php
    // Starting session
    // session_start();

    echo '
<div>
    <h2> Hi,' . " " . $_SESSION["first_name"] . ' ' . $_SESSION["last_name"] . '</h2>
    </div>
    ';
    echo ' <div class="form-floating mb-3">
<button type="button" class="btn btn-outline-primary" id="logout">LOG OUT</button>
</div>';
    ?>
</div>
<script src="../script/logout.js"></script>