<?php

class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "blog";

    public function __construct()
    {
        $conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($conn->connect_error) {
            die("Connection Error: " . $conn->connect_error);
        }
    }
}
