<?php
session_start();
require 'dbconfig.php';
include 'variabile.php';
include 'header.php';

//print_r($_SESSION);

if (!isset($_SESSION['id'])) {
	include 'login.php';
} else
	switch($action) {
		case 'statistici' :
			include ('statistici.php');
			break;

		case 'genereaza' :
			include ('genereaza.php');
			break;

		case 'import' :
			include ('import.php');
			break;

		case 'cautare' :
			include ('cautare.php');
			break;

		case 'logout' :
			session_destroy();
			header('Location:index.php');
			break;
	}

include 'footer.php';
?>