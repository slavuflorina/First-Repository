<?php
require_once ('classAutoloader.php');
$connection = new database;
$execute = $connection -> connect();

$idCustomer = $_GET['idCustomer'];

$sql = "SELECT * FROM customer WHERE idCustomer='$idCustomer'";
$result = $execute -> query($sql);
while ($row = $result -> fetch_assoc()) {
	$user = new customer;
	$user -> setName($row['name']);
	$user -> setSurname($row['surname']);
	$user -> setEmail($row['email']);
	$user -> setRole($row['role']);
	$client = array($user -> getName(), $user -> getSurname(), $user -> getEmail(), $user -> getRole());
}

if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['role'])) {
	$user -> setName($_POST['name']);
	$user -> setSurname($_POST['surname']);
	$user -> setEmail($_POST['email']);
	$user -> setRole($_POST['role']);
	$client = array($user -> getName(), $user -> getSurname(), $user -> getEmail(), $user -> getRole());

	$sql = "UPDATE customer
                        SET  name='" . $client[0] . "', surname='" . $client[1] . "',
                                     email='" . $client[2] . "',
                                     role='" . $client[3] . "'
             			WHERE idCustomer= '$idCustomer'";

	if ($execute -> query($sql))
		echo "Informatii modificate!";
	else
		echo "Eroare!";
}
?>

<form method="post" action="">
	<table>
		<tr>
			<td>Nume : </td>
			<td>
			<input type="text" name="name" class="textInput" value="<?php echo $user -> getName(); ?>">
			</td>
		</tr>
		<tr>
			<td>Prenume : </td>
			<td>
			<input type="text" name="surname" class="textInput" value="<?php echo $user -> getSurname(); ?>">
			</td>
		</tr>
		<tr>
			<td>Email : </td>
			<td>
			<input type="email" name="email" class="textInput" value="<?php echo $user -> getEmail(); ?>">
			</td>
		</tr>
		<tr>
			<td>Rol : </td>
			<td>
			<input type="text" name="role" class="textInput" value="<?php echo $user -> getRole(); ?>">
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