<?php
session_start();
require_once "dbconnect.php";
$conn         = new dbconnect("localhost", "root", "qwqwqwqw", "school");
$dbConnection = $conn->getConnection();
if (!$dbConnection) {
    die("Connection failed");
}
?>