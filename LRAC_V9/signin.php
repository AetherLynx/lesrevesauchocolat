<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="files/placeholdericon.png" type="image/x-icon">
    <script src="scripts/icons.js"></script>
    <title>Registro de usuario</title>
</head>

<body>
    <?php
    include("phpfuncs/main.php");
    changeColorsPRESET("blue");
    ?>
    <div class="half-box">
        <div class="image-cont">
            <img src="files/img_heladeria02.jpg">
        </div>
        <div style="width: 70%" class="innerbody">
            <h1 style="width: 100%; text-align: center;">Registro de usuario</h1>
            <br>
            <p>Tus datos menos la contraseña son públicos para los demás usuarios de Les Reves Au Chocolat.</p>
            <form method="post" action="conns/access.php">
                <div class='main-darkcont main-row'>
                    <div class='main-row main-iconmsides'>
                        <script>
                            document.write(userb);
                        </script>
                        <input type="text" placeholder="nombre de usuario" name="name" autocomplete="off" required>
                    </div>

                    <div class='main-row main-iconmsides'>
                        <script>
                            document.write(keyb);
                        </script>
                        <input type="password" placeholder="contraseña" name="pass" required>
                    </div>
                </div>

                <br>
                <div class='main-darkcont main-row'>
                    <div class='main-row main-iconmsides'>
                        <script>
                            document.write(mailb);
                        </script>
                        <input type="email" placeholder="correo electronico" name="mail" autocomplete="off" required>
                    </div>

                    <div class='main-row main-iconmsides'>
                        <script>
                            document.write(phoneb);
                        </script>
                        <input type="number" placeholder="numero de telefono" name="numtel" autocomplete="off" required>
                    </div>
                </div>

                <br>
                <p>En caso de olvidar tu usuario o contraseña, recuerda estos detalles para recuperarla.</p>
                <div class='main-darkcont main-row'>
                    <div class='main-row main-iconmsides'>
                        <script>
                            document.write(questionb);
                        </script>
                        <input type="text" placeholder="pregunta de seguridad" name="question" autocomplete="off" required>
                    </div>

                    <div class='main-row main-iconmsides'>
                        <script>
                            document.write(answerb);
                        </script>
                        <input type="text" placeholder="respuesta de seguridad" name="qanswer" autocomplete="off" required>
                    </div>
                </div>

                <br>

                <p>Tu dirección de residencia será usada para entregar tus pedidos, la puedes cambiar
                    cuando desees.
                </p>
                <div class='main-darkcont main-row main-maxw'>
                    <div class='main-rowcenter main-iconmsides'>
                        <script>
                            document.write(markerb);
                        </script>
                        <input style='width: 20em' type="text" placeholder="dirección de residencia" name="address" required>
                    </div>
                </div>

                <button name="signin">Crear cuenta</button>
            </form>
            <div class='main-biggerText'>
                <p>Ya tienes cuenta? <a class='underline_anim' type='textline' href=" login.php">Inicia sesión.</a></p>
            </div>
        </div>
    </div>
</body>

</html>