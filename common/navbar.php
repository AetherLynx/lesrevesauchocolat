<?php
//pagename setter
$pagename = "n/a";
switch ($_SESSION["data_curPage"]) {
    case "main":
        $pagename = "Sobre nosotros";
        break;
    case "catalogue":
        $pagename = "Catálogo de productos";
        break;
    case "viewproduct":
        $pagename = "Descripción de producto";
        break;
    case "shopcart":
        $pagename = "Tu carrito de compras";
        break;
    case "adminindex":
        $pagename = "Portal para Administradores";
        break;
    case "adminprodmng":
        $pagename = "Manejo de productos";
        break;
    case "userconfig":
        $pagename = "Configuración de cuenta";
        break;
    case "bridge_order":
        $pagename = "Detalles de tu nuevo pedido";
        break;
    case "ordersquery":
        $pagename = "Consulta los detalles de tu pedido activo";
        break;
}
?>

<nav>
    <navbutts p="l">
        <h1><?php echo $pagename ?></h1>
    </navbutts>
    <navbutts>
        <?php
        if (isset($_SESSION["loggedin"])) {
            if (($_SESSION["loggedin"] == true)) {
                echo "
                <a onclick='toggleSidebar()'>
                <div class='icontext'>
                    <script>
                        document.write(list);
                    </script>
                </div>
            </a>
            ";
            } else if (($_SESSION["loggedin"] == false)) {
                echo
                "
            <a href='login.php'>
                <div class='icontext'>
                    <script>
                        document.write(userb);
                    </script>
                    <p>Inicia sesión para usar todas nuestras funciones!</p>
                </div>
            </a>
            ";
            }
        }
        ?>
    </navbutts>
</nav>