<?php

class User
{
    public $name;
    protected function connect()
    {
        try {
            $username = "root";
            $password = "";
            $db = new PDO("mysql:host=localhost;dbname=test", $username, $password);
            return $db;
        } catch (\Exception $e) {
            echo "Error connecting to database" . $e->getMessage() . "<br/>";
            die();
        }
    }
    public function getUsers()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->connect()->query($sql);
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
}
