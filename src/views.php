<?php

/**
 * Views represent pages, and fill and render templates.
 * To add a view, create a function that calls render()
 * or redirects to another view and add it to the urls array in urls.php
 */

require_once "core/view.php";
require_once "core/template.php";
require_once "core/mail.php";
require_once "models.php";

use function Allegro\Core\template\render;
use function Allegro\Core\view\requirePOST;
use function Allegro\Core\view\requireAuthentication;
use function Allegro\Core\view\requireUnauthentication;

function sendMessage(){

	requirePOST();
   	$from = $_REQUEST["from"];
   	$email = $_REQUEST["email"];
   	$file = $_REQUEST["file"];
   
   	if ($file) {
    	function mail_attachment ($from , $to, $subject, $message, $attachment){
        	$filett = $attachment; // Path to the file
        	$filett_type = "application/octet-stream"; // File Type 
         
        	$start = strrpos($attachment, '/') == -1 ? 
            strrpos($attachment, '//') : strrpos($attachment, '/')+1;
				
         	$filett_name = substr($attachment, $start, 
            strlen($attachment)); // Filename that will be used for the 
            //file as the attachment 
         
        $email_from = $from; // Who the email is from
        $subject = "New Attachment Message";
         
        $email_subject =  $subject; // The Subject of the email 
        $email_txt = $message; // Message that the email has in it 
        $email_to = $to; // Who the email is to
         
        $headers = "From: ".$email_from;
        $file = fopen($filett,'rb'); 
        $data = fread($file,filesize($filett)); 
        fclose($file); 
         
        $msg_txt="\n\n You have recieved a new attachment message from $from";
        $semi_rand = md5(time()); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . "boundary=\"{$mime_boundary}\"";
        
        $email_txt .= $msg_txt;
			
        $email_message .= "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type:text/html; 
            charset = \"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . 
            $email_txt . "\n\n";
		
        $data = chunk_split(base64_encode($data));
         
        $email_message .= "--{$mime_boundary}\n" . "Content-Type: {$fileatt_type};\n" . " name = \"{$fileatt_name}\"\n" . //"Content-Disposition: attachment;\n" . 
            //" filename = \"{$fileatt_name}\"\n" . "Content-Transfer-Encoding: 
            "base64\n\n" . $data . "\n\n" . "--{$mime_boundary}--\n";
				
        $ok = mail($email_to, $email_subject, $email_message, $headers);
         
        if($ok) {
           echo "File Sent Successfully.";
           unlink($attachment); // delete a file after attachment sent.
        }else {
           die("Sorry but the email could not be sent. Please go back and try again!");
        }
      }
      move_uploaded_file($_FILES["file"]["tmp_name"],
         'temp/'.basename($_FILES['file']['name']));
			
      mail_attachment("$from", "youremailaddress@gmail.com", 
         "subject", "message", ("temp/".$_FILES["file"]["name"]));
   }
}

function landing(){

	$context = [
	];
	render("landingpage.php", $context);
}

function dashboard(){

	requireAuthentication();
	$users = User::all("id, firstName, lastName, username, email");
	$context = [
		"title" => "Home",
		"metaDescription" => "",
		"session" => $_SESSION,
		"users" => $users,
	];
	render("dashboard.php", $context);
}

//authentication:

function register(){
	
	requireUnauthentication();
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
		"errors" => $errors,
	];
	render("register.php", $context);
}

function login(){

	requireUnauthentication();
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
		"errors" => $errors,
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
		"title" => "Not found.",
	];
	render("404.php", $context);
}
