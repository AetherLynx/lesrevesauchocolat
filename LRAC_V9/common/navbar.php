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
        $pagename = "Comprobante de tu pedido";
        break;
    case "ordersquery":
        $pagename = "Consulta los detalles de tu pedido activo";
        break;
    case "adminorders":
        $pagename = "Administrador de pedidos";
        break;
    case "sharedorder":
        $pagename = "Viendo un pedido compartido";
        break;
    case "adminreq_deleteorder":
        $pagename = "Formulario de rechazo de pedido";
        break;
    case "userprofile":
        $pagename = "Viendo un perfil público";
        break;
    case "usersindex":
        $pagename = "Busqueda de usuarios";
        break;
}
?>

<nav>
    <navbutts p="l">
        <h1><?php echo $pagename ?></h1>
    </navbutts>
    <navbutts>
        <?php
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
            echo "
                <a onclick='toggleSidebar()'>
                <div class='icontext'>
                    <script>
                        document.write(list);
                    </script>
                </div>
            </a>
            ";
        } else {
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
        ?>
    </navbutts>
</nav>