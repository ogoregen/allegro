
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "external/PHPMailer/src/PHPMailer.php";
require 'external/PHPMailer/src/SMTP.php';
require "external/PHPMailer/src/Exception.php";

function sendMail($to, $subject, $body){

    $mail = new PHPMailer(true);

    try{

        $mail->isSMTP();
        $mail->Host = "smtp.yandex.com";
        $mail->SMTPAuth = true;
        $mail->Username = "";
        $mail->Password = "";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->setFrom("", "Allegro");
        
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

?>
