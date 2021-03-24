<?php
require 'dbconfig.php';

$URL_short=$_GET['url'];
$sql ="SELECT * FROM links.urls where URL_short='$URL_short'";
$result=mysqli_query($id_conexiune,$sql);

if($row = mysqli_fetch_assoc($result)) 
{	
	$active=$row['active'];
	if($active=="DA"){
		$views=$row['views'];
		$URL=$row['URL_long'];
		$stats_id=$row['URL_id'];
		header('Location:'.$URL);
		$views=$views+1;
		
        $ip = $_SERVER['REMOTE_ADDR'];
	
		$browser=$_SERVER['HTTP_USER_AGENT'];
		$sql = "INSERT INTO stats(URL_id_fk,browser,IP,date_and_time) VALUES ('$stats_id','$browser','$ip',NOW())";
		$result=mysqli_query($id_conexiune,$sql);
		$sql1 = "UPDATE links.urls SET views='$views' where URL_id='$stats_id'";
		$result1=mysqli_query($id_conexiune,$sql1);
	}
	else echo "Link-ul nu este activ.";
}
?>