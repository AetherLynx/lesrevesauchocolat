<?php
include "../conns/conexion.php";
include "../phpfuncs/main.php";

$cakecode = $_POST["cakecode"];

$sql = "SELECT product_id, cakecode FROM productdata WHERE cakecode='$cakecode'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(array("success" => $row['product_id']));
} else {
    echo json_encode(array("success" => false));
}