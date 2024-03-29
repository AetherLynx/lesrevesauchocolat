<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="files/placeholdericon.png" type="image/x-icon">
    <script src="scripts/icons.js"></script>
    <title>Sobre nosotros</title>

    <div style="position: absolute;">
        <?php
        include("conns/conexion.php");
        include("phpfuncs/main.php");
        ?>
    </div>
</head>

<body>
    <?php
    include("common/sidebar.php");
    include("common/navbar.php");
    ?>

    <!-- BODY -->
    <div class="undernav">
        <div class="bodybg">
            <?php
            renderPopup();
            ?>
            <div class="main-columncenter main-maxw">
                <h1>¡Bienvenido a nuestra página!</h1>
                <img src="files/lrac_banner.png" type="bbanner">

                <h1 class='main-maxw main-textcenter' t='bb'>¿Qué productos ofrecemos?</h1>
                <a href='catalogue.php?filter=1' class="mp-rowcont main-maxw">
                    <div class='main-columncenter' style='width: 50%'>
                        <h1>Panadería</h1>
                        <p class='main-medfont main-textcenter main-texts2' style='max-width: 30em;'>
                            Ofrecemos una alta variedad de productos de panadería,
                            priorizamos que encuentres lo que busques, por eso te damos a elegir entre opciones de cada producto que más
                            se adapte a tus necesidades.
                        </p>
                    </div>
                    <img src="files/img_panaderia01.jpg" style='width: 50%'>
                </a>

                <a href='catalogue.php?filter=2' class="mp-rowcont main-maxw">
                    <div class='main-columncenter' style='width: 50%'>
                        <h1>Heladería</h1>
                        <p class='main-medfont main-textcenter main-texts2' style='max-width: 30em;'>
                            Nuestros productos de heladería son varios, ofrecemos una alta cantidad de sabores y tipos
                            de helado para que ordenes a la puerta de tu casa ;)
                        </p>
                    </div>
                    <img src="files/img_heladeria04.jpg" style='width: 50%'>
                </a>


                <a href='catalogue.php?filter=3' class="mp-rowcont main-maxw">
                    <div class='main-columncenter' style='width: 50%'>
                        <h1>Pasteleria</h1>
                        <p class='main-medfont main-textcenter main-texts2' style='max-width: 30em;'>
                            De parte de nuestros habilidosos pasteleros, ofrecemos una cantidad de productos de Pasteleria
                            para que elijas a gusto, nuestro catálogo te da a elegir entre pasteleria común a fina, pide la
                            que mas se acomode a tus gustos.
                        </p>
                    </div>
                    <img src="files/img_pasteleria01.jpg" style='width: 50%'>
                </a>


                <a href='catalogue.php?filter=4' class="mp-rowcont main-maxw">
                    <div class='main-columncenter' style='width: 50%'>
                        <h1>Pasteles Personalizables</h1>
                        <p class='main-medfont main-textcenter main-texts2' style='max-width: 30em;'>
                            Si inicias sesión en nuestra pagina, puedes tener acceso a nuestra interfaz de creación de
                            pasteles! Esta interfaz te da a elegir entre opciones de tamaño, bordeado, sabor y topppings de
                            tu pastel, para que puedas pedirla en la comodidad de tu casa, incluso puedes ver las creaciones de otros usuarios!
                        </p>
                    </div>
                    <img src="files/img_cakemaking01.jpg" style='width: 50%'>
                </a>

                <br>

                <h1 class='main-maxw main-textcenter' t='bb'>¿Qué puedes hacer en nuestra página?</h1>

                <div class='main-rowcenter main-wrap' style='width: 60em'>

                    <div class="main-bordercont2 main-columncenter main-textcenter" style='max-width: 25em; height: 20em'>

                        <script>
                        icon("3em", "3em", "cart")
                        </script>
                        <h2>Realizar pedidos</h2>
                        <p>
                            Ofrecemos una interfaz de catalogo para añadir facilmente los
                            productos que se te antojen a un carrito que se guarda en tu cuenta.
                        </p>
                    </div>

                    <div class="main-bordercont2 main-columncenter main-textcenter" style='max-width: 25em; height: 20em'>
                        <script>
                        icon("4em", "4em", "track")
                        </script>
                        <h2>Consultar pedido en tiempo real</h2>
                        <p>
                            Cuando realizas tu pedido nosotros lo actualizaremos para que tu puedas
                            consultar su estado desde la pagina web.
                        </p>
                    </div>

                    <div class="main-bordercont2 main-columncenter main-textcenter" style='max-width: 25em; height: 20em'>
                        <script>
                        icon("4em", "4em", "user")
                        </script>
                        <h2>Crear un perfil público</h2>
                        <p>
                            Crea una cuenta, personalizala como quieras con foto de perfil, biografía, colores,
                            haz que los demás te conozcan bien!
                        </p>
                    </div>

                    <div class="main-bordercont2 main-columncenter main-textcenter" style='max-width: 25em; height: 20em'>
                        <script>
                        icon("4em", "4em", "users")
                        </script>
                        <h2>Interactúa con la comunidad</h2>
                        <p>
                            Mira los perfiles de otros, haz comentarios en productos del catálogo, en los perfiles
                            de los usuarios y mira las creaciones de otros!
                        </p>
                    </div>
                </div>

                <br>

                <h1 class='main-maxw main-textcenter' t='bb'>Sobre nosotros</h1>
                <div class="main-rowcenter" style='margin-bottom: 5em'>
                    <div class="main-darkcont2 main-columncenter main-textcenter" style='max-width: 30em; height: 30em'>
                        <h2>Nuestra Misión</h2>
                        <p class='main-medfont main-texts2'>
                            Entregamos una experiencia inolvidable a nuestros clientes,
                            con productos de pasteleria, reposteria y heladería de origen 100% colombiano.
                            Para brindar de la mayor calidad y frescura, nos destacamos por nuestro compromiso
                            con la excelencia y creatividad.
                        </p>
                    </div>

                    <div class="main-darkcont2 main-columncenter main-textcenter" style='max-width: 30em; height: 30em'>
                        <h2>Nuestra Visión</h2>
                        <p class='main-medfont main-texts2'>
                            Buscamos convertirnos en la cadena principal de panaderías, resposterías y
                            heladerías a nivel nacional para el 2030, seremos reconocidos por nuestra innovación,
                            calidad y compromiso con la satisfacción de nuestros clientes, asi tambien como nuestra
                            contribución al desarrollo sostenible y bienestar de nuestras comunidades.
                        </p>
                    </div>
                </div>
                <?php
                if (!isset($_SESSION["loggedin"])) {
                    echo <<<HTML
                        <h1>¿Listo para unirte a nosotros?</h1>
                        <p class='main-medfont'>Inicia sesión o regístrate para acceder a todas nuestras funciones.</p>
                        <div class='main-row'>
                            <a class='icontext' href="login.php">
                                <script>
                                    icon("2em", "2em", "user")
                                </script>
                                <p>Iniciar sesión</p>
                            </a>
                            <a class='icontext' href="signin.php">
                                <script>
                                    icon("2em", "2em", "pen")
                                </script>
                                <p>Registrarte</p>
                            </a>
                        </div>
                        HTML;
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>