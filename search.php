<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $userSearch = $_POST["usersearch"];

    try {
        require_once  "includes/try_dbh.inc.php";

        $query = "SELECT * from comments WHERE username =:usersearch;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":usersearch",$userSearch);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;
    } catch (PDOException $e) {
        die("Query failed: ". $e->getMessage());
    }
}
else{
    header("Location: ../try_login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet">
    <title>search</title>
</head>
<body>

<section>

    <h3>Search results:</h3>

    <?php
    
    if(empty($results)){
        echo "<div>";
        echo "<p>no result</p>";
        echo "</div>";
    }
    else{
        $i=1;
        foreach($results as $row){
            echo "<div>";
           if($i){
            echo "<h4>". "name: " . htmlspecialchars($row["username"]) . "</h4>";
            $i=0;
           }
            echo "<p>" . "comment: " . htmlspecialchars($row["comment_text"]) . "</p>";
            echo "<p>" . "date: " . htmlspecialchars($row["created_at"]) . "</p>";
            echo "</div>";
        }
    }


    ?>
   
</section>

</body>
</html>