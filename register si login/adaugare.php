
<?php
session_start();

$db=mysqli_connect("localhost","root","","login");
 
 	
	 if (empty($_POST['facultate'])) 
	{
    $_SESSION['message']= "Facultatea este obligatorie";
  } else
	  if (empty($_POST['specializare'])) {
    $_SESSION['message']= "Specializarea este obligatorie";
  } else
	if (empty($_POST['name'])) 
	{
    $_SESSION['message']= "Numele este obligatoriu";
  } else
	  if (empty($_POST['disciplina'])) {
    $_SESSION['message']= "Disciplina este obligatorie";
  } else
	  if (empty($_POST['nota'])) {
    $_SESSION['message']= "Nota este obligatorie";
  } else
		if(isset($_POST['register_btn']))
			
	{		$facultate=mysql_real_escape_string($_POST['facultate']);
		$specializare=mysql_real_escape_string($_POST['specializare']);
		$name=mysql_real_escape_string($_POST['name']);
		$disciplina=mysql_real_escape_string($_POST['disciplina']);
		$nota=mysql_real_escape_string($_POST['nota']); 
	 
		//$calitate='student';
	
		$sql = "INSERT INTO note(name,facultate,specializare,disciplina,nota) VALUES ('$name','$facultate','$specializare','$disciplina','$nota')";
		$result=mysqli_query($db,$sql);
	//$num=mysqli_num_rows($result);
	
    if($result) {
			 $_SESSION['message']="Studentul a fost adaugat"; 
}   else  $_SESSION['message']="Studentul nu a fost adaugat. Eroare"; 
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

	<form method="post" action="">
	Adaugare student: 
  <table>
   <tr>
   <td>Facultate : </td>
           <td><input type="text" name="facultate" class="textInput"></td>
     </tr>

     <tr>
           <td>Specializare : </td>
           <td><input type="text" name="specializare" class="textInput"></td>
     </tr>
           <td>Nume : </td>
           <td><input type="text" name="name" class="textInput"></td>
     </tr>

     <tr>
           <td>Disciplina : </td>
           <td><input type="text" name="disciplina" class="textInput"></td>
     </tr>
      <tr>
           <td>Nota : </td>
           <td><input type="numeric" name="nota" class="textInput"></td>
     </tr>
      
           <td><input type="submit" name="register_btn" class="Register"></td>
     </tr>
 
</table>   
</form>
	
		<br>
	<button class="button"> <a href="home1.php">Inapoi</a></button> <br>	
<button class="button"> <a href="logout.php">Log Out</a></button>
</body>
</html>