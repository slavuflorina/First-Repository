<?php
session_start();

if (!isset($_SESSION['id'])) {
    $_SESSION['message'] = "You are not logged.";
    ?>
    <html>
    <body>
    <form method="post" action="login.php">
        <input type="submit" name="login" value="Login">
    </form>
    </html>
    </body>
    <?php
} else {
    if ($_SESSION['status'] == 1) {
        require_once "dbconnect.php";
        require_once "dbconfig.php";
        require_once "users.php";

        $users       = new Users($dbConnection);
        $subjects    = $users->getAllSubjects();
        $sessionData = $_SESSION;
        echo $users->showAllSubjects($subjects, $sessionData);
    } else {
        $_SESSION['message'] = "You have no permision";
    }
    ?>
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
    <form method="post" action="logout.php">
        <label class="logoutLblPos">
            <input type="submit" name="logout" value="Logout">
        </label>
    </form>
    </html>

<?php }
if (isset($_SESSION['message'])) {
    echo "<div id='error_msg'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);
}
?>