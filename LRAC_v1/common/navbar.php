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
    case "cakemaker":
        $pagename = "Creador de pasteles";
        break;
    case "usercomments":
        $pagename = "Viendo los comentarios de un usuario";
        break;
    case "adminusers":
        $pagename = "Administrador de usuarios";
        break;
    case "adminconfirmation":
        $pagename = "Confirmar solicitud";
        break;
}

$islogged = "
    <a href='login.php' class='nav-button main-rowcenter main-iconmr'>
        <script>
            icon('2em', '2em', 'user');
        </script>
        <h3>Iniciar sesión</h3>
    </a>
";

//i was redesigning the sidebar

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    $islogged = "
    <button class='nav-button' onclick='toggleSidebar()'>
        <script>
            icon('3em', '3em', 'menuopen');
        </script>
    </button>
    ";
}

echo <<<HTML
    <nav class='main-rowcenter'>
        <h1>$pagename</h1>
        $islogged
        
        <button class='nav-button' left id='prevpageBt'>
            <script>
                icon('3em', '3em', 'back');
            </script>
        </button>
    </nav>
HTML;
