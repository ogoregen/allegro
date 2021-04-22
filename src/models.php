
<?php

require "base/database.php";
require "base/Model.php";

class User extends Model{

    public $id;
    public $email;
    public $firstName;
    public $lastName;

    function fullName(){

        return $this->$firstName." ".$this->$lastName;
    }

    static function who(){

        return __CLASS__;
    }
}
