<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="files/placeholdericon.png" type="image/x-icon">
    <script src="scripts/icons.js"></script>
    Nuestros productos</title>

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
            document.documentElement.style.setProperty('--co1', '#f7fafc')
            document.documentElement.style.setProperty('--co4', '#7f8ca3')
            document.documentElement.style.setProperty('--co4u', '#7d8db0')
            document.documentElement.style.setProperty('--co4ba', 'rgba(121, 146, 173, 70%)')
            document.documentElement.style.setProperty('--co3', '#e6edf7')
        </script>
        ";
    ?>

    <!-- BODY -->
    <div class='bodyCenter'>
        <div class="undernav">
            <div class="adminCont">

                <a href="adminprodmng.php" class="adminRow">
                    <div class='main-iconText'>
                        <script>
                            document.write(editbb)
                        </script>
                        <h1>Modificar productos del catálogo</h1>
                    </div>
                </a>

                <a class="adminRow">
                    <div class='main-iconText'>
                        <script>
                            document.write(userbb)
                        </script>
                        <h1>Administrar base de usuarios</h1>
                    </div>
                </a>

                <a class="adminRow">
                    <div class='main-iconText'>
                        <script>
                            document.write(lupabb)
                        </script>
                        <h1>Consultar pedidos activos</h1>
                    </div>
                </a>

                <a class="adminRow" href="main.php">
                    <div class='main-iconText'>
                        <script>
                            document.write(leftbb)
                        </script>
                        <h1>Volver al menú</h1>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>

</html>