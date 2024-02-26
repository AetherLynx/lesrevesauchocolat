<?php
if (!isset($_SESSION)) {
    session_start();
}

session_unset();

$_SESSION["loggedin"] = false;
$_SESSION["action_logout"] = true;

header("location: ../login.php");
