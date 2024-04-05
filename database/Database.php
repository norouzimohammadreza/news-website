<?php

namespace database;

use PDO;
use PDOException;

class DataBase
{

    public $connection;
    private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    private $dbHost = HOST;
    private $dbUserName = USER_NAME;
    private $dbName = DB_NAME;
    private $dbPassword = PASSWORD;

    function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUserName, $this->dbPassword, $this->options);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }


    // select('select * from users');
    // select('select * from users where id = ?', [2]);
    public function select($query, $values = null)
    {
        try {
            $stmt = $this->connection->prepare($query);
            if ($values == null) {
                $stmt->execute();
            } else {
                $stmt->execute($values);
            }
            $result = $stmt;
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function insert($table , $fields , $values){
        $query = "INSERT INTO " . $table . "(" . implode(', ', $fields) . " ) 
        VALUES ( :" . implode(', :', $fields) . " );";
        $stmt = $this->connection->prepare($query);
        for ($i=0; $i < sizeof($fields) ; $i++) { 
            $stmt->bindParam(':'.$fields[$i],$values[$i]);
        }
        $stmt->execute();
       
    }
    public function update($table, $id, $fields, $values)
    {

        $query = "UPDATE " . $table . " SET";
        foreach(array_combine($fields, $values) as $field => $value)
        {
            if($value)
            {
                $query .= " `" . $field . "` = ? ,";
            }
            else{
                $query .= " `" . $field . "` = NULL ,";

            }
        }

        $query .= " updated_time = now()";
        $query .= " WHERE id = ?";
        try{
            $stmt = $this->connection->prepare($query);
            $stmt->execute(array_merge(array_filter(array_values($values)), [$id]));
            return true;
        }

        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }


    }
    function delete($table, $index)
    {
        $query = "DELETE FROM " . $table . " WHERE id = ?;";
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute([$index]);
            return true;
        } catch (PDOException $th) {
            $th->getMessage();
            return false;
        }
    }
}



