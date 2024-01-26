<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="scripts/icons.js"></script>
    <script src="scripts/stuff.js"></script>
    <title>lrac_main</title>

    <div style="position: absolute;">
        <?php
        include("conns/conexion.php");
        session_start();
        ?>
    </div>
</head>

<body>
    <div id="sidebar">
        <div id="main">
            <a href="main.php">Sobre nosotros</a>
            <a onclick="closeSidebar()">
                <script>
                document.write(x);
                </script>
            </a>
        </div>
    </div>

    <nav>
        <h1>Sobre nosotros.</h1>
        <div class="navbutts">
            <a href="conns/logout.php">
                <script>
                document.write(logout);
                </script>
            </a>
            <a onclick="toggleSidebar()">
                <script>
                document.write(list);
                </script>
            </a>
        </div>
    </nav>
    <div class="undernav">
        <h1>Bienvenido a</h1>
        <h6>logo</h6>
    </div>
</body>

</html>