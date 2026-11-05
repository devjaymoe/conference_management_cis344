<?php
# Connection Class
// Contain connection
class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "conference_database";

    public function connect()
    {
        // connect to database
        $conn = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );

        // check connection
        if ($conn->connect_error) {
            throw new Exception("Database Connection Failed");
        }

        $conn->set_charset("utf8mb4");

        return $conn;
    }
}
