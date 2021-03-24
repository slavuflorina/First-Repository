<?php
require_once('library/php-excel-reader/excel_reader2.php');
require_once('library/SpreadsheetReader.php');
error_reporting(E_ERROR | E_PARSE);

if (!empty($_FILES)){
	$path = $_FILES['file']['name'];
	$ext = pathinfo($path, PATHINFO_EXTENSION);
	
	if($ext=="xls"|| $ext=="xlsx"){

		$targetPath = 'uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
		//echo $sheetCount;
		
		for($i=0;$i<=$sheetCount;$i++)
		$Reader->ChangeSheet($i);
	
			foreach ($Reader as $headKey=>$headRow){
				$headerArr = $headRow;
				break;
			} 
	
			 foreach ($Reader as $Row){
				 $expArr[] = $Row;
				 $index = count($arrExpData);
				 foreach($Row as $key => $val) {					 
					 $arrExpData[$index][$headerArr[$key]] = $val;
				 }
			 }
				//print_r($arrExpData);
				for($i=1;$i<=$index;$i++)
				{
					$URL_long=$arrExpData[$i]['URL_long'];
					
					if($URL_long!="")					
					{
						$sql="SELECT * FROM urls WHERE URL_long='$URL_long'";
						$result=mysqli_query($id_conexiune,$sql);
							if(!$row = mysqli_fetch_assoc($result)){
								$URL_short=substr(md5(uniqid(rand(), true)), 0, 10);
								$active="DA";
								$views=0;
								$sql = "INSERT INTO urls(URL_long,URL_short,active,URL_created,views) VALUES ('$URL_long','$URL_short','$active',NOW(),'$views')";
							$result=mysqli_query($id_conexiune,$sql); }
					} 
				}    $mesaj="Baza de date a fost actualizata";
  }
   else $mesaj="Extensie gresita. Se accepta doar .xls si .xlsx."; 
}
?>
			<form  role="form" action="" method ="post" enctype="multipart/form-data">
                    <div class="form-group">
                    <label for="upload">Alegeti fisier:</label>
                    <input type="file" class="form-control" id="file" name="file"/><br>
					<input type="submit" class="btn btn-primary btn-block" name="submit" value="Upload">
                              
					</div>
					<span class="mesaj"><?php echo $mesaj; ?></span>
			</form>
