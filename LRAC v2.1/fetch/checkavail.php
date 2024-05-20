<?php
include("../conns/conexion.php");

$optionExists = false;
$productCheck = $_GET["product"];
$productOption = $_GET["option"];
$userId = $_SESSION["user_id"];


$sql = "SELECT * FROM scdata WHERE user_id='$userId' AND user_product='$productCheck' AND sc_prodOption='$productOption'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $optionExists = true;
}

header('Content-Type: application/json');
echo json_encode(['success' => $optionExists]);
