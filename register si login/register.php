<?php
session_start();

$db=mysqli_connect("localhost","root","","login");
if (empty($_POST['name'])) {
    $_SESSION['message']= "Numele este obligatoriu";
  } else
if (empty($_POST['email'])) {
    $_SESSION['message']= "Email ieste obligatoriu";
  } else
  if (empty($_POST['password'])) {
    $_SESSION['message']="Parola este obligatorie";
  }  else
  if (empty($_POST['password2'])) {
  $_SESSION['message']="Parola2 este obligatorie";}
  else

  if (empty($_POST['calitate'])) {
    $_SESSION['message']= "Calitatea este obligatorie";
  } 
  else
	  
  {
	  if(isset($_POST['register_btn']))
{	$name=mysql_real_escape_string($_POST['name']);
   // $username=mysql_real_escape_string($_POST['username']);
    $email=mysql_real_escape_string($_POST['email']);
    $password=mysql_real_escape_string($_POST['password']);
    $password2=mysql_real_escape_string($_POST['password2']);
	$calitate=mysql_real_escape_string($_POST['calitate']);
  
  } 
	//	$email2=$email;
		$sql = "SELECT * FROM users WHERE name='$name'";
		$result=mysqli_query($db,$sql);
	$num=mysqli_num_rows($result);
    if($num==1) {
			 $_SESSION['message']="Utilizatorul exista in db."; 
}
   else   
	if($password==$password2  )
                
				{
					if($calitate=='profesor')
				
			{//  $password=md5($password); 
            $sql="INSERT INTO users(name,password,calitate,email) VALUES('$name','$password','$calitate','$email')";
            mysqli_query($db,$sql); 
		//	header("location:home1.php"); 
            $_SESSION['message']="Ati fost inregistrat cu succes"; 
          // $_SESSION['username']=$username;
	   
	 }
			
			else 
				if ($calitate=='elev')
				{//  $password=md5($password); 
            $sql="INSERT INTO users(name,password,calitate,email) VALUES('$name','$password','$calitate','$email')";
            mysqli_query($db,$sql); 
		//	header("location:home2.php"); 
           $_SESSION['message']="Ati fost inregistrat cu succes!"; 
           // $_SESSION['username']=$username;
         
	}  
				}
    else
    {
      $_SESSION['message']="Cele doua parole nu coincid";   
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
<form method="post" action="register.php">
  <table>
   <tr>
           <td>Nume : </td>
           <td><input type="text" name="name" class="textInput"></td>
     </tr>
	<tr>
           <td>Email : </td>
           <td><input type="email" name="email" class="textInput"></td>
     </tr>
      <tr>
           <td>Password : </td>
           <td><input type="password" name="password" class="textInput"></td>
     </tr>
      <tr>
           <td>Password again: </td>
           <td><input type="password" name="password2" class="textInput"></td>
     </tr>
	 <tr>
           <td>Calitate : </td>
           <td><input type="text" name="calitate" class="textInput"></td>
     </tr>
	
      <tr>
           <td></td>
           <td><input type="submit" name="register_btn" class="Register"></td>
     </tr>
 
</table>

<button class="button"> <a href="login.php"> Login</a> </button>
</form>
</body>
</html>