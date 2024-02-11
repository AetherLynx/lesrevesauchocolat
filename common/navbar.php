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
}
?>

<nav>
    <navbutts p="l">
        <h1><?php echo $pagename ?></h1>
    </navbutts>
    <navbutts>
        <a href="shopcart.php">
            <div class="icontext">
                <script>
                    document.write(cartn);
                </script>
                <p>Carrito de compras</p>
            </div>
        </a>
        <a onclick="toggleSidebar()">
            <div class="icontext">
                <script>
                    document.write(list);
                </script>
                <p>Menú</p>
            </div>
        </a>
    </navbutts>
</nav>