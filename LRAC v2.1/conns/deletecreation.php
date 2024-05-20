<?php
include("conexion.php");
include("../phpfuncs/main.php");
$sql = "SELECT * FROM productdata WHERE product_creator='{$_SESSION["user_id"]}'";
$result = $conn->query($sql);

$url = "../viewproduct.php?id={$_SESSION["session_curProductId"]}&sc={$_SESSION["session_origin"]}";

if ($_SESSION["session_origin"] == "4") {
    $profileOrigin = $_SESSION["profileOrigin"];
    $url = $url . "&viewing=$profileOrigin";
}

if (!$result->num_rows > 0) {
    setPopup("No tienes creado ningun producto.", $url);
    die();
}

$row = $result->fetch_assoc();
$product_creator = $row["product_creator"];

if ($product_creator != $_SESSION["user_id"]) {
    setPopup("Este producto no es tuyo, no puedes borrarlo.", $url);
    die();
}

if (!isset($_GET["id"])) {
    setPopup("No se pudo encontrar el producto que especificaste.", $url);
}

$queryId = $_GET["id"];

$sql = "DELETE FROM productdata WHERE product_id='$queryId'";
if (!$conn->query($sql) === TRUE) {
    setPopup("No se pudo eliminar este producto, hubo un error.", $url);
    $error = $conn->error;
    echo "
    <script>
        console.log('$error')
    </script>
    ";
    die();
}

$product_image = "customcake_id$queryId.png";
$file_path = "../files/products/custom/$product_image";
unlink($file_path);

setPopup("Se ha borrado tu creación exitosamente.", "../userprofile.php?user={$_SESSION["user_id"]}");
