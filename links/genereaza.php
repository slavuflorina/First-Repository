<?php

if (empty($_POST['URL'])) {
			$validareURL = 0;
	}
if($validareURL==1)
{
	$URL=mysqli_real_escape_string($id_conexiune,$_POST['URL']);
	$sql1="SELECT * FROM urls WHERE URL_long='$URL'";
    $result1=mysqli_query($id_conexiune,$sql1);
	
	if($row = mysqli_fetch_assoc($result1)){
		 $mesaj="URL-ul exista deja in baza de date cu URL_scurt: "."http://redirect.php/?url=".$row['URL_short'];
	}
	else{
	$URL_short=substr(md5(uniqid(rand(), true)), 0, 10);
	$active="DA";
	$views=0;
	$sql = "INSERT INTO urls(URL_long,URL_short,active,URL_created,views) VALUES ('$URL','$URL_short','$active',NOW(),'$views')";

	$result=mysqli_query($id_conexiune,$sql);
    if($result) {
			$mesaj= "URL-ul a fost adaugat. URL_scurt: "."http://redirect.php/?url=".$URL_short;
	}
	else{
	 $mesaj= "URL-ul nu a fost adaugat. Eroare";
		} 
	}   
}
?>

<form role="form" method="post" action="">
                    <div class="form-group">
                        <label for="exampleInputName">Introduceti link:</label>
                        <input type="name" name="URL" class="form-control" id="exampleInputURL" placeholder="Introduceti URL"> 
                    </div>
					
					<span class="mesaj"><?php echo $mesaj;?></span><br>
					<button type="submit" name="login" class="btn btn-primary btn-block">Genereaza</button>
</form>