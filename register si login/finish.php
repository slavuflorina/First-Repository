<!DOCTYPE html>
<html>
<head>
  <title>Catalog</title>
  <link rel="stylesheet" type="text/css" href="style.css"/>
  
</head>
<body>
<div class="header">
    <h1>Catalog</h1>
</div>

<?php
session_start();


$db=mysqli_connect("localhost","root","","login");

$email= $_SESSION['email'];
$sql1="SELECT * FROM users WHERE email='$email'";
 $result1=mysqli_query($db,$sql1);
	$num1=mysqli_num_rows($result1);
	if($num1==1)
	{
$activ=1;

$sql = "UPDATE users SET activ='$activ' where email='$email'";
	 $result=mysqli_query($db,$sql);
	//$num=mysqli_num_rows($result);
   // if($num==1)
	$_SESSION['message']="Ati fost inregistrat cu succes"; }
    else  $_SESSION['message']="Inregistrare esuata";
  //}  else  $_SESSION['message']="Nu a fost gasit acest email in bd";

?>

<?php

 if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
	
	?>

<button class="button"> <a href="login.php">Login</a> </button><br>
</body>
</html>
