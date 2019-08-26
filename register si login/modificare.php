<?php
session_start();



$db=mysqli_connect("localhost","root","","login");

$name=$_SESSION['name'];
	  $facultate=$_SESSION['facultate'];
	 $specializare=$_SESSION['specializare'];
	 
 if (empty($_POST['disciplina'])) {
    $_SESSION['message']= "Disciplina este obligatorie";
  } else if (empty($_POST['nota'])) {
    $_SESSION['message']= "Nota este obligatorie";
  }
  else
	   if(isset($_POST['register']))
		   
	{	
		$disciplina=mysql_real_escape_string($_POST['disciplina']);
		$nota=mysql_real_escape_string($_POST['nota']);
	
	$sql = "SELECT * FROM note WHERE name='$name' and facultate='$facultate' and specializare='$specializare' and disciplina='$disciplina' ";
		$result=mysqli_query($db,$sql);
	$num=mysqli_num_rows($result);
    if($num!=1) {
			 $_SESSION['message']="Disciplina nu exista in db."; 
}
   else   
	
	{$sql = "UPDATE note SET nota='$nota' where name='$name' and facultate='$facultate' and specializare='$specializare' and disciplina='$disciplina' ";
		$result=mysqli_query($db,$sql);
		if($result)
		{
			$_SESSION['message']="Datele au fost modificate";
		}
		else{
			$_SESSION['message']="Datele nu au fost modificate";
	}  }
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
	<form method="post" action="modificare.php">
	 Modificare student:
  <table>
   <tr>
           
		<td>Disciplina : </td>
           <td><input type="text" name="disciplina" class="textInput"></td>
     </tr>
	 <tr>
           <td>Nota : </td>
           <td><input type="text" name="nota" class="textInput"></td>
		</tr>
	<td><input type="submit" name="register" class="Modifica"></td>
</table>
	
	</form>
	
	

<br> <br>
<button class="button"> <a href="home1.php">Inapoi</a> </button><br>
<button class="button"> <a href="logout.php">Log Out</a></button>
</body>
</html>