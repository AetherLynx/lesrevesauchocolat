<?php
include("../phpfuncs/main.php");
if (!isset($_SESSION)) {
    session_start();
}

session_unset(); //clear ALL session variables
setPopup("Tu sesión fue cerrada exitosamente.", "../login.php");
