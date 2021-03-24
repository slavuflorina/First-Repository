<?php
class customer {
	private $idCustomer;
	private $name;
	private $surname;
	private $email;
	private $password;
	private $role;

	
	public function setIdCustomer($idCustomer) {
		$this -> idCustomer = $idCustomer;
	}

	public function getIdCustomer() {
		return $this -> idCustomer;
	}

	public function setName($name) {
		$this -> name = $name;
	}

	public function getName() {
		return $this -> name;
	}

	public function setSurname($surname) {
		$this -> surname = $surname;
	}

	public function getSurname() {
		return $this -> surname;
	}

	public function setEmail($email) {
		$this -> email = $email;
	}

	public function getEmail() {
		return $this -> email;
	}

	public function setPassword($password) {
		$this -> password = $password;
	}

	public function getPassword() {
		return $this -> password;
	}

	public function setRole($role) {
		$this -> role = $role;
	}

	public function getRole() {
		return $this -> role;
	}

}
?>