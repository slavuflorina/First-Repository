<?php
session_start();

require_once "dbconnect.php";
require_once "dbconfig.php";
require_once "users.php";
require_once "helper.php";

$validate         = new Helper();
$validate->errors = $validate->validLogin();

$users    = new Users($dbConnection);
$email    = $_POST['email'];
$password = $_POST['password'];

if ($validate->isValidLogin()) {
    if (isset($_POST['login'])) {
        $loggedUser = array();
        $loggedUser = $users->getUser($email, $password);

        if ($loggedUser == "null") {
            $_SESSION['message'] = "Wrong email or password";
        } else {
            $_SESSION['id']     = $loggedUser['userId'];
            $_SESSION['name']   = $loggedUser['name'];
            $_SESSION['email']  = $loggedUser['email'];
            $_SESSION['role']   = $loggedUser['role'];
            $_SESSION['status'] = $loggedUser['status'];
            header('Location: index.php?confirmation=success');
        }
    }
}
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<div class="center">

    <?php
    if (isset($_SESSION['message'])) {
        echo "<div id='error_msg'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    ?>
    <form method="post" action="">
        Username: <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <span class="error">* <?php echo $validate->errors["emailErr"]; ?></span>
        <br><br>
        Password: <input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
        <span class="error">* <?php echo $validate->errors["passwordErr"]; ?></span>
        <br><br>
        <input type="submit" name="login" value="Login">
    </form>
</div>
</body>
</html>
