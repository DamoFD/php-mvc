<?php

class Database
{
    private string $servername = "db";
    private string $username = "root";
    private string $password = "example";
    private string $dbname = "php_mvc";
    public object $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}
