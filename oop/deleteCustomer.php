<?php
include 'headerAdmin.php';

$idCustomer = $_GET['idCustomer'];

$sql = "DELETE FROM customer WHERE idCustomer='$idCustomer'";
if ($execute -> query($sql)) {
	echo "Client sters";
	header("Location: listaClienti.php");
} else
	echo "Eroare!";
?>