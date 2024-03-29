<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="files/placeholdericon.png" type="image/x-icon">
    <script src="scripts/icons.js"></script>
    <title>Perfil público</title>

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
        <div class="undernav">
            <div class='bodybg'>
                <?php
                renderPopup();
                if (!isset($_GET["user"])) {
                    echo "
                    <h1>No se definió la ID del usuario.</h1>
                    ";
                    die();
                }

                $historybt = null;
                if (isset($_GET["origin"])) {
                };
                $user = true;
                if (!isset($_SESSION["loggedin"])) {
                    $user = false;
                }

                $userquery = $_GET["user"];
                $_SESSION["profileOrigin"] = $userquery;
                $sql = "SELECT * FROM userdata WHERE userid='$userquery'";
                $result = $conn->query($sql);
                if ($user) {
                    $user_id = $_SESSION["user_id"];

                    if ($userquery == $user_id) {
                        $canEdit = "
                    <a href='userconfig.php' class='icontext'>
                        <script>
                            icon('2em', '2em', editb)
                        </script>
                        <p>Editar perfil</p>
                    </a>
                    ";
                    } else {
                        $canEdit = null;
                    }
                } else {
                    $canEdit = null;
                }

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $name = $row["name"];
                    $mail = $row["mail"];
                    $number = $row["numtel"];
                    $pfp = $row["pfp"];
                    $bio = $row["bio"];
                    $color = $row["prefColor"];
                    $ordersCant = $row["ordersCant"];

                    if (!(is_string($color))) {
                        $color = "dark";
                    }

                    if ($color != "default") {
                        changeColorsPRESET($color);
                    }

                    if ($bio == NULL) {
                        $bio = "(sin biografía.)";
                    }

                    echo <<<HTML
                        <div class='main-rowstartcenter main-maxw main-np'>

                            <div class='main-rowstartcenter main-wrap' style='width: 50%;'>
                                <img src='files/userpfp/$pfp' type='pfp'>
                                <div class='main-column'>
                                    <h1>$name</h1>
                                    <div class='up-biocont'>
                                        <h6>SOBRE MI</h6>
                                        <p>$bio</p>
                                    </div>
                                $canEdit
                                <a href='usercomments.php?user=$userquery' class='icontext'>
                                    <script>
                                        icon('2em', '2em', "textbubble")
                                    </script>
                                    <p>Ver comentarios</p>
                                </a>
                                </div>
                            </div>

                            <div class='main-column main-start' style='width: 50%'>
                                <div class='main-row main-nm'>
                                    <script>
                                    icon('3em', '3em', 'stat');
                                    </script>
                                    <h2>Cantidad de pedidos hechos</h2>
                                </div>
                                <p>Este usuario ha hecho un total de $ordersCant pedidos en nuestra página!</p>

                                <div class='main-row main-nm'>
                                    <script>
                                    icon('3em', '3em', 'telephone');
                                    </script>
                                    <h2>Información de contacto</h2>
                                </div>

                                <div class='up-biocont main-start'>
                                    <div class='main-row'>
                                        <script>
                                        icon('2em', '2em', 'mail');
                                        </script>
                                        <p>$mail</p>
                                    </div>
                                    <div class='main-row'>
                                        <script>
                                        icon('2em', '2em', phoneb);
                                        </script>
                                        <p>$number</p>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class='main-column main-start main-maxw'>
                            <h1>Creaciones</h1>
                            <p>Estas son las creaciones hechas por $name.</p>
                            <div class='up-biocont'>
                                <div class='catalog-container'>
                    HTML;

                    $sql = "SELECT * FROM productdata WHERE product_creator='$userquery'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $product_id = $row["product_id"];
                            $product_name = $row["product_name"];
                            $product_uniprice = $row["product_uniprice"];
                            $product_category = $row["product_category"];
                            $product_image = $row["product_image"];

                            $proper_price = formatCop($product_uniprice);

                            if ($product_category != "Creacion") {
                                $src = "files/products/" . $product_image;
                                $customfit = "";
                            } else {
                                $src = "files/products/custom/" . $product_image;
                                $customfit = "object-position: 50% 80%;";
                            }
                            echo <<<HTML
                                <a href='viewproduct.php?id=$product_id&sc=4&viewing=$userquery' class='catalog-product'>
                                    <ptitle>
                                        $product_name
                                    </ptitle>
                                    <ptitle type='sub'>
                                        <script>
                                            document.write($product_category);
                                        </script>
                                        $product_category
                                    </ptitle>
                                    <img src='$src' type='catalog' style='$customfit'><br>
                                    <ptitle type='sub'>
                                        PRECIO
                                    </ptitle>
                                    <ptitle>$$proper_price</ptitle>
                                </a>
                            HTML;
                        }
                    } else {
                        echo <<<HTML
                        <p>$name no ha creado ningún producto.</p>
                        HTML;
                    }

                    echo <<<HTML
                                </div>
                            </div>
                        </div>
                    HTML;
                } else {
                    echo "
                    <h1>No se encontró un usuario con esa ID.</h1>
                    <a href='main.php' class='icontext'>
                        <script>
                            icon('2em', '2em', 'back')
                        </script>
                        <p>Volver a la pagina principal</p>
                    </a>
                    ";
                    die();
                }
                include("common/comments.php");
                ?>
            </div>
        </div>
    </div>
</body>

</html>