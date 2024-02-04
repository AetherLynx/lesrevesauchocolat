<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="scripts/icons.js"></script>
    <title>Sobre nosotros</title>

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
        <div class="bodybg">
            <h1>¡Bienvenido a Les Reves Au Chocolat!</h1>
            <img type="bbanner" src="files/lrac_banner.png">
            <p t="c" style="max-width: 50rem;">
                Somos una empresa de productos de panadería, pastelería y heladería con el propósito
                de ser accesible a los ciudadanos Colombianos, ofreciendo una gran cantidad de opciones
                para personalizar sus pedidos a gusto.
            </p>
            <img type="bbanner" src="files/img_panaderia02.jpg">
        </div>
    </div>
</body>

</html>