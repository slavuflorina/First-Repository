<?php
session_start();
//require_once 'vendor/swiftmailer/swiftmailer/lib/swift_required.php';
require_once ('classAutoloader.php');

if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['password']) && !empty($_POST['email'])) {
	$user = new customer;
	$user -> setName($_POST['name']);
	$user -> setSurname($_POST['surname']);
	$user -> setPassword(md5($_POST['password']));
	$user -> setEmail($_POST['email']);
	$user -> setRole = "1";

	$connection = new database;
	$execute = $connection -> connect();
	//var_dump( $connected);
	$client = array($user -> getName(), $user -> getSurname(), $user -> getPassword(), $user -> getEmail());

	$sql = "INSERT INTO customer(name, surname, password, email, role) VALUES('$client[0]', '$client[1]','$client[2]', '$client[3]','1')";
	//print_r($sql);
	if ($execute -> query($sql))
		echo "Ati fost inregistrat cu succes!";
	else
		echo "Eroare!";
}
?>

<form method="post" action="">
	<table>
		<tr>
			<td>Nume : </td>
			<td>
			<input type="text" name="name" class="textInput">
			</td>
		</tr>
		<tr>
			<td>Prenume : </td>
			<td>
			<input type="text" name="surname" class="textInput">
			</td>
		</tr>
		<tr>
			<td>Email : </td>
			<td>
			<input type="email" name="email" class="textInput">
			</td>
		</tr>
		<tr>
			<td>Password : </td>
			<td>
			<input type="password" name="password" class="textInput">
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
			<input type="submit" name="signup_btn" class="Log In" value="Sign Up">
			</td>

		</tr>

	</table>
</form>