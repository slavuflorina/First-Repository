<?php
session_start();

if (!isset($_SESSION['id'])) {
    $_SESSION['message'] = "You are not logged.";
    if (isset($_SESSION['message'])) {
        echo "<div id='error_msg'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    } ?>
    <html>
    <body>>

    <form method="post" action="login.php">
        <input type="submit" name="login" value="Login">
    </form>
    </body>
    </html>
    <?php
} else { ?>
    <html>
    <h1>Welcome, <?php echo $_SESSION['name']; ?> ! </h1>
    </html>
<?php } ?>