<?php
 include "header.php";   
 include "connect.php";
?>

<h1>Catalog</h1>
<br> <br>
<form action="index.php" method="get">
    <input name="comanda" type="hidden" value="search" />
  
   Facultate: <input type="text" name="facultate"/>
  Specializare: <input type="text" name="specializare" />

    <input type="submit" value="Cauta"/>
</form>
<br> <br>
<?php
$comanda = $_REQUEST["comanda"];
 if (isset($comanda)) {
    switch ($comanda){
        case 'add':
            $nume = $_REQUEST["nume"];
			$cnp = $_REQUEST["cnp"];
			 $facultate = $_REQUEST["facultate"];
			  $specializare = $_REQUEST["specializare"];
			   $disciplina = $_REQUEST["disciplina"];
			    $nota = $_REQUEST["nota"];
           if($nume=='' || $cnp==''|| $facultate=='' || $specializare=='' || $disciplina==''|| $nota=='')
				  echo "<font color='red'>Toate campurile trebuie completate</font><br/>";
			  else
			  {$sql="INSERT INTO note(nume,cnp,facultate,specializare,disciplina,nota) VALUES ('$nume','$cnp','$facultate','$specializare','$disciplina','$nota')";
            if (!mysql_query($sql, $id_conexiune)) {
              die('Error: ' . mysql_error());
            }
            echo "<font color='red'>Intrare adaugata cu succes</font><br/>";}
			  break;  
        case 'delete':
            $id = $_REQUEST["id"];
            $sql = "DELETE FROM note WHERE id='$id'"; 
            if (!mysql_query($sql, $id_conexiune)) {
              die('Error: ' . mysql_error());
            }
            echo "<font color='red'>Intrarea cu id-ul $id a fost stearsa cu succes</font><br/>";
            
            break; 
        
        case 'edit':
            $id = $_REQUEST["id"];
            $sql = "SELECT * FROM note WHERE id='$id'"; 
            $result = mysql_query($sql, $id_conexiune);
            if ($row = mysql_fetch_array($result)) {
                $nume = $row['nume'];
				$cnp = $row['cnp'];
                $specializare = $row['specializare'];
				   $facultate = $row['facultate'];
				      $disciplina = $row['disciplina'];
					     $nota = $row['nota'];
            ?>
                <!-- Forma de editare -->
                <h3>Editare</h3>
                <form action="index.php" method="get">
                    <input name="comanda" type="hidden" value="update" />
                    <input name="id" type="hidden" value="<?php echo $id;?>" />
                    
                    Nume: <input type="text" name="nume" value="<?php echo $nume;?>"/><br><br>
					CNP: <input type="text" name="cnp" value="<?php echo $cnp;?>"/><br><br>
                   Facultate: <input type="text" name="facultate" value="<?php echo $facultate;?>"/><br><br>
				   Specializare: <input type="text" name="specializare" value="<?php echo $specializare;?>"/><br><br>
				   Disciplina: <input type="text" name="disciplina" value="<?php echo $disciplina;?>"/><br><br>
				   Nota: <input type="numeric" name="nota" value="<?php echo $nota;?>"/><br><br>
                    <input type="submit" value="Update"/>
                </form>
            <?php                   
            } else {
                echo "<font color='red'>Intrarea cu id-ul $id nu exista!</font><br/>";
            }
            break; 
                      
        case 'update':
            $id = $_REQUEST["id"];
			$nume = $_REQUEST["nume"];
			$cnp = $_REQUEST["cnp"];
            $facultate = $_REQUEST["facultate"];
			  $specializare = $_REQUEST["specializare"];
			   $disciplina = $_REQUEST["disciplina"];
			    $nota = $_REQUEST["nota"];
			 if($nume=='' || $cnp==''|| $facultate=='' || $specializare=='' || $disciplina==''|| $nota=='')
				  echo "<font color='red'>Toate campurile trebuie completate</font><br/>";
			  else {
            $sql = "UPDATE note SET nume='$nume',cnp='$cnp', facultate='$facultate', specializare='$specializare', disciplina='$disciplina', nota='$nota' WHERE id='$id'"; 
            if (!mysql_query($sql, $id_conexiune)) {
               die('Error: ' . mysql_error($id_conexiune));  
            } else {
               echo "<font color='red'>Intrarea cu id-ul $id a fost actualizata cu succes!</font><br/>";
			  }  }
       case 'search':
	
		
		$facultate=$_GET["facultate"];
		$specializare=$_GET["specializare"];
		if( $facultate=='' || $specializare=='' )
			echo"<font color='red'>Toate campurile trebuie completate</font><br/>";
		else{
			 $sql1 = "SELECT * FROM studenti WHERE  facultate='$facultate' AND specializare='$specializare'"; 
				   $result1 = mysql_query($sql1, $id_conexiune);
            if ( !mysql_fetch_array($result1)) 
			echo "<font color='red'>Datele introduse sunt invalide!</font><br/>";
			 else
			 {
		$sql="SELECT * FROM note where facultate='$facultate' and specializare='$specializare'";
		$result = mysql_query($sql, $id_conexiune);
		 
		 print("<table border='1'>\n");
      print("<tr><th>id</th><th width='300'>Nume</th><th width='300'>CNP</th><th width='100'>Facultate</th><th>Specializare</th><th>Disciplina</th><th>Nota</th></tr>\n");
      while($row = mysql_fetch_array($result)){
          print("<tr>\n");
          print("<td>" . $row['id']. "</td>\n");
          print("<td>" . $row['nume']. "</td>\n");
		  print("<td>" . $row['cnp']. "</td>\n");
          print("<td>" . $row['facultate']. "</td>\n");
		   print("<td>" . $row['specializare']. "</td>\n");
		    print("<td>" . $row['disciplina']. "</td>\n");
			 print("<td>" . $row['nota']. "</td>\n");
          print("<td><a href='index.php?comanda=delete&id=" . $row['id']. "'>Delete</a></td>\n");
          print("<td><a href='index.php?comanda=edit&id=" . $row['id']. "'>Edit</a></td>\n");
          print("</tr>\n");
      }
      print("</table>");
		
			
				
		}
		
		}
		
		break;
		
		
            
    }
    
 }  
?>
<br> <br>
<?php
 
 $query = "SELECT * FROM note";
 $result = mysql_query($query, $id_conexiune);
 
 if(mysql_num_rows($result)) {
     print("<table border='1'>\n");
      print("<tr><th>id</th><th width='300'>Nume</th><th width='300'>CNP</th><th width='100'>Facultate</th><th>Specializare</th><th>Disciplina</th><th>Nota</th></tr>\n");
      while($row = mysql_fetch_array($result)){
          print("<tr>\n");
          print("<td>" . $row['id']. "</td>\n");
          print("<td>" . $row['nume']. "</td>\n");
		  print("<td>" . $row['cnp']. "</td>\n");
          print("<td>" . $row['facultate']. "</td>\n");
		   print("<td>" . $row['specializare']. "</td>\n");
		    print("<td>" . $row['disciplina']. "</td>\n");
			 print("<td>" . $row['nota']. "</td>\n");
          print("<td><a href='index.php?comanda=delete&id=" . $row['id']. "'>Delete</a></td>\n");
          print("<td><a href='index.php?comanda=edit&id=" . $row['id']. "'>Edit</a></td>\n");
          print("</tr>\n");
      }
      print("</table>");
  } else {
        print "Nu exista intrari in agenda!";
  }
 ?>
<br> <br>
<!-- Forma de adaugare -->
<form action="index.php" method="get">
    <input name="comanda" type="hidden" value="add" />
    Nume: <input type="text" name="nume" /> <br><br>
	CNP: <input type="text" name="cnp" /> <br> <br>
   Facultate: <input type="text" name="facultate"/><br><br>
  Specializare: <input type="text" name="specializare" /><br><br>
  Disciplina: <input type="text" name="disciplina"/><br><br>
  Nota: <input type="numeric" name="nota"/><br><br>
   <input type="submit" value="Adauga"/>   <br><br>
</form>
<br> <br> <br><br> 
<?php
 include "footer.php";
?>
