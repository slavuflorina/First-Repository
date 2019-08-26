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
    require_once "helper.php";
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
        $users = new Users($dbConnection);

        $idCategory          = $_GET['idCategory'];
        $categoryInformations = array();
        $categoryInformations = $users->getInfoCategory($idCategory);
        $categoryName        = $categoryInformations["categoryName"];

        $validate = new Helper();
        if ($validate->isValidCategory()) {
            $requestData = $_POST;
            $users->updateCategory($requestData, $idCategory);
        } ?>

        <body>
        <form method="post" action="">
            <p><span class="error">* required field</span></p>
            Name: <input type="text" name="categoryName" value="<?php echo $categoryName; ?>">
            <span class="error">* <?php echo $validate->errors["categoryNameErr"]; ?></span>
            <br><br>
            <input type="submit" name="edit" value="Update">
        </form>
        <br><br>
        <button class="button"><a href="showCategories.php">Back</a></button>
        <br>
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