<?php

include("../conns/conexion.php");
include("../phpfuncs/main.php");

if (isset($_POST["mod_changePfp"])) {
    $newpfp = $_FILES["data_user_PFP"];

    $sql = "SELECT pfp FROM userdata WHERE userid='{$_SESSION["user_id"]}'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $prevPfp = $row["pfp"];

        $file_path = "../files/userpfp/$prevPfp";

        if (file_exists($file_path) && $prevPfp != 'default.png') {
            unlink($file_path);
        }

        if (isset($_FILES["data_user_PFP"]) && $_FILES["data_user_PFP"]["error"] == 0) {
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
            $filename = $_FILES["data_user_PFP"]["name"];
            $filetype = $_FILES["data_user_PFP"]["type"];
            $filesize = $_FILES["data_user_PFP"]["size"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            $indicator = $_SESSION["user_id"];

            $filename = "user$indicator.$ext";

            // Verify file extension
            if (!array_key_exists($ext, $allowed)) {
                setPopup("La extension del archivo que subiste no la manejamos!<br>Prueba con .jpg, .png, .gif y .jpeg.", "../userconfig.php");
                exit();
            }

            // Verify MYME type of the file
            if (in_array($filetype, $allowed)) {
                // Check whether file exists before uploading it
                if (file_exists("files/images/" . $filename)) {
                    //echo $filename . " is already exists.";
                } else {
                    move_uploaded_file($_FILES["data_user_PFP"]["tmp_name"], "../files/userpfp/" . $filename);
                    $sql = "UPDATE userdata SET pfp='$filename' WHERE userid='{$_SESSION["user_id"]}'";

                    if ($conn->query($sql) === TRUE) {
                        $_SESSION["user_pfp"] = $filename;

                        //echo "Your file was uploaded successfully.";
                        setPopup("Tu foto de perfil fue actualizada!", "../userconfig.php");
                        die();
                    } else {
                        $error = $conn->error;
                        setPopup("Hubo un error, por favor vuelve a intentarlo.", "../userconfig.php");
                        echo "<script>console.log('$error')</script>";
                        die();
                    }
                }
            } else {
                setPopup("Error parcial en la subida del archivo.", "../userconfig.php");
                exit();
            }
        } else {
            echo "Error: " . $_FILES["data_user_PFP"]["error"];
            //https://www.php.net/manual/en/features.file-upload.errors.php
        }
    }
} elseif (isset($_POST["mod_updateData"])) {
    $new_username = $_POST["data_user_name"];
    $new_usermail = $_POST["data_user_mail"];
    $new_usernumtel = $_POST["data_user_numtel"];
    $new_useraddress = $_POST["data_user_address"];

    $sql = "SELECT * FROM userdata WHERE userid='{$_SESSION["user_id"]}'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $db_username = $row["name"];
        $db_usermail = $row["mail"];
        $db_usernumtel = $row["numtel"];
        $db_useraddress = $row["address"];

        $actually_changed = false;

        if (!($db_username == $new_username)) {
            $actually_changed = true;
            $sql = "UPDATE userdata SET name='$new_username' WHERE userid='{$_SESSION["user_id"]}'";
            $_SESSION["user_name"] = $new_username;
            send($sql, $conn);
        }

        if (!($db_usermail == $new_usermail)) {
            $actually_changed = true;
            $sql = "SELECT mail FROM userdata WHERE mail='$new_usermail'";
            $result2 = $conn->query($sql);

            if ($result2->num_rows > 0) {
                setPopup("Ya existe un usuario con ese correo, por favor usa otra dirección.", "../userconfig.php");
                die();
            }

            $sql = "UPDATE userdata SET mail='$new_usermail' WHERE userid='{$_SESSION["user_id"]}'";
            $_SESSION["user_mail"] = $new_usermail;
            send($sql, $conn);
        }

        if (!($db_usernumtel == $new_usernumtel)) {
            $actually_changed = true;
            $sql = "UPDATE userdata SET numtel='$new_usernumtel' WHERE userid='{$_SESSION["user_id"]}'";
            $_SESSION["user_numtel"] = $new_usernumtel;
            send($sql, $conn);
        }

        if (!($db_useraddress == $new_useraddress)) {
            $actually_changed = true;
            $sql = "UPDATE userdata SET address='$new_useraddress' WHERE userid='{$_SESSION["user_id"]}'";
            $_SESSION["user_address"] = $new_useraddress;
            send($sql, $conn);
        }

        if ($actually_changed == true) {
            setPopup("Se actualizó tu información!", "../userconfig.php");
            die();
        } else {
            setPopup("No se cambió ningún dato.", "../userconfig.php");
            die();
        }
    }
} elseif (isset($_POST["mod_deleteAccount"])) {
    $sentPass = $_POST["security_delAccPass"];

    $sql = "SELECT * FROM userdata WHERE userid='{$_SESSION["user_id"]}'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $actualPass = $row["pass"];
        $actualPfp = $row["pfp"];

        //amo los operadores terniarios :3
        $actualPfp = ($actualPfp == "default.png") ? null : $actualPfp;

        if (!($sentPass == $actualPass)) {
            setPopup("No pudimos eliminar tu cuenta!<br>La contraseña que introduciste no es correcta.", "../userconfig.php");
        } else {
            $user_id = $_SESSION["user_id"];
            $sql = "DELETE FROM orders WHERE order_user='$user_id'";
            send($sql, $conn);
            $sql = "DELETE FROM posts WHERE userid='$user_id'";
            send($sql, $conn);
            $sql = "DELETE FROM productdata WHERE product_creator='$user_id'";
            send($sql, $conn);
            $sql = "DELETE FROM scdata WHERE user_id='$user_id'";
            send($sql, $conn);
            $sql = "DELETE FROM threads WHERE user_id='$user_id'";
            send($sql, $conn);
            $sql = "DELETE FROM userdata WHERE userid='{$_SESSION["user_id"]}'";
            send($sql, $conn);

            unlink("../files/userpfp/$actualPfp");

            setPopup("Eliminaste tu cuenta de manera exitosa.", "logout.php");
        }
    }
} elseif (isset($_POST["changeColor"])) {
    $prefColor = $_POST["prefColor"];

    $sql = "UPDATE userdata SET prefColor='$prefColor' WHERE userid='{$_SESSION["user_id"]}'";
    if (!($conn->query($sql) === TRUE)) {
        $error = $conn->error;
        setPopup("No se pudo cambiar tu color.", "../userconfig.php");
        echo "<script>console.log('$error')</script>";
        die();
    }

    setPopup("Cambiaste tu color exitosamente!", "../userconfig.php");
    die();
} elseif (isset($_POST["changebio"])) {
    $newbio = $_POST["newbio"];

    $sql = "UPDATE userdata SET bio='$newbio' WHERE userid='{$_SESSION["user_id"]}'";
    if (!($conn->query($sql) === TRUE)) {
        $error = $conn->error;
        setPopup("No se actualizó tu bio, por favor vuelve a intentarlo.", "../userconfig.php");
        echo "<script>console.log('$error')</script>";
        die();
    }

    setPopup("Actualizaste tu biografía exitosamente!", "../userconfig.php");
    die();
} elseif (isset($_POST["changePassword"])) {
    $input_oldpass = $_POST["oldpass"];
    $input_newpass = $_POST["newpass"];

    if ($input_oldpass == $input_newpass) {
        setPopup("Tu contraseña nueva sigue siendo la misma que la anterior.", "../userconfig.php");
        die();
    }

    $sql = "SELECT pass FROM userdata WHERE userid='{$_SESSION["user_id"]}'";
    $result = $conn->query($sql);

    if (!$result->num_rows > 0) {
        setPopup("Hubo un error cambiando tu contraseña.", "../userconfig.php");
        $error = $conn->error;
        echo "
        <script>
            console.log('$error');
        </script>
        ";
        die();
    }

    $row = $result->fetch_assoc();
    $actualPass = $row["pass"];

    if ($actualPass != $input_oldpass) {
        setPopup("La contraseña vieja que introduciste no es correcta.<br>No se cambió tu contraseña.", "../userconfig.php");
        die();
    }

    $sql = "UPDATE userdata SET pass='$input_newpass' WHERE userid='{$_SESSION["user_id"]}'";

    if (!$conn->query($sql) === TRUE) {
        setPopup("No se pudo establecer la solicitud con la base de datos.", "../userconfig.php");
        $error = $conn->error;
        echo "
        <script>
            console.log('$error');
        </script>
        ";
        die();
    }

    setPopup("Se cambió tu contraseña exitosamente!", "../userconfig.php");
    die();
}

function send($sql, $conn)
{
    if ($conn->query($sql) === TRUE) {
        return;
    } else {
        setPopup("Hubo un error.", "../userconfig.php");
        die();
    }
}