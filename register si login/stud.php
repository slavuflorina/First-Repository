<?php
 include "header.php";   
 include "connect.php";
?>
<html>
<body>

<h1>Catalog</h1>


<?php
		$nume=$_GET["nume"];
		$facultate=$_GET["facultate"];
		$specializare=$_GET["specializare"];
		$password=$_GET["password"];
			  if($nume=='admin' && $password=='a1234'&& $facultate=='' && $specializare=='' )
				  {  
				header("location:index.php");
					
			  }
			  
		  else 
		  {
			  $sql = "SELECT * FROM note WHERE nume='$nume' AND facultate='$facultate' AND specializare='$specializare'"; 
            $result = mysql_query($sql, $id_conexiune);
            while($row =  mysql_fetch_array($result)) { 
				 $disciplina = $row['disciplina'];
					     $nota = $row['nota'];
			echo "Disciplina ".$disciplina." "." Nota ".$nota."<br>";
		  }  }
		
	?>


<?php
 include "footer.php";
?>

</html>
</body>
