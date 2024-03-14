<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="files/placeholdericon.png" type="image/x-icon">
    <script src="scripts/icons.js"></script>
    <title>Carrito de compras</title>

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
    changeColorsPRESET("purple");
    ?>

    <!-- BODY -->
    <div class="undernav">
        <div class="bodybg">
            <?php
            if (isset($_SESSION["dynamic_errorPopup"])) {
                echo $_SESSION["dynamic_errorPopup"];
                unset($_SESSION["dynamic_errorPopup"]);
            }
            ?>

            <h2>Aqui están los antojos que guardaste.</h2>
            <div class='catalog-container main-row'>
                <?php include("common/scinfo.php") ?>
            </div>
        </div>
    </div>
</body>

</html>