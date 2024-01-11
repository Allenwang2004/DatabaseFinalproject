<?php

declare(strict_types=1);

function get_username(object $pdo, string $username){
    $query = "SELECT username FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username",$username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(object $pdo,string $username,string $pwd,string $region){
    $query = "INSERT INTO users (username,pwd,region) VALUES (:username,:pwd,:region);";
    $stmt = $pdo->prepare($query);

    $options = [
        'cost' =>10
    ];

    $hashedPwd = password_hash($pwd,PASSWORD_BCRYPT,$options);

    $stmt ->bindParam(":username",$username);
    $stmt ->bindParam(":pwd",$hashedPwd);
    $stmt ->bindParam(":region",$region);
    $stmt->execute();
}