<?php
include("conexion.php");
include("../phpfuncs/main.php");

adminconnChecker();

if (!isset($_SESSION["admin_curOrderby"])) {
    $_SESSION["admin_curOrderby"] = "0";
}

$query = $_SESSION["admin_curOrderby"];

if (!isset($_GET["type"])) {
    setPopup("No hay un tipo de solicitud definida.", "../adminorders.php?orderby=$query");
    die();
}

$requestType = $_GET["type"];
$order_id = $_GET["order"];

switch ($requestType) {
    case "state": //order state
        $subRequest = $_GET["state"];
        $sql = "SELECT order_user, order_state, final_state FROM orders WHERE order_id='$order_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $order_state = $row["order_state"];
            $order_user = $row["order_user"];
            $final_state = $row["final_state"];

            $gotIndex = array_search($order_state, $states_index); //states_index global from phpfuncs

            if ($subRequest == "back") {

                if ($gotIndex == 1) {
                    setPopup("No puedes desmarcar un pedido como recibido por nosotros.", "../adminorders.php?orderby=$query");
                    die();
                }

                if ($gotIndex == 6) {
                    setPopup("No puedes editar un pedido ya finalizado.", "../adminorders.php?orderby=$query");
                    die();
                }

                $new_index = $gotIndex - 1;

                if ($new_index == 2) {
                    $new_index = 1; //skipping Pedido rechazado
                }

                $new_state = $states_index[$new_index];
            } else if ($subRequest == "next") {

                if ($gotIndex == 5) {
                    setPopup("El siguiente estado solo puede ser establecido por el usuario. (Pedido entregado --X--> Confirmado como recibido)", "../adminorders.php?orderby=$query");
                    die();
                }

                if ($gotIndex == 6) {
                    setPopup("El pedido ha finalizado, no hay otro estado de pedido.", "../adminorders.php?orderby=$query");
                    die();
                }

                $new_index = $gotIndex + 1;

                if ($new_index == 2) {
                    $new_index = 3; //skipping Pedido rechazado
                }

                $new_state = $states_index[$new_index];
            }

            if ($final_state != 1) {
                createNotification($conn, $order_user, '5', 'ordersquery.php');
            }

            $sql = "UPDATE orders SET order_state='$new_state' WHERE order_id='$order_id'";

            if ($conn->query($sql) === TRUE) {
                setPopup("Se actualizó el estado de la orden como [$new_state]. ($gotIndex -> $new_index)", "../adminorders.php?orderby=$query");
                die();
            } else {
                $error = $conn->error;
                setPopup("Error del SQL: $error", "../adminorders.php?orderby=$query");
                die();
            }
        }
        break;
    case "rejectorder":
        $dreason = $_POST["dreason"];
        $sql = "SELECT order_user, order_state FROM orders WHERE order_id='$order_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $order_state = $row["order_state"];
            $order_user = $row["order_user"];

            if ($order_state == "Pedido rechazado") {
                setPopup("El pedido ya está definido como rechazado.", "../adminorders.php?orderby=$query");
                die();
            }

            if ($order_state != "Pedido recibido") {
                setPopup("No se puede rechazar un pedido que no tenga de estado [Pedido recibido].", "../adminorders.php?orderby=$query");
                die();
            }

            $sql = "UPDATE orders SET order_state='Pedido rechazado' WHERE order_id='$order_id'";

            if (!($conn->query($sql) === TRUE)) {
                $error = $conn->error;
                setPopup("Error del SQL: $error", "../adminorders.php?orderby=$query");
                die();
            }

            $sql = "UPDATE orders SET order_dreason='$dreason' WHERE order_id='$order_id'";
            //JAJA NO PUSE WHERE Y SE RECHAZABAN TODOS LOS PEDIDOS EXISTENTES :D
            //(los del sena)

            if (!($conn->query($sql) === TRUE)) {
                $error = $conn->error;
                setPopup("Error del SQL: $error", "../adminorders.php?orderby=$query");
                die();
            }

            createNotification($conn, $order_user, '8', 'ordersquery.php');

            setPopup("Se estableció el pedido #$order_id como rechazado.", "../adminorders.php?orderby=$query");
            die();
        }

        break;

    case "deleteorder":
        $sql = "DELETE FROM orders WHERE order_id='$order_id'";

        if (!($conn->query($sql) === TRUE)) {
            $error = $conn->error;
            setPopup("Error del SQL: $error", "../adminorders.php?orderby=$query");
            die();
        }

        setPopup("Se eliminó la orden #$order_id.", "../adminorders.php?orderby=$query");
        die();
}
