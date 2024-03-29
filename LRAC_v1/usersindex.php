<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="files/placeholdericon.png" type="image/x-icon">
    <script src="scripts/icons.js"></script>
    <title>Índice de usuarios</title>

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
    <div class='bodyCenter'>
        <div class='undernav'>
            <div class='bodybg'>
                <h2>¡Estos son los usuarios registrados en nuestro sitio!</h2>
                <div class='main-row main-maxw main-wrap'>
                    <?php
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

                        echo <<<HTML
                        <a href='userprofile.php?user=$userid' class="user-profile">
                            <img src="files/userpfp/$pfp" type='userp'>
                            <div class='main-column'>
                                <h2 class='main-nmb'>$name</h2>
                                <div class='up-biocont'>
                                    <h6>SOBRE MI:</h6>
                                    <p>$bio</p>
                                </div>
                            </div>
                        </a>
                        HTML;
                    }
                    ?>


                </div>
            </div>
        </div>
    </div>
</body>

</html>