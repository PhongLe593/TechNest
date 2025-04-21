<?php
class connection
{
    var $conn;
    function __construct()
    {
        $severname = "localhost";
        $username = "root";
        $password = "";
        $db_name = "tech_nest";

        $this->conn = new mysqli($severname, $username, $password, $db_name);
        $this->conn->set_charset("utf8");

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}