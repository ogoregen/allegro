<?php

require "config.php";

class Database{

    private $connection;
    private static $instance;

    private function __construct(){

        $this->connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    }

    static function getInstance(){

        if(!isset($instance)) $instance = new Database();
        return $instance;
    }
    
    function query($query){

        return $this->connection->query($query);
    }

    function fetch($query, $resultType = MYSQLI_NUM){

        $result = $this->query($query);
        return $result->fetch_all($resultType);
    }
}
