<?php

declare(strict_types=1);

function is_input_empty(string $username,string $pwd,string $region){
    if(empty($username)||empty($pwd)||empty($region)){
        return true;
    }
    else{
        return false;
    }
}


function is_username_taken(object $pdo, string $username){
    if(get_username($pdo, $username)){
        return true;
    }
    else{
        return false;
    }
}

function create_user(object $pdo,string $username,string $pwd,string $region){
    set_user( $pdo, $username, $pwd, $region);
}