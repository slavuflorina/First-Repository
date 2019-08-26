<?php
session_start();
if (isset($_SESSION['id'])) {
    ?>
    <html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="menu.css"/>
    </head>
    <body>
    <div class="vertical-menu">
        <a href="showCategories.php" name="categories">Categories</a>
        <a href="showSubcategories.php" name="subcategories">Subcategories</a>
        <a href="showSubjects.php" name="subjects">Subjects</a>
        <a href="showUsers.php" name="users">Users</a>
        <a href="showBooks.php" name="books">Books</a>
        <a href="showAuthors.php" name="books">Authors</a>
        <a href="showGenders.php" name="books">Genders</a>
    </div>
    </body>
    </html>

    <?php
} else {
    $_SESSION['message'] = "You are not logged."; ?>

    <form method="post" action="login.php">
        <input type="submit" name="login" value="Login">
    </form>
    <?php
}


