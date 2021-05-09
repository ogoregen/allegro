
<?php

//calls correct view depending on url

session_set_cookie_params(2147483647); //maximum cookie lifespan
session_start();

require "../urls.php";
require "../views.php";

$uri = filter_var($_SERVER["REQUEST_URI"], FILTER_SANITIZE_URL);

if(array_key_exists($uri, $urls)) $view = $urls[$uri]; //if url is valid
else $view = $urls["/404"];

$view();
