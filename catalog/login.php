<!DOCTYPE html>
<?php
 include "header.php";   
 include "connect.php";
?>

<h1>Catalog</h1>
<html>
<body>

<form action="stud.php" method="get">
  CNP:<br>
  <input type="text" name="cnp">
  <br>
  Facultate:<br>
  <input type="text" name="facultate">
  <br>
  Specializare:<br>
  <input type="text" name="specializare">
  <br>
  Parola:<br>
  <input type="password" name="password">
  <br>
  <br><br>
  <input type="submit" name="login" value="Submit">
</form> 
<?php
if(isset($_GET['login'])){
$cnp=mysql_real_escape_string($_GET['cnp']);
    $facultate=mysql_real_escape_string($_GET['facultate']);
	$specializare=mysql_real_escape_string($_GET['specializare']);
    $password=mysql_real_escape_string($_GET['password']);
			   {
				   
				   
            $sql = "SELECT * FROM studenti WHERE cnp='$cnp' AND facultate='$facultate' AND specializare='$specializare' AND password='$password'"; 
            $result = mysql_query($sql, $id_conexiune);
            if ( mysql_fetch_array($result)) {
				 
			
			
			
				
			}
				
				
				{
                echo "<font color='red'>Intrarea cu aceste informatii nu exista!</font><br/>";
		  }  }
}
?>  <br> <br>
<button class="button"> <a href="register.php">Inregistrare</a></button>
</body>
</html>

