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
		<?php
		  $name=$_SESSION['name'];
	  $facultate=$_SESSION['facultate'];
	 $specializare=$_SESSION['specializare'];
	  //echo $name;
	  //  echo $facultate;
		//  echo $specializare;
	{$sql = "DELETE FROM note WHERE name='$name' and facultate='$facultate' and specializare='$specializare'";
		$result=mysqli_query($db,$sql);
		if($result)
		{
			$_SESSION['message']="Datele nu au fost sterse. Eroare";
		}
		else{
			$_SESSION['message']="Datele au fost sterse";
			}  
	}
	
	?>

<br> <br>
<button class="button"> <a href="home1.php">Inapoi</a> </button><br>
<button class="button"> <a href="logout.php">Log Out</a></button>
</body>
</html>