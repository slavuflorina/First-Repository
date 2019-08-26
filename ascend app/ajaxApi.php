<?php
require_once "dbconnect.php";
require_once "dbconfig.php";

$json = array();
if (!empty($_POST["idCategory"])) {
    $idCategory = $_POST["idCategory"];

    $sql    = "SELECT * FROM school.categories 
                INNER JOIN school.subcategories ON categories.idCategory=subcategories.idCategory 
			            AND categories.idCategory='$idCategory'";
    $result = mysqli_query($dbConnection, $sql);
    if (mysqli_num_rows($result) > 0) {
        While ($row = $result->fetch_assoc()) {
            $json[$row['idSubcategory']] = $row['subcategoryName'];
        }
    }
}
echo json_encode($json);
?>

