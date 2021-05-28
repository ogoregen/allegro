<?php

namespace Allegro\Core\view;

function requireAuthentication($next = ""){
	
	if($next) $next = "?next=$next";
	if(!isset($_SESSION["is_authenticated"])) header("Location: /login$next");
}

function requireUnauthentication(){

	if(isset($_SESSION["is_authenticated"])) header("Location: /");
}

function requirePOST(){

	if($_SERVER["REQUEST_METHOD"] != "POST") header("Location: /");
}
