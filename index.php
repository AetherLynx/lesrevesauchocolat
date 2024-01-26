<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>LOGIN PAGE</title>
    <?php
    include("conexion.php");
    ?>
</head>

<body>
    <div class="innerbody">
        <h1>Inicio de sesión</h1>
        <form method="post">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                    <circle cx="12" cy="6" r="4" fill="currentColor" />
                    <path fill="currentColor" d="M20 17.5c0 2.485 0 4.5-8 4.5s-8-2.015-8-4.5S7.582 13 12 13s8 2.015 8 4.5" />
                </svg><input type="text" placeholder="nombre">
            </div>
            <br>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M7 15q1.25 0 2.125-.875T10 12q0-1.25-.875-2.125T7 9q-1.25 0-2.125.875T4 12q0 1.25.875 2.125T7 15m0 3q-2.5 0-4.25-1.75T1 12q0-2.5 1.75-4.25T7 6q2.025 0 3.538 1.15T12.65 10h8.375L23 11.975l-3.5 4L17 14l-2 2l-2-2h-.35q-.625 1.8-2.175 2.9T7 18" />
                </svg><input type="password" placeholder="contraseña">
            </div>
            <br>
            <button name="login">Iniciar sesión</button>
        </form>
        <p>No tienes cuenta? <a href="index.php">Regístrate</a></p>
    </div>
</body>

</html>