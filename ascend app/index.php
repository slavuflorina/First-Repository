<?php
session_start();
require_once "dbconnect.php";
require_once "dbconfig.php";
require_once "users.php";

if (!isset($_SESSION['id'])) {
    $_SESSION['message'] = "You are not logged.";
    if (isset($_SESSION['message'])) {
        echo "<div id='error_msg'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    } ?>
    <html>
    <body>
    <form method="post" action="login.php">
        <input type="submit" name="login" value="Login">
    </form>
    </body>
    </html>
    <?php
} else {
    if ($_SESSION['role'] == 1) {
        header('Location: admin.php');
    }
    if ($_SESSION['role'] == 2) {
        header('Location: professor.php');
    }
    if ($_SESSION['role'] == 3) {
        header('Location: pupil.php');
    }
}
?>
