<?php

include_once '/home/andreslaley/public_html/happy/controller/dbConnection/dbConnection.php';

class dao {

    public function queryFindObject($key, $value, $table) {
        $invalid_characters = array("$", "%", "#", "<", ">", "|", ";", "--", "-", "||", "&&", " ");
        $key = str_replace($invalid_characters, "", $key);
        $value = str_replace($invalid_characters, "", $value);
        $table = str_replace($invalid_characters, "", $table);
        $dataBase = new dbConnection();
        $cmd = $dataBase->connection()->prepare('SELECT * FROM ' . $table . ' WHERE ' . $key . ' = "' . $value . '" ');
        try {
            $cmd->execute(array($table, $key, $valuea));
            return $cmd->fetchAll();
        } catch (PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
    }

    public function queryLogin($nick, $password) {
        $invalid_characters = array("$", "%", "#", "<", ">", "|", ";", "--", "-", "||", "&&", " ");
        $nick = str_replace($invalid_characters, "", $nick);
        $password = str_replace($invalid_characters, "", $password);
        $dataBase = new dbConnection();
        $cmd = $dataBase->connection()->prepare('SELECT * FROM user WHERE nick = "' . $nick . '" and password = "' . $password . '"');
        try {
            $cmd->execute(array($nick, $password));
            return $cmd->fetchAll();
        } catch (PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
    }

    public function querySearch($query) {
        $invalid_characters = array("$", "%", "#", "<", ">", "|", ";", "--", "-", "||", "&&");
        $query = str_replace($invalid_characters, "", $query);
        $dataBase = new dbConnection();
        $cmd = $dataBase->connection()->prepare("SELECT * FROM user as u WHERE u.nick like '%" . $query . "%' or u.name like '%" . $query . "%' or u.second_name like '%" . $query . "%' or u.email like '%" . $query . "%'");
        try {
            $cmd->execute(array());
            return $cmd->fetchAll();
        } catch (PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
    }

    public function genericQuery($query) {
        $invalid_characters = array("$", "%", "#", "|", ";", "--", "||", "&&");
        $query = str_replace($invalid_characters, "", $query);
        $dataBase = new dbConnection();
        $cmd = $dataBase->connection()->prepare($query);
        try {
            $cmd->execute(array());
            return $cmd->fetchAll();
        } catch (PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
    }

    public function inster($object, $table) {
        $invalid_characters = array("$", "%", "#", "<", ">", "|", ";", "--", "-", "||", "&&");
        $dataBase = new dbConnection();
        $keys = array_keys($object);
        $keys = str_replace($invalid_characters, "", $keys);
        $fields = '' . implode(', ', $keys) . '';
        $placeholder = substr(str_repeat('?,', count($keys)), 0, -1);
        try {
            $dataBase->connection()->prepare("INSERT INTO " . $table . " ($fields) VALUES(" . $placeholder . ") ")->execute(array_values($object));
            return "Successful.";
        } catch (PDOException $e) {
            throw new Exception("Failed insert: " . $e->getMessage());
        }
    }

    public function edit($table, $key, $value, $qKey, $qValue) {
        $dataBase = new dbConnection();
        $dataBase->connection()->prepare("UPDATE ".$table." SET ".$key."='".$value."' WHERE ".$qKey."='".$qValue."' ")->execute();
    }

}

?>