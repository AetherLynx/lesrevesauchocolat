<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="files/placeholdericon.png" type="image/x-icon">
    <script src="scripts/icons.js"></script>
    <title>Consulta de pedido</title>
    <div style="position: absolute;">
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
    changeColorsPRESET("dark");
    ?>
    <dialog id='dialogStates'>
        <h1 class='main-textcenter'>Como identificar el estado de tu pedido</h1>
        <div class='main-start'>

            <div class='main-rowcenter'>
                <div class='main-iconmsides'>
                    <script>
                    document.write(CUSTOM_STATE01)
                    </script>
                </div>
                <p class='main-medfont'>Pedido enviado: Tu pedido fue creado y está guardado en nuestra
                    base de datos,<br> espera a que un trabajador note tu pedido.
                </p>
            </div>

            <div class='main-rowcenter'>
                <div class='main-iconmsides'>
                    <script>
                    document.write(CUSTOM_STATE02)
                    </script>
                </div>
                <p class='main-medfont'>Pedido recibido: Ya recibimos tu pedido! Lo revisaremos y te
                    notificaremos si lo rechazamos o lo aceptamos.
                </p>
            </div>

            <div class='main-rowcenter'>
                <div class='main-iconmsides'>
                    <script>
                    document.write(CUSTOM_STATE030)
                    </script>
                </div>
                <p class='main-medfont'>Pedido rechazado: Hubo un problema con tu pedido y lo rechazamos.<br>
                    También te mostraremos un mensaje detallando la razón.
                </p>
            </div>

            <div class='main-rowcenter'>
                <div class='main-iconmsides'>
                    <script>
                    document.write(CUSTOM_STATE031)
                    </script>
                </div>
                <p class='main-medfont'>Creado pedido: Tu pedido fue aceptado y ya nos pusimos manos a la obra con ello.
                </p>
            </div>

            <div class='main-rowcenter'>
                <div class='main-iconmsides'>
                    <script>
                    document.write(CUSTOM_STATE04)
                    </script>
                </div>
                <p class='main-medfont'>Pedido despachado: Tu pedido ya viene en camino! Alístate para recibirlo.
                </p>
            </div>

            <div class='main-rowcenter'>
                <div class='main-iconmsides'>
                    <script>
                    document.write(CUSTOM_STATE05)
                    </script>
                </div>
                <p class='main-medfont'>Pedido entregado: El repartidor marcó que ya entregó tu pedido, si vives en una casa probablemente ya hayas hablado<br>
                    con el repartidor, si vives en un conjunto residencial puede haberlo dejado en portería, si hay algún problema contáctanos.
                </p>
            </div>

            <div class='main-rowcenter'>
                <div class='main-iconmsides'>
                    <script>
                    document.write(CUSTOM_STATE06)
                    </script>
                </div>
                <p class='main-medfont'>Confirmado como recibido: Tu debes marcar tu pedido como recibido para completar tu orden.
                </p>
            </div>
        </div>
        <button id='orderstates_hide' t='alt' class='main-maxw'>
            Cerrar ventana
        </button>
    </dialog>


    <dialog id='dialogCancelOrder'>
        <h1 class='main-textcenter'>¿Estás seguro que deseas cancelar tu orden?</h1>

        <p class='main-medfont'>Solo cancela tu orden si cometiste un error al crearla,
            o si quieres hacer un cambio.
        </p>

        <a href='conns/cancelorder.php' class='main-maxw butt main-center' t='alt'>
            Si, cancelar mi orden
        </a>
        <button id='orderx_hide' t='alt' class='main-maxw'>
            No, cambié de opinión
        </button>
    </dialog>


    <dialog id='dialogConfirmOrder'>
        <h1 class='main-textcenter'>¿Todo listo?</h1>

        <p class='main-medfont main-textcenter'>
            Solo confirma tu orden si recibiste tu pedido y no se presentan problemas,<br>
            una vez marcas el pedido como recibido no puedes hacer reclamos.
        </p>

        <a href='conns/confirmReceived.php' class='main-maxw butt main-center' t='alt'>
            Si, confirmar que recibí mi pedido
        </a>
        <button id='confirm_hide' t='alt' class='main-maxw '>
            No, no he recibido mi pedido
        </button>
    </dialog>

    <!-- BODY -->
    <div class="undernav">
        <div class="bodybg">
            <?php

            renderPopup();

            function stateCheck($value)
            {
                switch ($value) {
                    case "Pedido enviado":
                        return "
                        <script>
                                document.write(CUSTOM_STATE01);
                            </script>
                        <h1 class='main-textleft main-maxw'>$value</h1>
                        ";

                    case "Pedido recibido":
                        return "
                        <script>
                                document.write(CUSTOM_STATE02);
                            </script>
                        <h1 class='main-textleft main-maxw'>$value</h1>
                        ";

                    case "Pedido rechazado":
                        return "
                        <script>
                                document.write(CUSTOM_STATE030);
                            </script>
                        <h1 class='main-textleft main-maxw'>$value</h1><br>
                        ";

                    case "Creando pedido":
                        return "
                        <script>
                                document.write(CUSTOM_STATE031);
                            </script>
                        <h1 class='main-textleft main-maxw'>$value</h1>
                        ";

                    case "Pedido despachado":
                        return "
                        <script>
                                document.write(CUSTOM_STATE04);
                            </script>
                        <h1 class='main-textleft main-maxw'>$value</h1>
                        ";

                    case "Pedido entregado":
                        return "
                        <script>
                                document.write(CUSTOM_STATE05);
                            </script>
                        <h1 class='main-textleft main-maxw'>$value</h1>
                        ";

                    case "Confirmado como recibido":
                        return "
                        <script>
                                document.write(CUSTOM_STATE06);
                            </script>
                        <h1 class='main-textleft main-maxw'>$value</h1>
                        ";
                }
            }

            function buttonOrderCheck($var)
            {
                if ($var == "Pedido entregado") {
                    return "
                    <button id='confirm_show' class='icontext main-buttonpadding'>
                        <script>
                            document.write(checkb)
                        </script>
                        <p>Confirmar pedido como recibido</p>
                    </button>
                    ";
                } else {
                    return
                        "
                    <button id='confirm_show' class='icontext main-buttonpadding' disabled>
                        <script>
                            document.write(checkb)
                        </script>
                        <p>Confirmar pedido como recibido</p>
                    </button>
                    ";
                }
            }

            function cancelOrder_check($value)
            {
                if ($value == "Pedido enviado") {
                    return "
                    <button id='orderx_show' class='icontext main-buttonpadding'>
                    <script>
                    document.write(xb)
                    </script>
                    <p>Cancela tu pedido</p>
                    </button>
                    ";
                } else {
                    return "
                    <button id='orderx_show' class='icontext main-buttonpadding' disabled>
                    <script>
                    document.write(xb)
                    </script>
                    <p>Cancela tu pedido</p>
                    </button>
                    ";
                }
            }

            $sql = "SELECT * FROM orders WHERE order_user='{$_SESSION["user_id"]}' AND final_state=0";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                $order_id = $row["order_id"];
                $order_user = $row["order_user"];
                $order_username = $row["order_username"];
                $order_date = $row["order_date"];
                $order_address = $row["order_address"];
                $order_state = $row["order_state"];
                $order_product_id = $row["order_product_id"];
                $order_product_options = $row["order_product_options"];
                $order_product_amount = $row["order_product_amount"];
                $order_total = $row["order_total"];

                $order_dreason = $row["order_dreason"];

                $op_id_arr = explode(", ", $order_product_id);
                $op_options_arr = explode(", ", $order_product_options);
                $op_amount_arr = explode(", ", $order_product_amount);


                $stateOrder_check = stateCheck($order_state);
                $buttonOrder_check = buttonOrderCheck($order_state);
                $cancelOrder_check = cancelOrder_check($order_state);

                echo "
            <h1>Orden #$order_id</h1>

            <div class='main-row main-maxw'>
                <a href='bridge_order.php' class='icontext'>
                    <script>
                        document.write(receiptb)
                    </script>
                    <p>Ver comprobante</p>
                </a>
                <button id='orderstates_show' class='icontext main-buttonpadding'>
                    <script>
                        document.write(questionb)
                    </script>
                    <p>Acerca de los estados del pedido</p>
                </button>
                $cancelOrder_check
                $buttonOrder_check
            </div>

            <div class='main-rowhc main-maxw'>

                <div class='main-maxh' style='width: calc(20% - 2em);'>
                    <img src='files/userpfp/{$_SESSION["user_pfp"]}' type='pfp2'>
                    <p class='main-textcenter'>Información de entrega</p>
                    <div class='main-bordercont2 main-nm main-maxh'>
                        <p>Nombre: $order_username</p>
                        <p>Dirección: $order_address</p>
                        <p>Creado el " . formatDate($order_date) . "</p>
                        <br>
                        <p class='main-medfont'>Total: $" . formatCOP($order_total) . "</p>
                    </div>
                    <br>
                    <h2 class='main-textcenter'>¡Importante!</h2>
                    <div class='main-bordercont2 main-nm main-maxh'>
                        <p>Los datos de este pedido son fijos, el precio de cada producto, 
                        tu nombre, el valor final a pagar, no serán afectados si el precio 
                        de algún producto que pediste cambia, si te cambias el nombre después de 
                        hacer tu pedido, etc.
                        </p>
                    </div>
                </div>

                <div class='main-nm' style='width: calc(80% - 2em)'>
                    <div class='main-row main-maxw main-bordercont2 main-nm'>
                        <div class='main-rowcenter main-maxw main-bordercont2 oq_iconfix'>
                            $stateOrder_check;
                        </div>
                        ";

                if ($order_state == "Pedido rechazado") {
                    echo <<<HTML
                        <div class='main-maxw main-bordercont2'>
                            <h1>¡Tu pedido fué rechazado por nosotros! :(</h1>
                            <p class='main-medfont'>La razón por la que lo rechazamos fué: $order_dreason</p>
                            <br>
                            <p class='main-medfont'>Si hay alguna inconformidad no dudes en contactarnos.</p>
                            <a href='conns/cancelorder.php?asRejected' class='icontext butt' t='alt'>
                                <script>
                                    icon("2em", "2em", 'eraser')
                                </script>
                                Eliminar tu orden
                            </a>
                        </div>
                    HTML;
                }

                echo "
                        <h1 class='main-textleft main-maxw'>Productos pedidos</h1>

                        
                        ";

                foreach ($op_id_arr as $index => $render) {
                    $sql = "SELECT product_image, product_name, product_uniprice, product_category FROM productdata WHERE product_id='$op_id_arr[$index]'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $product_image = $row["product_image"];
                    $product_name = $row["product_name"];
                    $product_category = $row["product_category"];
                    $product_uniprice = $row["product_uniprice"];

                    if ($product_category == "Creacion") {
                        $src = "files/products/custom/$product_image";
                        $customfit = "object-position: 50% 80%;";
                    } else {
                        $src = "files/products/$product_image";
                        $customfit = "";
                    }

                    if ($op_options_arr[$index] == "") {
                        $option_fixed = "SIN OPCIÓN";
                    } else {
                        $option_fixed = $op_options_arr[$index];
                    }

                    echo "
                        <a class='orderquery-product' href='viewproduct.php?id=$op_id_arr[$index]&sc=2'>
                            <img src='$src' type='oq' style='$customfit'>
                            <div class='main-start'>
                                <h1>$product_name</h1>
                                <p class='main-medfont'>$" . formatCOP($product_uniprice) . "</p>
                                <p class='main-medfont'>$op_amount_arr[$index] unidad(es)</p>
                                <p class='main-medfont'>$option_fixed</p>
                            </div>
                        </a>
                    ";
                }

                echo "
                        </div>
                    </div>
                </div>
                ";
            } elseif ($result->num_rows > 1 && $row["final_state"] == 0) {
                echo "<h1>Encontramos más de un pedido para tu usuario</h1>
                <p>Esto es un error, por favor contáctate con los administradores.</p>";
            } else {
                echo "
                <h1>No tienes ningún pedido activo!</h1>
                <p class='main-textcenter'>Si ya tienes productos en tu carrito, puedes realizar un pedido.<br>
                De lo contrario, añade productos a tu carrito desde nuestro catálogo!</p>
                <div class='main-rowcenter'>
                    <a href='catalogue.php?filter=0' class='icontext'>
                        <script>
                            document.write(breadb);
                        </script>
                        <p>Ir al catálogo</p>
                    </a>

                    <a href='shopcart.php' class='icontext'>
                    <script>
                        document.write(cartb);
                    </script>
                    <p>Carrito de compras</p>
                </a>
                </div>
                ";
            }
            ?>
        </div>
    </div>
</body>
<script>
document.addEventListener("DOMContentLoaded", function() {

    var dialogStates = document.getElementById('dialogStates');
    var openStates = document.getElementById('orderstates_show');
    var closeStates = document.getElementById('orderstates_hide');

    openStates.onclick = function() {
        dialogStates.showModal();
    }

    closeStates.onclick = function() {
        dialogStates.close();
    }


    var dialogOrderX = document.getElementById('dialogCancelOrder');
    var openOrderX = document.getElementById('orderx_show');
    var closeOrderX = document.getElementById('orderx_hide');

    openOrderX.onclick = function() {
        dialogOrderX.showModal();
    }

    closeOrderX.onclick = function() {
        dialogOrderX.close();
    }

    var dialogConfirmOrder = document.getElementById('dialogConfirmOrder');
    var confirmShow = document.getElementById('confirm_show');
    var confirmHide = document.getElementById('confirm_hide');

    confirmShow.onclick = function() {
        dialogConfirmOrder.showModal();
    }

    confirmHide.onclick = function() {
        dialogConfirmOrder.close();
    }
});
</script>

</html>