<?php
    require_once "config.php";
    //Stabiliesc conexiunea cu serverul MySQL
    $id_conexiune = mysql_connect(DB_HOST, DB_USER, DB_PASS);
    
    if (!$id_conexiune)  {
        die('Eroare conectare la MySQL: ' . mysql_error());
    }
	     
    //print ("Conectare reusita");
    
    mysql_select_db(DB_NAME, $id_conexiune) or die("Eorare la selectarea bazei de date " . mysql_error());
    
    //mysql_close($id_conexiune);

?>