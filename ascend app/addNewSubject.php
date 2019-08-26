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
    require_once "helper.php";

    if ($_SESSION['role'] == 1) {
        require_once "menu.php";
    } else {
        require_once "menuProfessor.php";
    }
    ?>
    <html>
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>

        <script>
            $(document).ready(function () {

                $("#categoryId").on('change', function () {

                    var idCategory = $(this).val();

                    if (idCategory) {
                        $.ajax({
                            type: 'POST',
                            url: "ajaxApi.php",
                            dataType: 'Json',
                            data: 'idCategory=' + idCategory,
                            success: function (data) {

                                $('select[name="dropDownSubcategories"]').empty();
                                $.each(data, function (key, value) {
                                    $('select[name="dropDownSubcategories"]').append('<option value="' + key + '">' + value + '</option>');
                                });

                            }
                        });
                    } else {
                        $('select[name="dropDownSubcategories"]').empty();
                    }
                });
            });
        </script>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
    <body>
    <div class="center">

        <?php
        $users       = new Users($dbConnection);
        $validate    = new Helper();
        $subjectName = $_POST['subjectName'];

        if (isset($_POST['upload'])) {
            if ($validate->isValidSubject()) {
                $idCategory          = $_POST["dropDownCategories"];
                $requestData         = $_POST;
                $requestFile         = $_FILES;
                $sessionData         = $_SESSION;
                $_SESSION['message'] = $users->uploadFile($idCategory, $requestData, $requestFile, $sessionData);
            }
        } ?>

        <form action="" method="post" enctype="multipart/form-data">
            Category name: <select id="categoryId" name="dropDownCategories">
                <option value="">Selectati</option>
                <?php $users->dropDownCategories(); ?>
            </select>* <?php echo $validate->errors["dropDownCategoriesErr"]; ?>
            <br><br>
            Subcategory name: <select name="dropDownSubcategories">
                <option value="">Selectati</option>
            </select><?php echo "* " . $validate->errors["dropDownSubcategoriesErr"]; ?>
            <br><br>

            Subject name: <input type="text" name="subjectName">
            <span class="error">* <?php echo $validate->errors["subjectNameErr"]; ?></span>
            <br><br>
            Select File to Upload:
            <input type="file" name="file">
            <input type="submit" name="upload" value="Upload">
        </form>
        <button class="button"><a href="showSubjects.php">Back</a></button>
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