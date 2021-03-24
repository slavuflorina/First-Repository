<?php
include 'header.php';
	if($_SESSION['role'] == 1)
	{
		echo "Nu aveti permisiune!";
		exit();
	}
?>