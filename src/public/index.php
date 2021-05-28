<?php

//calls correct view depending on url

require __DIR__."/../urls.php";
require __DIR__."/../views.php";

session_set_cookie_params(2147483647); //maximum cookie lifespan
session_start();

$uri = filter_var($_SERVER["REQUEST_URI"], FILTER_SANITIZE_URL);

if(array_key_exists($uri, $urls)) $view = $urls[$uri]; //if url is valid
else $view = $urls["/404"];

$view();
