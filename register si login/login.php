<?php
session_start();

$db=mysqli_connect("localhost","root","","login");

if (empty($_POST['name'])) {
    $_SESSION['message']= "Numele este obligatoriu";
  } else
	  
  if (empty($_POST['password'])) {
    $_SESSION['message']="Parola este obligatorie";
  }  else
  
if(isset($_POST['login_btn']))
{
    $name=mysql_real_escape_string($_POST['name']);
    $password=mysql_real_escape_string($_POST['password']);
	$calitate=mysql_real_escape_string($_POST['calitate']);
   // $password=md5($password);
   $sql1="SELECT * FROM users WHERE name='$name'";
   $result1=mysqli_query($db,$sql1);
	$num1=mysqli_num_rows($result1);
	if($num1==1)
	{  
		while($row = mysqli_fetch_assoc($result1)) 
		{$activ=$row["activ"];
		$email=$row["email"];}
			if($activ==1)
			{
    $sql="SELECT * FROM users WHERE name='$name' AND password='$password' AND calitate='$calitate'";
    $result=mysqli_query($db,$sql);
	$num=mysqli_num_rows($result);
    if($num==1)
    {  if($calitate=='profesor')
		
        {$_SESSION['message']="Ati fost logat cu succes!";
        $_SESSION['name']=$name;
        header("location:home1.php");
	   }
		else
			if ($calitate=='student')
			{$_SESSION['message']="Ati fost logat cu succes!";
        $_SESSION['name']=$name;
        header("location:home2.php"); }
			
    }
   else
   {
                $_SESSION['message']="Combinatie incorecta de nume si parola";
    }   
	} else   {$_SESSION['message']="Contul nu a fost activat. Verificati adresa de email";
				  $_SESSION['email']=$email;
$to = "$email";
$headers = "From: Catalog" . "\r\n" .
"";
 $txt = "     
      Hello,

      Welcome to Catalog!
      To complete your registration  please , just click following link
     
      http://localhost/register%20si%20login/finish.php
	  Click HERE to Activate :)
      
      Thanks.";
      
   $subject = "Confirm Registration";
mail($to,$subject,$txt,$headers);  
	}
}
	}  
?>
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
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>
<form method="post" action="login.php">
  <table>
     <tr>
           <td>Nume : </td>
           <td><input type="text" name="name" class="textInput"></td>
     </tr>
      <tr>
           <td>Password : </td>
           <td><input type="password" name="password" class="textInput"></td>
     </tr>
	 <tr>
           <td>Calitate : </td>
           <td><input type="text" name="calitate" class="textInput"></td>
     </tr>
      <tr>
           <td></td>
           <td><input type="submit" name="login_btn" class="Log In"></td>
		
     </tr>
	 
 
</table>
 <button class="button"> <a href="register.php" >Register</a> </button>
 <button class="button"> <a href="forgot.php" >Ai uitat parola?</a> </button>
</form>
</body>
</html>

