<?php
include("../conns/conexion.php");
include("../phpfuncs/main.php");

$url = "../viewproduct.php?id={$_SESSION["session_curProductId"]}&sc={$_SESSION["session_origin"]}";
$id = $_GET["id"];
$user_id = $_SESSION["user_id"];
$prodOptionStr = "";

if (isset($_POST["prodAmount_set"])) {
    $prodAmount = $_POST["product_amount"];
    $prodOption = $_POST["product_option"];
    $prodOptionStr = " AND sc_prodOption='$prodOption'";
}

if ($_SESSION["session_origin"] == "4") {
    $profileOrigin = $_SESSION["profileOrigin"];
    $url = $url . "&viewing=$profileOrigin";
}

if (isset($_GET["fromSC"])) {
    $url = "../shopcart.php";
    $id = $_GET["id"];

    if (isset($_GET["po"])) {
        $prodOption = $_GET["po"];
        $prodOptionStr = " AND sc_prodOption='$prodOption'";
    }
}

$sql = "SELECT user_id FROM scdata WHERE user_id='$user_id' AND user_product='$id'" . $prodOptionStr;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sql = "DELETE FROM scdata WHERE user_id='$user_id' AND user_product='$id'" . $prodOptionStr;
    if (!($conn->query($sql) === TRUE)) {
        setPopup("Hubo un error eliminando el producto de tu carrito.", $url);
        die();
    }
    setPopup("El producto fue eliminado de tu carrito. :(", $url);
    die();
}

$sql = "INSERT INTO scdata(user_id, user_product, sc_prodAmount, sc_prodOption) VALUES ('$user_id', '$id', '$prodAmount', '$prodOption')";
if (!($conn->query($sql) === TRUE)) {
    setPopup("Hubo un error añadiendo el producto a tu carrito.", $url);
    die();
}
setPopup("El producto fue añadido a tu carrito!", $url);
die();

/*
old code

$sql = "SELECT * FROM scdata WHERE user_id='{$_SESSION["user_id"]}' AND user_product='$whatProduct' AND sc_prodOption='$prodOption'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    //data already exists, redirect only
    $sql = "DELETE FROM scdata WHERE user_id = '" . $_SESSION["user_id"] . "' AND user_product = '" . $_SESSION["session_curProductId"] . "' AND sc_prodOption='$prodOption'";
    if (!($conn->query($sql) === TRUE)) {
        $error = $conn->error;
        setPopup("Hubo un error borrando el producto a tu carrito.<br>$error", "$url");
        die();
    }

    setPopup("El producto fue eliminado de tu carrito. :(", "$url");
} else {
    //data doesn't exist, add data and redirect
    $sql = "INSERT INTO scdata (user_id, user_product, sc_prodAmount, sc_prodOption) VALUES ('" . $_SESSION["user_id"] . "', '" . $_SESSION["session_curProductId"] . "', '$prodAmount', '$prodOption')";
    if (!($conn->query($sql) === TRUE)) {
        $error = $conn->error;
        setPopup("Hubo un error añadiendo el producto a tu carrito.<br>$error", "$url");
    }

    setPopup("El producto fue añadido a tu carrito! :)", "$url");
}
*/

//rip ?confirmAdd
//hijueperra vida
// 8 / 02 / 24