<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="files/placeholdericon.png" type="image/x-icon">
    <script src="scripts/icons.js"></script>
    <script src="scripts/stuff.js"></script>
    <title>Iniciar sesión</title>
</head>

<body>
    <div style="position: absolute;">
        <?php
        include("conns/conexion.php");
        include("phpfuncs/main.php");

        renderPopup();
        ?>
    </div>
    <div class="half-box">
        <div class="image-cont">
            <img src="files/img_panaderia01.jpg">
        </div>
        <div style="width:70%;" class="innerbody">
            <div class='main-rowcenter'>
                <div class='main-padding2em'>
                    <h1 style="width: 100%; text-align: center;">Inicio de sesión</h1>
                    <form method="post" action="conns/access.php">
                        <div class='main-rowcenter'>
                            <script>
                                document.write(userb);
                            </script>
                            <input type="text" placeholder="nombre de usuario" name="name" autocomplete="off" required>
                        </div>
                        <br>
                        <div class='main-rowcenter'>
                            <script>
                                document.write(keyb);
                            </script>
                            <input type="password" placeholder="contraseña" name="pass" required>
                        </div>
                        <br>
                        <button name="login">Iniciar sesión</button>
                    </form>
                </div>

                <div class=' main-columncenter' style='width: 20em'>
                    <h2 class='main-textcenter'>¿No necesitas iniciar sesión?</h2>
                    <a href="signin.php" class='butt main-maxw main-center'>Registrarse</a>
                    <a href="recover.php" class='butt main-maxw main-center'>Recuperar cuenta</a>
                    <a href="main.php" class='butt main-maxw main-center'>Página de inicio</a>
                </div>
            </div>
        </div>
</body>

</html>