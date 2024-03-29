<?php
renderPopup();

if (isset($_GET["id"])) {
    $getid = $_GET["id"];
    $_SESSION["session_origin"] = $_GET["sc"];
    prodinfo($conn, $getid);
}

function checkProd($conn)
{
    if (isset($_SESSION["loggedin"])) {
        $sql = "SELECT * FROM scdata WHERE user_id = '" . $_SESSION["user_id"] . "' AND user_product = '" . $_SESSION["session_curProductId"] . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $_SESSION["data_canAdd"] = false;
            $x = "<script>document.write(minusb);</script><p id='cartbutton'>Quitar del carrito</p>";
            return $x;
        } else {
            $_SESSION["data_canAdd"] = true;
            $x = "<script>document.write(plusb);</script><p id='cartbutton'>Añadir al carrito</p>";
            return $x;
        }
    } else {
        //do nothing
    }
}

//to check if user comes from shopping cart or catalogue :)
function checkOrigin($conn)
{
    if (!isset($_SESSION["data_curFilter"])) {
        $_SESSION["data_curFilter"] = 0;
    }
    if (isset($_GET["sc"])) {
        $sc = $_GET["sc"];

        switch ($sc) {
            case "0":
                $x = "
                <a href='catalogue.php?filter={$_SESSION["data_curFilter"]}'>
                    <div class='icontext'>
                        <script>
                            document.write(leftb);
                        </script>
                        <p>Volver al catálogo</p>
                    </div>
                </a>
                    ";
                return $x;
            case "1":
                $x = "
                <a href='shopcart.php'>
                    <div class='icontext'>
                        <script>
                            document.write(leftb);
                        </script>
                        <p>Volver a tu carrito</p>
                    </div>
                </a>
                ";
                return $x;
            case "2":
                $x = "
                <a href='ordersquery.php'>
                    <div class='icontext'>
                        <script>
                            document.write(leftb);
                        </script>
                        <p>Volver a consultar tu pedido</p>
                    </div>
                </a>
                ";
                return $x;
            case "3":

                if ($_SESSION["data_isAdmin"] == true) {
                    $url = "sharedorder.php?orderid={$_SESSION["history_sharedorder"]}&cfa";
                } else {
                    $url = "sharedorder.php?orderid={$_SESSION["history_sharedorder"]}";
                }

                $x = "
                <a href='$url'>
                    <div class='icontext'>
                        <script>
                            document.write(leftb);
                        </script>
                        <p>Volver a ver pedido compartido</p>
                    </div>
                </a>
                ";
                return $x;
            case "4":
                $profileOrigin = $_SESSION["profileOrigin"];
                $x = "
                <a href='userprofile.php?user=$profileOrigin'>
                    <div class='icontext'>
                        <script>
                            document.write(leftb);
                        </script>
                        <p>Volver al perfil</p>
                    </div>
                </a>
                ";
                return $x;
            case "5":
                $was = $_GET["was"];
                $x = "
                <a href='usercomments.php?user=$was'>
                    <div class='icontext'>
                        <script>
                            document.write(leftb);
                        </script>
                        <p>Seguir viendo comentarios del usuario</p>
                    </div>
                </a>
                ";
                return $x;
        }
    } else {
        echo "<script>console.log('can't get id[sc]')</script>";
    }
}

function adminFunctionality($getid)
{
    if (isset($_SESSION["data_isAdmin"])) {
        if ($_SESSION["data_isAdmin"] == true) {
            $y = "
            <a href='adminprodmng.php?modproduct=$getid'  class='icontext main-maxw main-buttonpadding'>
                <script>
                document.write(configb);
                </script>
                <p>Modificar producto</p>
            </a>
        ";
            return $y;
        }
    } else {
        return null;
    }
}

function prodinfo($conn, $getid)
{
    $sql = "SELECT * FROM productdata WHERE product_id='$getid'";
    $result = $conn->query($sql);
    showProduct($result, $conn);
}

function showProduct($result, $conn)
{
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_id = $row["product_id"];
        $_SESSION["session_curProductId"] = $product_id;
        $product_name = $row["product_name"];
        $product_desc = $row["product_desc"];
        $product_uniprice = $row["product_uniprice"];
        $product_ingredients = $row["product_ingredients"];
        $product_category = $row["product_category"];
        $product_image = $row["product_image"];
        $product_options = $row["product_options"];
        $product_creator = $row["product_creator"];

        if ($product_options != null) {
            $showSelect = true;
        }

        if (!isset($canRemoveCreation)) {
            $canRemoveCreation = null;
        }

        $actualCreator = null;

        if (isset($_SESSION["user_id"])) {
            $actualCreator = $_SESSION["user_id"];
        }

        $array_options = explode(", ", $product_options);
        $buttonDisplay = checkProd($conn);
        $backType = checkOrigin($conn);
        $adminModify = adminFunctionality($product_id);
        $backType = null; //[TESTING NEW BACK BUTTON] 

        if ($product_creator == $actualCreator) {
            $canRemoveCreation = "
            <a href='conns/deletecreation.php?id=$product_id'  class='icontext main-maxw main-buttonpadding'>
                <script>
                icon('2em', '2em', 'eraser');
                </script>
                <p>Eliminar creación</p>
            </a>
            ";
        }


        handleColors($product_category); //translate category into page color scheme

        if ($product_category != "Creacion") {
            $src = "files/products/" . $product_image;
            $creator = "<h3 t='bb'>Creado por Les Reves Au Chocolat</h3>";
            $customfit = "";
        } else {
            $sql = "SELECT name FROM userdata WHERE userid='$product_creator'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $user_name = $row["name"];

            $src = "files/products/custom/" . $product_image;
            $creator = "<h3 t='bb'>Creado por <a href='userprofile.php?user=$product_creator' class='underline_anim' col='alt'>$user_name</a></h3>";
            $customfit = "object-position: 50% 80%;";
        }

        echo "
            $backType

            <div class='catalog-container'>

                <div class='catalog-leftdetails'>
                    <img src='$src' type='viewproduct' style='$customfit'>
                    <h2 style='text-align:center' t='bb'>Precio: $" . formatCop($product_uniprice) . "</h2>";

        if (isset($_SESSION["loggedin"])) {
            echo "<form style='margin: 0;' method='post' class='main-maxw main-nm' action='common/addproduct.php?id=$product_id'>";

            echo "
            <div class='main-nm'>
                <div class='main-row main-textcenter'>
                    <div class='main-columncenter main-maxw'>
                        <p>Cantidad: </p>
                        <input type='number' class='main-inputalt main-textcenter' style='width: 3em' min='1' max='10' value='1' name='product_amount'>
            ";
            if (isset($showSelect)) {
                echo "
                            <p>Opciones: </p>
                            <select name='product_option' class='main-select' onchange='checkAdded(this)' id='selectthing'>";
                foreach ($array_options as $value) {
                    echo "<option value='$value'>$value</option>";
                }
                echo "  </select>";
            }
            echo "
                        </div>
                    </div>
                </div>
            ";
            echo "
                    <button class='icontext main-maxw main-buttonpadding' type='submit' name='prodAmount_set'>
                            " . $buttonDisplay . "
                        </button>
                    $adminModify
                    $canRemoveCreation
                    </form>
            ";
        }

        echo "            

                </div>

                <div class='catalog-rightdetails'>
                    <div style='margin-bottom: 8rem;'>
                        <h1>" . $product_name . "</h1>
                        $creator
                        <p>" . $product_desc . "</p>
                    </div>

                    <div>
                        <h1 t='bb'>Ingredientes</h1>
                        <p>" . $product_ingredients . "</p>
                    </div>
                </div>
            </div>
        ";
        echo <<<HTML
        <script>
                var cartbutton = document.getElementById("cartbutton");

                function checkAdded(element) {
                    if (element) {
                        var selected = element.value;
                        var urlParams = new URLSearchParams(window.location.search);
                        var id = urlParams.get('id');
                        fetchData(id, selected, cartbutton);
                    }
                }

                function fetchData(parameter1, parameter2, cartbutton) {
                var url = 'conns/checkavail.php?product=' + encodeURIComponent(parameter1) + '&option=' + encodeURIComponent(parameter2);
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success === true) {
                            console.log("category exists!")
                            cartbutton.textContent = "Quitar del carrito";
                        } else {
                            console.log("category doesnt exist!")
                            cartbutton.textContent = "Añadir al carrito";
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error)
                    })
                }

                document.addEventListener("DOMContentLoaded", () => {
                    var select = document.getElementById("selectthing");
                    checkAdded(select);
                })
        </script>
        HTML;
    } else {
        echo "
        <h1>No se encontró un producto con esa ID.</h1>
            <a href='catalogue.php?filter={$_SESSION["data_curFilter"]}'>
                <div class='icontext'>
                    <script>
                        document.write(leftb);
                    </script>
                    <p>Volver al catálogo</p>
                </div>
            </a>
        ";
        die();
    }
}

function handleColors($product_category)
{
    switch ($product_category) {
        case "Panaderia":
            changeColorsPRESET("brown");
            break;
        case "Heladeria":
            changeColorsPRESET("cyan");
            break;
        case "Pasteleria":
            changeColorsPRESET("pink");
            break;
        case "Creacion":
            changeColorsPRESET("strongcyan");
            break;
        default:
            //do nothing, use default colors
            break;
    }
}
