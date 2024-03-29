<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="scripts/icons.js"></script>
    <link rel="icon" href="files/placeholdericon.png" type="image/x-icon">
    <title>Manejo de productos</title>

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
    <div class="undernav">
        <div class="bodybg">
            <?php
            adminChecker();
            ?>
            <a class='butt' href="adminindex.php" t='alt'>Volver al index</a>
            <h2>Elija una opción de administración</h2>
            <div class='catchoose'>
                <a href='adminprodmng.php?addproduct' class='butt' t='alt'>Añadir producto</a>
                <a href='adminprodmng.php?searchproduct' class='butt' t='alt'>Modificar producto</a>
            </div>

            <?php
            if (isset($_GET["addproduct"])) {
                echo "
                <form class='prodMng' method='post' action='conns/adminuploadprod.php' enctype='multipart/form-data'>
                    <p>Llene el formulario para subir un nuevo producto al catalogo.</p>
                
                    <div class='main-borderbox main-bordercontx' style='width: 50em'>
                        <h3 class='main-textcenter'>Nombre del producto</h3>
                        <input name='product_name' type='text' placeholder='Nombre del producto'>
                    </div>

                    <div class='main-borderbox main-bordercontx' style='width: 50em'>
                        <h3 class='main-textcenter'>Descripcion del producto</h3>
                        <textarea name='product_desc' type='text' placeholder='Descripción del producto'></textarea>
                    </div>

                    
                    <div class='main-borderbox main-bordercontx' style='width: 50em'>
                        <h3 class='main-textcenter'>Ingredientes del producto (INCLUIR ALÉRGENOS)</h3>
                        <textarea name='product_ingredients' type='text' placeholder='Ingredientes del producto'></textarea>
                    </div>

                    <div class='main-borderbox main-bordercontx' style='width: 50em;'>
                        <h3 class='main-textcenter'>Precio y categoria del producto</h3>
                        <div class='main-row'>
                            <input name='product_uniprice' type='number' placeholder='Precio unitario' style='width:50%'>
                            <select name='product_category'>
                                <option value='Panaderia'>Panaderia</option>
                                <option value='Heladeria'>Heladeria</option>
                                <option value='Pasteleria'>Pasteleria</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class='main-borderbox main-bordercontx' style='width: 50em;'>
                        <h3 class='main-textcenter'>Opciones del producto</h3>
                        <p t='c'>Cada opción debe ser separada por una coma y un espacio, dejar en blanco para ninguna opción.</p>
                        <div class='main-row'>
                            <input name='product_options' type='text' placeholder='(ej: Chocolate, Fresa, Vanilla)' style='width:50%'>
                        </div>
                    </div>

                <div class='main-borderbox main-bordercontx main-center' style='width: 50em;'>
                    <h3>Imagen del producto</h3>
                    <input name='product_imageFILE' type='file' accept='image/*'>
                </div>
                    <button type='submit' t='alt' name='ADMIN_addProduct'>Añadir producto al catálogo</button>
                </form>
                ";
            } else if (isset($_GET["searchproduct"])) {

                unset($_SESSION["ADMIN_curModifProd"]);

                if (isset($_SESSION["error_adminProd404"])) {
                    if ($_SESSION["error_adminProd404"] == true) {
                        echo "<h2 class='main-bordercont'>El nombre introducido no trajo resultados.</h2>";
                        unset($_SESSION["error_adminProd404"]);
                    }
                } else if (isset($_SESSION["data_adminPMod"])) {
                    if ($_SESSION["data_adminPMod"] == true) {
                        echo "<h2 class='main-bordercont'>El producto fue modificado exitosamente.</h2>";
                        unset($_SESSION["data_adminPMod"]);
                    }
                } else if (isset($_SESSION["data_adminPDel"])) {
                    if ($_SESSION["data_adminPDel"] == true) {
                        echo "<h2 class='main-bordercont'>El producto fue eliminado de la base de datos.</h2>";
                        unset($_SESSION["data_adminPDel"]);
                    }
                }
                echo "
                <form class='prodMng' method='post' action='conns/adminmodifyprod.php' enctype='multipart/form-data'>
                <div class='main-borderbox main-bordercontx main-center' style='width: 50em;'>
                    <h3>Buscar producto por nombre</h3>
                    <input name='product_nameSEARCH' type='text' placeholder='Nombre del producto a buscar'>
                    <button type='submit' t='alt' name='search_productName'>Buscar en la base de datos</button>
                </div>

                <h2>Elegir producto de la lista</h2>
                <div class='main-borderbox main-bordercontx main-center' style='width: 50em;>
                        <div class='main-maxw main-center adminmod-scroll'>
                ";
                //mid echo code that probs is the worst way to do this shit
                $sql = "SELECT product_name, product_id FROM productdata ORDER BY 'product_id' asc";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $product_id = $row["product_id"];
                        $product_name = $row["product_name"];
                        echo "<a class='icontext main-fw main-nmb' style='width: 40em; padding: 1em' href='adminprodmng.php?modproduct=$product_id'><h2>$product_name</h2></a>";
                    }
                }

                echo "
                        </div>
                    </div>
                </form>
                ";
            } else if (isset($_GET["modproduct"])) {
                $product_id = $_GET["modproduct"];
                $sql = "SELECT * FROM productdata WHERE product_id='$product_id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $product_id = $row["product_id"];
                    $product_name = $row["product_name"];
                    $product_desc = $row["product_desc"];
                    $product_uniprice = $row["product_uniprice"];
                    $product_ingredients = $row["product_ingredients"];
                    $product_image = $row["product_image"];
                    $product_category = $row["product_category"];
                    $product_options = $row["product_options"];
                    $pc_PN = "";
                    $pc_HD = "";
                    $pc_PS = "";
                    $pc_CR = "";

                    if ($product_category != "Creacion") {
                        $src = "files/products/" . $product_image;
                        $customfit = "";
                    } else {
                        $src = "files/products/custom/" . $product_image;
                        $customfit = "object-position: bottom;";
                    }

                    switch ($product_category) {
                        case "Panaderia":
                            $pc_PN = "selected";
                            $pc_HD = "";
                            $pc_PS = "";
                            break;
                        case "Heladeria":
                            $pc_PN = "";
                            $pc_HD = "selected";
                            $pc_PS = "";
                            break;
                        case "Pasteleria":
                            $pc_PN = "";
                            $pc_HD = "";
                            $pc_PS = "selected";
                            break;
                        case "Creacion":
                            $pc_PN = "";
                            $pc_HD = "";
                            $pc_PS = "";
                            $pc_CR = "selected";
                            break;
                    }
                }

                if (!isset($_SESSION["ADMIN_curModifProd"])) {
                    $_SESSION["ADMIN_curModifProd"] = $_SESSION["session_curProductId"];
                }

                $_SESSION["ADMIN_curModifProd"] = $_GET["modproduct"];

                echo "
                <form class='prodMng' method='post' action='conns/adminmodifyprod.php' enctype='multipart/form-data'>
                    <p>Editando $product_name. [ID={$_SESSION["ADMIN_curModifProd"]}]</p>

                        <div class='main-borderbox main-bordercontx main-center' style='width: 50em;'>
                            <h3>Imagen del producto</h3>
                            <img src='$src' type='catalog' id='pr_output'>
                            <input type='file' accept='image/*' name='product_imageChange' class='main-inputfile' onchange='loadFile(event)' id='active_input'>
                            <button type='submit' t='alt' name='ADMIN_changeProductImg' id='submitButtonImg' disabled>Cambiar foto del producto</button>
                        </div>

                        <div class='main-borderbox main-bordercontx main-center' style='width: 50em;'>
                            <h3>Nombre del producto</h3>
                            <input name='product_name' type='text' placeholder='Nombre del producto' value='$product_name' required>
                        </div>
                        
                        <div class='main-borderbox main-bordercontx main-center' style='width: 50em;'>
                            <h3>Descripcion del producto</h3>
                            <textarea name='product_desc' type='text' placeholder='Descripción del producto' required>$product_desc</textarea>
                        </div>
                        
                        <div class='main-borderbox main-bordercontx main-center' style='width: 50em;'>
                            <h3>Ingredientes del producto (INCLUIR ALÉRGENOS)</h3>
                            <textarea name='product_ingredients' type='text' placeholder='Ingredientes del producto' required>$product_ingredients</textarea>
                        </div>
                
                    <div class='main-borderbox main-bordercontx main-center' style='width: 50em;'>
                        <h3>Precio y categoria del producto</h3>
                        <div class='main-row'>
                            <input name='product_uniprice' type='number' placeholder='Precio unitario' style='width:50%' value='$product_uniprice' required>
                            <select name='product_category'>
                                <option value='Panaderia' $pc_PN>Panaderia</option>
                                <option value='Heladeria' $pc_HD>Heladeria</option>
                                <option value='Pasteleria' $pc_PS>Pasteleria</option>
                                <option value='Creacion' $pc_CR>Creacion</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class='main-borderbox main-bordercontx' style='width: 50em;'>
                        <h3 class='main-textcenter'>Opciones del producto</h3>
                        <p t='c'>Cada opción debe ser separada por una coma y un espacio, dejar en blanco para ninguna opción.</p>
                        <div class='main-row'>
                            <input name='product_options' type='text' placeholder='(ej: Chocolate, Fresa, Vanilla)' style='width:50%' value='$product_options'>
                        </div>
                    </div>


                    <div class='main-row'>
                        <div class='main-darkcont' c='c' t='c' style='width: 50%; text-align: center;'>
                            <h2>Actualizar información</h2>
                            <p>La información que introduciste será actualizada para todos los usuarios.</p>
                            <button type='submit' t='alt' name='ADMIN_modifyProduct'>Actualizar datos</button>
                        </div>
                        <div class='main-darkcont' c='c' t='c' style='width: 50%; text-align: center'>
                            <h2>Eliminar producto</h2>
                            <p>Esto eliminará los datos de la base de datos, borrará la imagen de los archivos de la página y no aparecerá en el catálogo.</p>
                            <button type='submit' t='alt' name='ADMIN_deleteProduct'>Borrar producto</button>
                        </div>
                    </div>
                </form>
                <script>
                    var loadFile = function(event) { 
                        var image = document.getElementById('pr_output');
                        var bt = document.getElementById('submitButtonImg');
                        bt.removeAttribute('disabled');
                        image.src = URL.createObjectURL(event.target.files[0]);
                    };
                </script>
                ";
            }
            ?>
        </div>
    </div>
</body>

</html>