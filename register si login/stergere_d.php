
<?php
session_start();


$db=mysqli_connect("localhost","root","","login");
 
 
 
	 $name=$_SESSION['name'];
	  $facultate=$_SESSION['facultate'];
	 $specializare=$_SESSION['specializare'];
	 
	  if (empty($_POST['disciplina'])) {
  $_SESSION['message']= "Disciplina este obligatorie"; }
  else
	   if(isset($_POST['register']))
		   
	{	//$name=mysql_real_escape_string($_POST['name']);
	$disciplina=mysql_real_escape_string($_POST['disciplina']);

	
	$sql = "SELECT * FROM note WHERE facultate='$facultate' and specializare='$specializare' and disciplina='$disciplina'";
		$result=mysqli_query($db,$sql);
	$num=mysqli_num_rows($result);
    if($num!=1) {
			 $_SESSION['message']="Disciplina nu exista in db."; 
}
   else   
   {
	$sql = "DELETE FROM note WHERE facultate='$facultate' and specializare='$specializare' and disciplina='$disciplina'";
		$result=mysqli_query($db,$sql);
		if($result)
		{
			$_SESSION['message']="Datele au fost sterse";
		}
		else{
			$_SESSION['message']="Datele nu au fost sterse";
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

	<form method="post" action="stergere_d.php">
	 Stergere disciplina:
  <table>
   
	 <tr>
       
		<tr>
           <td>Disciplina : </td>
           <td><input type="text" name="disciplina" class="textInput"></td>
     </tr>
	<td><input type="submit" name="register" class="Sterge"></td>
</table>
	
	</form>
	
<br> <br>
<button class="button"> <a href="home1.php">Inapoi</a> </button><br>
<button class="button"> <a href="logout.php">Log Out</a></button>
</body>
</html>