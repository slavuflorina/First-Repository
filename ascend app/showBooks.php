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
    require_once "menu.php";
    ?>
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
    <div class="center">

        <?php
        $users    = new Users($dbConnection);
        $books = $users->getBooks();
        echo $users->viewAllBooks($books);
        ?>
        <body>
        <br>
        <button class="button"><a href="addNewBook.php">Add New Book</a></button>
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