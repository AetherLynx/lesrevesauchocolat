<?php
include("conexion.php");
include("../phpfuncs/main.php");

adminconnChecker();

if (isset($_POST["ADMIN_addProduct"])) {
    $product_name = $_POST["product_name"];
    $product_desc = $_POST["product_desc"];
    $product_uniprice = $_POST["product_uniprice"];
    $product_ingredients = $_POST["product_ingredients"];
    $product_category = $_POST["product_category"];
    $product_options = $_POST["product_options"];

    if ($product_options == "") {
        $product_options = null;
    }

    $product_image = $_FILES["product_imageFILE"];

    if (isset($_FILES["product_imageFILE"]) && $_FILES["product_imageFILE"]["error"] == 0) {
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
        $filename = $_FILES["product_imageFILE"]["name"];
        $filetype = $_FILES["product_imageFILE"]["type"];
        $filesize = $_FILES["product_imageFILE"]["size"];

        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) {
            $_SESSION["ADMINdata_prodUploadError"] = 1;
            header("location: ../common/toast.php");
            exit();
        }

        // Verify MYME type of the file
        if (in_array($filetype, $allowed)) {
            // Check whether file exists before uploading it
            if (file_exists("files/images/" . $filename)) {
                echo $filename . " is already exists.";
            } else {
                move_uploaded_file($_FILES["product_imageFILE"]["tmp_name"], "../files/products/" . $filename);
                echo "Your file was uploaded successfully.";

                $sql = "INSERT INTO productdata (product_id, product_name, product_desc, product_uniprice, product_ingredients, product_category, product_image, product_options, product_creator) VALUES (NULL, '$product_name', '$product_desc', '$product_uniprice', '$product_ingredients', '$product_category', '$filename', '$product_options', null)";
                if ($conn->query($sql) === TRUE) {
                    $_SESSION["ADMINdata_prodUploadError"] = 0;
                    header("location: ../common/toast.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } else { {
                $_SESSION["ADMINdata_prodUploadError"] = 3;
                header("location: ../common/toast.php");
                exit();
            }
        }
    } else {
        echo "Error: " . $_FILES["product_imageFILE"]["error"];
    }
}
