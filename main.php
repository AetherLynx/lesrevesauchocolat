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
            <p t="c" style="max-width: 100rem;">
                Somos una empresa de productos de panadería, pastelería y heladería con el propósito
                de ser accesible a los ciudadanos Colombianos, ofreciendo una gran cantidad de opciones
                para personalizar sus pedidos a gusto.
            </p>
            <img type="mbanner" src="files/img_panaderia02.jpg">
            <h1>¿Qué servicios ofrecemos?</h1>
            <p>Puedes darle a los botones para mirar productos de esa categoria.</p>

            <div class='mainRow'>
                <div>
                    <a href="catalogue.php?filter=1">
                        <div class='icontext' style=' background-color: #BF7B69 !important'>
                            <script>
                                document.write(Panaderia);
                            </script>
                            <p>Una alta variedad de panes!</p>
                        </div>
                    </a>
                    <img type="mbanner" src="files/img_panaderia03.jpg">
                </div>

                <div>
                    <a href="catalogue.php?filter=2">
                        <div class='icontext' style=' background-color: #94ADD7 !important'>
                            <script>
                                document.write(Heladeria);
                            </script>
                            <p>Variedad de productos de Heladería</p>
                        </div>
                    </a>
                    <img type="mbanner" src="files/img_heladeria03.jpg">
                </div>

                <div>
                    <a href="catalogue.php?filter=3">
                        <div class='icontext' style=' background-color: #E63F74 !important'>
                            <script>
                                document.write(Pasteleria);
                            </script>
                            <p>Muchos tipos de pasteles, y personalizables ;)</p>
                        </div>
                    </a>
                    <img type="mbanner" src="files/img_pasteleria01.jpg">
                </div>
            </div>
        </div>
    </div>
</body>

</html>