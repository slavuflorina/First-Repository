<?php
$sql ="SELECT * FROM urls";
$result=mysqli_query($id_conexiune,$sql);
 $text = "<table class='table table-striped'>"."<tr>"."<th>Id.</th>"."<th>URL_lung</th>"."<th>URL_scurt</th>"."<th>Activ</th>"."<th>Vizualizari</th>"."</tr>";

while($row = mysqli_fetch_assoc($result)) 
				{
				 $URL_id=$row['URL_id']; 
				 $URL_long=$row['URL_long'];
				 $views=$row['views'];
				 $text = $text . " " . "<tr>\n";
            $text = $text . " " . "<td>" .$URL_id. "</td>\n";
            $text = $text . " " . "<td>" ."<a href='$URL_long' target='blank'>". $URL_long . "</a></td>\n";
			$text = $text . " " . "<td>" ."<a href='$URL_long' target='blank'>". "http://redirect.php/?url=".$row['URL_short'] . "</a></td>\n";
			$text = $text . " " . "<td>" . $row['active'] . "</td>\n";
            $text = $text . " " . "<td>"."<a href='views.php?URL_id=$URL_id' target='blank'>". $views. "</a></td>\n";
            $text = $text . " " . "</tr>\n";				
				}
				  $text = $text . " " . "</table>";
			echo $text;
?>

