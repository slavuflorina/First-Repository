<?php

class dbconnect
{
    private $servername;
    private $username;
    private $password;
    private $database;

    function __construct($servername, $username, $password, $database)
    {
        $this->servername = $servername;
        $this->username   = $username;
        $this->password   = $password;
        $this->database   = $database;
    }
    public function getConnection()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if (!empty($this->conn->error)) {
            die  (mysqli_connect_error());
            echo mysqli_connect_error();
            exit();
        } else {
            return $this->conn;
        }
    }
}
?>