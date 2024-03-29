<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="files/placeholdericon.png" border="image/x-icon">
    <script src="scripts/icons.js"></script>
    <script src="scripts/cakecreator.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <title>Creacion de pasteles</title>

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
    changeColorsPRESET("strongcyan");
    ?>
    <div class='bodyCenter'>


        <dialog id='createConfirm'>
            <h2 class='main-textcenter'>Listo para terminar tu creación?</h2>
            <div class='main-rowcenter'>
                <div style='margin-right: 1em'>
                    <canvas id="canvas" style='display: none'></canvas>
                    <div>
                        <img src="" alt="GENERATEDIMAGE" id='canvasImage' class='dialog_ccimg'>
                    </div>
                </div>
                <div>
                    <p class='main-medfont main-textcenter'>
                        Este es tu pastel, es creado por tí y podrás compartirlo<br>
                        en tu perfil y añadirlo para pedirlo en tu carrito de compras.
                    </p>
                    <form method='post' action='conns/createcustomcake.php' class='main-column main-center' enctype='multipart/form-data'>
                        <h3 class='main-nmb'>Nombre de tu torta</h3>

                        <input type="text" class='main-inputalt' name='cakename' autocomplete="off" required>
                        <input type="hidden" name='cakedesc' id='cakedesc' readonly>
                        <input type="hidden" name='cakeprice' id='cakeprice' readonly>
                        <input type="hidden" name='cakeing' id='cakeing' readonly>
                        <input type="file" style='display: none' name='cakeimg' id='cakeimg'>

                        <button class='main-button main-maxw main-rowcenter main-iconnmtb' type="submit">
                            <script>
                            icon("2em", "2em", "saveas")
                            </script>
                            Crear torta
                        </button>
                    </form>
                </div>
            </div>
            <button class='main-button main-maxw' id='closeCrCf'>
                Cerrar
                <!-- create dialog for creating an order with preview -->
            </button>
        </dialog>



        <div class='undernav'>
            <div class='bodybg'>
                <?php
                renderPopup();
                ?>
                <h1>Descubre todas las opciones que ofrecemos para crear!</h1>
                <p t='c'>
                    Usa el menú interactivo para llevar a cabo la creación de tu pastel, luego puedes publicarlo o<br>
                    añadirlo a tu carrito para pedirlo.
                </p>

                <div class='main-rowcenter main-maxw main-flex1'>

                    <div class='main-bordercont2 main-center main-maxh main-nm' style='width: 40%'>
                        <h2>Vista previa de tu torta</h2>
                        <p id='price'>Precio $0</p>
                        <div class='cc_imgpreview_cont' id='imagecont'>
                            <img src="files/cakecreator/no_data.png" alt="PREVIEW" class='cc_imgpreview' id='cc_imgpreview'>
                            <img src="" alt="SIZE" class='cc_imgpreview' id='cc_size'>
                            <img src="" alt="FLAVOR" class='cc_imgpreview' id='cc_flavor'>
                            <img src="" alt="FILLING" class='cc_imgpreview' id='cc_filling'>
                            <img src="" alt="COVER" class='cc_imgpreview' id='cc_cover'>
                            <img src="" alt="BORDER" class='cc_imgpreview' id='cc_border'>
                        </div>
                    </div>

                    <div class='main-maxw' style='width: 40%'>

                        <div class='main-bordercont2 main-start main-maxh main-maxw' id='cc_cont_p1'>
                            <div class='main-rowstart main-aligncenter'>
                                <script>
                                icon("3em", "3em", "chart");
                                </script>
                                <div class='main-column main-start'>
                                    <h2 class='main-nmb'>Tamaño de tu torta</h2>
                                    <p>Las porciones o el tamaño de la torta, adecúalo en base a tus necesidades.</p>
                                </div>
                            </div>

                            <div class='main-maxw' id='cc_contOptions_p1'>
                                <button class='cc_button' id='option_size1'>
                                    <p>1/4 de libra (8 personas) [ $20.000 ]</p>
                                </button>

                                <button class='cc_button' id='option_size2'>
                                    <p>1/2 de libra (12 a 14 personas) [ $35.000 ]</p>
                                </button>

                                <button class='cc_button' id='option_size3'>
                                    <p>1 libra (30 a 35 personas) [ $50.000 ]</p>
                                </button>
                            </div>
                        </div>

                        <div class='main-bordercont2 main-start main-maxh main-maxw' id='cc_cont_p2'>

                            <div class='main-rowstart main-aligncenter'>
                                <script>
                                icon("3em", "3em", "cake");
                                </script>
                                <div class='main-column main-start'>
                                    <h2 class='main-nmb'>Sabores del Bizcocho</h2>
                                    <p>El sabor de la base del bizcocho del pastel.</p>
                                </div>
                            </div>

                            <div class='main-maxw' id='cc_contOptions_p2'>
                                <button class='cc_button' id='option_flavor1'>
                                    <p>Pastel de Zanahoria [ $2.000 ]</p>
                                </button>

                                <button class='cc_button' id='option_flavor2'>
                                    <p>Pastel de Chocolate [ $3.000 ]</p>
                                </button>

                                <button class='cc_button' id='option_flavor3'>
                                    <p>Pastel de Naranja con semillas de amapola [ $4.000 ]</p>
                                </button>

                                <button class='cc_button' id='option_flavor4'>
                                    <p>Pastel de Vainilla [ $2.000 ]</p>
                                </button>

                                <button class='cc_button' id='option_flavor5'>
                                    <p>Pastel de Red Velvet [ $3.000 ]</p>
                                </button>

                                <button class='cc_button' id='option_flavor6'>
                                    <p>Pastel de Limón [ $3.000 ]</p>
                                </button>
                            </div>
                        </div>

                        <div class='main-bordercont2 main-start main-maxh main-maxw' id='cc_cont_p3'>
                            <div class='main-rowstart main-aligncenter'>
                                <script>
                                icon("3em", "3em", "cakephp");
                                </script>
                                <div class='main-column main-start'>
                                    <h2 class='main-nmb'>Relleno de la torta</h2>
                                    <p>El sabor adicional que estará de relleno en tu torta.</p>
                                </div>
                            </div>

                            <div class='main-maxw' id='cc_contOptions_p3'>

                                <button class='cc_button' id='option_filling0'>
                                    <p>Sin relleno</p>
                                </button>

                                <h2 class='main-textcenter' style='margin-top: 1em;'>Cremas pasteleras</h2>

                                <div class='main-row main-start main-wrap'>
                                    <button class='cc_button main-widthautoimp' id='option_filling1'>
                                        <p>De limón [ $1.000 ]</p>
                                    </button>

                                    <button class='cc_button main-widthautoimp' id='option_filling2'>
                                        <p>De naranja [ $1.000 ]</p>
                                    </button>

                                    <button class='cc_button main-widthautoimp' id='option_filling3'>
                                        <p>De vainilla [ $1.000 ]</p>
                                    </button>
                                </div>

                                <br>

                                <h2 class='main-textcenter'>Rellenos dulces</h2>

                                <button class='cc_button' id='option_filling4'>
                                    <p>Crema chantilly [ $2.000 ]</p>
                                </button>

                                <button class='cc_button' id='option_filling5'>
                                    <p>Crema de arándanos [ $5.000 ]</p>
                                </button>

                                <button class='cc_button' id='option_filling6'>
                                    <p>Ganache de chocolate [ $4.000 ]</p>
                                </button>

                                <button class='cc_button' id='option_filling7'>
                                    <p>Crema de chocolate [ $4.000 ]</p>
                                </button>


                                <br>

                                <h2 class='main-textcenter'>Mermeladas</h2>
                                <div class='main-row main-start main-wrap'>
                                    <button class='cc_button main-widthautoimp' id='option_filling8'>
                                        <p>Fresa [ $1.000 ]</p>
                                    </button>

                                    <button class='cc_button main-widthautoimp' id='option_filling9'>
                                        <p>Mora [ $1.000 ]</p>
                                    </button>

                                    <button class='cc_button main-widthautoimp' id='option_filling10'>
                                        <p>Frutos Rojos [ $1.000 ]</p>
                                    </button>

                                    <button class='cc_button main-widthautoimp' id='option_filling11'>
                                        <p>Mango [ $1.000 ]</p>
                                    </button>

                                    <button class='cc_button main-widthautoimp' id='option_filling12'>
                                        <p>Naranja [ $1.000 ]</p>
                                    </button>
                                </div>
                            </div>
                        </div>


                        <div class='main-bordercont2 main-start main-maxh main-maxw' id='cc_cont_p4'>

                            <div class='main-rowstart main-aligncenter'>
                                <script>
                                icon("3em", "3em", "dessert");
                                </script>
                                <div class='main-column main-start'>
                                    <h2 class='main-nmb'>Cobertura del pastel</h2>
                                    <p>Elige con que quieres darle cobertura a tu torta.</p>
                                </div>
                            </div>

                            <div class='main-maxw' id='cc_contOptions_p4'>
                                <button class='cc_button' id='option_cover0'>
                                    <p>Sin cobertura</p>
                                </button>

                                <button class='cc_button' id='option_cover1'>
                                    <p>Buttercream [ $4.000 ]</p>
                                </button>

                                <button class='cc_button' id='option_cover2'>
                                    <p>Chocolate Negro [ $5.000 ]</p>
                                </button>

                                <button class='cc_button' id='option_cover3'>
                                    <p>Chocolate Blanco [ $5.000 ]</p>
                                </button>

                                <button class='cc_button' id='option_cover4'>
                                    <p>Cubierta de crema Chantilly [ $6.000 ]</p>
                                </button>

                                <button class='cc_button' id='option_cover5'>
                                    <p>Cubierta de Fondant blanco [ $4.000 ]</p>
                                </button>
                            </div>
                        </div>

                        <div class='main-bordercont2 main-start main-maxh main-maxw' id='cc_cont_p5'>

                            <div class='main-rowstart main-aligncenter'>
                                <script>
                                icon("3em", "3em", "cakeslice");
                                </script>
                                <div class='main-column main-start'>
                                    <h2 class='main-nmb'>Bordeado de la torta</h2>
                                    <p>Elige como complementar el sabor y el diseño con los bordeados que ofrecemos.</p>
                                </div>
                            </div>

                            <div class='main-maxw' id='cc_contOptions_p5'>
                                <button class='cc_button' id='option_border0'>
                                    <p>Sin bordeado</p>
                                </button>

                                <button class='cc_button' id='option_border1'>
                                    <p>Crema chantilly [ $2.000 ]</p>
                                </button>

                                <button class='cc_button' id='option_border2'>
                                    <p>Oreos [ $3.000 ]</p>
                                </button>

                                <button class='cc_button' id='option_border3'>
                                    <p>M&Ms [ $4.000 ]</p>
                                </button>

                                <button class='cc_button' id='option_border4'>
                                    <p>Pepitas de chocolate [ $2.000 ]</p>
                                </button>

                                <button class='cc_button' id='option_border5'>
                                    <p>Chispas de colores [ $1.000 ]</p>
                                </button>
                            </div>
                        </div>


                        <div class='main-rowcenter main-nm'>
                            <button class='cc_button' id='option_back' tt='send' disabled>
                                <script>
                                icon("2em", "2em", "larrow");
                                </script>
                                <p>Volver</p>
                            </button>
                            <button class='cc_button' id='option_next' tt='send' disabled>
                                <p>Continuar</p>
                                <script>
                                icon("2em", "2em", "rarrow");
                                </script>
                            </button>
                        </div>
                        <button class='cc_button' id='option_finish' tt='send' disabled>
                            <script>
                            icon("2em", "2em", "brush");
                            </script>
                            <p>Terminar y publicar creación</p>
                        </button>
                    </div>

                </div>

                <input type="hidden" class='main-inputalt' style='width: 50%; text-align: center' id='cake_params' readonly>
            </div>
        </div>
    </div>
</body>

</html>