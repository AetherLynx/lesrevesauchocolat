<?php
include("../conns/conexion.php");

$sql = "SELECT order_id FROM orders WHERE order_user='{$_SESSION["user_id"]}'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $sql = "DELETE FROM orders WHERE order_user='{$_SESSION["user_id"]}'";

    if ($conn->query($sql) === TRUE) {
        header("location: ../ordersquery.php");
    } else {
        echo "Error: $conn->error";
        die();
    }
} elseif ($result->num_rows > 1 || $result->num_rows < 1) {
    header("location: ../ordersquery.php");
}