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
    require_once "dbconnect.php";
    require_once "dbconfig.php";
    require_once "users.php";
    if ($_SESSION['role'] == 1) {
        require_once "menu.php";
    } else {
        require_once "menuProfessor.php";
    } ?>

    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
    <div class="center">

        <?php
        $users   = new users($dbConnection);
        $genders = $users->getGenders();
        echo $users->showAllGenders($genders);
        ?>
        <body>
        <form method="post" action="addNewGender.php">
            <input type="submit" name="addnewgender" value="Add New Gender">
        </form>
    </div>
    <form method="post" action="logout.php">
        <label class="logoutLblPos">
            <input type="submit" name="logout" value="Logout">
        </label>
    </form>
    </body>
    </html>
<?php }
if (isset($_SESSION['message'])) {
    echo "<div id='error_msg'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);
} ?>