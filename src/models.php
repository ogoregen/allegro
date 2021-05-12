<?php

require_once "core/Model.php";

class User extends Model{

    public $id;
    public $email;
    public $username;
    public $password;
    public $firstName;
    public $lastName;
    
    function fullName(){

        return $this->firstName." ".$this->lastName;
    }
}

class Message extends Model{

    public $id;
    public $creationDatetime;
    public $author;
    public $recipients;
    public $subject;
    public $body;
}
