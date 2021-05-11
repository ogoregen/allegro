<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "vendor/PHPMailer/src/PHPMailer.php";
require "vendor/PHPMailer/src/SMTP.php";
require "vendor/PHPMailer/src/Exception.php";
require "config.php";

function sendMail($recipients, $subject, $body){

    $mail = new PHPMailer(true);

    try{

        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        
        $mail->Port = MAIL_PORT;
        $mail->Host = MAIL_HOST;
        $mail->Username = MAIL_USERNAME;
        $mail->Password = MAIL_PASSWORD;
        $mail->setFrom(MAIL_FROM_ADDR, MAIL_FROM_NAME);
        
        foreach($recipients as $recipient){
            
            $mail->addAddress($recipient);
        }
        
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->send();
        return true;
    }
    catch(Exception $e){
    
        return false;
    }
}
