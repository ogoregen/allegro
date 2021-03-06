<?php

/**
 * Minimal wrapping of PHPMailer
 */

namespace Allegro\Core\mail;

require_once "vendor/PHPMailer/src/PHPMailer.php";
require_once "vendor/PHPMailer/src/SMTP.php";
require_once "vendor/PHPMailer/src/Exception.php";
require_once __DIR__."/../config/credentials.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * Send email using credentials defined in config/credentials.php.
 * 
 * @param array|string $recipients Array of email addresses, or a single address 
 * @param string $subject
 * @param string $body HTML email body
 * 
 * @return bool Operation success
 */
function sendMail($recipients, $subject, $body){
	
	if(gettype($recipients) == "string"){

		$recipients = [$recipients];
	}

	$mail = new PHPMailer(true);
	$mail->isSMTP();
	$mail->CharSet = "UTF-8";
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
	$mail->Host = MAIL_HOST;
	$mail->Port = MAIL_PORT;
	$mail->Username = MAIL_USER;
	$mail->Password = MAIL_PASS;
	$mail->setFrom(MAIL_FROM_MAIL, MAIL_FROM_NAME);
	
	foreach($recipients as $recipient){
		
		$mail->addAddress($recipient);
	}
	
	$mail->isHTML(true);
	$mail->Subject = $subject;
	$mail->Body = $body;

	try{

		$mail->send();
		return true;
	}
	catch(Exception $e){

		return false;
	}
}
