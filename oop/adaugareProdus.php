<?php
include 'headerAdmin.php';

if (!empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['type']) && !empty($_POST['quantity']) && !empty($_POST['description']) && !empty($_FILES)) {
	$produs = new product;
	$produs -> setNameProduct($_POST['name']);
	$produs -> setPriceProduct($_POST['price']);
	$produs -> setTypeProduct($_POST['type']);
	$produs -> setQuantityProduct($_POST['quantity']);
	$produs -> setDescriptionProduct($_POST['description']);
	$produs -> setImage($_FILES['file']['name']);
	$target_dir = "productImage/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);

	// Select file type
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	$extensions_arr = array("jpg", "jpeg", "png", "gif");
	if (in_array($imageFileType, $extensions_arr)) {
	
		move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $produs -> getImage());
	
		$informatiiProdus = array($produs -> getNameProduct(), $produs -> getPriceProduct(), $produs -> getTypeProduct(), $produs -> getQuantityProduct(), $produs -> getDescriptionProduct(),  $produs -> getImage());

		$check = "SELECT * FROM product WHERE nameProduct='$informatiiProdus[0]' AND typeProduct='$informatiiProdus[2]'";
		$result = $execute -> query($check);
		if ($result -> num_rows > 0)
			echo "Produsul deja exista!";
		else {

			$sql = "INSERT INTO product(nameProduct, priceProduct, typeProduct, quantityProduct, descriptionProduct, image) 
					VALUES('$informatiiProdus[0]', '$informatiiProdus[1]', '$informatiiProdus[2]', '$informatiiProdus[3]', '$informatiiProdus[4]', '$informatiiProdus[5]')";
			if ($execute -> query($sql))
				echo "Produs adaugat!";
			else
				echo "Eroare!";
		}
	}
}
?>

<form method="post" action="" enctype='multipart/form-data'>
	<table>
		<tr>
			<td>Nume : </td>
			<td>
			<input type="text" name="name" class="textInput">
			</td>
		</tr>
		<tr>
			<td>Pret : </td>
			<td>
			<input type="text" name="price" class="textInput">
			</td>
		</tr>
		<tr>
			<td>Tip : </td>
			<td>
			<input type="text" name="type" class="textInput">
			</td>
		</tr>
		<tr>
			<td>Cantitate : </td>
			<td>
			<input type="text" name="quantity" class="textInput">
			</td>
		</tr>
		<tr>
			<td>Descriere : </td>
			<td>
			<input type="text" name="description" class="textInput">
			</td>
		</tr>
		<tr>
			<td>Incarcare imagine : </td>
			<td>
			<input type="file" name="file">
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
			<input type="submit" name="add_btn" class="Log In" value="Adauga">
			</td>

		</tr>

	</table>
</form>