
<?php

function createTable($model){

    $statement = "CREATE TABLE 'allegro'.'".get_class($model)."' (";
    $fields = (array)($model);
    while($field = current($fields)){

        $statement .= key($fields)." ".$field;
        if(next($fields)) $statement .= ", ";
        else $statement .= " ";
    }
    $statement .= ");";
    echo $statement;
}
