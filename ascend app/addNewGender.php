<?php
session_start();

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
    </html>
    </body>
    <?php
} else {
    require_once "dbconnect.php";
    require_once "dbconfig.php";
    require_once "users.php";
    require_once "menu.php";
    require_once "helper.php";
    ?>
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
    <div class="center">

        <?php
        $users    = new Users($dbConnection);
        $validate = new Helper();

        if ($validate->isValidGender()) {
            $requestData = $_POST;
            $users->addNewGender($requestData);
        }
        ?>

        <form method="post" action="">
            <p><span class="error">* required field</span></p>
            Category name: <input type="text" name="genderName">
            <span class="error">*  <?php echo $validate->errors["genderNameErr"]; ?></span>
            <br><br>
            <input type="submit" name="addnewgender" value="Add">
        </form>
        <br><br>
        <button class="button"><a href="showGenders.php">Back</a></button>
        <br>
    </div>
    <form method="post" action="logout.php">
        <label class="logoutLblPos">
            <input type="submit" name="logout" value="Logout">
        </label>
    </form>
    </body>
    </html>
<?php } ?>