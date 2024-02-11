<?php
if (!isset($_SESSION)) {
    session_start();
}

$_SESSION["loggedin"] = false;
$_SESSION["action_logout"] = true;

unset($_SESSION["user_name"]);
unset($_SESSION["user_pass"]);
unset($_SESSION["user_mail"]);
unset($_SESSION["user_q"]);
unset($_SESSION["user_qa"]);
unset($_SESSION["data_userinfoSet"]);

header("location: ../login.php");
