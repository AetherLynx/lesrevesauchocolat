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
            <input required type="password" name="security_delAccPass" class='main-inputalt' placeholder='verifica tu contraseña' autocomplete='off'>
            <button name='mod_deleteAccount' id='deleteFully' t='alt' class='main-maxw'>
                Si, eliminar definitivamente
            </button>
        </form>
        <button id='deleteCancel' t='alt' class='main-maxw'>
            No, cambié de opinión
        </button>
    </dialog>

    <dialog id='passChange'>
        <h1 class='main-textcenter'>Cambiar tu contraseña</h1>
        <p t='c'>Para cambiar tu contraseña debes introducir tu contraseña vieja, y luego tu contraseña nueva.</p>
        <div class='main-rowcenter'>
            <form method='post' class='main-maxw' action='conns/usermodifyacc.php'>
                <div class='main-nm main-rowcenter'>
                    <input type="password" class='main-inputalt' name='oldpass' placeholder="Contraseña anterior" required>
                    <input type="password" class='main-inputalt' name='newpass' placeholder="Contraseña nueva" required>
                </div>
                <button type='submit' t='alt' class='main-maxw' name='changePassword'>Cambiar contraseña</button>
            </form>
        </div>
        <button type='button' id='changepassExit' t='alt' class='main-maxw'>Cancelar</button>
    </dialog>
    <!-- BODY -->
    <div class='bodyCenter'>
        <div class="undernav">
            <div class='bodybg'>
                <?php

                renderPopup();
                $sql = "SELECT prefColor, bio FROM userdata WHERE userid='{$_SESSION["user_id"]}'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $chosenColor = $row["prefColor"];
                $colors = ["default", "lime", "dark", "brown", "cyan", "pink", "strongcyan", "orange", "pinkie", "mint", "red", "lily"];
                $buttons = ["bt1", "bt2", "bt3", "bt4", "bt5", "bt6", "bt7", "bt8", "bt9", "bt10", "bt11", "bt12"];
                $buttons_JS = json_encode($buttons);
                $index = array_search($chosenColor, $colors);

                $chosen_button = $buttons[$index];

                $bio = $row["bio"];


                echo <<<HTML
                <form method='post' action='conns/usermodifyacc.php' enctype='multipart/form-data'>
                        <div class='main-rowstart main-maxw'>

                            <div class='main-columncenter main-shadow main-br6' id='userconfig'>
                                <div class='main-rowcenter up-biocont main-nmt'>
                                    <script>
                                        icon("3em", "3em", "avatar")
                                    </script>
                                    <div>
                                        <h2>Foto de perfil</h2>
                                        <p>Elige una foto con la que te identifiques.</p>
                                    </div>
                                </div>
                                <div class='main-columncenter main-maxh'>
                                    <img src='files/userpfp/{$_SESSION["user_pfp"]}' type='pfp' id='output'>
                                    <input type='file' accept='image/*' name='data_user_PFP' class='main-inputfile'onchange='loadFile(event)' id=pfpFile''>
                                    <button type='submit' t='alt' class='main-maxw' name='mod_changePfp' id='fileUploadBT'disabled>Cambiar foto de perfil</button>
                                </div>
                            </div>
                            
                            <div class='main-columncenter main-shadow main-br6' id='userconfig'>
                                <div class='main-rowcenter up-biocont main-nmt'>
                                    <script>
                                        icon("3em", "3em", "data")
                                    </script>
                                    <div>
                                        <h2>Información sobre tí</h2>
                                        <p>Datos sobre tu cuenta, tu nombre, numero y correo son públicos.</p>
                                    </div>
                                </div>
                                <div class='main-columncenter'>
                                    <div class='main-rowcenter'>
                                    <script>
                                    document.write(userb);
                                    </script>
                                    <input type='text' name='data_user_name' placeholder='Nombre de usuario' class='main-inputalt main-maxw' value='{$_SESSION["user_name"]}'>
                                </div>
                                <div class='main-rowcenter'>
                                    <script>
                                    document.write(mailb);
                                    </script>
                                    <input type='text' name='data_user_mail' placeholder='Correo electrónico' class='main-inputalt' value='{$_SESSION["user_mail"]}'>
                                </div>
                                <div class='main-rowcenter'>
                                    <script>
                                    document.write(phoneb);
                                    </script>
                                    <input type='text' name='data_user_numtel' placeholder='Número de teléfono' class='main-inputalt' value='{$_SESSION["user_numtel"]}'>
                                </div>
                                <div class='main-rowcenter'>
                                    <script>
                                    document.write(markerb);
                                    </script>
                                    <input type='text' name='data_user_address' placeholder='Dirección de entrega' class='main-inputalt' value='{$_SESSION["user_address"]}'>
                                </div>
                                <button type='submit' t='alt' class='main-maxw' name='mod_updateData'>Actualizar datos</button>
                                </div>
                            </div>

                            <div class='main-columncenter main-shadow main-br6 main-maxh' id='userconfig'>
                                <div class='main-rowcenter up-biocont main-nmt'>
                                    <script>
                                        icon("3em", "3em", "config")
                                    </script>
                                    <div>
                                        <h2>Otras opciones</h2>
                                        <p>Cambiar contraseña, eliminar cuenta, etc.</p>
                                    </div>
                                </div>
                                <div class='main-columncenter main-maxw'>
                                    <button type='button' id='changepassConfirm' t='alt' class='main-maxw'>Cambiar contraseña</button>
                                    <button type='button' id='deleteConfirm' t='alt' class='main-maxw'>Eliminar cuenta</button>
                                </div>
                            </div>


                        </div>
                    <div class='main-rowcenter main-maxw'>
                            <div class='main-columncenter main-shadow main-br6' id='userconfig'>

                                <div class='main-rowcenter up-biocont main-nmt main-aligncenter'>
                                    <script>
                                        icon("3em", "3em", "brush")
                                    </script>
                                    <div>
                                        <h2>Cambiar color del perfil</h2>
                                        <p>El color que se mostrará en tu perfil público.</p>
                                    </div>
                                </div>
                                <div class='main-rowstart main-maxw' id='buttons-cont'>
                                        <button class='color-chooser' type='button' style='background-color: var(--co4)' id='default'></button>
                                        <button class='color-chooser' type='button' style='background-color:#81c986' id='lime'></button>
                                        <button class='color-chooser' type='button' style='background-color:#34324a' id='dark'></button>
                                        <button class='color-chooser' type='button' style='background-color:#BF7B69' id='brown'></button>
                                        <button class='color-chooser' type='button' style='background-color:#94ADD7' id='cyan'></button>
                                        <button class='color-chooser' type='button' style='background-color:#E63F74' id='pink'></button>
                                        <button class='color-chooser' type='button' style='background-color:#6ed7db' id='strongcyan'></button>
                                        <button class='color-chooser' type='button' style='background-color:#ff913d' id='orange'></button>
                                        <button class='color-chooser' type='button' style='background-color:#df9ee8' id='pinkie'></button>
                                        <button class='color-chooser' type='button' style='background-color:#7be0b5' id='mint'></button>
                                        <button class='color-chooser' type='button' style='background-color:#ff3d3d' id='red'></button>
                                        <button class='color-chooser' type='button' style='background-color:#9c81cc' id='lily'></button>
                                </div>
                                <form method='post' class='main-rowstart' action='conns/usermodifyacc.php'>
                                    <input class='main-inputalt' type='hidden' id='valuecolor' name='prefColor' readonly>
                                    <button class='icontext main-buttonpadding' type='submit' name='changeColor'>
                                        <script>
                                            icon('2em', '2em', 'brush')
                                        </script>
                                        <p>Cambiar color</p>
                                    </button>
                                </form>
                                
                            </div>
                        </div>
                    <div class='main-rowcenter main-maxw'>
                        <div class='main-columncenter main-shadow main-br6' id='userconfig'>
                            <div class='main-rowcenter up-biocont main-nmt'>
                                <script>
                                    icon("3em", "3em", "infor")
                                </script>
                                <div>
                                    <h2>Sobre tí</h2>
                                    <p>Escribe algo pequeño para conocerte un poco.</p>
                                </div>
                            </div>
                            <div class='main-columncenter main-maxh'>
                                <form method='post' action='conns/usermodifyacc.php'>
                                    <input type="text" id='bio-input' maxlength="50" name='newbio' value='$bio' placeholder="Cuéntanos sobre ti..." autocomplete="off">
                                    <button class='icontext main-buttonpadding' type='submit' name='changebio'>
                                        <script>
                                            icon('2em', '2em', editb)
                                        </script>
                                        <p>Actualizar biografía</p>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>
            
            
                    <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        var bt1 = document.getElementById("default");
                        var bt2 = document.getElementById("lime");
                        var bt3 = document.getElementById("dark");
                        var bt4 = document.getElementById("brown");
                        var bt5 = document.getElementById("cyan");
                        var bt6 = document.getElementById("pink");
                        var bt7 = document.getElementById("strongcyan");
                        var bt8 = document.getElementById("orange");
                        var bt9 = document.getElementById("pinkie");
                        var bt10 = document.getElementById("mint");
                        var bt11 = document.getElementById("red");
                        var bt12 = document.getElementById("lily");
                        var input = document.getElementById("valuecolor");
                        
                        var buttons = $buttons_JS;
                        $chosen_button.classList.add("chosen");
                        input.value = '$chosenColor';
                        var chosen = '$chosen_button';
                        const buttonsContainer = document.getElementById("buttons-cont");
                        const inputColor = document.getElementById("valuecolor");

                        buttonsContainer.addEventListener("click", (event) => {
                            if (event.target.classList.contains("color-chooser")) { 
                                for (const button of buttonsContainer.querySelectorAll(".color-chooser")) {
                                    button.classList.remove("chosen");
                                }
                              event.target.classList.add("chosen");
                              inputColor.value = event.target.id;
                            }
                        });


                        var dialog = document.getElementById('dialog');
                        var openButton = document.getElementById('deleteConfirm');
                        var closeButton = document.getElementById('deleteCancel');

                        var dialog2 = document.getElementById('passChange');
                        var openButton2 = document.getElementById('changepassConfirm');
                        var closeButton2 = document.getElementById('changepassExit');
                                                    
                        openButton.onclick = function() {
                            dialog.showModal();
                        }
                        
                        closeButton.onclick = function() {
                            dialog.setAttribute("closing", ""); //for backdrop
                            dialog.style.animation = "dialog-close 0.4s";
                            dialog.style.animationFillMode = "forwards";
                            setTimeout(() => {
                                dialog.close();
                                dialog.style.animation = "none";
                                dialog.removeAttribute("closing");
                            }, 390);
                        }

                        openButton2.onclick = function() {
                            dialog2.showModal();
                        }
                        
                        closeButton2.onclick = function() {
                            dialog2.setAttribute("closing", ""); //for backdrop
                            dialog2.style.animation = "dialog-close 0.4s";
                            dialog2.style.animationFillMode = "forwards";
                            setTimeout(() => {
                                dialog2.close();
                                dialog2.style.animation = "none";
                                dialog2.removeAttribute("closing");
                            }, 390);
                        }
                    });
                    
                    var loadFile = function(event) {
                            var image = document.getElementById('output');
                            var bt = document.getElementById('fileUploadBT');
                        
                            bt.removeAttribute('disabled');
                            image.src = URL.createObjectURL(event.target.files[0]);
                        
                        };
                    </script>
                HTML;
                ?>
            </div>
        </div>
</body>

</html>