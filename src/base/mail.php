
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "external/PHPMailer/src/PHPMailer.php";
require "external/PHPMailer/src/SMTP.php";
require "external/PHPMailer/src/Exception.php";
require "config.php";

function sendMail($to, $subject, $body){

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
        
        $mail->addAddress($to);
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
