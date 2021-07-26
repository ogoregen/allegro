<?php

/**
 * Views represent pages, and fill and render templates.
 * To add a view, create a function that calls render()
 * or redirects to another view and add it to the urls array in urls.php
 */

require_once "vendor/parsedown/Parsedown.php";

require_once "sturdy/Messages.php";
require_once "sturdy/template.php";
require_once "core/mail.php";
require_once "core/view.php";

require_once "models.php";
require_once "utils.php";

use Sturdy\Messages;
use function Sturdy\render;
use function Allegro\Core\view\requirePOST;
use function Allegro\Core\view\requireAuthentication;
use function Allegro\Core\view\requireUnauthentication;

function landingPage(){

	requireUnauthentication("dashboard");
	$context = [
		"title" => "The ultimate student messenger",
		"metaDescription" => "Allegro standardizes your classroom's out-of-class communication replacing hard to follow chat groups and unspecialized email. A no-nonsense messaging application where you will instantly feel familiar.",
	];
	render("landingpage.php", $context);
}

function privacyPolicy(){

	$context = [
		"title" => "Privacy Policy",
		"metaDescription" => "Your privacy is important to us. It is Allegro's policy to respect your privacy and comply with any applicable law and regulation regarding any personal information about you.",
	];
	render("privacypolicy.php", $context);
}

function support(){

	if($_SERVER["REQUEST_METHOD"] == "POST"){

		$supportTicket = new SupportTicket();
		$supportTicket->author = $_SESSION["user"]->id;
		$supportTicket->subject = $_POST["subject"];
		$supportTicket->body = $_POST["body"];
		$supportTicket->save();
		Messages::addMessage("success", "Your message has been sent. We will get back to you as soon as possible.");
	}

	$context = [
		"title" => "Support",
		"metaDescription" => "Frequently Asked Questions and support",
	];

	render("support.php", $context);
}

function about(){
	$context = [
		"title" => "About",
		"metaDescription" => "Allegro is the education communication platform you've been looking for. Learn more.",
	];
	render("about.php", $context);
}

function credits(){
	$context = [
		"title" => "Credits",
	];
	render("credits.php", $context);
}

//app:

function dashboard(){

	requireAuthentication();

	switch($_GET["tab"] ?? "inbox"){

		case "inbox":
			$allegroMessages = Message::filter("recipient = {$_SESSION["user"]->id} AND status = 'S' ORDER BY createdOn DESC");
			$allegroMessages = array_map(function($x){

				$x->author = User::get("id = $x->author");
				return $x;
			}, $allegroMessages);
			break;

		case "sent":
			$allegroMessages = Message::filter("author = {$_SESSION["user"]->id} AND status = 'S' ORDER BY createdOn DESC");
			$allegroMessages = array_map(function($x){

				$x->recipient = User::get("id = $x->recipient");
				return $x;
			}, $allegroMessages);
			break;

		case "drafts":
			$allegroMessages = Message::filter("author = {$_SESSION["user"]->id} AND status = 'D' ORDER BY createdOn DESC");
			break;
	}

	if(isset($_GET["message"])){

		$selectedMessage = Message::get("id = {$_GET["message"]}");

		if($selectedMessage->author != $_SESSION["user"]->id && $selectedMessage->recipient != $_SESSION["user"]->id){

			$selectedMessage = null;
		}
		else{

			$parsedown = new Parsedown();
			$selectedMessage->body = $parsedown->text(preg_replace("/&gt;/", ">", htmlspecialchars($selectedMessage->body)));



			if($_GET["tab"] == "inbox"){

				$selectedMessage->author = User::get("id = $selectedMessage->author");
			}
			else{

				$selectedMessage->recipient = User::get("id = $selectedMessage->recipient");
			}
		}
	}
	
	if(isset($_GET["delete"])){

		$deleteMessage = true;
		$messageToDelete = $_GET["message"];
		$deletePermanently = ($selectedMessage->author == $_SESSION["user"]->id);
	}

	if(isset($_GET["compose"])){

		if($_GET["tab"] == "drafts"){

			$editingMessage = Message::get("id = {$_GET["message"]}");

			$autofill = [
				"to" => $editingMessage->to ?? "",
				"subject" => $editingMessage->subject,
				"body" => $editingMessage->body,
				"id" => $editingMessage->id,
			];
		}
		else if($_GET["tab"] == "inbox"){

			$editingMessage = Message::get("id = {$_GET["message"]}");

			$originalAuthor = User::get("id = $editingMessage->author");

			$body = $editingMessage->body;

			$body = preg_split("/\r\n|\r|\n/", $body);

			for($i = 0; $i < count($body); $i++){

				$body[$i] = "> ".$body[$i].PHP_EOL;
			}

			$body = implode($body);

			$body = PHP_EOL.PHP_EOL.PHP_EOL.$originalAuthor->fullName()." wrote on ".date("d/m/y, H:i", strtotime($editingMessage->createdOn)).":".PHP_EOL.PHP_EOL.$body;

			$autofill = [
				"to" => $originalAuthor->username,
				"subject" => "Re: ".$editingMessage->subject,
				"body" => $body,
			];
		}

		$compose = true;
	}

	$context = [
		"title" => "Dashboard",
		"messages" => Messages::getMessages(),
		"tab" => $_GET["tab"] ?? "inbox",
		"allegroMessages" => $allegroMessages,
		"selectedMessage" => $selectedMessage ?? null,
		"deleteMessage" => $deleteMessage ?? false,
		"messageToDelete" => $messageToDelete ?? null,
		"deletePermanently" => $deletePermanently ?? null,
		"compose" => $compose ?? false,
		"autofill" => $autofill ?? [],
	];
	render("dashboard.php", $context);
}

function people(){

	requireAuthentication();

	if(isset($_GET["id"])){

		$selectedUser = User::get("id = {$_GET["id"]}");
	}

	$context = [
		"title" => "Classmates",
		"messages" => Messages::getMessages(),
		"people" => User::all(),
		"classmate" => $selectedUser ?? null,
		"compose" => isset($_GET["to"]),
		"to" => $_GET["to"] ?? false,
	];

	render("people.php", $context);
}

function sendMessage(){

	requirePOST();
	requireAuthentication();
	
	$failed = false;
	$draft = false;
	$notification = "";

	if($_POST["id"] != ""){

		$message = Message::get("id = {$_POST["id"]}");
	}
	else{

		$message = new Message();
	}

	$message->author = $_SESSION["user"]->id;	
	$message->subject = addslashes(htmlspecialchars($_POST["subject"]));
	$message->body = addslashes($_POST["body"]);

	switch($_POST["button"]){

		case "send":
			if(isset($_POST["to"])){

				$recipient = User::get("username = '{$_POST["to"]}' OR email = '{$_POST["to"]}'");
				if(!$recipient){

					$failed = true;
					$notification = "This user does not exist.";
				}
			}
			else{

				$failed = true;
				$notification = "Please enter a username.";
			}

			if($failed){

				$draft = true;
				break;
			}

			$message->recipient = $recipient->id;
			$message->createdOn = date("Y-m-d H:i:s", time());
			$message->status = 'S';
			$message->save();
			Messages::addMessage("success", "Message sent successfully.");

			if(!($_POST["isSilent"] ?? false)){

				sendMessageNotificationMail($recipient, $message);
			}
			break;

		case "draft":

			$draft = true;
			break;
	}

	if($draft){

		$message->status = 'D';
		echo $message->save();
		if($failed){

			Messages::addMessage("error", $notification." saved as draft.");
		}
		else{

			Messages::addMessage("success", "message saved as draft");
		}
	}

	header("Location: /dashboard");
}

function deleteMessage(){
	
	requirePOST();
	requireAuthentication();

	$message = Message::get("id = {$_POST["messageID"]}");
	if($message->author == $_SESSION["user"]->id){
		$message->delete();
		$notification = "Message deleted.";
		Messages::addMessage("success", $notification);
	}
	else if($message->recipient == $_SESSION["user"]->id){
		$message->status = "R";
		$message->save();
		Messages::addMessage("success", $notification);
	}
	header("Location: /dashboard");
	
}

function account(){

	requireAuthentication();

	$tab = $_GET["tab"] ?? "details";

	if($_SERVER["REQUEST_METHOD"] == "POST"){

		$user = $_SESSION["user"];

		switch($_POST["button"]){

			case("details"):

				$failed = false;

				$autofill["name"] = $user->fullName();
				$autofill["email"] = $user->email;
				$autofill["username"] = $user->username;

				$name = trim($_POST["name"]);

				if($name != $user->fullName()){

					if(validateFullName($name)){

						$user->firstName = implode(" ", explode(" ", $name, -1));
						$user->lastName =  substr($name, strrpos($name, " ") + 1);
						$user->username = $_POST["username"];
					}
					else{
	
						$errors["name"] = "Please enter a valid name.";
						$autofill["name"] = $_POST["name"];
						$failed = true;
					}
				}

				if($_POST["email"] != $user->email){

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
					else{
						$user->email = $_POST["email"];
						$user->emailVerified = false;
						$emailChanged = true; 
					}
				}

				if($_POST["username"] != $user->username){

					if(!ctype_alnum($_POST["username"])){
		
						$errors["username"] = "Username must be alphanumeric";
						$autofill["username"] = $_POST["username"];
						$failed = true;
					}
					else if(User::exists("username = '{$_POST["username"]}'")){
			
						$errors["username"] = "A user with this username address already exists.";
						$autofill["username"] = $_POST["username"];
						$failed = true;
					}
					else{
						$user->username = $_POST["username"];
					}
				}

				if(!$failed){

					$user->save();
					if(isset($emailChanged)){

						sendVerificationMail($user);
						Messages::addMessage("info", "A confirmation mail for changing your email address has been sent to your original address. Please check your inbox.");
					}
					Messages::addMessage("success", "Your details have been saved.");
				}
				break;

			case("communication"):
				$user->emailNotify = $_POST["emailNotify"] ?? false;
				$user->emailInform = $_POST["emailInform"] ?? false;
				$user->save();
				$_SESSION["user"] = $user;
				Messages::addMessage("success", "Communication preferences updated.");
				break;
			case("privacy"):
				$user->displayOnline = $_POST["displayOnline"] ?? false;
				$user->displayEmail = $_POST["displayEmail"] ?? false;
				$user->save();
				$_SESSION["user"] = $user;
				Messages::addMessage("success", "Privacy settings updated.");
				break;
			case("password"):

				if(strlen($_POST["newPassword"]) < 8){

					$errors["newPassword"] = "Your password must be at least 8 characters.";
				}
				else if(password_verify($_POST["password"], $user->password)){

					$user->password = password_hash($_POST["newPassword"], PASSWORD_BCRYPT);
					$user->save();
					Messages::addMessage("success", "Your password has been updated.");
				}
				else{

					$errors["password"] = "Password incorrect.";
				}
				break;
		}
	}
	else{ // REQUEST != POST

		switch($tab){
			case "details":
				$autofill = [
					"name" => $_SESSION["user"]->fullName(),
					"username" => $_SESSION["user"]->username,
					"email" => $_SESSION["user"]->email,
				];
				break;
		}
	}

	$context = [
		"title" => "Account Settings",
		"messages" => Messages::getMessages(),
		"tab" => $tab,
		"autofill" => $autofill ?? [],
		"errors" => $errors ?? []
	];
	render("account.php", $context);
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

			$errors["username"] = "A user with this username address already exists.";
			$autofill["username"] = $_POST["username"];
			$failed = true;
		}

		$name = trim($_POST["name"]);

		if(!validateFullName($name)){

			$errors["name"] = "Please enter a valid full name.";
			$autofill["name"] = $_POST["name"];
			$failed = true;
		}

		if(strlen($_POST["password"]) < 8){

			$errors["password"] = "Your password must be at least 8 characters.";
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
			Messages::addMessage("success", "Welcome to Allegro! Please check your inbox for a verification link.");
			login($user);
		}
	}
	$context = [
		"title" => "Sign Up",
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
			Messages::addMessage("info", "A confirmation email has been sent. please check your inbox.");
		}
		else{

			$autofill["user"] = $_POST["user"];
			$errors["user"] = "This user does not exist.";
		}
	}
	$context = [
		"title" => "Forgot Password",
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

				$user->password = password_hash($_POST["password"], PASSWORD_BCRYPT);
				$user->save();
				Messages::addMessage("success", "You password has been changed successfully."); 
			}
			else{

				$errors["password"] = "Your password must be at least 8 characters.";
			}
		}
		else{

			Messages::addMessage("error", "Invalid verification link."); 
		}
	}

	$context = [
		"title" => "Reset Password",
		"id" => $_GET["id"],
		"token" => $_GET["token"],
		"errors" => $errors ?? [],
		"messages" => Messages::getMessages(),
	];
	render("resetpassword.php", $context);
}

function logout(){

	$_SESSION["user"]->lastActive = 0;
	$_SESSION["user"]->save();
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
		$_SESSION["user"]->emailVerified = true;
		$user->save();
		Messages::addMessage("success", "Your email address has been verified successfully.");
	}
	else{

		Messages::addMessage("error", "Invalid verification link.");
	}
	header("Location: /");
}

function requestVerificationMail(){

	requireAuthentication();
	sendVerificationMail($_SESSION["user"]);
	Messages::addMessage("info", "A verification email has been sent you your email address.");
	header("Location: /account");
}

//error:

function _404(){

	http_response_code(404);
	$context = [
		"title" => "Not found.",
	];
	render("404.php", $context);
}
