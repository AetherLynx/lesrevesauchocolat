<?php
include("conexion.php");
include("../phpfuncs/main.php");

$user_id = $_SESSION["user_id"];

$sql = "SELECT order_id, order_state FROM orders WHERE order_user='$user_id' AND final_state=0";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $order_state = $row["order_state"];
    $order_id = $row["order_id"];

    if ($order_state == "Pedido entregado") {
        $confirmed = "Confirmado como recibido";
        $sql = "UPDATE orders SET order_state='$confirmed', final_state=1 WHERE order_user='$user_id'";
        if ($conn->query($sql) === TRUE) {
            setPopup("Gracias por confirmar! Esperamos que estés satisfecho con tu compra ;)", "../ordersquery.php");
        } else {
            $sqlerror = $conn->error;
            setPopup("Error: $sqlerror", "../ordersquery.php");
        }
    }
}
