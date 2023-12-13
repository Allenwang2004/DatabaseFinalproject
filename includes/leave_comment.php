<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $usercomment = $_POST["usercomment"];

    try {
        require_once 'config_session.inc.php';

        if(empty($usercomment)){
            $_SESSION["errors_leave_comment"] = "empty comment";
            header("Location: ../try_login.php");
            die();
        }

        require_once  "try_dbh.inc.php";

        $query = "INSERT INTO comments (username,comment_text,users_id) VALUES (:username,:comment_text,:userid);";
        $stmt = $pdo->prepare($query);

        $stmt ->bindParam(":username",$_SESSION["user_username"]);
        $stmt ->bindParam(":userid",$_SESSION["user_id"]);
        $stmt ->bindParam(":comment_text",$usercomment);
        $stmt->execute();

        $pdo = null;
        $stmt = null;
        header("Location: ../try_login.php");
        die();
    } catch (PDOException $e) {
        die("Query failed: ". $e->getMessage());
    }
}
else{
    header("Location: ../try_login.php");
    die();
}