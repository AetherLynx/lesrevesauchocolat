<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="scripts/icons.js"></script>
    <link rel="icon" href="files/placeholdericon.png" type="image/x-icon">
    <title>Nuestros productos</title>

    <div style="position: absolute;">
        <?php
        include("conns/conexion.php");
        include("phpfuncs/main.php");
        switch ($_GET["filter"]) {
            case "0":
                // do nothing :)
                break;
            case "1":
                changeColorsPRESET("brown");
                break;
            case "2":
                changeColorsPRESET("cyan");
                break;
            case "3":
                changeColorsPRESET("pink");
                break;
            case "4":
                changeColorsPRESET("strongcyan");
                break;
        }
        ?>
    </div>
</head>

<body>
    <?php
    include("common/sidebar.php");
    include("common/navbar.php");
    ?>

    <!-- BODY -->
    <div class="undernav">
        <h1>Antojate de nuestros productos ;)</h1>
        <div class="bodybg">
            <div class="newCatalogFilter">
                <h2>Filtrar productos por su categoría</h2>
                <div class="main-row" order="space-evenly">
                    <a href="catalogue.php?filter=0" class='main-iconText'>
                        <script>
                            document.write(filterb);
                        </script>
                        Mostrar todos
                    </a>

                    <a href="catalogue.php?filter=1" class='main-iconText'>
                        <script>
                            document.write(breadb);
                        </script>
                        Panaderia
                    </a>

                    <a href="catalogue.php?filter=2" class='main-iconText'>
                        <script>
                            document.write(icecreamb);
                        </script>
                        Heladeria
                    </a>

                    <a href="catalogue.php?filter=3" class='main-iconText'>
                        <script>
                            document.write(cakeb);
                        </script>
                        Pasteleria
                    </a>

                    <a href="catalogue.php?filter=4" class='main-iconText'>
                        <script>
                            icon("2em", "2em", "custom");
                        </script>
                        Creaciones
                    </a>
                </div>
            </div>
            <div class="catalog-container">
                <?php
                include("common/products.php");
                ?>
            </div>
        </div>
    </div>
</body>

</html>