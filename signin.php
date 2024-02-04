<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="scripts/icons.js"></script>
    <title>Registro de usuario</title>
</head>

<body>
    <div class="half-box">
        <div class="image-cont">
            <img src="files/img_heladeria02.jpg">
        </div>
        <div style="width:50%; background-color: var(--co8);" class="innerbody">
            <h1>Registro de usuario</h1>
            <p>Introduce los datos para tu nueva cuenta.</p>
            <form method="post" action="conns/access.php">
                <div class="alt">
                    <script>
                        document.write(user);
                    </script>
                    <input type="text" placeholder="nombre" name="name" autocomplete="off" required>
                </div>
                <br>
                <div class="alt">
                    <script>
                        document.write(key);
                    </script>
                    <input type="password" placeholder="contraseña" name="pass" required>
                </div>
                <br>
                <div class="alt">
                    <script>
                        document.write(mail);
                    </script>
                    <input type="text" placeholder="correo electronico" name="mail" autocomplete="off" required>
                </div>
                <br><br><br>
                <div class="alt">
                    <script>
                        document.write(question);
                    </script>
                    <input type="text" placeholder="pregunta de seguridad" name="question" autocomplete="off" required>
                </div>
                <br>
                <div class="alt">
                    <script>
                        document.write(answer);
                    </script>
                    <input type="text" placeholder="respuesta de seguridad" name="qanswer" autocomplete="off" required>
                </div>
                <br>
                <button name="signin" style="color: var(--co8);">Crear cuenta</button>
            </form>
            <p>Ya tienes cuenta? <a href=" login.php">Inicia sesión.</a></p>
        </div>
    </div>
</body>

</html>