
<?php

require "base/Model.php";

class User extends Model{

    public $id = "INT NOT NULL AUTO_INCREMENT";
    public $email = "TINYTEXT NOT NULL";
    public $password = "TINYTEXT NOT NULL";
    public $firstName = "TINYTEXT NOT NULL";
    public $lastName = "TINYTEXT NOT NULL";
    
    function fullName(){

        return $this->firstName." ".$this->lastName;
    }
}
