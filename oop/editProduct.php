<?php
include 'headerAdmin.php';
$idProduct = $_GET['idProduct'];

$sql = "SELECT * FROM product WHERE idProduct='$idProduct'";
$result = $execute -> query($sql);
while ($row = $result -> fetch_assoc()) {
	$produs = new product;
	$produs -> setNameProduct($row['nameProduct']);
	$produs -> setPriceProduct($row['priceProduct']);
	$produs -> setTypeProduct($row['typeProduct']);
	$produs -> setQuantityProduct($row['quantityProduct']);
	$produs -> setDescriptionProduct($row['descriptionProduct']);
	$produs -> setImage($row['image']);
	$informatiiProdus = array($produs -> getNameProduct(), $produs -> getPriceProduct(), $produs -> getTypeProduct(), $produs -> getQuantityProduct(), $produs -> getDescriptionProduct(), $produs -> getImage());
}

if (!empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['type']) && !empty($_POST['quantity']) && !empty($_POST['description']) && !empty($_FILES)) {
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
		$informatiiProdus = array($produs -> getNameProduct(), $produs -> getPriceProduct(), $produs -> getTypeProduct(), $produs -> getQuantityProduct(), $produs -> getDescriptionProduct(), $produs -> getImage());

		$sql = "UPDATE product
                        SET  nameProduct='" . $informatiiProdus[0] . "', priceProduct='" . $informatiiProdus[1] . "',
                                     typeProduct='" . $informatiiProdus[2] . "',
                                     quantityProduct='" . $informatiiProdus[3] . "', descriptionProduct='" . $informatiiProdus[4] . "', image='" . $informatiiProdus[5] . "'
             			WHERE idProduct= '$idProduct'";

		if ($execute -> query($sql))
			echo "Informatii modificate!";
		else
			echo "Eroare!";
	}
}
?>

<form method="post" action="" enctype="multipart/form-data">
	<table>
		<tr>
			<td>Nume : </td>
			<td>
			<input type="text" name="name" class="textInput" value="<?php echo $produs -> getNameProduct(); ?>">
			</td>
		</tr>
		<tr>
			<td>Pret : </td>
			<td>
			<input type="text" name="price" class="textInput" value="<?php echo $produs -> getPriceProduct(); ?>">
			</td>
		</tr>
		<tr>
			<td>Tip : </td>
			<td>
			<input type="text" name="type" class="textInput" value="<?php echo $produs -> getTypeProduct(); ?>">
			</td>
		</tr>
		<tr>
			<td>Cantitate : </td>
			<td>
			<input type="text" name="quantity" class="textInput" value="<?php echo $produs -> getQuantityProduct(); ?>">
			</td>
		</tr>
		<tr>
			<td>Descriere : </td>
			<td>
			<input type="text" name="description" class="textInput" value="<?php echo $produs -> getDescriptionProduct(); ?>">
			</td>
		</tr>
		<tr>
			<td>Imagine : </td>
			<td>
			<input type="file" name="file" value="<?php echo $produs -> getImage(); ?>">
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
			<input type="submit" name="update_btn" class="Log In" value="Update">
			</td>

		</tr>

	</table>
</form>