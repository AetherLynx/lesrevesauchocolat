<?php
session_start(); //(se me olvido colocar esto y me quedé 3 horas pensando pq no funcionaba)
$_SESSION["loggedin"] = false;
$_SESSION["action_logout"] = true;
header("location: ../login.php");