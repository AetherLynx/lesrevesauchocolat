<?php
include("../conns/conexion.php");
include("../phpfuncs/main.php");
if (isset($_POST["prodAmount_set"])) {
    $prodAmount = $_POST["product_amount"];
    $prodOption = $_POST["product_option"];
}

$url = "../viewproduct.php?id=" . $_SESSION["session_curProductId"] . "&sc={$_SESSION["session_origin"]}";

if ($_SESSION["session_origin"] == "4") {
    $profileOrigin = $_SESSION["profileOrigin"];
    $url = $url . "&viewing=$profileOrigin";
}

$sql = "SELECT * FROM scdata WHERE user_id='{$_SESSION["user_id"]}' AND user_product='{$_SESSION["session_curProductId"]}' AND sc_prodOption='$prodOption'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    //data already exists, redirect only
    $sql = "DELETE FROM scdata WHERE user_id = '" . $_SESSION["user_id"] . "' AND user_product = '" . $_SESSION["session_curProductId"] . "' AND sc_prodOption='$prodOption'";
    if ($conn->query($sql) === TRUE) {
        setPopup("El producto fue eliminado de tu carrito. :(", "$url");
    }
} else {
    //data doesn't exist, add data and redirect
    $sql = "INSERT INTO scdata (user_id, user_product, sc_prodAmount, sc_prodOption) VALUES ('" . $_SESSION["user_id"] . "', '" . $_SESSION["session_curProductId"] . "', '$prodAmount', '$prodOption')";
    if ($conn->query($sql) === TRUE) {
        setPopup("El producto fue añadido a tu carrito! :)", "$url");
    }
}

//rip ?confirmAdd
//hijueputa vida
// 8 / 02 / 24