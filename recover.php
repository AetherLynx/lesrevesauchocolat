<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="scripts/icons.js"></script>
    <title>Recuperar cuenta</title>
</head>

<body>
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
                    <input type="text" placeholder="correo electronico" name="name" autocomplete="off" required>
                </div>
                <button id="altbutt">Buscar cuenta</button>
            </form>
            <br><a href="login.php">Regresar</a>
        </div>
    </div>
</body>

</html>