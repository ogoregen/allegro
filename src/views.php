<?php

/**
 * Views represent pages, and fill and render templates.
 * To add a view, create a function that calls render()
 * or redirects to another view and add it to the urls array in urls.php
 */

require_once "core/view.php";
require_once "core/template.php";
require_once "core/Messages.php";
require_once "core/mail.php";
require_once "models.php";
require_once "utils.php";

use Allegro\Core\Messages;
use function Allegro\Core\template\render;
use function Allegro\Core\view\requirePOST;
use function Allegro\Core\view\requireAuthentication;
use function Allegro\Core\view\requireUnauthentication;

function test(){

	var_dump(User::filter("id > 41"));
}

function landingPage(){

	requireUnauthentication("dashboard");
	$context = [
		"title" => "The ultimate student messenger - Allegro",
		"metaDescription" => "",
	];
	render("landingpage.php", $context);
}

//app:

function dashboard(){

	requireAuthentication();
	$context = [
		"title" => "Dashboard",
		"metaDescription" => "",
		"messages" => Messages::getMessages(),
		"receivedMessages" => Message::filter("recipient = {$_SESSION["user"]->id}"),
		//"sentMessages" => Message::filter("author = {$_SESSION["id"]}"),
	];
	render("dashboard.php", $context);
}
function sent(){

	requireAuthentication();
	$context = [
		"title" => "Dashboard",
		"metaDescription" => "",
		"messages" => Messages::getMessages(),
		"receivedMessages" => Message::filter("recipient = {$_SESSION["user"]->id}"),
		//"sentMessages" => Message::filter("author = {$_SESSION["id"]}"),
	];
	render("sent.php", $context);
}
function drafts(){

	requireAuthentication();
	$context = [
		"title" => "Dashboard",
		"metaDescription" => "",
		"messages" => Messages::getMessages(),
		"receivedMessages" => Message::filter("recipient = {$_SESSION["user"]->id}"),
		//"sentMessages" => Message::filter("author = {$_SESSION["id"]}"),
	];
	render("drafts.php", $context);
}

function people(){

	requireAuthentication();
	$context = [
		"title" => "People",
		"metaDescription" => "",
		"messages" => Messages::getMessages(),
		"people" => User::all(),
	];
	render("people.php", $context);
}

function sendMessage(){

	requirePOST();
	requireAuthentication();
	
	$recipient = $_POST["to"];
	$recipient = User::get("email = '$recipient' OR username = '$recipient'");

	$message = new Message();
	$message->author = $_SESSION["user"]->id;
	$message->recipient = $recipient->id;
	$message->subject = $_POST["subject"];
	$message->body = $_POST["body"];
	$message->save();
	
	Messages::addMessage("success", "Message sent!");

	header("Location: /dashboard");
}

function account(){

	requireAuthentication();

	if($_SERVER["REQUEST_METHOD"] == "POST"){

		$user = $_SESSION["user"];

		switch($_POST["button"]){

			case("details"):

				$name = trim($_POST["name"]);
				if(validateFullName($name)){

					$user->firstName = implode(" ", explode(" ", $name, -1));
					$user->lastName =  substr($name, strrpos($name, " ") + 1);
				}
				else{

					$errors["name"] = "Please enter a valid name.";
					$autofill["name"] = $_POST["name"];
				}
				$user->save();
				break;

			case("emailPreferences"):
				$user->emailNotify = $_POST["emailNotify"];
				$user->emailDisplay = $_POST["emailDisplay"];
				$user->emailInform = $_POST["emailInform"];
				$user->save();
				break;
		
			case("password"):
				if(strlen($_POST["newPassword"]) < 8){

					$errors["password"]["newPassword"] = "Password too short.";
				}
				else if(password_verify($_POST["password"], $user->password)){

					$user->password = $_POST["newPassword"];
					$user->save();
					Messages::addMessage("success", "Your password has been updated.");
				}
				break;

			case("deleteAccount"):
				if($_POST["id"] == $user->id && $_POST["confirmation"] == "delete"){

					$user->delete();
					Messages::addMessage("info", "Your account has been deleted. We are sorry to see you go.");
					logout();
				}
				break;
		}
	}

	$context = [
		"title" => "",
		"messages" => Messages::getMessages(),
	];
	render("settings.php", $context);
}

//authentication:

function register(){
	
	requireUnauthentication("dashboard");
	$autofill = [];
	$errors = [];
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		//validate:
		$failed = false;
		if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){

			$errors["email"] = "Please enter a valid email address.";
			$autofill["email"] = $_POST["email"];
			$failed = true;
		}
		else if(User::exists("email = '{$_POST["email"]}'")){

			$errors["email"] = "A user with this email address already exists.";
			$autofill["email"] = $_POST["email"];
			$failed = true;
		}
		if(!ctype_alnum($_POST["username"])){

			$errors["username"] = "Username must be alphanumeric";
			$autofill["username"] = $_POST["username"];
			$failed = true;
		}
		else if(User::exists("username = '{$_POST["username"]}'")){

			$errors["username"] = "A user with this user name address already exists.";
			$autofill["username"] = $_POST["username"];
			$failed = true;
		}

		$name = trim($_POST["name"]);

		if(!validateFullName($name)){

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
			$user->firstName = implode(" ", explode(" ", $name, -1));
			$user->lastName =  substr($name, strrpos($name, " ") + 1);
			$user->save();
			sendVerificationMail($user);
			Messages::addMessage("success", "Welcome to Allegro! Please check your inbox for an email verification link.");
			login($user);
		}
	}
	$context = [
		"title" => "Sign Up",
		"metaDescription" => "",
		"autofill" => $autofill,
		"errors" => $errors,
	];
	render("register.php", $context);
}

function loginView(){

	requireUnauthentication("dashboard");
	$autofill = [];
	$errors = [];
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		$user = User::get("email = '{$_POST["user"]}' OR username = '{$_POST["user"]}'");
		if(!$user || !password_verify($_POST["password"], $user->password)){

			$errors["form"] = "Wrong credentials.";
			$autofill["user"] = $_POST["user"];
		}
		else{

			login($user);
		}
	}
	$context = [
		"title" => "Log In",
		"metaDescription" => "",
		"autofill" => $autofill,
		"errors" => $errors,
	];
	render("login.php", $context);
}

function forgotPassword(){

	$autofill = [];
	$errors = [];

	if($_SERVER["REQUEST_METHOD"] == "POST"){

		if($user = User::get("email = '{$_POST["user"]}' OR username = '{$_POST["user"]}'")){

			sendPasswordResetMail($user);
			Messages::addMessage("info", "Email sent. Please check.");
		}
		else{

			$autofill["user"] = $_POST["user"];
			$errors["user"] = "Does not exist.";
		}
	}
	$context = [
		"errors" => $errors,
		"autofill" => $autofill,
		"messages" => Messages::getMessages(),
	];
	render("forgotpassword.php", $context);
}

function resetPassword(){

	requireUnauthentication();
	if(!isset($_GET["id"]) || !isset($_GET["token"])) header("Location: /forgotpassword");
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		$user = User::get("id = {$_GET["id"]}");
		if(VerificationToken::isValid($user, $_GET["token"])){

			if(strlen($_POST["password"]) >= 8){

				$user->password = $_POST["password"];
				$user->save();
				Messages::addMessage("success", "changed"); 
			}
			else{

				$errors["password"] = "password too short.";
			}
		}
		else{

			Messages::addMessage("error", "Your verification link has timed out."); 
		}
	}

	$context = [
		"id" => $_GET["id"],
		"token" => $_GET["token"],
		"errors" => $errors ?? [],
		"messages" => Messages::getMessages(),
	];
	render("resetpassword.php", $context);
}

function logout(){

	$_SESSION = [];
	session_destroy();
	header("Location: /");
}

function verifyEmail(){

	if($_SESSION && $_SESSION["userID"] != $_GET["id"]){

		header("Location: /");
	}
	$user = User::get("id = {$_GET["id"]}");
	if(VerificationToken::isValid($user, $_GET["token"])){

		$user = User::get("id = $user->id");
		$user->emailVerified = true;
		$user->save();
		Messages::addMessage("success", "Your email address was verified successfully.");
	}
	else{

		Messages::addMessage("error", "Invalid verification link.");
	}
	header("Location: /");
}

//error:

function _404(){

	http_response_code(404);
	$context = [
		"title" => "Not found.",
	];
	render("404.php", $context);
}
