<?php

session_start();

if (!isset($_SESSION['id'])) {
    $_SESSION['message'] = "You are not logged."; ?>
    <form method="post" action="login.php">
        <input type="submit" name="login" value="Login">
    </form>

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
    }
    ?>

    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
    <div class="center">

        <?php
        $users = new Users($dbConnection);

        if (isset($_POST['add'])) {
            $validate = new Helper();
            if ($validate->isValidSubcategory()) {
                $requestData = $_POST;
                $users->addNewSubcategory($requestData);
            }
        }
        ?>
        <p><span class="error">* required field</span></p>
        <form method="post" action="">
            Category name: <select name="dropDownCategories">
                <option value="">Selectati</option>
                <?php $users->dropDownCategories(); ?>   </select>*<?php echo $validate->errors["dropDownMenuErr"]; ?>
            <br><br>
            Subcategory Name: <input type="text" name="subcategoryName">
            <span class="error">* <?php echo $validate->errors["subcategoryNameErr"]; ?></span>
            <br><br>
            <input type="submit" name="add" value="Add">
        </form>
        <button class="button"><a href="showSubcategories.php">Back</a></button>
        <br>
    </div>
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