<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lrac_bd";
$conn = new mysqli($servername, $username, $password, $dbname);

if (!isset($_SESSION)) {
    session_start();
}

$_SESSION["data_curPage"] = basename($_SERVER['PHP_SELF'], '.php');

if ($_SESSION["data_curPage"] != "recover") {
    if ($_SESSION["data_curPage"] != "accrecovery") {
        unset($_SESSION["recov_isActive"]);
        unset($_SESSION["recov_recovData"]);
        unset($_SESSION["recov_id"]);
        unset($_SESSION["recov_question"]);
        unset($_SESSION["recov_username"]);
    }
}

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    if ($_SESSION["user_id"] == NULL or !isset($_SESSION["user_id"])) {
        include "phpfuncs/main.php";
        setPopup("Tus datos no están sincronizados con el navegador, por favor inicia sesión de nuevo.", "conns/logout.php");
        die();
    }

    $sql = "SELECT * FROM userdata WHERE userid='{$_SESSION["user_id"]}'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $_SESSION["user_id"] = $row["userid"];
    $_SESSION["user_name"] = $row["name"];
    $_SESSION["user_pass"] = $row["pass"];
    $_SESSION["user_mail"] = $row["mail"];
    $_SESSION["user_q"] = $row["question"];
    $_SESSION["user_qa"] = $row["qanswer"];
    $_SESSION["user_numtel"] = $row["numtel"];
    $_SESSION["user_role"] = $row["userRole"];
    $_SESSION["user_pfp"] = $row["pfp"];
    $_SESSION["user_address"] = $row["address"];
}