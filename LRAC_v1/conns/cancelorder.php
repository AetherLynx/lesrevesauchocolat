<?php
include("../conns/conexion.php");
include("../phpfuncs/main.php");

$sql = "SELECT order_id, order_state, final_state FROM orders WHERE order_user='{$_SESSION["user_id"]}' AND final_state=0";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $order_state = $row["order_state"];

    if (isset($_GET["asRejected"])) {
        if ($order_state == "Pedido rechazado") {
            $sql = "DELETE FROM orders WHERE order_user='{$_SESSION["user_id"]}' AND final_state=0";
            if (!($conn->query($sql) === TRUE)) {
                $error = $conn->error;
                setPopup("Hubo un error al cancelar tu orden.", "../ordersquery.php");
                echo "<script>console.log('$error')</script>";
                die();
            }

            setPopup("Lamentamos que tu pedido haya sido rechazado.<br>Hemos borrado tu pedido exitosamente.", "../ordersquery.php");
            die();
        }
    }

    if ($order_state == "Pedido enviado") {
        $sql = "DELETE FROM orders WHERE order_user='{$_SESSION["user_id"]}' AND final_state=0";

        if ($conn->query($sql) === TRUE) {
            header("location: ../ordersquery.php");
        } else {
            echo "Error: $conn->error";
            die();
        }
    } elseif ($order_state != "Pedido enviado") {
        setPopup("No puedes cancelar una orden si ya fue recibida por nosotros.", "../ordersquery.php");
    }
} elseif ($result->num_rows > 1 || $result->num_rows < 1) {
    header("location: ../ordersquery.php");
}