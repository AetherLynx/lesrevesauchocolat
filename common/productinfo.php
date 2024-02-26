<?php
//check first-hand if logged in
if (isset($_SESSION["loggedin"])) {
    if ($_SESSION["loggedin"] == false) {
        $_SESSION["error_notLogged"] = true;
        header("location: login.php");
    }
}

if (isset($_GET["id"])) {
    $getid = $_GET["id"];
    $_SESSION["session_origin"] = $_GET["sc"];
    if (isset($_SESSION["pi_confirmAdd"])) {
        switch ($_SESSION["pi_confirmAdd"]) {
            case "1":
                echo "
            <div class='popup' id='popup'>
                <div>
                    <p>El producto fue añadido a tu carrito! :)</p>
                </div>
            </div>
            ";
                unset($_SESSION["pi_confirmAdd"]);
                break;


            case "0":
                echo "
            <div class='popup' id='popup'>
                <div>
                    <p>El producto fue eliminado de tu carrito :(</p>
                </div>
            </div>
            ";
                unset($_SESSION["pi_confirmAdd"]);
                break;
        }
    }
    prodinfo($conn, $getid);
}

function checkProd($conn)
{
    $sql = "SELECT * FROM scdata WHERE user_mail = '" . $_SESSION["user_mail"] . "' AND user_product = '" . $_SESSION["session_curProductId"] . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION["data_canAdd"] = false;
        $x = "
            <script>
                document.write(minusb);
            </script>
            <p>Quitar del carrito</p>";
        return $x;
    } else {
        $_SESSION["data_canAdd"] = true;
        $x = "
        <script>
            document.write(plusb);
        </script>
        <p>Añadir al carrito</p>";
        return $x;
    }
}

function checkForm()
{
}

//to check if user comes from shopping cart or catalogue :)
function checkOrigin($conn)
{
    if (!isset($_SESSION["data_curFilter"])) {
        $_SESSION["data_curFilter"] = 0;
    }
    if (isset($_GET["sc"])) {
        $sc = $_GET["sc"];
        if ($sc == "0") {
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
        } else if ($sc == "1") {
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
        } else if ($sc == "2") {
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
        }
    } else {
        echo "<script>console.log('can't get id[sc]')</script>";
    }
}

function adminFunctionality($getid)
{
    if ($_SESSION["data_isAdmin"]) {
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

        if ($product_options != null) {
            $showSelect = true;
        }

        $array_options = explode(", ", $product_options);

        changeColors($product_category);
        $buttonDisplay = checkProd($conn);
        $backType = checkOrigin($conn);
        $adminModify = adminFunctionality($product_id);

        echo "
            $backType

            <div class='catalog-container'>

                <div class='catalog-leftdetails'>
                    <img src='files/products/" . $product_image . "' type='viewproduct'>
                    <h2 style='text-align:center' t='bb'>Precio: $" . formatCop($product_uniprice) . "</h2>
                    <form style='margin: 0;' method='post' class='main-maxw main-nm' action='common/addproduct.php?id=$product_id'>
                        ";

        if ($_SESSION["data_canAdd"] == true) {
            echo "
            <div class='main-nm'>
                <div class='main-row main-textcenter'>
                    <div class='main-row'>
                        <p>Cantidad: </p>
                        <input type='number' class='main-inputalt main-textcenter' style='width: 3em' min='1' max='10' value='1' name='product_amount'>
            ";
            if (isset($showSelect)) {
                echo "
                <p>Opciones: </p>
                <select name='product_option' class='main-select'>";
                foreach ($array_options as $value) {
                    echo "<option value='$value'>$value</option>";
                }
                echo "</select>";
            }
            echo "
                        </div>
                    </div>
                </div>
            ";
        }

        echo "                        
                        <button class='icontext main-maxw main-buttonpadding' type='submit' name='prodAmount_set'>
                            " . $buttonDisplay . "
                        </button>
                    $adminModify
                    </form>
                </div>

                <div class='catalog-rightdetails'>
                    <div style='margin-bottom: 8rem;'>
                        <h1 t='bb'>" . $product_name . "</h1>
                        <p>" . $product_desc . "</p>
                    </div>

                    <div>
                        <h1 t='bb'>Ingredientes</h1>
                        <p>" . $product_ingredients . "</p>
                    </div>
                </div>
            </div>
        ";
    }
}

function changeColors($product_category)
{
    switch ($product_category) {
        case "Panaderia":
            echo "
                <script>
                    document.documentElement.style.setProperty('--co1', '#fff3f0')
                    document.documentElement.style.setProperty('--co4', '#BF7B69')
                    document.documentElement.style.setProperty('--co4u', '#BF7B69')
                    document.documentElement.style.setProperty('--co4ba', 'rgba(191, 123, 105, 70%)')
                    document.documentElement.style.setProperty('--co3', '#f0af9e')
                </script>
                ";
            break;
        case "Heladeria":
            echo "
                <script>
                    document.documentElement.style.setProperty('--co1', '#f5f9ff')
                    document.documentElement.style.setProperty('--co4', '#94ADD7')
                    document.documentElement.style.setProperty('--co4u', '#94ADD7')
                    document.documentElement.style.setProperty('--co4ba', 'rgba(148, 173, 215, 70%)')
                    document.documentElement.style.setProperty('--co3', '#d2e0f7')
                </script>
                ";
            break;
        case "Pasteleria":
            echo "
                <script>
                    document.documentElement.style.setProperty('--co1', '#fff7fa')
                    document.documentElement.style.setProperty('--co4', '#E63F74')
                    document.documentElement.style.setProperty('--co4u', '#E63F74')
                    document.documentElement.style.setProperty('--co4ba', 'rgba(230, 63, 116, 70%)')
                    document.documentElement.style.setProperty('--co3', '#ffd1e0')
                </script>
                ";
            break;
    }
}

function formatCOP($value)
{
    $x = number_format($value, 0, '', '.');
    return $x;
}