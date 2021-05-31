<?php

/**
 * Functions for interacting with cookie-based messages
 */

namespace Allegro\Core;

/**
 * Create cookie-based messages that can be retrieved after redirecting.
 * 
 * @param string $level Message level or any meta value
 * @param string $body Message itself
 */
function addMessage($level, $body){

    if(isset($_COOKIE["messages"])) $messages = json_decode($_COOKIE["messages"]); //retrieve existing messages
    $messages[] = [
        //add to the end of messages array
        "level" => $level,
        "body" => $body
    ];
    setcookie("messages", json_encode($messages));
}

/**
 * Fetch messages and delete afterwards.
 * 
 * @return array Array of arrays (messages) 
 */
function getMessages(){

    if(isset($_COOKIE["messages"])){

        $messages = json_decode($_COOKIE["messages"], true);
        setcookie("messages", "", -1); //delete read messages
    }
    return $messages ?? [];
}
