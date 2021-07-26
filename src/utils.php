<?php

/**
 * App-specific utility functions.
 */

require_once "vendor/parsedown/Parsedown.php";

require_once "core/mail.php";
require_once "sturdy/view.php";
require_once "sturdy/models.php";

use function Allegro\Core\mail\sendMail;
use function Sturdy\renderToString;

/**
 * Construct and send email address verification mail to given user.
 * 
 * @param User $user
 */
function sendVerificationMail($user){

    $verificationLink = $_SERVER["SERVER_NAME"]."/verify?id=".$user->id."&token=".VerificationToken::createToken($user);

    $context = [
        "name" => $user->firstName,
        "verificationLink" => $verificationLink,
    ];
    $body = renderToString("mail/emailverification.php", $context);

    sendMail($user->email, "Verify your email address", $body);
}

/**
 * Construct and send password reset mail to given user.
 * 
 * @param User $user
 */
function sendPasswordResetMail($user){

    $verificationLink = $_SERVER["SERVER_NAME"]."/resetpassword?id=".$user->id."&token=".VerificationToken::createToken($user);

    $context = [
        "name" => $user->firstName,
        "verificationLink" => $verificationLink,
    ];
    $body = renderToString("mail/passwordreset.php", $context);

    sendMail($user->email, "Password reset request", $body);
}

/**
 * Construct and send email address change verification mail to given user.
 * 
 * The mail is sent to the verified address (old email).
 * 
 * @param User $user
 * @param string $newEmail
 */
function sendEmailChangeMail($user, $newEmail){

    $verificationLink = $_SERVER["SERVER_NAME"]."/verify?id=".$user->id."&token=".VerificationToken::createToken($user);

    $context = [
        "fullName" => $user->fullName,
        "verificationLink" => $verificationLink,
        "newEmail" => $newEmail
    ];
    $body = renderToString("mail/emailchange", $context);

    sendMail($user->email, "Confirm email address change", $body);
}

/**
 * Various utility functions.
 */

//mail:

/**
 * Construct and send message notification mail to given user.
 * 
 * @param User $user
 * @param Message $message
 */
function sendMessageNotificationMail($user, $message){

    if(!$user->emailNotify) return;

    $parsedown = new Parsedown();

    $message->body = $parsedown->text($message->body);

    $context = [
        "message" => $message,
    ];
    $body = renderToString("mail/messagenotification.php", $context);

    sendMail($user->email, "You've received a new Allegro message", $body);
}

//authentication:

/**
 * Set session variables for given user and redirect to dashboard.
 * 
 * @param User $user
 */
function login($user){

    $_SESSION["isAuthenticated"] = true;
    $_SESSION["user"] = User::get("id = $user->id");
    header("Location: /dashboard");
}

//validation:

/**
 * Check if input is in the form of multiple words separated by spaces.
 * 
 * @param string $fullName
 * 
 * @return bool
 */
function validateFullName($fullName){

    return preg_match("/^[\p{L}.]([-']?[\p{L}.]+)*( [\p{L}.]([-']?[\p{L}.]+)*)+$/u", $fullName);
}

function updateActivity($user){

    $user->lastActive = date("Y-m-d H:i:s", time());
    $user->save();
}
