<?php
require_once 'login_model.inc.php';
require_once 'login_contr.inc.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $region = $_POST["selected_region"];

    try {
        require_once  "try_dbh.inc.php";

        $result = get_user($pdo,$username);
        if(!password_verify($pwd, $result["pwd"])){
            $_SESSION["wrong_password"] = "wrong password";
            header("Location: ../accounts.php");
            die();
        }

        $query = "UPDATE users SET username = :username , pwd = :pwd, region = :region WHERE username = :username;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":username",$username);
        $options = [
            'cost' =>10
        ];
    
        $hashedPwd = password_hash($pwd,PASSWORD_BCRYPT,$options);
        $stmt->bindParam(":pwd",$hashedPwd);
        $stmt->bindParam(":region",$region);

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
    header("Location: ../accounts.php");
}