<?php
//soy bobo marica siempre olvido esto
/*
ERRORS:
00 = pfp changed
01 = data changed

10 = uncompatible filetype
21 = delete account: wrong password
*/

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
            if (unlink($file_path)) {
                echo 'File deleted successfully.';
            } else {
                echo 'Unable to delete the file.';
            }
        } else {
            echo 'File does not exist/Pfp is default, cant delete.';
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

            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!array_key_exists($ext, $allowed)) {
                setPopup("La extension del archivo que subiste no la manejamos!<br>Prueba con .jpg, .png, .gif y .jpeg.", "../userconfig.php");
                exit();
            }

            // Verify MYME type of the file
            if (in_array($filetype, $allowed)) {
                // Check whether file exists before uploading it
                if (file_exists("files/images/" . $filename)) {
                    echo $filename . " is already exists.";
                } else {
                    move_uploaded_file($_FILES["data_user_PFP"]["tmp_name"], "../files/userpfp/" . $filename);
                    $sql = "UPDATE userdata SET pfp='$filename' WHERE userid='{$_SESSION["user_id"]}'";

                    if ($conn->query($sql) === TRUE) {
                        $_SESSION["user_pfp"] = $filename;

                        echo "Your file was uploaded successfully.";
                        setPopup("Tu foto de perfil fue actualizada!", "../userconfig.php");
                    } else {
                        $errorsql = $conn->error;
                        setPopup("Error: $errorsql", "../userconfig.php");
                    }
                }
            } else {
                $_SESSION["userconfig_error"] = 3; //ni idea de q era este error jsjs
                header("location: ../userconfig.php");
                exit();
            }
        } else {
            echo "Error: " . $_FILES["data_user_PFP"]["error"];
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

        if (!($db_username == $new_username)) {
            $sql = "UPDATE userdata SET name='$new_username' WHERE userid='{$_SESSION["user_id"]}'";
            $_SESSION["user_name"] = $new_username;
            send($sql, $conn);
        }

        if (!($db_usermail == $new_usermail)) {
            $sql = "UPDATE userdata SET mail='$new_usermail' WHERE userid='{$_SESSION["user_id"]}'";
            $_SESSION["user_mail"] = $new_usermail;
            send($sql, $conn);
        }

        if (!($db_usernumtel == $new_usernumtel)) {
            $sql = "UPDATE userdata SET numtel='$new_usernumtel' WHERE userid='{$_SESSION["user_id"]}'";
            $_SESSION["user_numtel"] = $new_usernumtel;
            send($sql, $conn);
        }


        if (!($db_useraddress == $new_useraddress)) {
            $sql = "UPDATE userdata SET address='$new_useraddress' WHERE userid='{$_SESSION["user_id"]}'";
            $_SESSION["user_address"] = $new_useraddress;
            send($sql, $conn);
        }
    }
    setPopup("Tus datos fueron actualizados!", "../userconfig.php");
} elseif (isset($_POST["mod_deleteAccount"])) {
    $sentPass = $_POST["security_delAccPass"];

    $sql = "SELECT pass FROM userdata WHERE userid='{$_SESSION["user_id"]}'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $actualPass = $row["pass"];

        if (!($sentPass == $actualPass)) {
            setPopup("No pudimos eliminar tu cuenta!<br>La contraseña que introduciste no es correcta.", "../userconfig.php");
        } else {
            $sql = "DELETE FROM userdata WHERE userid='{$_SESSION["user_id"]}'";
            send($sql, $conn);
            setPopup("Eliminaste tu cuenta de manera exitosa.", "../login.php");
        }
    }
} elseif (isset($_POST["changeColor"])) {
    $prefColor = $_POST["prefColor"];

    $sql = "UPDATE userdata SET prefColor='$prefColor' WHERE userid='{$_SESSION["user_id"]}'";
    if (!($conn->query($sql) === TRUE)) {
        $error = $conn->error;
        setPopup("No se pudo cambiar tu color: $error", "../userconfig.php");
        die();
    }

    setPopup("Cambiaste tu color exitosamente!", "../userconfig.php");
    die();
} elseif (isset($_POST["changebio"])) {
    $newbio = $_POST["newbio"];

    $sql = "UPDATE userdata SET bio='$newbio' WHERE userid='{$_SESSION["user_id"]}'";
    if (!($conn->query($sql) === TRUE)) {
        $error = $conn->error;
        setPopup("No se actualizó tu bio: $error", "../userconfig.php");
        die();
    }

    setPopup("Actualizaste tu biografía exitosamente!", "../userconfig.php");
    die();
}

function send($sql, $conn)
{
    if ($conn->query($sql) === TRUE) {
        //done
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die();
    }
}
