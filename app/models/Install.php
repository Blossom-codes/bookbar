<?php

class Install
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
   
}
// $install = new Install;
// $install->connect();
