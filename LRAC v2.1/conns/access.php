<?php
include("conexion.php");
include("../phpfuncs/main.php");

if (isset($_POST["login"])) {
    unset($_SESSION["loggedin"]);
    $mail = $_POST["mail"];
    $pass = $_POST["pass"];

    $sql = "SELECT mail FROM userdata WHERE mail = '$mail'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        setPopup("No se encontró una cuenta con ese correo electrónico.", "../login.php");
        die();
    }

    $sql = "SELECT mail, pass FROM userdata WHERE mail = '$mail' AND pass = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        setPopup("La contraseña que introduciste es incorrecta.", "../login.php");
        die();
    }

    $sql = "SELECT * FROM userdata WHERE mail = '$mail' AND pass = '$pass'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $_SESSION["loggedin"] = true;
    //changed unique mail to unique id!! (pensar no es lo mío)
    $_SESSION["user_id"] = $row["userid"];
    $_SESSION["user_name"] = $row["name"];
    $_SESSION["user_pass"] = $row["pass"];
    $_SESSION["user_mail"] = $row["mail"];
    $_SESSION["user_q"] = $row["question"];
    $_SESSION["user_qa"] = $row["qanswer"];
    $_SESSION["user_numtel"] = $row["numtel"];
    $_SESSION["user_role"] = $row["userRole"];
    $_SESSION["user_pfp"] = $row["pfp"];
    $_SESSION["user_address"] = $row["address"];
    $_SESSION["data_userinfoSet"] = true;

    if ($_SESSION["user_role"] == "admin") {
        $_SESSION["data_isAdmin"] = true;
    } else {
        $_SESSION["data_isAdmin"] = false;
    }

    setPopup("Iniciaste sesión correctamente como {$_SESSION["user_name"]}!", "../index.php");
    //.
} elseif (isset($_POST["signin"])) {
    $name = $_POST["name"];
    $pass = $_POST["pass"];
    $mail = $_POST["mail"];
    $question = $_POST["question"];
    $qanswer = $_POST["qanswer"];
    $numtel = $_POST["numtel"];
    $address = $_POST["address"];

    $sql = "SELECT mail FROM userdata WHERE mail='$mail'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        setPopup("Ya existe un usuario con ese correo, por favor usa otra dirección.", "../signin.php");
        die();
    } else {

        $sql = "SELECT numtel FROM userdata WHERE numtel='$numtel'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            setPopup("Ya hay un usuario con ese número de teléfono, por favor usa otro teléfono.", "../signin.php");
            die();
        } else {
            createAccount($name, $pass, $mail, $question, $qanswer, $numtel, $address);
        }
    }
}

function createAccount($name, $pass, $mail, $question, $qanswer, $numtel, $address)
{
    include("conexion.php");
    $sql = "INSERT INTO userdata (name, pass, mail, question, qanswer, numtel, userRole, address) VALUES ('$name', '$pass', '$mail', '$question', '$qanswer', '$numtel', 'user', '$address')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION["data_userRegistered"] = true;
        header("location: ../common/toast.php"); //fix to prevent re-sending form data
    } else {
        $_SESSION["data_userRegistered"] = null;
        header("location: ../common/toast.php"); //fix to prevent re-sending form data

    }
    $conn->close();
}