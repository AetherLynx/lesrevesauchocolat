<?php
include("../conns/conexion.php");
$sql = "SELECT * FROM scdata WHERE user_mail = '" . $_SESSION["user_mail"] . "' AND user_product = '" . $_SESSION["session_curProductId"] . "'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    //data already exists, redirect only
    $sql = "DELETE FROM scdata WHERE user_mail = '" . $_SESSION["user_mail"] . "' AND user_product = '" . $_SESSION["session_curProductId"] . "'";
    if ($conn->query($sql) === TRUE) {
        header("location: ../viewproduct.php?id=" . $_SESSION["session_curProductId"] . "&confirmAdd=0&sc={$_SESSION["session_origin"]}");
    }
} else {
    //data doesn't exist, add data and redirect
    $sql = "INSERT INTO scdata (user_mail, user_product) VALUES ('" . $_SESSION["user_mail"] . "', '" . $_SESSION["session_curProductId"] . "')";
    if ($conn->query($sql) === TRUE) {
        header("location: ../viewproduct.php?id=" . $_SESSION["session_curProductId"] . "&confirmAdd=1&sc={$_SESSION["session_origin"]}");
    }
}

//rip ?confirmAdd
//hijueputa vida
// 8 / 02 / 24