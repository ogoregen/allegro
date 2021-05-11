<?php

/**
 * Create cookie-based messages that can be retrieved after redirecting.
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

function getMessages(){

    if(isset($_COOKIE["messages"])){

        $messages = json_decode($_COOKIE["messages"], true);
        setcookie("messages", "", -1); //delete read messages
    }
    return $messages ?? [];
}
