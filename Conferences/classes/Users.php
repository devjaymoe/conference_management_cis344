<?php

class Users
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getUser($users)
    {
        $username = $users['username'];
        $password = $users['password'];
        // make sql query
        $sql = "SELECT name, password
                FROM users
                WHERE name = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        // make query and get results
        $result = $this->$stmt->bind_result($username, $password);
        $user = $result->fetch_assoc();

        if ($user) {
            if (password_verify($password, $user['Password'])) {
                echo "login successful";
                return $user;
            } else {
                echo "invalid password";
                return false;
            }
        } else {
            echo "user not found";
            return false;
        }
    }
}
