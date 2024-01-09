<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {
        require_once  "try_dbh.inc.php";

        $query = "UPDATE users SET username = :username , pwd = :pwd, email = :email WHERE username = :username;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":username",$username);
        $options = [
            'cost' =>10
        ];
    
        $hashedPwd = password_hash($pwd,PASSWORD_BCRYPT,$options);
        $stmt->bindParam(":pwd",$hashedPwd);
        $stmt->bindParam(":email",$email);

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
