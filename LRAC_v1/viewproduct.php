<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="files/placeholdericon.png" type="image/x-icon">
    <script src="scripts/icons.js"></script>
    <title>Descripción de producto</title>

    <div style="position: absolute;">
        <?php
        include("conns/conexion.php");
        include("phpfuncs/main.php");
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
        <div class="bodybg">

            <?php
            include("common/productinfo.php");
            include("common/comments.php");
            ?>
        </div>
    </div>
</body>
<script src="scripts/dialog.js"></script>

</html>