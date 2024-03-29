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
    <title>Recuperación de cuenta</title>
</head>

<body>
    <div class='main-absolute'>
        <?php
        include("conns/conexion.php");
        include("phpfuncs/main.php");
        changeColorsPRESET("dark");
        renderPopup();
        ?>
    </div>
    <div class="main-center main-maxvh">

        <div class="middlebody">
            <h1>Recuperación de cuenta</h1>
            <p>Por favor introduzca el correo de la cuenta que desea recuperar.</p>
            <form method="post" action="conns/access.php">
                <div class='main-rowcenter'>
                    <script>
                        document.write(mailb);
                    </script>
                    <input type="text" placeholder="correo electronico" name="recovMail" autocomplete="off" required>
                </div>
                <button name="search_recoverMail">Buscar cuenta</button>
            </form>
            <div>
                <?php
                if (isset($_SESSION["recov_isActive"])) {
                    echo "
                        <form method='POST' action='conns/access.php'>
                            <p style='text-align: center;'>Por favor responde la pregunta de seguridad<br>para restablecer tu contraseña.</p>
                            <div>
                                <center><h3>Pregunta: " . $_SESSION["recov_question"] . "</h3></center>
                                <script>
                                    document.write(question);
                                </script>
                                <input type='text' placeholder='ingrese la respuesta' name='input_qanswer' autocomplete='off'><br>
                                <script>
                                    document.write(key);
                                </script>
                                <input type='password' placeholder='contraseña nueva' name='input_newpass' autocomplete='off'><br>
                                <center><button type='submit' name='input_modify'>Modificar contraseña</button></center>
                            </div>
                        </form>
                    ";
                }
                ?>
            </div>
            <br><a type='textlink' class='main-smallfont underline_anim' href='login.php'>Regresar</a>
        </div>
    </div>
</body>

</html>