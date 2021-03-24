 <?php
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "links";
 
  $id_conexiune = mysqli_connect($dbhost, $dbuser, $dbpass);
    
    if (!$id_conexiune)  {
        die('Eroare conectare la MySQL: ' . mysqli_error());
    } 
	 mysqli_select_db($id_conexiune,$db ) or die("Eroare la selectarea bazei de date " . mysqli_error());
 ?>