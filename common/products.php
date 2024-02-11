<?php
if (isset($_GET["filter"])) {
    $filter = $_GET["filter"];
    $category = ['', 'Panaderia', 'Heladeria', 'Pasteleria'];
    show($conn, $category, $filter);
}

function show($conn, $category, $filter)
{
    if ($filter > 0) {
        $sql = "SELECT * FROM productdata WHERE product_category = '$category[$filter]'";
    } elseif ($filter == 0) {
        $sql = "SELECT * FROM productdata";
    }
    $result = $conn->query($sql);
    printItems($result);
}

function printItems($result)
{
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $product_id = $row["product_id"];
            $product_name = $row["product_name"];
            $product_uniprice = $row["product_uniprice"];
            $product_category = $row["product_category"];
            $product_image = $row["product_image"];
            echo "
            <a href='viewproduct.php?id=" . $product_id . "&isAdded=na&sc=0' class='catalog-product'>
                <ptitle>
                    " . $product_name . "
                </ptitle>
                <ptitle type='sub'>
                    <script>
                        document.write(" . $product_category . ");
                    </script>
                    " . $product_category . "
                </ptitle>
                <img src='files/products/" . $product_image . "' type='catalog'><br>
                <ptitle type='sub'>
                    PRECIO
                </ptitle>
                <ptitle>$" . $product_uniprice . "</ptitle>
            </a>
        ";
        }
    } else {
        echo "
    <img src='files/looking-around.gif' type='bbanner'>
    ";
    }
}
