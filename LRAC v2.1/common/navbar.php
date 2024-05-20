<?php
//pagename setter
$pagename = "n/a";
switch ($_SESSION["data_curPage"]) {
    case "index":
        $pagename = "Pagina principal";
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
    case "userorders":
        $pagename = "Historial de pedidos";
        break;
    case "threads":
        $pagename = "Foro de Les Reves au Chocolat";
        break;
    case "threads_create":
        $pagename = "Crear post de foro";
        break;
    case "threadpost":
        $pagename = "Viendo un post del foro";
        break;
}

$islogged = <<<HTML
    <a href='login.php' class='nav-button main-rowcenter main-iconmr'>
        <script>
            icon('2em', '2em', 'user');
        </script>
        <h3>Iniciar sesión</h3>
    </a>
HTML;

//i was redesigning the sidebar

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    $islogged = <<<HTML
    <button class='nav-button' onclick='toggleSidebar()'>
        <script>
            icon('3em', '3em', 'menuopen');
        </script>
    </button>
    
    <button class='nav-button' onclick='toggleNotifs()' right2>
        <script>
            icon('3em', '3em', 'bell2');
        </script>
    </button>
    HTML;
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

?>

<script>
    var backbt = document.getElementById("prevpageBt")
    var pagename = basename(window.location.href);

    if (pagename == "index.php") {
        backbt.style.display = "none";
    }

    function basename(path) {
        return path.split('/').reverse()[0];
    }
</script>