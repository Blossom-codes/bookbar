<?php

class Register
{
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
    public function setUser($first_name, $last_name, $gender)
    {
        $sql = "INSERT INTO users (first_name,last_name,gender) VALUES (?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        if ($stmt->execute([$first_name, $last_name, $gender])) {
            return true;
        } else {
            return false;
        }
    }
    public function setReader($email, $password)
    {
        $date = date("Y-m-d");
        $sql = "INSERT INTO readers (email,password,date) VALUES (?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        if ($stmt->execute([$email, $password, $date])) {
            return true;
        } else {
            return false;
        }
    }
    public function checkReader($email)
    {
        $sql = "SELECT * FROM readers WHERE email = '$email'";
        $stmt = $this->connect()->query($sql);
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function checkUser($first_name, $last_name, $gender)
    {
        $sql = "SELECT * FROM users WHERE first_name = '$first_name' AND last_name = '$last_name' AND gender = '$gender' ";
        $stmt = $this->connect()->query($sql);
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
