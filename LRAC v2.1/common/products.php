<?php
if (isset($_GET["filter"])) {
    $filter = $_GET["filter"];
    $_SESSION["data_curFilter"] = $_GET["filter"];

    $category = ['', 'Panaderia', 'Heladeria', 'Pasteleria', 'Creacion'];
    show($conn, $category, $filter);
} else {
    $filter = "0";
    $_SESSION["data_curFilter"] = "0";

    $category = ['', 'Panaderia', 'Heladeria', 'Pasteleria', 'Creacion'];
    show($conn, $category, $filter);
}

function show($conn, $category, $filter)
{
    if ($filter > 0) {
        $sql = "SELECT * FROM productdata WHERE product_category = '$category[$filter]'";
    } elseif ($filter == 0) {
        $sql = "SELECT * FROM productdata WHERE product_category NOT IN ('Creacion')";
    }
    $result = $conn->query($sql);
    $_SESSION["data_productsGot"] = $result->num_rows;
    printItems($result);
}

function printItems($result)
{
    if ($result->num_rows > 0) {
        $numrows = $result->num_rows;
        echo <<<HTML
            <div class='main-maxw main-center'>
                <h2>Mostrando $numrows productos!</h2>
            </div>
        HTML;
        while ($row = $result->fetch_assoc()) {
            $product_id = $row["product_id"];
            $product_name = $row["product_name"];
            $product_uniprice = $row["product_uniprice"];
            $product_category = $row["product_category"];
            $product_image = $row["product_image"];

            if ($product_category != "Creacion") {
                $src = "files/products/" . $product_image;
                $customfit = "";
            } else {
                $src = "files/products/custom/" . $product_image;
                $customfit = "object-position: 50% 80%;";
            }
            echo "
            <a href='viewproduct.php?id=$product_id&sc=0' class='catalog-product'>
                <div class='new-productcat main-rowcenter'>
                    <script>
                        document.write($product_category);
                    </script>
                    <p>$product_category</p>
                </div>
                <ptitle class='product-title'>
                    $product_name
                </ptitle>
                <img src='$src' type='catalog' style='$customfit'><br>
                <div class='main-rowcenter main-nm main-maxw'>
                    <ptitle type='sub'>
                        PRECIO
                    </ptitle>
                    <ptitle>$" . formatCop($product_uniprice) . "</ptitle>
                </div>
            </a>
        ";
        }
    } else {
        $rand = rand(1, 100);
        echo "<script>console.log($rand)</script>";
        if ($rand <= 10) { //lmao
            echo "
            <div class='main-columncenter'>
                <p>no hay productos</p>
                <img src='files/elultimotvNAUTA.png''>
            </div>
            ";
        } else {
            echo "<h1>No se encontraron productos! :(</h1>";
        }
    }
}