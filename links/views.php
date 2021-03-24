<?php
require 'dbconfig.php';
include 'variabile.php';
include 'header.php';

$URL_id_fk=$_GET['URL_id'];

$sql ="SELECT * FROM stats WHERE URL_id_fk='$URL_id_fk'";
$result=mysqli_query($id_conexiune,$sql);

$text = "<table class='table table-striped'>"."<tr>"."<th>Id.</th>"."<th>Browser</th>"."<th>IP</th>"."<th>Data/Ora</th>"."</tr>";
while($row = mysqli_fetch_assoc($result)) 
				{
				 $text = $text . " " . "<tr>\n";
            $text = $text . " " . "<td>" . $row['stats_id'] . "</td>\n";
            $text = $text . " " . "<td>" . $row['browser'] . "</td>\n";
            $text = $text . " " . "<td>" . $row['IP'] . "</td>\n";
			$text = $text . " " . "<td>" . $row['date_and_time'] . "</td>\n";
            $text = $text . " " . "</tr>\n";				
				}
				  $text = $text . " " . "</table>";
	 echo $text;
?>
