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

        if ($validate->isValidUser()) {
            $requestData = $_POST;
            $users->addNewUser($requestData);
        } ?>
        <form method="post" action="">
            <p><span class="error">* required field</span></p>
            Name: <input type="text" name="name">
            <span class="error">*  <?php echo $validate->errors["nameErr"]; ?></span>
            <br><br>
            Email: <input type="email" name="email">
            <span class="error">*  <?php echo $validate->errors["emailErr"]; ?></span>
            <br><br>
            Password: <input type="password" name="password">
            <span class="error">*  <?php echo $validate->errors["passwordErr"]; ?></span>
            <br><br>
            Role: <select name="role">
                <option>Select</option>
                <?php echo $users->getAllRoles(); ?>
            </select>
            <span class="error">*  <?php echo $validate->errors["roleErr"]; ?></span>
            <br><br>
            Status:<select name="status">
                <option>Select</option>
                <?php echo $users->getAllStatus(); ?>
            </select>
            <span class="error">* <?php echo $validate->errors["statusErr"]; ?></span>
            <br><br>
            <input type="submit" name="addNewUser" value="Add">
        </form>
        <br><br>

        <button class="button"><a href="showUsers.php">Back</a></button>
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