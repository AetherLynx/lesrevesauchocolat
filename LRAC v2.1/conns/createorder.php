<?php
include("conexion.php");
include("../phpfuncs/main.php");


$sql = "SELECT order_user, final_state FROM orders WHERE order_user='{$_SESSION["user_id"]}' AND final_state='0'";
$result = $conn->query($sql);

$preference = [null];
$preference_data = null;

//(trans flag emoji)
$trans_preferences = [
    "",
    "Usar harinas diabéticas",
    "Lácteos deslactosados",
    "Endulzar con Stevia",
    "Sin azúcares",
    "Remover alérgenos posibles",
    "Recibir el producto en casa/apt",
    "Dejar en portería de la unidad/casa",
    "Excluír cafeína",
    "Leche de almendras",
    "Leche de avena"
];

$done_i = 0;

for ($i = 0; $i < 11; $i++) {
    if (isset($_POST["$i"])) {
        $preference[$i] = $trans_preferences[$i];
        $done_i++;
        if ($done_i != 1) {
            $preference_data = $preference_data . ", " . $preference[$i];
        } else {
            $preference_data = $preference_data . $preference[$i];
        }
    } else {
        $preference[$i] = null;
    }
}

if ($result->num_rows < 1) {
    //echo "no orders from {$_SESSION["user_id"]}! :)";

    //echo "<br>PRODUCTS: <br>";

    $product_array = $_SESSION["sc_productArray"];
    $product_arrayDesc = $_SESSION["sc_productArrayDesc"];
    $product_arrayAmount = $_SESSION["sc_productArrayAmount"];


    foreach ($product_array as $index => $render) {
        //echo "- $render, $product_arrayDesc[$index], $product_arrayAmount[$index]<br>";
    }

    $products_data = implode(", ", $product_array);
    $options_data = implode(", ", $product_arrayDesc);
    $amounts_data = implode(", ", $product_arrayAmount);

    //echo "PRODUCTS: $products_data<br>OPTIONS: $options_data<br>AMOUNTS: $amounts_data";

    //clean data for db
    $order_user = $_SESSION["user_id"];
    $order_username = $_SESSION["user_name"];
    date_default_timezone_set("America/Bogota");
    $order_date = date("Y/m/d");
    $order_address = $_SESSION["user_address"];
    $order_state = "Pedido enviado";
    //enviado -> recibido -> rechazado/creando -> despachado -> entregado -> recibido
    $order_product_id = $products_data;
    $order_product_options = $options_data;
    $order_product_amount = $amounts_data;
    $order_total = $_SESSION["data_finalPrice"];

    $sql = "INSERT INTO orders (order_id, order_user, order_username, order_date, order_address, order_state, order_product_id, order_product_options, order_product_amount, order_total, order_preferences) VALUES (NULL, '$order_user', '$order_username', '$order_date', '$order_address', '$order_state', '$order_product_id', '$order_product_options', '$order_product_amount', '$order_total', '$preference_data')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION["order_created"] = true;

        $sql = "SELECT ordersCant FROM userdata WHERE userid='$order_user'";
        $result = $conn->query($sql);

        if (!($result->num_rows > 0)) {
            setPopup("No se pudo contar esta orden a tus estadísticas.", "../bridge_order.php");
            die();
        }

        $row = $result->fetch_assoc();
        $ordersCant = intval($row["ordersCant"]);
        $sql = "UPDATE userdata SET ordersCant='" . ++$ordersCant . "' WHERE userid='$order_user'";
        if (!($conn->query($sql) === TRUE)) {
            setPopup("No se pudo contar esta orden a tus estadísticas.", "../bridge_order.php");
            die();
        }

        header("location: ../bridge_order.php");
    } else {
        //echo "Error: $sql<br>!!: $conn->error";
    }
} else {
    //echo "there's $result->num_rows order(s) from {$_SESSION["user_id"]} :(";
    setPopup("Ya tienes una orden pendiente! Consulta tu pagina de Ver tu pedido activo.", "../shopcart.php");
}