<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="scripts/icons.js"></script>
    <title>Nuestros productos</title>

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
    ?>

    <!-- BODY -->
    <div class="undernav">
        <h1>Antojate de nuestros productos ;)</h1>
        <div class="bodybg">
            <div class="catalog-filter">
                <h3 style="width: auto">Filtrar por</h3>
                <a href="catalogue.php?filter=0">
                    <script>
                        document.write(filterb);
                    </script>
                    Todos
                </a>
                <a href="catalogue.php?filter=1">
                    <script>
                        document.write(Panaderia);
                    </script>
                    Panadería
                </a>
                <a href="catalogue.php?filter=2">
                    <script>
                        document.write(Heladeria);
                    </script>
                    Heladería
                </a>
                <a href="catalogue.php?filter=3">
                    <script>
                        document.write(Pasteleria);
                    </script>
                    Pastelería
                </a>
            </div>
            <hr>
            <div class="catalog-container">
                <?php
                include("common/products.php");
                ?>
            </div>
        </div>
    </div>
</body>

</html>