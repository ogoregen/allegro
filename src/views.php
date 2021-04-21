
<?php

// views represent pages, and fill and render templates
// to add a view, create a function that calls render() and add it to the urls array in index.php

include "renderer.php";

function home(){

    $context = [

        "title" => "Home",
        "metaDescription" => ""
    ];
    render("home.php", $context);
}

function login(){

    $context = [

        "title" => "Log In",
        "metaDescription" => ""
    ];
    render("login.php", $context);
}

function _404(){

    http_response_code(404);
    $context = [

        "title" => "Not found."
    ];
    render("404.php", $context);
}

?>
