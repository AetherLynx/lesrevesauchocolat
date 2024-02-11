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
    echo "
        <script>
            document.documentElement.style.setProperty('--co1', '#faf7ff')
            document.documentElement.style.setProperty('--co4', '#8a79ad')
            document.documentElement.style.setProperty('--co4u', '#8a79ad')
            document.documentElement.style.setProperty('--co4ba', 'rgba(138, 121, 173, 70%)')
            document.documentElement.style.setProperty('--co3', '#ebe6f7')
        </script>
        ";
    ?>

    <!-- BODY -->
    <div class="undernav">
        <div class="bodybg">
            <h2>Aqui están los antojos que guardaste.</h2>
            <div class='catalog-container'>
                <?php include("common/scinfo.php") ?>
            </div>
        </div>
    </div>
</body>

</html>