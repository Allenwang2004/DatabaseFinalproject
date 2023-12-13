<?php

session_start();
session_unset();
session_destroy();

header("Location: ../try_login.php");
die();