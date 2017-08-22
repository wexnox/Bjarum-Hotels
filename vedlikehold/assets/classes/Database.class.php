<?php

/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 06.01.2017
 * Time: 17.21
 */

class Database
{
    private $host = "localhost";
    private $db_name = "bjarumairline";
    private $username = "root";
    private $password = "secret";
    public $conn;

    public function dbConnection()
    {

        $this->conn = null;
        try
        {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception)
        {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}