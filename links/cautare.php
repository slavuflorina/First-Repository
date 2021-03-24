<?php
	if (empty($_POST['URL'])) {
			$validareURLcautare = 0;
	}
	
	if($validareURLcautare==1){
		$URL=mysqli_real_escape_string($id_conexiune,$_POST['URL']);
		$sql="SELECT * FROM urls WHERE URL_long LIKE '%$URL%'";
		$result=mysqli_query($id_conexiune,$sql);
	
	$text = "<table class='table table-striped'>"."<tr>"."<th>Id.</th>"."<th>URL_lung</th>"."<th>URL_scurt</th>"."<th>Activ</th>"."<th>Vizualizari</th>"."</tr>";
	if(mysqli_num_rows($result)!=0){
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
				
				 }
			else{
			$text="URL-ul nu a fost gasit in baza de date";}
}
?>
<form role="form" method="post" action="">
                    <div class="form-group">
                        <label for="exampleInputName">Introduceti link:</label>
                        <input type="name" name="URL" class="form-control" id="exampleInputURL" placeholder="Introduceti URL"> 
                    </div>
					
					<span class="mesaj"><?php echo $text;?></span><br>
					<button type="submit" name="login" class="btn btn-primary btn-block">Cauta</button>
</form>