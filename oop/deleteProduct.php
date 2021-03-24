<?php
include 'headerAdmin.php';

$idProduct = $_GET['idProduct'];

$sql = "DELETE FROM product WHERE idProduct='$idProduct'";
if ($execute -> query($sql)) {
	echo "Produs sters";
	header("Location: listaProduse.php");
} else
	echo "Eroare!";
?>