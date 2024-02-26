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
        switch ($_GET["filter"]) {
            case "0":
                // do nothing :)
                break;
            case "1":
                echo "
                <script>
                    document.documentElement.style.setProperty('--co1', '#fff3f0')
                    document.documentElement.style.setProperty('--co4', '#BF7B69')
                    document.documentElement.style.setProperty('--co4u', '#BF7B69')
                    document.documentElement.style.setProperty('--co4b', '#BF7B69')
                    document.documentElement.style.setProperty('--co4ba', 'rgba(191, 123, 105, 70%)')
                    document.documentElement.style.setProperty('--co3', '#f0af9e')
                </script>
                ";
                break;
            case "2":
                echo "
                <script>
                    document.documentElement.style.setProperty('--co1', '#f5f9ff')
                    document.documentElement.style.setProperty('--co4', '#94ADD7')
                    document.documentElement.style.setProperty('--co4u', '#94ADD7')
                    document.documentElement.style.setProperty('--co4b', '#94ADD7')
                    document.documentElement.style.setProperty('--co4ba', 'rgba(148, 173, 215, 70%)')
                    document.documentElement.style.setProperty('--co3', '#d2e0f7')
                </script>
                ";
                break;
            case "3":
                echo "
                <script>
                    document.documentElement.style.setProperty('--co1', '#fff7fa')
                    document.documentElement.style.setProperty('--co4', '#E63F74')
                    document.documentElement.style.setProperty('--co4u', '#E63F74')
                    document.documentElement.style.setProperty('--co4b', '#E63F74')
                    document.documentElement.style.setProperty('--co4ba', 'rgba(230, 63, 116, 70%)')
                    document.documentElement.style.setProperty('--co3', '#ffd1e0')
                </script>
                ";
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