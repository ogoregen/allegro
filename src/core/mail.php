<?php

/**
 * Minimal wrapping of PHPMailer and other mail utility
 */

namespace Allegro\Core;

require_once "vendor/PHPMailer/src/PHPMailer.php";
require_once "vendor/PHPMailer/src/SMTP.php";
require_once "vendor/PHPMailer/src/Exception.php";
require_once "../config/credentials.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * Send email using credentials defined in config.php.
 * 
 * @param array $recipients Array of recipient email addresses (string) 
 * @param string $subject
 * @param string $body HTML email body
 * 
 * @return bool Operation success
 */
function sendMail($recipients, $subject, $body){

    $mail = new PHPMailer(true);

    $mail->isSMTP();
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
