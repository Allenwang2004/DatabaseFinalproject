<?php

declare(strict_types=1);

function output_username(){
    if(isset( $_SESSION["user_id"])){
        echo"You are logged in as " . $_SESSION["user_username"];
        echo"<br>";
        echo"Your default location is  " . $_SESSION["user_region"];
    }
    else {
        echo"You are not logged in";
    }

}

function check_login_errors(){
    if(isset( $_SESSION["errors_login"])){
        $errors=$_SESSION["errors_login"];

        echo"<br>";

        foreach($errors as $error){
            echo '<p>'.$error.'</p>';
        }

        unset($_SESSION["errors_signup"]);
    }
    else if(isset( $_GET["login"]) && $_GET["login"] === "success"){
        echo"<br>";
        echo '<p class="form-success">login success!</p>';
    }
}

function check_password(){
    if(isset($_SESSION["wrong_password"])){
        echo "wrong password";
        unset($_SESSION["wrong_password"]);
    }
    
}