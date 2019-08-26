
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
           <td>Email : </td>
           <td><input type="text" name="email" class="textInput"></td>
		</tr>
		<td><input type="submit" name="login_btn" class="Cauta"></td>
		
	</table>
	
	</form>
	<?php


	
	?>
<?php
session_start();
 

$db=mysqli_connect("localhost","root","","login");

 if (empty($_POST['email'])) {
    $_SESSION['message']="Email este obligatoriu";
  }  else
  
if(isset($_POST['login_btn']))
{
    $email=mysql_real_escape_string($_POST['email']);
	 $sql1="SELECT * FROM users WHERE email='$email'";
   $result1=mysqli_query($db,$sql1);
	$num1=mysqli_num_rows($result1);
	if($num1==1)
	{while($row = mysqli_fetch_assoc($result1)) 
		$activ=$row["activ"];	
			if($activ==1)
			{ 				  $_SESSION['email']=$email;
				$to = "$email";
$headers = "From: Catalog" . "\r\n" .
"";
 $txt = "     
      Hello,

      Welcome to Catalog!
      To reset your password  please , just click following link
     
      http://localhost/register%20si%20login/newpass.php
	  Click HERE to Activate :)
      
      Thanks.";
      
   $subject = "Confirm Registration";
mail($to,$subject,$txt,$headers); 
$_SESSION['message']="Verificati adresa de email"; 

 }
		else   $_SESSION['message']="Contul cu aceasta adresa de email nu a fost activat"; } 
else   $_SESSION['message']="Aceasta adresa nu exista in db"; }



if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>

<button class="button"> <a href="login.php">Login</a> </button><br>
</body>
</html>