<?php
 include "header.php";   
 include "connect.php";
?>

<h1>Catalog</h1>
<html>
<body>

<form action="" method="get">
  Nume:<br>
  <input type="text" name="nume">
  <br>
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
  Parola2:<br>
  <input type="password" name="password2">
  <br>
  
  <br><br>
  <input type="submit" name="register" value="Inregistrare">
</form> 
<?php
if(isset($_GET['register'])){
$nume=mysql_real_escape_string($_GET['nume']);
$cnp=mysql_real_escape_string($_GET['cnp']);
    $facultate=mysql_real_escape_string($_GET['facultate']);
	$specializare=mysql_real_escape_string($_GET['specializare']);
    $password=mysql_real_escape_string($_GET['password']);
	$password2=mysql_real_escape_string($_GET['password2']);
	 if($nume=='' || $cnp==''|| $facultate=='' || $specializare=='' || $password==''|| $password2=='')
		 echo "<font color='red'>Toate campurile trebuie completate!</font><br/>";
	 else
		 if($password!=$password2)
			 echo "<font color='red'>Cele doua parole nu coincid</font><br/>";
		 else
			   {
				     $sql1 = "SELECT * FROM studenti WHERE nume='$nume' AND cnp='$cnp' AND facultate='$facultate' AND specializare='$specializare'"; 
				   $result1 = mysql_query($sql1, $id_conexiune);
            if ( mysql_fetch_array($result1)) 
			echo "<font color='red'>Utilizatorul deja exista!</font><br/>";
			 else
			{
				
				
				
            $sql="INSERT INTO studenti(nume,cnp,facultate,specializare,password,password2) VALUES ('$nume','$cnp','$facultate','$specializare','$password','$password2')";
            $result = mysql_query($sql, $id_conexiune);
            if ( ($result)) {
				 
			
			echo "<font color='red'>Inregistrare cu succes</font><br/>";
			
				
			}
				
				else
				{
                echo "<font color='red'>Inregistrare nereusita!</font><br/>";
		  }  }
}  }
?>
<button class="button"> <a href="login.php">Login</a></button>
</body>
</html>