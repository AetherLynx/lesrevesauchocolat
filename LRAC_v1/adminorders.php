<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="files/placeholdericon.png" type="image/x-icon">
    <script src="scripts/icons.js"></script>
    <title>Consultar pedidos activos</title>

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
    changeColorsPRESET("gray");
    ?>

    <!-- BODY -->
    <div class='bodyCenter'>
        <div class='undernav'>
            <div class='bodybg'>
                <?php
                renderPopup();
                adminChecker();
                ?>
                <a class='icontext butt' href="adminindex.php" t='alt'>
                    <script>
                        icon('2em', '2em', 'back')
                    </script>
                    Volver al index
                </a>
                <div class='main-bordercont main-center main-maxw'>
                    <h1>Filtros de búsqueda</h1>
                    <div class='main-rowcenter main-nm main-wrap'>
                        <a href='?orderby=1' class='butt main-textcenter' t='alt' style='width: 15em'>Más nuevos</a>
                        <a href='?orderby=2' class='butt main-textcenter' t='alt' style='width: 15em'>Más viejos</a>
                        <a href='?orderby=3' class='butt main-textcenter' t='alt' style='width: 15em'>Activos o pendientes</a>
                        <a href='?orderby=4' class='butt main-textcenter' t='alt' style='width: 15em'>Completados o confirmados</a>
                        <a href='?orderby=5' class='butt main-textcenter' t='alt' style='width: 15em'>Pedidos rechazados</a>
                    </div>
                </div>

                <?php

                if (isset($_GET["orderby"])) {
                    $query = $_GET["orderby"];
                    $_SESSION["admin_curOrderby"] = $query;

                    switch ($query) {
                        case "0":
                            $sql = "SELECT * FROM orders";
                            echo "<h2>Ningún filtro activo</h2>";
                            break;
                        case "1":
                            $sql = "SELECT * FROM orders ORDER BY order_id DESC"; //NEWEST
                            echo "<h2>Ordenando por órdenes más nuevas</h2>";
                            break;
                        case "2":
                            $sql = "SELECT * FROM orders ORDER BY order_id"; //OLDEST
                            echo "<h2>Ordenando por órdenes más viejas</h2>";
                            break;
                        case "3":
                            $sql = "SELECT * FROM orders WHERE final_state='0'";
                            echo "<h2>Mostrando pedidos activos</h2>";
                            break;
                        case "4":
                            $sql = "SELECT * FROM orders WHERE final_state='1'";
                            echo "<h2>Mostrando pedidos cerrados</h2>";
                            break;
                        case "5":
                            $sql = "SELECT * FROM orders WHERE order_state='Pedido rechazado'";
                            echo "<h2>Mostrando pedidos rechazados</h2>";
                            break;
                        default:
                            $sql = "SELECT * FROM orders";
                            break;
                    }
                } else {
                    $sql = "SELECT * FROM orders";
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $order_user = $row["order_user"];
                        $order_username = $row["order_username"];
                        $order_id = $row["order_id"];
                        $order_date = $row["order_date"];
                        $order_state = $row["order_state"];
                        $final_state = intval($row["final_state"]);
                        $state_string = ["El pedido sigue activo.", "El pedido fue cerrado."];

                        $sql = "SELECT pfp FROM userdata WHERE userid='$order_user'";
                        $result2 = $conn->query($sql);

                        if ($result2->num_rows == 1) {
                            $row2 = $result2->fetch_assoc();
                            $order_pfp = $row2["pfp"];
                        } else {
                            $order_pfp = "default.png";
                        }

                        $formatted_date = formatDate($order_date);
                        $showicon = returnOrStIcon($order_state);

                        //BIEN TARDE ME VENGO A DAR CUENTA DE ESTO SADKLSD :(
                        echo <<<HTML
                            <div class='main-rowcenter main-maxw'>
                                    <a href='sharedorder.php?orderid=$order_id&cfa' class='adminorders_order main-maxw main-rowcenter'>
                                        <div class='main-darkbg main-maxh' style='width: 20%'>
                                            <img type='pfp3' src='files/userpfp/$order_pfp' alt=''>
                                        </div>
                                    
                                        <div style='width: 40%'>
                                            <h1>Pedido de $order_username</h1>
                                            <p class='main-medfont'>ID del pedido: #$order_id</p>
                                            <p class='main-medfont'>Creado el $formatted_date</p>
                                            <p class='main-medfont'>$state_string[$final_state]</p>
                                        </div>
                                    
                                        <div style='width: 20%'>
                                            <div class='main-columncenter'>
                                                <script>
                                                document.write($showicon);
                                                </script>
                                                <h5 class='main-medfont main-textcenter'>$order_state</h5>
                                            </div>
                                        </div>
                                    </a>
                                    
                                    <div style='width: 60%' class='main-nm'>
                                        <div class='main-rowcenter'>
                                            <div class='main-columncenter main-maxh'>
                                                <h3 class='main-nmb'>Opciones</h3>
                                                <form method='post' action='conns/admineditorder.php?type=rejectorder&order=$order_id' class='main-maxw main-nm main-np'>
                                                    <a href='conns/admineditorder.php?type=deleteorder&order=$order_id' class='icontext butt main-maxw' t='alt'>
                                                        <script>
                                                            icon("2em", "2em", 'eraser')
                                                        </script>
                                                        Eliminar #$order_id
                                                    </a>
                                                    <input name='dreason' type='text' class='main-inputalt main-widthauto' placeholder='Razón de rechazo...' required>
                                                    <button class='icontext butt main-maxw' t='alt' type='submit'>
                                                        <script>
                                                            icon("2em", "2em", xb)
                                                        </script>
                                                        Rechazar #$order_id
                                                    </button>
                                                </form>
                                            </div>
                                            <div class='main-columncenter main-maxh'>
                                                <h3 class='main-nmb'>Etapas</h3>
                                                <div class='main-rowcenter main-nm main-wrap'>
                            
                                                <a href='conns/admineditorder.php?type=state&state=back&order=$order_id' class='icontext butt' t='alt'>
                                                    <script>
                                                        icon("2em", "2em", 'previous')
                                                    </script>
                                                </a>
                            
                                                <a href='conns/admineditorder.php?type=state&state=next&order=$order_id' class='icontext butt' t='alt'>
                                                    <script>
                                                        icon("2em", "2em", 'next')
                                                    </script>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            HTML;
                    }
                } else {
                    echo <<<HTML
                    <h1>No se encontraron pedidos activos.</h1>
                    HTML;
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>