<?php

/**
 * Functions for interacting with cookie-based messages
 */

namespace Allegro\Core;

class Messages{

    static $messages = [];

    private function __construct(){}

    /**
     * Create cookie-based messages that can be retrieved after redirecting.
     * 
     * @param string $level Message level or any meta value
     * @param string $body Message itself
     */
    static function addMessage($level, $body){

        //retrieve existing messages
        $messages = self::$messages;
        if(isset($_COOKIE["messages"])){
            
            $messages = array_merge($messages, json_decode($_COOKIE["messages"], true)); 
        } 
        //add to the end of messages array
        $messages[] = [
            "level" => $level,
            "body" => $body,
        ];
        self::$messages = $messages;
        setcookie("messages", json_encode($messages));
    }

    /**
     * Fetch messages and delete afterwards.
     * 
     * @return array Array of arrays (messages) 
     */
    static function getMessages(){

        if(isset($_COOKIE["messages"])){

            $messages = json_decode($_COOKIE["messages"], true);
            setcookie("messages", "", -1); //delete read messages
        }
        $messages = array_merge(self::$messages, $messages ?? []);
        self::$messages = [];
        return $messages;
    }
}
