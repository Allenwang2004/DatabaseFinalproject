<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {
        require_once  "try_dbh.inc.php";
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';
        
        //error handle
        $errors = [];
        
        if(is_input_empty($username,$pwd,$email)){
            $errors["empty_input"] = "fill in all fields";
        }
        if(is_email_invalid($email)){
            $errors["invalid_email"] = "invalid email";
        }
        if(is_username_taken($pdo, $username)){
            $errors["username_taken"] = "username taken";
        }
        if(is_email_registered($pdo, $email)){
            $errors["email_used"] = "email already registerd";
        }

        require_once 'config_session.inc.php';

        if($errors){
            $_SESSION["errors_signup"] = $errors;
            header("Location: ../try_login.php");
            die();
        }

        create_user( $pdo, $username, $pwd, $email);
        header("Location: ../try_login.php?signup=success");

        $pdo=NULL;
        $stmt=NULL;

        die();
    } catch (PDOException $e) {
        die("Query failed: ". $e->getMessage());
    }
}
else{
    header("Location: ../try_login.php");
    die();
}