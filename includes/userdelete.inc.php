<?php
require_once 'login_model.inc.php';
require_once  "try_dbh.inc.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $result = get_user($pdo,$username);
    try {

        if(!password_verify($pwd, $result["pwd"])){
            $_SESSION["errors_login"] = $errors;
            header("Location: ../accounts.php");
            die();
        }

        $query = "DELETE FROM users WHERE username = :username";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":username",$username);

        $stmt->execute();

        $pdo = null;
        $stmt = null;

        header("Location: ../accounts.php");

        die();
    } catch (PDOException $e) {
        die("Query failed: ". $e->getMessage());
    }
}
else{
    header("Location: ../try_login.php");
}
