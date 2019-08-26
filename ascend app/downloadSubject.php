<?php
session_start();

if (isset($_SESSION['id'])) {
    require_once "dbconnect.php";
    require_once "dbconfig.php";
    require_once "users.php";
    if ($_SESSION['role'] == 1) {
        require_once "menu.php";
    } else {
        require_once "menuProfessor.php";
    }
    ?>
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
    <div class="center">

    <?php
    $users = new Users($dbConnection);
    $id    = $_GET['id'];
    $users->downloadSubject($id);
} else {
    $_SESSION['message'] = "You are not logged.";
    ?>
    </div>
    <body>
    <form method="post" action="logout.php">
        <label class="logoutLblPos">
            <input type="submit" name="logout" value="Logout">
        </label>
    </form>
    <br><br>
    <button class="button"><a href="login.php">Login</a></button>
    <br>
    </body>
    </html>
    <?php
}
if (isset($_SESSION['message'])) {
    echo "<div id='error_msg'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);
}

?>
