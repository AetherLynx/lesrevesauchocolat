<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="scripts/icons.js"></script>
    <title>Recuperación de cuenta</title>
</head>

<body>
    <div style="position: absolute">
        <?php
        include("conns/conexion.php");
        ?>
    </div>
    <div class="background-img">
        <img src="files/img_heladeria02.jpg">
    </div>
    <div class="center">

        <div id="altcont" class="middlebody">
            <h1>Recuperación de cuenta</h1>
            <p>Por favor introduzca el correo de la cuenta que desea recuperar.</p>
            <form method="post" action="conns/access.php">
                <div class="alt">
                    <script>
                        document.write(mail);
                    </script>
                    <input type="text" placeholder="correo electronico" name="recovMail" autocomplete="off" required>
                </div>
                <button id="altbutt" name="search_recoverMail">Buscar cuenta</button>
            </form>
            <div>
                <?php
                if (isset($_SESSION["recov_isActive"])) {
                    echo "
                        <form method='POST' action='conns/access.php'>
                            <p style='text-align: center;'>Por favor responde la pregunta de seguridad<br>para restablecer tu contraseña.</p>
                            <div class='alt'>
                                <center><h3>Pregunta: " . $_SESSION["recov_question"] . "</h3></center>
                                <script>
                                    document.write(question);
                                </script>
                                <input type='text' placeholder='ingrese la respuesta' name='input_qanswer' autocomplete='off'><br>
                                <script>
                                    document.write(key);
                                </script>
                                <input type='password' placeholder='contraseña nueva' name='input_newpass' autocomplete='off'><br>
                                <center><button id='altbutt' type='submit' name='input_modify'>Modificar contraseña</button></center>
                            </div>
                        </form>
                    ";
                } elseif (isset($_SESSION["error_recovmail404"])) {
                    echo "
                        <div class='popup'>
                            <div>
                                <p>No se encontró una cuenta asociada a el correo introducido.</p>
                            </div>
                        </div>
                    ";
                    unset($_SESSION["error_recovmail404"]);
                } elseif (isset($_SESSION["error_answerNotmatched"])) {
                    echo "
                        <div class='popup'>
                            <div>
                                <p>La respuesta que introduciste no es correcta.</p>
                            </div>
                        </div>
                    ";
                    unset($_SESSION["error_answerNotmatched"]);
                }
                ?>
            </div>
            <br><a href="login.php">Regresar</a>
        </div>
    </div>
</body>

</html>