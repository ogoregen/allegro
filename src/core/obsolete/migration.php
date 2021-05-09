
<?php

require "../database.php";

function createTable($model){
    /*
    creates database table for a model using initial class properties
    usage example with User:

    createTable(new User([
        "id" => "INT NOT NULL AUTO_INCREMENT",
        "email" => "TINYTEXT NOT NULL",
        "password" => "TINYTEXT NOT NULL",
        "firstName" => "TINYTEXT NOT NULL",
        "lastName" => "TINYTEXT NOT NULL",
    ]));
    */    
    ], true));
    $statement = "CREATE TABLE 'allegro'.'".get_class($model)."' (";
    $fields = (array)($model);
    while($field = current($fields)){

        $statement .= key($fields)." ".$field;
        if(next($fields)) $statement .= ", ";
        else $statement .= " ";
    }
    $statement .= ");";
    echo $statement;
    global $connection;
    echo $connection->query($statement);
}
