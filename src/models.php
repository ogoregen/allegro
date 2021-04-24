
<?php

require "base/Model.php";

class User extends Model{

    public $id;
    public $email;
    public $password;
    public $firstName;
    public $lastName;
    
    function fullName(){

        return $this->firstName." ".$this->lastName;
    }
}

/*
$user = User::get("id = 1", "id, email, firstName, lastName");
*/
