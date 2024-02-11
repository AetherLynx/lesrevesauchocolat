<?php
$_SESSION["data_finalPrice"] = 0;

$sql = "SELECT * FROM scdata WHERE user_mail='{$_SESSION["user_mail"]}'";
echo "<script>console.log('{$_SESSION["user_mail"]}')</script>";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sc_pid = $row["user_product"];
        echo "<script>console.log('$sc_pid')</script>";
        $sql = "SELECT * FROM productdata WHERE product_id='$sc_pid'";
        $result2 = $conn->query($sql);
        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
                $product_id = $row2["product_id"];
                $product_name = $row2["product_name"];
                $product_uniprice = $row2["product_uniprice"];
                $product_category = $row2["product_category"];
                $product_image = $row2["product_image"];

                $_SESSION["data_finalPrice"] = ($_SESSION["data_finalPrice"] + intval($product_uniprice));

                echo "
                <a href='viewproduct.php?id=" . $product_id . "&isAdded=na&sc=1' class='sc-item'>
                    <img src='files/products/" . $product_image . "'>
                    <div class='sc-prodt'>
                        <h1 class='titleicon'>
                            <script>
                                document.write(" . $product_category . ");
                            </script>
                            " . $product_name . "
                        </h1>
                        <h1 style='margin-top: 0;'>$" . $product_uniprice . "</h1>
                    </div>
                </a>
            ";
            }
        } else if (!$result2) {
            echo "Query failed: " . $conn->error;
        }
    }
    showTotal();
} else {
    echo "
    <div style='display: flex; flex-direction: column; align-items: center'>
        <h3>Aun no tienes productos añadidos a tu carrito!</h3>
        <p>Comienza buscando un antojito ;)</p>
        <a href='catalogue.php?filter=0'>
            <div class='icontext'>
                <script>
                    document.write(breadb);
                </script>
                <p>Ir al Catálogo</p>
            </div>
        </a>
    </div>
    ";
}

function showTotal()
{
    echo "
    <hr>
    <div>
        <h2>Total a pagar: $ {$_SESSION["data_finalPrice"]}</h2>
        <a>
            <div class='icontext'>
                <script>
                    document.write(payb);
                </script>
                <p>Realizar pedido</p>
            </div>
        </a>
    </div>
    ";
}