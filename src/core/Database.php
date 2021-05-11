<?php

/**
 * Database Class
 * 
 * Initiate and facilitate mysqli connection.
 * 
 * The Database class is a singleton that holds
 * a mysqli connection object and provides methods
 * for interacting with it.
 */

require "config.php";

class Database{

    private $connection;
    private static $instance;

    private function __construct(){

        $this->connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    }

    /**
     * Return the single instance creating it if it does not exist.
     */
    static function getInstance(){

        if(!isset($instance)) $instance = new self();
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
