<?php
session_start();
if (isset($_SESSION["first_name"]) && isset($_SESSION["last_name"])) {
    return true;
} else {
    header('Location: ../index.php');
}