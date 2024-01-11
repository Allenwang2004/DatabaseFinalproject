<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $region = $_POST['selected_region'];

    try {
        require_once  "try_dbh.inc.php";
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';
        
        //error handle
        $errors = [];
        
        if(is_input_empty($username,$pwd,$region)){
            $errors["empty_input"] = "fill in all fields";
        }
        if(is_username_taken($pdo, $username)){
            $errors["username_taken"] = "username taken";
        }

        require_once 'config_session.inc.php';

        if($errors){

            $_SESSION["errors_signup"] = $errors;
            header("Location: ../try_login.php");
            die();
        }

        create_user( $pdo, $username, $pwd, $region);
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