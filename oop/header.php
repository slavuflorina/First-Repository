<?php
require_once ('classAutoloader.php');
$connection = new database;
$execute = $connection -> connect();

if(!isset($_SESSION['idCustomer'])) 
		header("Location: login.php");
?>
<html>
<head>

	<title>Magazin online</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<?php 
//include 'footer.php';
?>