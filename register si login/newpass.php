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
   
?>
<form action="" method="post">
  
	<table>
		
	<tr>
           <td>Parola noua : </td>
           <td><input type="password" name="password" class="textInput"></td>
		</tr>
		<td><input type="submit" name="login_btn" class="Cauta"></td>
		
	</table>
	
	</form>
<?php
session_start();


$db=mysqli_connect("localhost","root","","login");
 if (empty($_POST['password'])) {
    $_SESSION['message']="Parola este obligatorie";
  }  else
  
if(isset($_POST['login_btn']))
{  $password=mysql_real_escape_string($_POST['password']);
$email= $_SESSION['email'];
$sql1="SELECT * FROM users WHERE email='$email'";
 $result1=mysqli_query($db,$sql1);
	$num1=mysqli_num_rows($result1);
	if($num1==1)
	{


$sql = "UPDATE users SET password='$password' where email='$email'";
	 $result=mysqli_query($db,$sql);
	//$num=mysqli_num_rows($result);
   // if($num==1)
	$_SESSION['message']="Parola a fost schimbata"; }
else  $_SESSION['message']="Parola nu a fost schimbata";  }
  //}  else  $_SESSION['message']="Nu a fost gasit acest email in bd";

   if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
  
?>


<button class="button"> <a href="login.php">Login</a> </button><br>
</body>
</html>
