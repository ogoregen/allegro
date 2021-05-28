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

namespace Allegro\Core;

require_once __DIR__."/../config/credentials.php";

class Database{

    private $connection;
    private static $instance;

    private function __construct(){

        $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    /**
     * Return the single instance, create if does not exist.
     * 
     * @return Database
     */
    static function getInstance(){

        if(!isset($instance)) $instance = new self();
        return $instance;
    }
    
    /**
     * Perform database query.
     * 
     * @param string $query MySQL query
     * 
     * @return mysqli_result|bool
     */
    function query($query){

        return $this->connection->query($query);
    }

    /**
     * Perform database query and fetch all results.
     * 
     * @param string $query MySQL query
     * @param int $resultType mysqli result mode constant
     * 
     * @return mysqli_result|bool
     */
    function fetch($query, $resultType = MYSQLI_NUM){

        $result = $this->query($query);
        return $result->fetch_all($resultType);
    }
}
