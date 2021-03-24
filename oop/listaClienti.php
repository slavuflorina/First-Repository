<?php
include 'headerAdmin.php';

$sql = "SELECT * FROM customer";
$result = $execute -> query($sql);
$text = "
	<table>
	" . "
	<tr>
	" . "<th>Id.</th>" . "<th>Nume</th>" . "<th>Prenume</th>" . "<th>Email</th>" . "<th>Password</th>" . "<th>Rol</th>" . "
	</tr>";

while ($row = $result -> fetch_assoc()) {
	$text = $text . " " . "
	<tr>
	\n";
	$text = $text . " " . "<td>" . $row['idCustomer'] . "</td>\n";
	$text = $text . " " . "<td>" . $row['name'] . "</td>\n";
	$text = $text . " " . "<td>" . $row['surname'] . "</td>\n";
	$text = $text . " " . "<td>" . $row['email'] . "</td>\n";
	$text = $text . " " . "<td>" . $row['password'] . "</td>\n";
	$text = $text . " " . "<td>" . $row['role'] . "</td>\n";
	$text = $text . " " . "<td><a href='deleteCustomer.php?comanda=delete&idCustomer=" . $row['idCustomer'] . "'>Sterge</a></td>\n";
	$text = $text . " " . "<td><a href='editCustomer.php?comanda=edit&idCustomer=" . $row['idCustomer'] . "'>Editeaza</a></td>\n";
}
$text = $text . " " . "
</table>
";
echo $text;
?>
