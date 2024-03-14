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
    include("phpfuncs/main.php");
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
                echo <<<HTML
                        <div class='main-maxw main-column main-start'>
                            <a href='userprofile.php?user={$_SESSION["user_id"]}' class='icontext'>
                                <script>
                                    icon('2em', '2em', 'back')
                                </script>
                                <p>Ir a tu perfil público</p>
                            </a>
                            <hr t='2'>
                            <br>
                            <h2>Editar datos</h2>
                            <p>Modificar información de tu cuenta, cambiar foto de perfil y eliminar cuenta.</p>
                        </div>
                    HTML;

                renderPopup();
                $sql = "SELECT prefColor, bio FROM userdata WHERE userid='{$_SESSION["user_id"]}'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $chosenColor = $row["prefColor"];
                $colors = ["default", "lime", "dark", "brown", "cyan", "pink"];
                $buttons = ["bt1", "bt2", "bt3", "bt4", "bt5", "bt6"];
                $index = array_search($chosenColor, $colors);

                $chosen_button = $buttons[$index];

                $bio = $row["bio"];


                echo <<<HTML
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

                            <hr t='2'>

                            <div class='main-start main-column main-maxw'>
                                <h2>Editar preferencias de tu perfil</h2>
                                <p>Cambia ajustes de tu perfil público.</p>
                            </div>

                            <div class='main-maxw main-rowstart main-nm main-aligncenter main-wrap'>
                                <h3>¿Qué color prefieres para tu perfil?</h3>
                                <button class='color-chooser' type='button' style='background-color: var(--co4)' id='default'></button>
                                <button class='color-chooser' type='button' style='background-color: #81c986' id='lime'></button>
                                <button class='color-chooser' type='button' style='background-color: #34324a' id='dark'></button>
                                <button class='color-chooser' type='button' style='background-color: #BF7B69' id='brown'></button>
                                <button class='color-chooser' type='button' style='background-color: #94ADD7' id='cyan'></button>
                                <button class='color-chooser' type='button' style='background-color: #E63F74' id='pink'></button>
                                
                                <form method='post' class='main-row' action='conns/usermodifyacc.php'>
                                    <input class='main-inputalt' type='hidden' id='valuecolor' name='prefColor' readonly>
                                    <button class='icontext main-buttonpadding' type='submit' name='changeColor'>
                                        <script>
                                            icon('2em', '2em', 'brush')
                                        </script>
                                        <p>Cambiar color</p>
                                    </button>
                                </form>
                            </div>

                            <div class='main-column main-start main-maxw'>
                                <div class='main-rowstart main-aligncenter'>
                                    <h3>Tu biografía:</h3>
                                    <input type="text" id='bio-input' maxlength="50" name='newbio' value='$bio'>
                                    <button class='icontext main-buttonpadding' type='submit' name='changebio'>
                                        <script>
                                            icon('2em', '2em', editb)
                                        </script>
                                        <p>Actualizar biografía</p>
                                    </button>
                                </div>
                            </div>
                    
                    
                            <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                var bt1 = document.getElementById("default");
                                var bt2 = document.getElementById("lime");
                                var bt3 = document.getElementById("dark");
                                var bt4 = document.getElementById("brown");
                                var bt5 = document.getElementById("cyan");
                                var bt6 = document.getElementById("pink");
                                var input = document.getElementById("valuecolor");

                                $chosen_button.classList.add("chosen");
                                input.value = '$chosenColor';
                                var chosen = '$chosen_button';

                                bt1.onclick = function () {
                                    removeRest()
                                    bt1.classList.add("chosen");
                                    input.value = "default";
                                }

                                bt2.onclick = function () {
                                    removeRest()
                                    bt2.classList.add("chosen");
                                    input.value = "lime";
                                }

                                bt3.onclick = function () {
                                    removeRest()
                                    bt3.classList.add("chosen");
                                    input.value = "dark";
                                }

                                bt4.onclick = function () {
                                    removeRest()
                                    bt4.classList.add("chosen");
                                    input.value = "brown";
                                }

                                bt5.onclick = function () {
                                    removeRest()
                                    bt5.classList.add("chosen");
                                    input.value = "cyan";
                                }

                                bt6.onclick = function () {
                                    removeRest()
                                    bt6.classList.add("chosen");
                                    input.value = "pink";
                                }

                                function removeRest() {
                                    bt1.classList.remove("chosen");
                                    bt2.classList.remove("chosen");
                                    bt3.classList.remove("chosen");
                                    bt4.classList.remove("chosen");
                                    bt5.classList.remove("chosen");
                                    bt6.classList.remove("chosen");
                                }
                            });
                            </script>
                            HTML;
                ?>
            </div>
        </div>
</body>

</html>