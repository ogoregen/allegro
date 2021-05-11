<?php

/**
 * Model Class
 * 
 * Interact with database tables.
 * 
 * The Model class is an abstract class that facilitates
 * database operations. Each child class represents a
 * database table, and their instances represent
 * database rows.
 */

require "Database.php";

abstract class Model{

    function __construct($fields = []){

        foreach($fields as $key => $value) $this->$key = $value;
    }

    function __set($name, $value){

        throw new Exception("Cannot add new property \$$name to instance of Model.");
    }

    function save(){

        $data = (array)$this;
        array_shift($data); //omitting id
        if(isset($this->id)){ //update if exists

            $query = "UPDATE ".get_class($this)." SET ";
            while($field = current($data)){

                if(isset($field)) $query .= key($data)." = '$field'";
                if(next($data)) $query .= ", ";
                else $query .= " ";
            }
            $query .= " WHERE id = $this->id;";
        }
        else{ //create if does not exist
        
            $query = "INSERT INTO ".get_class($this)." (".implode(", ", array_keys($data)).") VALUES ('".implode("', '", array_values($data))."');";
        }
        Database::getInstance()->query($query);
    }

    /**
     * Delete the record.
     */
    function delete(){

        $query = "DELETE FROM ".get_class($this)." WHERE id = $this->id;";
        Database::getInstance()->query($query);
    }

    /**
     * Delete records satisfying condition.
     */
    static function deleteWhere($condition){

        $query = "DELETE FROM ".get_called_class()." WHERE $condition;";
        Database::getInstance()->query($query);
    }

    /**
     * Fetch the record satisfying condition.
     */
    static function get($condition, $fields = "*"){

        $query = "SELECT $fields FROM ".get_called_class()." WHERE $condition;";
        $result = Database::getInstance()->fetch($query, MYSQLI_ASSOC);
        if($result){

            if(count($result) > 1) throw new Exception("Multiple results");
            else return new (get_called_class())($result[0]);
        }
        return null;
    }

    /**
     * Fetch all records satisfying condition.
     */
    static function filter($condition = "", $fields = "*"){

        if($condition) $condition = " WHERE ".$condition;
        $query = "SELECT $fields FROM ".get_called_class()."$condition;";
        $result = Database::getInstance()->fetch($query, MYSQLI_ASSOC);
        if($result) return array_map(fn($x) => new (get_called_class())($x), $result); 
        return [];
    }

    /**
     * Fetch all records.
     */
    static function all($fields = "*"){

        return self::filter(fields: $fields);
    }

    static function exists($condition){

        $query = "SELECT EXISTS(SELECT * FROM ".get_called_class()." WHERE $condition LIMIT 1);";
        $result = Database::getInstance()->fetch($query);
        return $result[0][0];
    }
}
