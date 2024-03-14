<?php
$_SESSION["data_finalPrice"] = 0;
$_SESSION["sc_productArray"] = array();
$_SESSION["sc_productDesc"] = array();
$_SESSION["sc_productAmount"] = array();

$sql = "SELECT * FROM scdata WHERE user_mail='{$_SESSION["user_mail"]}'";
echo "<script>console.log('{$_SESSION["user_mail"]}')</script>";
$result = $conn->query($sql);

$arrayIndex = 0;

$arr_id = null;
$arr_name = null;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sc_pid = $row["user_product"];
        $sc_amount = $row["sc_prodAmount"];
        $sc_prodOption = $row["sc_prodOption"];
        $sql = "SELECT * FROM productdata WHERE product_id='$sc_pid'";
        $result2 = $conn->query($sql);

        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
                $product_id = $row2["product_id"];
                $product_name = $row2["product_name"];
                $product_uniprice = $row2["product_uniprice"];
                $product_category = $row2["product_category"];
                $product_image = $row2["product_image"];

                $sc_showOption = hasOptions($sc_prodOption);

                $addproduct = 0;
                $addproduct = intval($product_uniprice) * $sc_amount;
                $_SESSION["data_finalPrice"] = ($_SESSION["data_finalPrice"] + $addproduct);

                echo "
                <a href='viewproduct.php?id=" . $product_id . "&sc=1' class='sc-item'>
                    <img src='files/products/" . $product_image . "'>
                    <div class='sc-prodt'>
                        <h1 class='titleicon'>
                            <script>
                                document.write(" . $product_category . "s);
                            </script>
                            " . $product_name . "
                        </h1>
                        <h1 class='main-nmt'>$" . formatCop($product_uniprice) . "</h1>
                        <h2 class='main-nmt'>$sc_amount unidad(es)$sc_showOption</h2>
                    </div>
                </a>
            ";

                $_SESSION["sc_productArray"][$arrayIndex] = $product_id;
                $_SESSION["sc_productArrayDesc"][$arrayIndex] = $sc_prodOption;
                $_SESSION["sc_productArrayAmount"][$arrayIndex] = $sc_amount;
                $arrayIndex++;
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
        <h2 class='main-textcenter'>Total a pagar: $ " . formatCop($_SESSION["data_finalPrice"]) . "</h2>
        <p>¿Todo listo? Mantén undido el botón para confirmar tu pedido.</p>
            <div>
                <a href='conns/createorder.php' class='icontext' id='confirmBT'>
                    <div></div>
                    <span id='loadIcon'></span>
                    <p id='confirmTXT'>Realizar pedido</p>
                </a>
                <br>
                <p t='c'>¿Olvidaste algo? Puedes volver al catálogo si deseas.</p>
                <a href='catalogue.php?filter=0' class='icontext'>
                    <script>
                        document.write(breadb);
                    </script>
                    <p>Ir al catálogo</p>
                </a>
                
            </div>
    </div>
    ";
}

function hasOptions($value)
{
    if ($value != null) {
        return ", Opción: $value";
    } else {
        return null;
    }
}

?>

<script>
const bicon = document.getElementById("loadIcon");
const button = document.getElementById("confirmBT");
const text = document.getElementById("confirmTXT");

bicon.innerHTML = payb; //show icon by default


let holdStartTime = null;
let clickAllowed = false;
let isHolding = false; // Flag to track ongoing hold

button.addEventListener("mousedown", () => {
    //BUTTON STARTS BEING HELD
    bicon.innerHTML = "";
    bicon.classList.add("loader");
    holdStartTime = Date.now();
    clickAllowed = false;
    button.style.filter = "brightness(130%)";
    text.innerHTML = "Confirmando... 3";
    isHolding = true;
});

document.addEventListener("mouseup", () => {
    //BUTTON RELEASES WHEN IT ISN'T DONE
    if (isHolding) {
        bicon.innerHTML = payb;
        bicon.classList.remove("loader");
        isHolding = false;
        button.style.filter = "brightness(100%)";
        text.innerHTML = "Realizar pedido"; // Reset text
    }
});

setInterval(() => {
    //BUTTON IS HELD FOR 3S 
    if (holdStartTime && Date.now() - holdStartTime >= 3000 && isHolding) {
        bicon.innerHTML = payb;
        bicon.classList.remove("loader");
        clickAllowed = true;
        window.location.href = button.href; // Redirect after filter animation
        holdStartTime = null; // Reset timer
        button.style.filter = "none"; // Reset filter
        text.innerHTML = "Realizar pedido"; // Reset text
        isHolding = false; // Reset holding flag
    } else if (holdStartTime && Date.now() - holdStartTime >= 1000 && Date.now() - holdStartTime < 2000 && isHolding) {
        text.innerHTML = "Confirmando... 2";
    } else if (holdStartTime && Date.now() - holdStartTime >= 2000 && Date.now() - holdStartTime < 3000 && isHolding) {
        text.innerHTML = "Confirmando... 1";
    }
}, 10);

button.addEventListener("click", (event) => {
    if (!clickAllowed) {
        event.preventDefault();
    }
});
</script>