<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="files/placeholdericon.png" type="image/x-icon">
    <script src="scripts/icons.js"></script>
    <title>Iniciar sesión</title>
</head>

<body>
    <div style="position: absolute;">
        <?php
        include("conns/conexion.php");
        if (isset($_SESSION["error_logincr"])) {
            echo "
            <div class='popup' id='popup'>
                    <p>El usuario o contraseña no son correctos.</p>
            </div>
            ";
            unset($_SESSION["error_logincr"]);
        } elseif (isset($_SESSION["action_logout"])) {
            echo "
            <div class='popup' id='popup'>
                    <p>Cerraste la sesión exitosamente.</p>
            </div>
            ";
            unset($_SESSION["action_logout"]);
        } elseif (isset($_SESSION["info_passchangeMelo"])) {
            echo "
            <div class='popup' id='popup'>
                    <p>Cambiaste la contraseña a tu cuenta exitosamente.</p>
            </div>
            ";
            unset($_SESSION["info_passchangeMelo"]);
        } elseif (isset($_SESSION["error_notLogged"])) {
            echo "
            <div class='popup' id='popup'>
                    <p>Necesitas iniciar sesión para hacer eso!</p>
            </div>
            ";
            unset($_SESSION["error_notLogged"]);
        }
        ?>
    </div>
    <div class="half-box">
        <div class="image-cont">
            <img src="files/img_panaderia01.jpg">
        </div>
        <div style="width:70%;" class="innerbody">
            <h1 style="width: 100%; text-align: center;">Inicio de sesión</h1>
            <form method="post" action="conns/access.php">
                <div>
                    <script>
                        document.write(user);
                    </script>
                    <input type="text" placeholder="nombre de usuario" name="name" autocomplete="off" required>
                </div>
                <br>
                <div>
                    <script>
                        document.write(key);
                    </script>
                    <input type="password" placeholder="contraseña" name="pass" required>
                </div>
                <br>
                <button name="login">Iniciar sesión</button>
            </form>
            <hr t="alt">
            <h2 class='main-nmb'>Otras opciones</h2>
            <div class='main-row main-nm' style='margin-top: 1rem;'>
                <a href="signin.php" class='butt'>Registrarse</a>
                <a href="recover.php" class='butt'>Recuperar cuenta</a>
                <a href="main.php" class='butt'>Página de inicio</a>
            </div>
        </div>
</body>

</html>