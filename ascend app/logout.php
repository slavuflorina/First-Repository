<?php
session_start();
if ( isset( $_SESSION['id'] ) ) {
    session_destroy();
    unset($_SESSION['id']);
    unset($_SESSION['email']);
    unset($_SESSION['name']);
    unset($_SESSION['role']);
    unset($_SESSION['status']);
    $_SESSION['message'] = "You have been delogged!";
    header("location:login.php");
}
else $_SESSION['message']="You are not logged.";

if (isset($_SESSION['message'])) {
    echo "<div id='error_msg'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);
}
?>