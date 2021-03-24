<?php
//session_start();
include 'header.php';

$sql = "SELECT * FROM product";
$result = $execute -> query($sql);
$text = "<table>" . "<tr>" . "<th>Id.</th>" . "<th>Nume</th>" . "<th>Pret</th>" . "<th>Tip</th>" . "<th>Cantitate</th>" . "<th>Descriere</th>" . "<th>Imagine</th>" . "</tr>";

while ($row = $result -> fetch_assoc()) {
	$text = $text . " " . "<tr>\n";
	$text = $text . " " . "<td>" . $row['idProduct'] . "</td>\n";
	$text = $text . " " . "<td>" . $row['nameProduct'] . "</td>\n";
	$text = $text . " " . "<td>" . $row['priceProduct'] . "</td>\n";
	$text = $text . " " . "<td>" . $row['typeProduct'] . "</td>\n";
	$text = $text . " " . "<td>" . $row['quantityProduct'] . "</td>\n";
	$text = $text . " " . "<td>" . $row['descriptionProduct'] . "</td>\n";
	$text = $text . " " . "<td><img src='productImage/" . $row['image'] . "' height='150px' width='300px'></td>\n";
	$text = $text . " " . "<td><a href='comanda.php?action=add&idProduct=" . $row['idProduct'] . "'>Adauga in cos</a></td>\n";
}
$text = $text . " " . "</table>";
echo $text;
?>

