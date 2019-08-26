<?php
session_start();
session_destroy();
unset($_SESSION['name']);
$_SESSION['message']="Ati fost delogat cu succes!";
header("location:login.php");
?>