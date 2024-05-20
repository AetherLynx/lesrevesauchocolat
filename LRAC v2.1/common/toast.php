<link rel="stylesheet" href="../style.css">
<script src="../scripts/stuff.js"></script>
<title>Confirmación</title>

<?php
include("../conns/conexion.php");
//echo "<script>console.log('{$_SESSION["data_userRegistered"]}')</script>";
//echo "<script>console.log('{$_SESSION["ADMINdata_prodUploadError"]}')</script>";
if (isset($_SESSION["data_userRegistered"])) {
    switch ($_SESSION["data_userRegistered"]) {
        case false:
            echo "
                <div class='toast'>
                    <h1>Ya existe un usuario con ese correo.</h1>
                    <p>Por favor vuelve a intentarlo.</p>
                    <a class='butt' href='../signin.php'>Registro de usuario</a>
                </div>
                ";
            unset($_SESSION["data_userRegistered"]);
            break;

        case true:
            echo "
                <div class='toast'>
                    <h1>Te has registrado exitosamente!</h1>
                    <p>Ahora inicia sesión para poder acceder a nuestra pagina :)</p>
                    <a class='butt' href='../login.php'>Iniciar sesión</a>
                </div>
                ";
            unset($_SESSION["data_userRegistered"]);
            break;

        case null:
            echo "
                <div class='toast'>
                    <h1>Hubo un error registrándote.</h1>
                    <p>Por favor vuelve a intentarlo.</p>
                    <a class='butt' href='../signin.php'>Registro de usuario</a>
                </div>
                ";
            unset($_SESSION["data_userRegistered"]);
            break;
    }
} else if (isset($_SESSION["ADMINdata_prodUploadError"])) {
    switch ($_SESSION["ADMINdata_prodUploadError"]) {
        case 1:
            echo "
                <div class='toast'>
                    <h1>ARCHIVO DE IMAGEN NO COMPATIBLE</h1>
                    <p>El archivo subido no es una imagen compatible, por favor elija un archivo con la extensión .jpg, .jpeg, .png o .gif.</p>
                    <a class='butt'  onclick='goBack()'>Volver</a>
                </div>
                ";
            unset($_SESSION["ADMINdata_prodUploadError"]);
            break;
        case 2:
            echo "
                <div class='toast'>
                    <h1>ARCHIVO DEMASIADO PESADO</h1>
                    <p>La imagen enviada supera las 10MB.</p>
                    <a class='butt'  onclick='goBack()'>Volver</a>
                </div>
                ";
            unset($_SESSION["ADMINdata_prodUploadError"]);
            break;

        case 3:
            echo "
                <div class='toast'>
                    <h1>ERROR</h1>
                    <p>Hubo un error al subir la imagen.</p>
                    <p>Verifica estar conectado a la base de datos o reinicia tu sesión.</p>
                    <a class='butt'  onclick='goBack()'>Volver</a>
                </div>
                ";
            unset($_SESSION["ADMINdata_prodUploadError"]);
            break;

        case 0:
            echo "
                <div class='toast'>
                    <h1>Producto subido exitosamente al catálogo.</h1>
                    <a class='butt' href='../adminprodmng.php'>Volver al portal de administradores</a>
                    <a class='butt' href='../catalogue.php?filter=0'>Revisar el catálogo</a>
                </div>
                ";
            unset($_SESSION["ADMINdata_prodUploadError"]);
            break;
    }
} else if (!isset($_SESSION["ADMINdata_prodUploadError"]) && !isset($_SESSION["data_userRegistered"])) {
    header("location: ../login.php");
}
