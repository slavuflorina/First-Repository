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
					
					
					 // echo $_SESSION['username'];
					  $name=$_SESSION['name'];
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
				  $sql="SELECT  * FROM note where name='$name' and facultate='$facultate' and specializare='$specializare' order by name";
					$result=mysqli_query($db,$sql);
			
			if(mysqli_num_rows($result)==1)
		 
			while($row = mysqli_fetch_assoc($result)) 
			{
				//  echo $name;
					   $sql="SELECT * FROM note where name='$name'";
		$result=mysqli_query($db,$sql);
		//if(mysqli_num_rows($result)==1)
		 
			while($row = mysqli_fetch_assoc($result)) 
				{
			//	 $id=$row["id"];
				 $name=$row["name"]; 
				//$username=$row["username"];
				$facultate=$row["facultate"];
			$specializare=$row["specializare"];
			
			$disciplina=$row["disciplina"]; 
			
			$nota=$row["nota"];
			echo $name."<br>";
			echo $facultate."<br>";
			echo $specializare."<br>";
			echo $disciplina." ";
			echo $nota."<br>";
		
				}
				
			} 
			
				
			else 	$_SESSION['message']= "Studentul nu exista in db";
					
					
			} 
			
			
			//echo "Student: ",$name."<br>";
		//	echo "Specializare: ",$specializare;
			  
			
			


?>
<br> <br>
<button class="button"> <a href="logout.php">Log Out</a> </button>
</body>
</html>
