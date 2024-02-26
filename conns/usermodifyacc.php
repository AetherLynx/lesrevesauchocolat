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
                $_SESSION["userconfig_error"] = 10;
                header("location: ../userconfig.php");
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
                if (file_exists("files/images/" . $filename)) {
                    echo $filename . " is already exists.";
                } else {
                    move_uploaded_file($_FILES["data_user_PFP"]["tmp_name"], "../files/userpfp/" . $filename);
                    $sql = "UPDATE userdata SET pfp='$filename' WHERE userid='{$_SESSION["user_id"]}'";

                    if ($conn->query($sql) === TRUE) {
                        $_SESSION["user_pfp"] = $filename;

                        echo "Your file was uploaded successfully.";
                        $_SESSION["userconfig_error"] = 00;
                        header("location: ../userconfig.php");
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            } else { {
                    $_SESSION["userconfig_error"] = 3;
                    header("location: ../userconfig.php");
                    exit();
                }
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

    $_SESSION["userconfig_error"] = 01;
    header("location: ../userconfig.php");
} elseif (isset($_POST["mod_deleteAccount"])) {
    $sentPass = $_POST["security_delAccPass"];

    $sql = "SELECT pass FROM userdata WHERE userid='{$_SESSION["user_id"]}'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $actualPass = $row["pass"];

        if (!($sentPass == $actualPass)) {
            $_SESSION["userconfig_error"] = 21;
            header("location: ../userconfig.php");
        } else {
            $sql = "DELETE FROM userdata WHERE userid='{$_SESSION["user_id"]}'";
            send($sql, $conn);
            header("location: ../login.php");
        }
    }
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
