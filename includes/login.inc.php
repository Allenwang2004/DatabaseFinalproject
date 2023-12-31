<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try {
        require_once  "try_dbh.inc.php";
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        //error handle
        $errors = [];
        
        if(is_input_empty($username,$pwd)){
            $errors["empty_input"] = "fill in all fields";
        }

        $result = get_user($pdo,$username);

        if(is_username_wrong($result)){
            $errors["incorrect_username"] = "no such user";
        }

        if(!is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"])){
            $errors["incorrect_password"] = "incorrect password";
        }

        require_once 'config_session.inc.php';

        if($errors){
            $_SESSION["errors_login"] = $errors;
            header("Location: ../try_login.php");
            die();
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);
        $_SESSION["last_regeneration"]=time();

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars ($result["username"]);
        

        header("Location: ../try_login.php?login=success");

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