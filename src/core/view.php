<?php

/**
 * Utility functions for use in views.
 */

namespace Allegro\Core\view;

/**
 * Assert authentication, redirect to login if fails.
 * 
 * @param string $next GET variable to be passed to login view where it should be used as redirect location after login.
 */
function requireAuthentication($next = ""){
	
	if(!isset($_SESSION["is_authenticated"])){

		if($next) $next = "?next=$next";
		header("Location: /login$next");
	}
}

/**
 * Assert unauthentication, redirect to specified path or index if fails.
 * 
 * @param string $target path to redirect
 */
function requireUnauthentication($target = ""){

	if(isset($_SESSION["is_authenticated"])) header("Location: /$target");
}

/**
 * Assert POST request, redirect to index if fails. 
 */
function requirePOST(){

	if($_SERVER["REQUEST_METHOD"] != "POST") header("Location: /");
}
