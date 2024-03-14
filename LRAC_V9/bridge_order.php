<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="files/placeholdericon.png" type="image/x-icon">
    <script src="scripts/icons.js"></script>
    <title>¡Tu pedido fue exitoso!</title>

    <div style=" position: absolute;">
        <?php
        include("conns/conexion.php");
        ?>
    </div>

</head>

<body>
    <?php
    include("common/sidebar.php");
    include("common/navbar.php");
    include("phpfuncs/main.php");
    changeColorsPRESET("lime");
    ?>
    <div class='undernav'>
        <div class='bodybg'>
            <?php

            $sql = "SELECT * FROM orders WHERE order_user='{$_SESSION["user_id"]}' AND final_state=0";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                $order_id = $row["order_id"];
                $order_username = $row["order_username"];
                $order_date = $row["order_date"];
                $order_address = $row["order_address"];
                $order_state = $row["order_state"];
                $order_product_id = $row["order_product_id"];
                $order_product_options = $row["order_product_options"];
                $order_product_amount = $row["order_product_amount"];
                $order_total = $row["order_total"];

                $op_id_arr = explode(", ", $order_product_id);
                $op_options_arr = explode(", ", $order_product_options);
                $op_amount_arr = explode(", ", $order_product_amount);

                if (isset($_SESSION["order_created"])) {
                    $header = "
                    <h1>¡Tu pedido fué creado exitosamente!</h1>
                    <p class='main-medfont'>
                        A continuación te mostramos los detalles de tu pedido.
                    </p>
                    ";
                } else {
                    $header = "
                    <p class='main-medfont'>
                        Este es el recibo correspondiente a tu pedido más reciente.
                    </p>
                    ";
                }

                echo "

                    <div class='main-textcenter'>
                    $header
                    </div>

                    <div class='main-bordercont main-start' style='width: 50em' id='receipt'>
                    <h2 t='bb' class='main-maxw main-textcenter'>Comprobante de tu pedido</h2>
                    <p class='main-medfont'>Nombre: $order_username</p>
                    
                    <p class='main-medfont'>Número de orden (ID): $order_id</p>
                    <p class='main-medfont'>Dirección de entrega: $order_address</p>
                    <p class='main-medfont'>Fecha de creación del pedido: " . formatDate($order_date) . "</p>
                    <p class='main-medfont'>Estado de tu orden: $order_state</p>
                    
                    <br>
                    <h2 t='bb' class='main-maxw main-textcenter'>Productos que pediste</h2>
                    <div class='main-fontgrandstander main-darkcont2 main-maxw'>
                    ";

                $tempprice = 5000;
                foreach ($op_id_arr as $index => $render) {
                    $sql = "SELECT product_name, product_uniprice FROM productdata WHERE product_id='$op_id_arr[$index]'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $product_name = $row["product_name"];
                    $product_uniprice = $row["product_uniprice"];

                    if ($op_options_arr[$index] == "") {
                        $option_fixed = "SIN OPCIÓN";
                    } else {
                        $option_fixed = $op_options_arr[$index];
                    }
                    echo "<p class='main-medfont'>• $product_name - $op_amount_arr[$index] UNDS - " . formatCOP($product_uniprice) . " C/U - $option_fixed</p>";
                }

                echo "
                    </div>
                    
                    <h2 class='main-maxw main-textcenter'>Total a pagar: $" . formatCOP($order_total) . "</h2>

                    <h2 t='bb' class='main-maxw main-textcenter'>Importante</h2>
                    <p class='main-medfont'>• Si pediste una orden personalizada, nuestros empleados pueden revisar
                        las características de tu creación desde la página, no incluimos los
                        detalles en el recibo para tener mejor orden :^)
                    </p>
                    <br>
                    <p class='main-medfont'>• Puedes ir al apartado de Consultar Pedidos en tu menú de
                        la derecha para verificar el estado de tu pedido, revisalo si quieres estar
                        actualizad@ con los detalles que necesites!
                    </p>
                    </div>
                ";
            } else {
                echo "<p>Se encontró más de una orden realizada, esto es un error de<br>
                            parte de nosotros, por favor contáctanos y muéstranos este error.</p>";
            }

            unset($_SESSION["order_created"]);
            ?>

            <a class='icontext' href='ordersquery.php'>
                <script>
                    document.write(trackb)
                </script>
                <p>Consultar tu pedido</p>
            </a>
        </div>
    </div>
</body>

</html>