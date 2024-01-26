<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="scripts/icons.js"></script>
    <title>Inicio de sesión</title>
</head>

<body>
    <div style="position: absolute;">
        <?php
        include("conns/conexion.php");
        session_start();
        if (isset($_SESSION["error_logincr"])) {
            echo "
            <div class='popup'>
                <div>
                    <p>El usuario o contraseña no son correctos.</p>
                </div>
            </div>
            ";
            unset($_SESSION["error_logincr"]);
        } elseif (isset($_SESSION["action_logout"])) {
            echo "
            <div class='popup'>
                <div>
                    <p>Cerraste la sesión exitosamente.</p>
                </div>
            </div>
            ";
            unset($_SESSION["action_logout"]);
        }
        ?>
    </div>
    <div class="half-box">
        <div class="image-cont">
            <img src="files/img_panaderia01.jpg">
        </div>
        <div style="width:50%;" class="innerbody">
            <h1>Inicio de sesión</h1>
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
            <p>No tienes cuenta? <a href="signin.php">Regístrate.</a>
                <br>
            <p><a href="recover.php">Recuperar cuenta</a></p>
        </div>
    </div>
</body>

</html>