<?php
 include "header.php";   
 include "connect.php";
?>
<html>
<body>

<h1>Catalog</h1>


<?php
		//$nume=$_GET["nume"];
		$cnp=$_GET["cnp"];
		$facultate=$_GET["facultate"];
		$specializare=$_GET["specializare"];
		$password=$_GET["password"];
		if($cnp=='admin' && $password=='a1234'&& $facultate=='' && $specializare=='' )
				  {  
				header("location:index.php");
					
			  }
			  else
		
		 if($cnp=='' || $password==''|| $facultate=='' || $specializare=='')
				  echo "Utilizatorul nu exista";
			  
			  
			  else if(($cnp=='admin' && $password=='a1234') && ($facultate=='' || $specializare=='' ) )
				   echo "Utilizatorul nu exista";
			    else if(($cnp=='admin' && $password!='a1234') )
				   echo "Utilizatorul nu exista";
			   else if(($cnp=='admin' && $password=='a1234') && ($facultate!='' || $specializare!='') )
				   echo "Utilizatorul nu exista";
			
		
		
			 
			  
		  else 
			 
				  
		  {
			  $sql = "SELECT * FROM note WHERE cnp='$cnp'  AND facultate='$facultate' AND specializare='$specializare'"; 
            $result = mysql_query($sql, $id_conexiune);
			
			{
            while($row =  mysql_fetch_array($result)) { 
			
				 $disciplina = $row['disciplina'];
					     $nota = $row['nota'];
			echo "Disciplina ".$disciplina." "." Nota ".$nota."<br>";
		  }  } 
		  
		//  else echo "Utilizatorul nu exista";
		  }
		
	?>


<?php
 include "footer.php";
?>

</html>
</body>
