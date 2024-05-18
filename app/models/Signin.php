<?php

class Signin
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
    protected function setUserActive($email, $status)
    {
        $sql = "UPDATE readers SET status = ? WHERE email = '$email'";
        $stmt = $this->connect()->prepare($sql);
        if ($stmt->execute([$status])) {
            $result = true;
        } else {
            $result = false;
        }
        return $result ?? "";
    }
    public function getReader($username, $pwd)
    {
        $sql = "SELECT * FROM readers WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            $user_email = $row['email'];
            $verify = password_verify($pwd, $row['password']);
            if ($verify) {
                $_SESSION['loggedIn'] = $row['reader_id'];
                if (isset($_SESSION['loggedIn'])) {
                    if ($this->setUserActive("$user_email", "Online")) {
                        $result = true;
                    }
                }
            } else {
                $result = false;
            }
        } else {
            $result = false;
        }
        return $result ?? "";
    }
    public function sign_out($user_id)
    {
        $sql = "SELECT * FROM readers WHERE reader_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id]);

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            $user_email = $row['email'];
            if (isset($_SESSION['loggedIn'])) {
                if ($this->setUserActive("$user_email", "Offline")) {
                    unset($_SESSION['loggedIn']);
                    $result = true;
                }
            } else {
                $result = false;
            }
        } else {
            $result = false;
        }
        return $result ?? "";
    }
}
