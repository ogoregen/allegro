
<?php

// views represent pages, and fill and render templates
// to add a view, create a function that calls render() or redirects to another view and add it to the urls array in index.php

require "renderer.php";

//base:

function home(){

    $context = [

        "title" => "Home",
        "metaDescription" => ""
    ];
    render("home.php", $context);
}

//authentication:

function login(){

    $autofill = [];
    $errors = [];
    if($_SERVER["REQUEST_METHOD"] === "POST"){

        //login
        header("Location: /dashboard");
    }
    $context = [

        "title" => "Log In",
        "metaDescription" => "",
        "autofill" => $autofill
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
