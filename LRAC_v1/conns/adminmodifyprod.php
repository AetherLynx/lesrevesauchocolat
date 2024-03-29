<?php
include("conexion.php");
include("../phpfuncs/main.php");

adminconnChecker();

if (isset($_POST["search_productName"])) {
    $product_nameSEARCH = $_POST["product_nameSEARCH"];
    $sql = "SELECT * FROM productdata WHERE product_name='$product_nameSEARCH'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $row = $result->fetch_assoc();
        $_SESSION["ADMIN_curModifProd"] = $row["product_id"];
        header("location: ../adminprodmng.php?modproduct={$_SESSION["ADMIN_curModifProd"]}");
    } else {
        $_SESSION["error_adminProd404"] = true;
        header("location: ../adminprodmng.php?searchproduct");
    }
} else if (isset($_POST["ADMIN_modifyProduct"])) {
    $product_name = $_POST["product_name"];
    $product_desc = $_POST["product_desc"];
    $product_uniprice = $_POST["product_uniprice"];
    $product_ingredients = $_POST["product_ingredients"];
    $product_category = $_POST["product_category"];
    $product_options = $_POST["product_options"];

    $sql = "UPDATE productdata SET product_name='$product_name', product_desc='$product_desc', product_uniprice='$product_uniprice', product_ingredients='$product_ingredients', product_category='$product_category', product_options='$product_options' WHERE product_id='{$_SESSION["ADMIN_curModifProd"]}'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION["data_adminPMod"] = true;
        header("location: ../adminprodmng.php?searchproduct");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else if (isset($_POST["ADMIN_deleteProduct"])) {
    $sql = "SELECT * FROM productdata WHERE product_id='{$_SESSION["ADMIN_curModifProd"]}'";
    $proceed = false;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $row = $result->fetch_assoc();
        $product_image = $row["product_image"];
        $product_category = $row["product_category"];

        if ($product_category != "Creacion") {
            $file_path = "../files/products/$product_image";
        } else {
            $file_path = "../files/products/custom/$product_image";
        }
    }


    if (file_exists($file_path)) {
        if (unlink($file_path)) {
            echo 'File deleted successfully.';
            $proceed = true;
        } else {
            echo 'Unable to delete the file.';
        }
    } else {
        echo 'File does not exist.';
    }

    if ($proceed == true) {
        $sql = "DELETE FROM productdata WHERE product_id='{$_SESSION["ADMIN_curModifProd"]}'";
        if ($conn->query($sql) === TRUE) {
            $_SESSION["data_adminPDel"] = true;
            header("location: ../adminprodmng.php?searchproduct");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else if (isset($_POST["ADMIN_changeProductImg"])) {
    $new_prodimg = $_FILES["product_imageChange"];

    $sql = "SELECT product_image FROM productdata WHERE product_id='{$_SESSION["ADMIN_curModifProd"]}'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $prev_prodimg = $row["product_image"];

        $file_path = "../files/products/$prev_prodimg";

        if (file_exists($file_path)) {
            if (unlink($file_path)) {
                echo 'File deleted successfully.';
            } else {
                echo 'Unable to delete the file.';
            }
        } else {
            echo 'File does not exist/Pfp is default, cant delete.';
        }


        if (isset($_FILES["product_imageChange"]) && $_FILES["product_imageChange"]["error"] == 0) {
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
            $filename = $_FILES["product_imageChange"]["name"];
            $filetype = $_FILES["product_imageChange"]["type"];
            $filesize = $_FILES["product_imageChange"]["size"];

            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!array_key_exists($ext, $allowed)) {
                $_SESSION["adminmng_pfperror"] = 1;
                header("location: ../adminprodmng.php?modproduct={$_SESSION["ADMIN_curModifProd"]}");
                exit();
            }

            // Verify file size - 10MB maximum (DISABLEZ BC MAX FILE SIZE SUCKS D---)
            /*
        $maxsize = 10 * 1024 * 1024;
        if ($filesize > $maxsize) {
            $_SESSION["ADMINdata_prodUploadError"] = 2;
            header("location: ../userconfig.php");
            exit();
        }
        */

            // Verify MYME type of the file
            if (in_array($filetype, $allowed)) {
                // Check whether file exists before uploading it
                if (file_exists("files/products/" . $filename)) {
                    echo $filename . " is already exists.";
                } else {
                    move_uploaded_file($_FILES["product_imageChange"]["tmp_name"], "../files/products/" . $filename);
                    $sql = "UPDATE productdata SET product_image='$filename' WHERE product_id='{$_SESSION["ADMIN_curModifProd"]}'";

                    if ($conn->query($sql) === TRUE) {

                        echo "Your file was uploaded successfully.";
                        $_SESSION["adminmng_pfperror"] = 0;
                        header("location: ../adminprodmng.php?modproduct={$_SESSION["ADMIN_curModifProd"]}");
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            } else { {
                    $_SESSION["adminmng_pfperror"] = 2;
                    header("location: ../adminprodmng.php?modproduct={$_SESSION["ADMIN_curModifProd"]}");
                    exit();
                }
            }
        } else {
            echo "Error: " . $_FILES["product_imageChange"]["error"];
        }
    }
}
