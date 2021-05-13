<?php

/**
 * Views represent pages, and fill and render templates.
 * To add a view, create a function that calls render()
 * or redirects to another view and add it to the urls array in urls.php
 */

require_once "core/template.php";
require_once "core/mail.php";
require_once "models.php";

use function Allegro\Core\template\render;

//base:

function dashboard(){

    if(!isset($_SESSION["is_authenticated"])) header("Location: /login");
    $context = [

        "title" => "Home",
        "metaDescription" => "",
        "session" => $_SESSION
    ];
    render("dashboard.php", $context);
}

//authentication:

function register(){
    
    if(isset($_SESSION["is_authenticated"])) header("Location: /");
    $autofill = [];
    $errors = [];
    if($_SERVER["REQUEST_METHOD"] === "POST"){

        //validate:
        $failed = false;
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){

            $errors["email"] = "Invaid email address.";
            $autofill["email"] = $_POST["email"];
            $failed = true;
        }
        else if(User::get("email = '".$_POST["email"]."'")){

            $errors["email"] = "Already exists.";
            $autofill["email"] = $_POST["email"];
            $failed = true;
        }
        if(!preg_match("/^[a-zA-Z\'\-\040\.]+$/", $_POST["name"])){

            $errors["name"] = "Please enter a valid name.";
            $autofill["name"] = $_POST["name"];
            $failed = true;
        }
        if(strlen($_POST["password"]) < 8){

            $errors["password"] = "Password is too short.";
            $failed = true;
        }
        if(!$failed){ //register

            $user = new User();
            $user->email = $_POST["email"];
            $user->username = $_POST["username"];
            $user->password = password_hash($_POST["password"], PASSWORD_BCRYPT);
            $firstName = implode(" ", explode(" ", $_POST["name"], -1));
            $lastName =  substr($_POST["name"], strrpos($_POST["name"], " ") + 1);
            $user->save();
            //todo: create success message
            login();
        }
    }
    $context = [

        "title" => "Sign Up",
        "metaDescription" => "",
        "autofill" => $autofill,
        "errors" => $errors
    ];
    render("register.php", $context);
}

function login(){

    if(isset($_SESSION["is_authenticated"])) header("Location: /");
    $autofill = [];
    $errors = [];
    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $user = User::get("email = '".$_POST['email']."'");
        if(!$user || !password_verify($_POST["password"], $user->password)){

            $errors["form"] = "Wrong credentials.";
            $autofill["email"] = $_POST["email"];
        }
        else{

            $_SESSION["is_authenticated"] = true;
            $_SESSION["id"] = $user->id;
            $_SESSION["username"] = $user->username;
            header("Location: /");
        }
    }
    $context = [

        "title" => "Log In",
        "metaDescription" => "",
        "autofill" => $autofill,
        "errors" => $errors
    ];
    render("login.php", $context);
}

function logout(){

    $_SESSION = [];
    session_destroy();
    header("Location: /");
}

//error:

function _404(){

    http_response_code(404);
    $context = [

        "title" => "Not found."
    ];
    render("404.php", $context);
}
function settings(){

  render("register.php");
}
