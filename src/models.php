<?php

require_once "core/Model.php";

use Allegro\Core\Model;

class User extends Model{

	public $email;
	public $username;
	public $password;
	public $createdOn;
	public $firstName;
	public $lastName;
	public $emailVerified;
	public $emailNotify;
	
	function fullName(){

		return $this->firstName." ".$this->lastName;
	}
}

class Message extends Model{

	public $author;
	public $recipient;
	public $createdOn;
	public $subject;
	public $body;
}

class VerificationToken extends Model{

	public $user;
	public $token;
	public $createdOn;
	public $lifespan;

	/**
	 * Create VerificationToken, return token.
	 * 
	 * @param User $user
	 * @param int $validity lifespan Lifespan in seconds
	 * 
	 * @return string bool 
	 */
	static function createToken($user, $lifespan = 172800 /* (seconds) 2 days */){

		$verificationToken = new self();
		$verificationToken->user = $user->id;
		$verificationToken->token = bin2hex(openssl_random_pseudo_bytes(16));
		$verificationToken->lifespan = $lifespan;
		$verificationToken->save();
		return $verificationToken->token;
	}

	/**
	 * Check token validity, delete token, return validity.
	 * 
	 * @param int $userID
	 * @param string $token
	 * 
	 * @return bool
	 */
	static function isValid($user, $token){

		$verificationToken = self::get("user = $user->id AND token = '$token'");
		if($verificationToken && time() - strtotime($verificationToken->createdOn) + $verificationToken->lifespan > 0){

			$result = true;
			$verificationToken->delete();
		}
		else{

			$result = false;
		}
		return $result;
	}
}
