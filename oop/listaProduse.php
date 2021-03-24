<?php
include 'headerAdmin.php';

$sql = "SELECT * FROM product";
$result = $execute -> query($sql);
$text = "<div class='container' >
<div class='parent'>
";

while ($row = $result -> fetch_assoc()) {
	
	$text = $text ."
	<div class='child'>
		<div class='owl-item active'>
<div class='material-container' data-reactid='.4.$0.1.$1'>
<div class='material-item' data-reactid='.4.$0.1.$1.0'>
<a href='#'>
<div class='cover'><img id='cover' src='productImage/" . $row['image'] . "' height='150px' width='300px'>";
	$text = $text ."</div>
</a></div>
<div class='material-description'>
<span class='material-title'>";
	$text = $text . $row['nameProduct'] . "</span> <div class='material-price'><a href='#'>";
	$text = $text . $row['priceProduct'] . "</div><div class='material-type'><a href='#'>";
	$text = $text . $row['typeProduct'] . "</div><div class='material-quantity'><a href='#'>";
	$text = $text . $row['quantityProduct'] . "</div><div class='material-description'><a href='#'>";
	$text = $text . $row['descriptionProduct'] . "</div>";
	$text = $text . " " . "<div class = 'material-options'><a href='deleteProduct.php?comanda=delete&idProduct=" . $row['idProduct'] . "'>Sterge</a>\n";
	$text = $text . " " . "<a href='editProduct.php?comanda=edit&idProduct=" . $row['idProduct'] . "'>Editeaza</a></div>\n";

$text = $text . "</div>
</div>
<br>
";} $text .= "</div></div>";
echo $text;
?>
<button class="btn" type="submit" onClick="location.href='adaugareProdus.php'">
	Adauga produs
</button>