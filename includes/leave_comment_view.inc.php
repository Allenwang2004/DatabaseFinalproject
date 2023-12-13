<?php

function check_empty_comment(){
    if(isset( $_SESSION["errors_leave_comment"])){
        echo "Cannot leave empty comment";
        unset($_SESSION["errors_leave_comment"]);
    }
    else 
    {   
        echo "You made a comment";
    }
}