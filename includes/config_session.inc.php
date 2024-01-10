<?php

ini_set('session.use_only_coockies',1);
ini_set('session.use_strict_mode',1);

session_set_cookie_params([
    'lifetime'=>1800,
    'domain'=>'localhost',
    'path'=>'/',
    'secure'=>true,
    'httponly'=>true
]);

session_start();

if(isset($_SESSION["user_id"])){
    if(!isset($_SESSION["last_regeneration"])){
        regenerate_loggedin();
    }
    else{
        $interval = 60*30;
        if(time() - $_SESSION["last_regeneration"] >= $interval){
            regenerate_loggedin();
        }
    }
}
else{
    if(!isset($_SESSION["last_regeneration"])){
        regenerate();
    }
    else{
        $interval = 60*30;
        if(time() - $_SESSION["last_regeneration"] >= $interval){
            regenerate();
        }
    }
}

function regenerate(){
    session_regenerate_id(true);
    $_SESSION["last_regeneration"]=time();
}

function regenerate_loggedin(){
    session_regenerate_id(true);

    $newSessionId = session_create_id();
    $sessionId = $newSessionId . "_" . $_SESSION["user_id"];
    sesssion_id($sessionId);

    $_SESSION["last_regeneration"]=time();
}