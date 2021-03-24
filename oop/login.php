<?php
require_once ('classAutoloader.php');

if (!empty($_POST['password']) && !empty($_POST['email'])) {
	$user = new customer;
	$user -> setPassword(md5($_POST['password']));
	$user -> setEmail($_POST['email']);

	$connection = new database;
	$execute = $connection -> connect();

	$client = array($user -> getEmail(), $user -> getPassword());

	$sql = "SELECT * FROM customer WHERE email='$client[0]' AND password='$client[1]'";
	$result = $execute -> query($sql);
	if ($row = $result -> fetch_assoc()) {
		$client = $row;
		$_SESSION = $client;
		if ($row['idCustomer'] == 6)
			header("Location: indexAdmin.php");
		else
			header("Location: index.php?id=" . $client['idCustomer']);
	} else
		echo "Utilizatorul nu exista!";
}
?>

<form method="post" action="">
	<table>
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
			<td>
			<input type="submit" name="login_btn" class="Log In" value="Login">
			</td>
		</tr>
	</table>
</form>