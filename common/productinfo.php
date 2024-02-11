<?php
if (isset($_GET["id"])) {
    $getid = $_GET["id"];
    $_SESSION["session_origin"] = $_GET["sc"];
    if (isset($_GET["confirmAdd"])) {
        $confirmAdd = $_GET["confirmAdd"];
        echo "<script>console.log('" . $confirmAdd . "')</script>";
        if ($confirmAdd == "1") {
            echo "
            <div class='popup'>
                <div>
                    <p>El producto fue añadido a tu carrito! :)</p>
                </div>
            </div>
            ";
        } else if ($confirmAdd == "0") {
            echo "
            <div class='popup'>
                <div>
                    <p>El producto fue eliminado de tu carrito. :(</p>
                </div>
            </div>
            ";
        }
    }
    prodinfo($conn, $getid);
}

function checkProd($conn)
{
    $sql = "SELECT * FROM scdata WHERE user_mail = '" . $_SESSION["user_mail"] . "' AND user_product = '" . $_SESSION["session_curProductId"] . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $x = "<script>document.write(minusb);</script><p>Quitar del carrito</p>";
        return $x;
    } else {
        $x = "<script>document.write(plusb);</script><p>Añadir al carrito</p>";
        return $x;
    }
}

//to check if user comes from shopping cart or catalogue :)
function checkOrigin($conn)
{
    if (isset($_GET["sc"])) {
        $sc = $_GET["sc"];
        if ($sc == "0") {
            $x = "
                <a href='catalogue.php?filter=0'>
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
        }
    } else {
        echo "<script>console.log('can't get id[sc]')</script>";
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

        changeColors($product_category);
        $buttonDisplay = checkProd($conn);
        $backType = checkOrigin($conn);

        echo "
            $backType

            <div class='catalog-container'>

                <div class='catalog-leftdetails'>
                    <img src='files/products/" . $product_image . "' type='viewproduct'>
                    <h2 style='text-align:center' t='bb'>Precio: $" . $product_uniprice . "</h2>
                    <a href='common/addproduct.php?id=" . $product_id . "'>

                        <div class='icontext'>
                            " . $buttonDisplay . "
                        </div>

                    </a>
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
