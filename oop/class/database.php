<?php
class database {

	protected $db_name = "oop";
	protected $db_user = "root";
	protected $db_pass = "";
	protected $db_host = "localhost";

	public function connect() {

		$this -> conn = new mysqli($this -> db_host, $this -> db_user, $this -> db_pass);

		if (!$this -> conn) {
			die('Eroare conectare la MySQL: ' . mysqli_error());
		}
		mysqli_select_db($this -> conn, $this->db_name) or die("Eroare la selectarea bazei de date " . mysqli_error());
		return $this -> conn;
	}
	

}


?>