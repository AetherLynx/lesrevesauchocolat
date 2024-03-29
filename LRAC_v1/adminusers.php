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
                renderPopup();
                $sql = "SELECT userid, name, bio, pfp FROM userdata";
                $result = $conn->query($sql);

                if ($result->num_rows < 0) {
                    echo "<h1>No se encontraron usuarios registrados :(</h1>";
                    die();
                }

                while ($row = $result->fetch_assoc()) {
                    $userid = $row["userid"];
                    $name = $row["name"];
                    $bio = $row["bio"];
                    $pfp = $row["pfp"];

                    $logged = null;

                    $candelete = "
                        <a href='adminconfirmation.php?deleteUser&query=$userid' class='icontext'>
                            <script>
                                icon('2em', '2em', 'eraser')
                            </script>
                            <p>Eliminar a $name (#$userid)</p>
                        </a>
                        ";

                    if ($userid == $_SESSION["user_id"]) {
                        $candelete = null;
                        $logged = " (SESIÓN ACTUAL)";
                    }

                    echo <<<HTML
                        <div class='main-rowstart main-aligncenter main-maxw'>
                            <a href='userprofile.php?user=$userid' class="user-profile">
                                <img src="files/userpfp/$pfp" type='userp'>
                                <div class='main-column'>
                                        <h2 class='main-nmb'>$name</h2>
                                        <p>ID #$userid $logged</p>
                                    <div class='up-biocont'>
                                        <h5>BIOGRAFÍA:</h5>
                                        <p>$bio</p>
                                    </div>
                                </div>
                            </a>

                            <div class='main-nm main-column'>
                                <a href='adminconfirmation.php?modifyUser&query=$userid' class='icontext'>
                                    <script>
                                        icon('2em', '2em', editb)
                                    </script>
                                    <p>Modificar datos</p>
                                </a>
                                <a href='conns/adminmngusers.php?removePfp&query=$userid' class='icontext'>
                                    <script>
                                        icon('2em', '2em', userb)
                                    </script>
                                    <p>Eliminar foto de perfil</p>
                                </a>
                                $candelete
                            </div>
                        </div>
                        HTML;
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>