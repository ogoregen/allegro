<?php

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
        else $query = "INSERT INTO ".get_class($this)." (".implode(", ", array_keys($data)).") VALUES ('".implode("', '", array_values($data))."');"; //create if does not exist
        Database::getInstance()->query($query);
    }

    function delete(){
        //deletes the record
        $query = "DELETE FROM ".get_class($this)." WHERE id = $this->id;";
        Database::getInstance()->query($query);
    }

    static function deleteWhere($condition){
        //deletes all records satisfying condition
        $query = "DELETE FROM ".get_called_class()." WHERE $condition;";
        Database::getInstance()->query($query);
    }

    static function get($condition, $fields = "*"){
        //returns the object matching given condition
        $query = "SELECT $fields FROM ".get_called_class()." WHERE $condition;";
<<<<<<< Updated upstream
        $result = self::_fetch($query, MYSQLI_ASSOC);
=======
        $result = Database::getInstance()->fetch($query, MYSQLI_ASSOC);
>>>>>>> Stashed changes
        if($result){

            if(count($result) > 1) throw new Exception("Multiple results");
            else return new (get_called_class())($result[0]);
        }
        return null;
    }

    static function filter($condition = "", $fields = "*"){
        //returns an object array of all records of the model matching given condition
        if($condition) $condition = " WHERE ".$condition;
        $query = "SELECT $fields FROM ".get_called_class()."$condition;";
<<<<<<< Updated upstream
        $result = self::_fetch($query, MYSQLI_ASSOC);
=======
        $result = Database::getInstance()->fetch($query, MYSQLI_ASSOC);
>>>>>>> Stashed changes
        if($result) return array_map(fn($x) => new (get_called_class())($x), $result); 
        return [];
    }

    static function all($fields = "*"){
        //returns an object array of all records of the model
        return self::filter(fields: $fields);
    }

    static function exists($condition){

        $query = "SELECT EXISTS(SELECT * FROM ".get_called_class()." WHERE $condition LIMIT 1);";
<<<<<<< Updated upstream
        $result = self::_fetch($query);
        return $result[0][0];
    }

    private static function _fetch($query, $resultType = MYSQLI_NUM){

        global $connection;
        $result = $connection->query($query);
        return $result->fetch_all($resultType);
    } 
=======
        $result = Database::getInstance()->fetch($query);
        return $result[0][0];
    }
>>>>>>> Stashed changes
}
