<?php
$x = verifyError();
echo "
<h1>Estos son tus datos, {$_SESSION["user_name"]}</h1>
<p>Acá puedes verificar información, modificarla e incluso borrar tu cuenta.</p>

$x

<form method='post' action='conns/usermodifyacc.php' enctype='multipart/form-data'>
    <div class='main-row'>
        <div class='main-center main-bordercont' style='height: 40em'>
            <h2>Tu foto de perfil</h2>
            <p t='c'>
                Cualquier imagen que te represente, incluso animada!
            </p>
            <img src='files/userpfp/{$_SESSION["user_pfp"]}' type='pfp' id='output'>
            <input type='file' accept='image/*' name='data_user_PFP' class='main-inputfile' onchange='loadFile(event)' id=pfpFile''>
            <button type='submit' t='alt' class='main-maxw' name='mod_changePfp' id='fileUploadBT' disabled>Cambiar foto de perfil</button>
        </div>

        <div class='main-center main-bordercont' style='width: 30em; height: 40em'>
            <h2>Tus datos personales</h2>
            <p t='c'>
                Puedes modificar tus datos cuando gustes.
            </p>
            <div class='main-rowcenter'>
                <script>
                document.write(userb);
                </script>
                <input type='text' name='data_user_name' placeholder='Nombre de usuario' class='main-nmb' value='{$_SESSION["user_name"]}'>
            </div>

            <div class='main-rowcenter'>
                <script>
                document.write(mailb);
                </script>
                <input type='text' name='data_user_mail' placeholder='Correo electrónico' class='main-nmb' value='{$_SESSION["user_mail"]}' readonly>
            </div>

            <div class='main-rowcenter'>
                <script>
                document.write(phoneb);
                </script>
                <input type='text' name='data_user_numtel' placeholder='Número de teléfono' class='main-nmb' value='{$_SESSION["user_numtel"]}'>
            </div>
            
            <div class='main-rowcenter'>
                <script>
                document.write(markerb);
                </script>
                <input type='text' name='data_user_address' placeholder='Dirección de entrega' class='main-nmb' value='{$_SESSION["user_address"]}'>
            </div>

            <button type='submit' t='alt' class='main-maxw' name='mod_updateData'>Actualizar datos</button>
        </div>

        <div class='main-center main-bordercont ' style='width: 30em; height: 40em'>
            <h2>Otras opciones</h2>
            <p t='c'>Eliminar tu cuenta definitivamente, puedes registrarte de nuevo con la misma
                dirección de correo una vez la eliminen.
            </p>
            <button type='button' id='deleteConfirm' t='alt' class='main-maxw'>Eliminar cuenta</button>
        </div>
</form>


<script>
var dialog = document.getElementById('dialog');
var openButton = document.getElementById('deleteConfirm');
var closeButton = document.getElementById('deleteCancel');

openButton.onclick = function() {
    dialog.showModal();
}

closeButton.onclick = function() {
    dialog.close();

}

var loadFile = function(event) {
    var image = document.getElementById('output');
    var bt = document.getElementById('fileUploadBT');

    bt.removeAttribute('disabled');
    image.src = URL.createObjectURL(event.target.files[0]);

};
</script>
";

function verifyError()
{
    if (isset($_SESSION["userconfig_error"])) {
        //pq putas se formatea así (te amo php)
        switch ($_SESSION["userconfig_error"]) {
            case "00":
                $x = "
<div class='popup' id='popup'>
    <p t='c'>Tu foto de perfil fue actualizada!</p>
</div>
";
                unset($_SESSION["userconfig_error"]);
                break;
            case "10":
                $x = "
<div class='popup' id='popup'>
    <p t='c'>La extension del archivo que subiste no la manejamos!<br>Prueba con .jpg, .png, .gif y .jpeg.</p>
</div>
";
                unset($_SESSION["userconfig_error"]);
                break;
            case "01":
                $x = "
<div class='popup' id='popup'>
    <p t='c'>Tus datos fueron actualizados!</p>
</div>
";
                unset($_SESSION["userconfig_error"]);
                break;
            case "21":
                $x = "
<div class='popup' id='popup'>
    <p t='c'>No pudimos eliminar tu cuenta!<br>La contraseña que introduciste no es correcta.</p>
</div>
";
                unset($_SESSION["userconfig_error"]);
                break;
        }
        return $x;
    } else {
        $x = null;
    }
}
