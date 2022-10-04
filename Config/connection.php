<?php

class Database
{
    private $host = "localhost"; // Host Name
    private $username = "root"; // User Name
    private $password = ""; // Password
    private $db_name = "blog"; // Database Name

    function connect_db()
    {
        $conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($conn->connect_error) {
            die("Connection Error: " . $conn->connect_error);
        }
        return $conn;
    }
}
