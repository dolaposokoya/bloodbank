<?php
include('../header.php');
include('../connection/connection.php');
include('../controller/checkuser.controller.php');
?>
<link rel="stylesheet" href="../styles/user.css">
<div id="alert_box">
    <p class="alert alert-warning" id="warning_alert" role="alert">

    </p>
</div>
<div>
    <?php

    echo '
    <div style="display: flex; align-items: center; width: 100vw; justify-content: center;">
<div class="main">
    <h2> Hi,' . " " . $_SESSION["first_name"] . ' ' . $_SESSION["last_name"] . '</h2>' .
        '<button type="button" class="btn btn-outline-primary" id="logout">LOG OUT</button>
</div>
</div>
';

    $query =  "SELECT * from users";
    $result = mysqli_query($conn, $query);
    echo "<div class='table-responsive-sm'>
    <table class='table'>

<tr>

<th>Id</th>

<th>Name</th>

<th>email</th>
<th>Action</th>

</tr>";
    $index = 1;
    while ($row = mysqli_fetch_assoc($result)) {

        echo "<tr>";

        echo "<td>" . $index++ . "</td>";

        echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";

        echo "<td>" . $row['email'] . "</td>";

        echo '<td><button type="button" class="btn btn-outline-primary"' . "onclick=getUser(" . $row['user_id'] . ")" . "" . '>Check</button><td>';

        echo "</tr>";
    }

    echo "</table>
    </div>
    ";
    ?>
</div>
<script src="../script/logout.js"></script>
<script>
const getUser = async (userId) => {
    alert(userId);
}
</script>