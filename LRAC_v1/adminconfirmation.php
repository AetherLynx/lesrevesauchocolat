<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="files/placeholdericon.png" type="image/x-icon">
    <script src="scripts/icons.js"></script>
    <title>Index para administradores</title>

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
    changeColorsPRESET("gray");
    ?>

    <!-- BODY -->
    <div class='bodyCenter'>
        <div class="undernav">
            <div class="bodybg">
                <?php
                adminChecker();
                if (empty($_GET)) {
                    echo "<h1>No hay parámetros definidos para ver esta página.</h1>";
                    die();
                }

                if (isset($_GET["deleteUser"])) {
                    $query = $_GET["query"];

                    $sql = "SELECT * FROM userdata WHERE userid='$query'";
                    $result = $conn->query($sql);

                    if (!$result->num_rows > 0) {
                        echo "<h1>No se encontró ese usuario.</h1>";
                        die();
                    }

                    $row = $result->fetch_assoc();

                    echo <<<HTML
                    <div class='main-columncenter main-maxw'>
                        <h1>Estás seguro que quieres eliminar este usuario?</h1>
                        <table>
                            <tr>
                                <th>NOMBRE</th>
                                <th>CORREO</th>
                                <th>PREGUNTA DE SEGURIDAD</th>
                                <th>RESPUESTA DE SEGURIDAD</th>
                                <th>NUMERO</th>
                                <th>TIPO DE USUARIO</th>
                                <th>DIRECCION</th>
                                <th>COLOR DE PERFIL</th>
                                <th>BIOGRAFIA</th>
                                <th>CANTIDAD DE ORDENES</th>
                            </tr>
                            <tr>
                                <td>{$row["name"]}</td>
                                <td>{$row["mail"]}</td>
                                <td>{$row["question"]}</td>
                                <td>{$row["qanswer"]}</td>
                                <td>{$row["numtel"]}</td>
                                <td>{$row["userRole"]}</td>
                                <td>{$row["address"]}</td>
                                <td>{$row["prefColor"]}</td>
                                <td>{$row["bio"]}</td>
                                <td>{$row["ordersCant"]}</td>
                            </tr>
                        </table>
                        <a href='conns/adminmngusers.php?deleteUser&query=$query' class='icontext' href="">
                            <script>
                                icon("2em", "2em", "eraser")
                            </script>
                            <p>Eliminar a {$row["name"]}</p>
                        </a>
                    </div>
                    HTML;
                    die();
                }

                if (isset($_GET["modifyUser"])) {
                    $query = $_GET["query"];
                    $sql = "SELECT * FROM userdata WHERE userid='$query'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();

                    $canrc = null;
                    if ($row["userid"] == $_SESSION["user_id"]) {
                        $canrc = "disabled";
                    };


                    $useris = $row["userRole"];
                    $role = ["user" => "", "admin" => ""];
                    $role[$useris] = "selected";

                    $prefColor = $row["prefColor"];
                    $colors = [
                        "default" => "",
                        "lime" => "",
                        "dark" => "",
                        "brown" => "",
                        "cyan" => "",
                        "pink" => "",
                        "strongcyan" => "",
                        "orange" => "",
                        "pinkie" => "",
                        "mint" => "",
                        "red" => "",
                        "lily" => ""
                    ];
                    $colors[$prefColor] = "selected";

                    echo <<<HTML
                        <form method='post' action="conns/adminmngusers.php?editUserinfo&query=$query" class='main-row main-start main-maxw'>
                            <div class='main-column' style='width: 40%'>
                                <h1>Nombre del usuario</h1>
                                <p>El nombre que define el usuario en la plataforma, usado para el login.</p>
                            </div>
                            <div class='main-column' style='width: 40%'>
                                <input type="text" class='main-inputalt' style='width: 100%' name='name' value='{$row["name"]}'>
                            </div>
                            
                            <div class='main-column' style='width: 40%'>
                                <h1>Contraseña del usuario</h1>
                                <p>La contraseña con que inicia sesión el usuario.</p>
                            </div>
                            <div class='main-column' style='width: 40%'>
                                <input type="text" class='main-inputalt' style='width: 100%' name='pass' value='{$row["pass"]}'>
                            </div>
                            
                            <div class='main-column' style='width: 40%'>
                                <h1>Pregunta de seguridad</h1>
                                <p>Pregunta para el restablecimiento de contraseña. (No se puede cambiar.)</p>
                            </div>
                            <div class='main-column' style='width: 40%'>
                                <input type="text" class='main-inputalt' style='width: 100%' name='question' readonly value='{$row["question"]}'>
                            </div>
                            
                            <div class='main-column' style='width: 40%'>
                                <h1>Respuesta de seguridad</h1>
                                <p>Respuesta para el restablecimiento de contraseña. (No se puede cambiar.)</p>
                            </div>
                            <div class='main-column' style='width: 40%'>
                                <input type="text" class='main-inputalt' style='width: 100%' name='qanswer' readonly value='{$row["qanswer"]}'>
                            </div>
                            
                            <div class='main-column' style='width: 40%'>
                                <h1>Número telefónico</h1>
                                <p>El número de telefono del usuario.</p>
                            </div>
                            <div class='main-column' style='width: 40%'>
                                <input type="text" class='main-inputalt' style='width: 100%' name='numtel' value='{$row["numtel"]}'>
                            </div>
                            
                            <div class='main-column' style='width: 40%'>
                                <h1>Tipo de usuario</h1>
                                <p>Cuál es el rol del usuario, ser administrador le proporcionará permisos.</p>
                            </div>
                            <div class='main-column' style='width: 40%'>
                                <select name="userRole" class='main-select' style='width: 100%' $canrc>
                                    <option value="user" {$role["user"]}>Usuario</option>
                                    <option value="admin" {$role["admin"]}>Administrador</option>
                                </select>
                            </div>
                            
                            <div class='main-column' style='width: 40%'>
                                <h1>Dirección de residencia</h1>
                                <p>La dirección a la que se le enviarán los pedidos al usuario.</p>
                            </div>
                            <div class='main-column' style='width: 40%'>
                                <input type="text" class='main-inputalt' style='width: 100%' name='address' value='{$row["address"]}'>
                            </div>
                            
                            <div class='main-column' style='width: 40%'>
                                <h1>Color del perfil</h1>
                                <p>El color que se mostrará en el perfil del usuario.</p>
                            </div>
                            <div class='main-column' style='width: 40%'>
                                <select name="prefColor" class='main-select' style='width: 100%'>
                                    <option value="default" {$colors["default"]}>Predeterminado</option>
                                    <option value="lime" {$colors["lime"]}>Lima</option>
                                    <option value="dark" {$colors["dark"]}>Negro</option>
                                    <option value="brown" {$colors["brown"]}>Café</option>
                                    <option value="cyan" {$colors["cyan"]}>Celeste Pastel</option>
                                    <option value="pink" {$colors["pink"]}>Rosa Fuerte</option>
                                    <option value="strongcyan" {$colors["strongcyan"]}>Cyan Fuerte</option>
                                    <option value="orange" {$colors["orange"]}>Naranja</option>
                                    <option value="pinkie" {$colors["pinkie"]}>Rosa Pastel</option>
                                    <option value="mint" {$colors["mint"]}>Menta</option>
                                    <option value="red" {$colors["red"]}>Rojo</option>
                                    <option value="lily" {$colors["lily"]}>Lila</option>
                                </select>
                            </div>
                            
                            <div class='main-column' style='width: 40%'>
                                <h1>Biografía</h1>
                                <p>Información sobre el usuario.</p>
                            </div>
                            <div class='main-column' style='width: 40%'>
                                <input type="text" class='main-inputalt' style='width: 100%' name='bio' value='{$row["bio"]}'>
                            </div>

                            <div class='main-column' style='width: 40%'>
                                <h1>Cantidad de ordenes</h1>
                                <p>Cuántas ordenes ha realizado el usuario. (No se puede cambiar.)</p>
                            </div>
                            <div class='main-column' style='width: 40%'>
                                <input type="number" class='main-inputalt' style='width: 100%' name='ordersCant' value='{$row["ordersCant"]}' readonly>
                            </div>

                            <button class='icontext main-buttonpadding' type="submit" name='editUserinfo'>
                                <script>
                                    icon("", "", editb)
                                </script>
                                <p>Actualizar información</p>
                            </button>
                        </form>
                    HTML;
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>