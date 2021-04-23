
<?php

require "database.php";

class Model{

    function __construct($fields = [], $migration = false){
        
        if(!$migration){

            foreach($this as $key => $value) $this->$key = null; //clear property values
            foreach($fields as $key => $value) $this->$key = $value; //
        }
    }

    function save(){

        $data = (array)$this;
        array_shift($data); //omitting id
        if(!is_null($this->id)){ //update if exists

            $query = "UPDATE ".get_class($this)." SET  ";
            while($field = current($data)){

                $query .= key($data)." = '$field'";
                if(next($data)) $query .= ", ";
                else $query .= " ";
            }
            $query .= " WHERE id = $this->id;";
        }
        else $query = "INSERT INTO ".get_class($this)." (".implode(", ", array_keys($data)).") VALUES ('".implode("', '", array_values($data))."');"; //create if does not exist
        global $connection;
        $connection->query($query);
    }

    static function get($condition, $fields = "*"){

        global $connection;
        $query = "SELECT $fields FROM ".get_called_class()." WHERE $condition;";
        $result = $connection->query($query);
        $result = $result->fetch_assoc();
        return new (get_called_class())($result);
    }

    function __set($name, $value){

        throw new Exception("Cannot add new property \$$name to instance of Model.");
    }
}
