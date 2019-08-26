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
					
					
						 // echo $_SESSION['username'];
					  $name=$_SESSION['name'];
					// echo $name;
					   $sql="SELECT * FROM note where name='$name'";
		$result=mysqli_query($db,$sql);
		//if(mysqli_num_rows($result)==1)
		 
			while($row = mysqli_fetch_assoc($result)) 
			{
			//	 $id=$row["id"];
			//	 $name=$row["name"]; 
				//$username=$row["username"];
			//	$facultate=$row["facultate"];
		//	$specializare=$row["specializare"];
			
			$disciplina=$row["disciplina"]; 
			
			$nota=$row["nota"];
		//	echo $name."<br>";
		//	echo $facultate."<br>";
		//	echo $specializare."<br>";
			echo $disciplina." ";
			echo $nota."<br>";
		
			}
			
?>
	
		
	<button class="button"> <a href="stergere_s.php" class="button">Stergere student</a></button>	<br>
	<button class="button"> <a href="stergere_d.php" class="button">Stergere disciplina</a>	</button><br>
	<button class="button"> <a href="modificare.php" class="button">Modificare</a></button><br>

	
	
<button class="button"> <a href="logout.php">Log Out</a> </button>
</body>
</html>