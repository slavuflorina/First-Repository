<?php
session_start();


$db=mysqli_connect("localhost","root","","login");


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
<form action="" method="post">
  Afiseaza studentii:
	<table>
		
	<tr>
           <td>Facultate : </td>
           <td><input type="text" name="facultate" class="textInput"></td>
		</tr>
        <tr>
           <td>Specializare : </td>
           <td><input type="text" name="specializare" class="textInput"></td>
		</tr>
           <td><input type="submit" name="search" class="Cauta"></td>
 
	

	</table>
	
	</form>
	
	<?php
					
					
							
							if (empty($_POST['facultate'])) {
							$_SESSION['message']= "Facultatea este obligatorie";
						} else
							if (empty($_POST['specializare'])) {
							$_SESSION['message']= "Specializarea este obligatorie";
						} else
							if(isset($_POST['search']))
			{	// $name=mysql_real_escape_string($_POST['name']);
			$facultate=mysql_real_escape_string($_POST['facultate']);
				$specializare=mysql_real_escape_string($_POST['specializare']);
				 $_SESSION['facultate']=$facultate;
				  $_SESSION['specializare']=$specializare;
				
					   $sql="SELECT DISTINCT name FROM note where facultate='$facultate' and specializare='$specializare' order by name";
		$result=mysqli_query($db,$sql);
		if(mysqli_num_rows($result)==1)
		 
			while($row = mysqli_fetch_assoc($result)) 
			{
			//	 $id=$row["id"];
				 $name=$row["name"]; 
				//$username=$row["username"];
			//$specializare=$row["specializare"];
		//	$disciplina=$row["disciplina"]; 
			
		//	$nota=$row["nota"];   ?>
			<a href="execut.php"><?php echo $name; ?> </a> <br>
			     <?php   $_SESSION['name']=$name;   ?>
				

				<?php	
			}
			
			else 	$_SESSION['message']= "Datele introduse sunt invalide";
				
			}

 ?> 
	<br>
	
 <button class="button"> <a href="adaugare.php" class="button">Adaugare</a> </button><br>
 
<button class="button"> <a href="logout.php">Log Out</a> </button>
</body>
</html>