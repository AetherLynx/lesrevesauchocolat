<?php
include("conexion.php");
include("../phpfuncs/main.php");
//esto va a mi carta de suicidio
if (!($_SERVER["REQUEST_METHOD"] == "POST")) {
    setPopup("Hubo un error procesando esa solicitud.", "../main.php");
    die();
}

$cakename = $_POST["cakename"];
$cakedesc = $_POST["cakedesc"];
$cakeprice = $_POST["cakeprice"];
$cakeimg = $_FILES["cakeimg"];
$cakeing = $_POST["cakeing"];

if (isset($_FILES["cakeimg"]) && $_FILES["cakeimg"]["error"] == 0) {
    $allowed = array(
        "jpg" => "image/jpg",
        "JPG" => "image/jpg",
        "jpeg" => "image/jpeg",
        "JPEG" => "image/jpeg",
        "gif" => "image/gif",
        "GIF" => "image/gif",
        "png" => "image/png",
        "PNG" => "image/png"
    );


    $filetype = $_FILES["cakeimg"]["type"];
    $filesize = $_FILES["cakeimg"]["size"];

    // Verify file extension
    $ext = pathinfo($_FILES["cakeimg"]["name"], PATHINFO_EXTENSION);

    // new filename

    $sql = "SHOW TABLE STATUS LIKE 'productdata'"; //get info about the table!!
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $ai = $row["Auto_increment"];

    $filename = 'customcake_id' . $ai . '.' . $ext;

    if (!array_key_exists($ext, $allowed)) {
        $_SESSION["ADMINdata_prodUploadError"] = 1;
        header("location: ../common/toast.php");
        exit();
    }

    // Verify MYME type of the file
    if (in_array($filetype, $allowed)) {
        // Check whether file exists before uploading it
        if (file_exists("files/images/" . $filename)) {
            //echo $filename . " is already exists.";
        } else {
            move_uploaded_file($_FILES["cakeimg"]["tmp_name"], "../files/products/custom/" . $filename);
            //echo "Your file was uploaded successfully.";

            $sql = "INSERT INTO productdata (product_id, product_name, product_desc, product_uniprice, product_ingredients, product_category, product_image, product_options, product_creator) VALUES (null, '$cakename', '$cakedesc', '$cakeprice', '$cakeing', 'Creacion', '$filename', null, '{$_SESSION["user_id"]}')";

            if (!($conn->query($sql) == true)) {
                $error = $conn->error;
                setPopup("Hubo un error creando tu pastel, por favor vuelve a intentarlo.", "../cakemaker.php");
                echo "<script>console.log('$error')</script>";
                die();
            }

            setPopup("Tu pastel fue creado exitosamente!<br>Puedes verlo abajo en tus creaciones.", "../userprofile.php?user={$_SESSION["user_id"]}");
            die();
        }
    }
} else {
    setPopup("No se pudo crear tu torta por problemas con la imagen.", "../cakemaker.php");
}