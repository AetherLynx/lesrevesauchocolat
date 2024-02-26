<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="files/placeholdericon.png" type="image/x-icon">
    <script src="scripts/icons.js"></script>
    <title>Configuración de Cuenta</title>

    <div style="position: absolute;">
        <?php
        include("conns/conexion.php");
        ?>
    </div>
</head>

<body>
    <?php
    include("common/sidebar.php");
    include("common/navbar.php");
    ?>
    <dialog id='dialog'>
        <h1 class='main-textcenter'>¿Estas seguro que quieres borrar tu cuenta?</h1>
        <p t="c">
            Si borras tu cuenta, perderás tus pasteles creados, tus datos de tu carrito,<br>
            tu perfil también se borrará, pero podrás crear otra cuenta con la dirección<br>
            de correo asociada a esta cuenta.
        </p>
        <form method='post' action='conns/usermodifyacc.php'>
            <h3 class='main-textcenter'>Por seguridad, introduce tu contraseña.</h3>
            <input type="password" name="security_delAccPass" class='main-inputalt' placeholder='verifica tu contraseña' autocomplete='off'>
            <button name='mod_deleteAccount' id='deleteFully' t='alt' class='main-maxw'>
                Si, eliminar definitivamente
            </button>
        </form>
        <button id='deleteCancel' t='alt' class='main-maxw'>
            No, cambié de opinión
        </button>
    </dialog>
    <!-- BODY -->
    <div class='bodyCenter'>
        <div class="undernav">
            <div class='bodybg'>
                <?php
                include("common/accountmng.php")
                ?>
            </div>
        </div>
</body>

</html>