<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';
require_once 'includes/leave_comment_view.inc.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>account</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <h3>
        <?php output_username();?>
    </h3>

    <div class="text-center">
    
    <h3>Logout</h3>
    <form action = "includes/logout.inc.php" method="post">
        <button>Logout</button>
    </form>
    

    <h3>Change Account</h3>
    <form action = "includes/userupdate.inc.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="pwd" placeholder="Password">
        <input type="hidden" name="selected_region" id="selectedRegion" value="">
        <select onchange="handleSelectChange(this)">
                <option>桃園區</option>
                <option>中壢區</option>
                <option>平鎮區</option>
                <option>八德區</option>
                <option>楊梅區</option>
                <option>蘆竹區</option>
                <option>大溪區</option>
                <option>龜山區</option>
                <option>大園區</option>
                <option>觀音區</option>
                <option>新屋區</option>
                <option>龍潭區</option>
                <option>復興區</option>
            </select>
        <button>Change</button>
    </form>
    <?php check_password(); ?>

    <h3>Delete Account</h3>
    <form action = "includes/userdelete.inc.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="pwd" placeholder="Password">
        <button>Delete</button>
    </form>
    <?php check_password(); ?>

    <h3>Search Comment</h3>
    <form class="searchform" action = "search.php" method="post">
        <label for="search">Search for a user's comment:</label>
        <input id="search" type="text" name="usersearch">
        <button>Search</button>
    </form>
    
    <?php if(isset( $_SESSION["user_id"])){?>
    <h3>Leave a Comment</h3>
    <form action = "includes/leave_comment.php" method="post">
        <label for="search">Comment here:</label>
        <input id="search" type="text" name="usercomment">
        <button>Comment</button>
    </form>
    <?php check_empty_comment();} ?>
    
    </div>
</body>
</html>

<script>
    function handleSelectChange(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var selectedText = selectedOption.text;
        document.getElementById('selectedRegion').value = selectedText;
    }
</script>