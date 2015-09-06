<?php

class dbConnection {

    private $servername = "localhost";
    private $username = "andreslaleydb";
    private $password = "12jasmin12";

    public function connection() {
        try {
            $con = new PDO("mysql:host=" . $this->servername . ";dbname=happy_db", $this->username, $this->password);
            // set the PDO error mode to exception
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function queryInsertUser($nick, $email, $password) {
        $cmd = $this->connection()->prepare('INSERT INTO user (nick, email, password) VALUES(?,?,?)');
        try {
            $cmd->execute(array($nick, $email, $password));
        } catch (PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
    }

    public function querySelect() {
        //PDO
        $cmd = $this->connection()->prepare('INSERT INTO user (nick, 
            , email, password) 
            VALUES(?,?,?)');
        $cmd->execute(array($nombre, $apellido, $edad, $email));
    }

}

?>
