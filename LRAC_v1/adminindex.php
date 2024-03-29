<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="files/placeholdericon.png" type="image/x-icon">
    <script src="scripts/icons.js"></script>
    <title>Index para administradores</title>

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
    changeColorsPRESET("gray");
    ?>

    <!-- BODY -->
    <div class='bodyCenter'>
        <div class="undernav">
            <?php
            adminChecker();
            ?>
            <div class="adminCont">

                <a href="adminprodmng.php" class="adminRow">
                    <div class='main-iconText'>
                        <script>
                            document.write(editbb)
                        </script>
                        <h1>Modificar productos del catálogo</h1>
                    </div>
                </a>

                <a href='adminusers.php' class="adminRow">
                    <div class='main-iconText'>
                        <script>
                            document.write(userbb)
                        </script>
                        <h1>Administrar base de usuarios</h1>
                    </div>
                </a>
                <?php

                if (!isset($_SESSION["admin_curOrderby"])) {
                    $_SESSION["admin_curOrderby"] = "0";
                }

                $query = $_SESSION["admin_curOrderby"];

                echo <<<HTML
                <a href='adminorders.php?orderby=$query' class="adminRow">
                    <div class='main-iconText'>
                        <script>
                            document.write(lupabb)
                        </script>
                        <h1>Consultar pedidos activos</h1>
                    </div>
                </a>
                HTML;
                ?>

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