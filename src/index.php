
<?php

//calls correct view depending on url

session_set_cookie_params(2147483647); //maximum cookie lifespan
session_start();

require "views.php";

$urls = [
    //path => view
    "" => "home", 
    "login" => "login",
    "logout" => "logout",
    "404" => "_404"
];

if(isset($_GET["url"])) $url = explode("/", $_GET["url"]);
else $url = [""];
$path = $url[0];

if(array_key_exists($path, $urls)) $view = $urls[$path]; //if url is valid
else $view = $urls["404"];
$view();
