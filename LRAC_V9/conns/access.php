<?php
include("conexion.php");
include("../phpfuncs/main.php");

if (isset($_POST["login"])) {
    unset($_SESSION["loggedin"]);
    $name = $_POST["name"];
    $pass = $_POST["pass"];

    $sql = "SELECT * FROM userdata WHERE name = '$name' AND pass = '$pass'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
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
        header("location: ../main.php");
    } else {
        setPopup("El usuario o contraseña son incorrectos.", "../login.php");
    }
} elseif (isset($_POST["signin"])) {
    $name = $_POST["name"];
    $pass = $_POST["pass"];
    $mail = $_POST["mail"];
    $question = $_POST["question"];
    $qanswer = $_POST["qanswer"];
    $numtel = $_POST["numtel"];
    $address = $_POST["address"];

    $sql = "SELECT * FROM userdata WHERE mail='$mail'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION["data_userRegistered"] = false;
        header("location: ../common/toast.php"); //fix to prevent re-sending form data
    } else {
        createAccount($name, $pass, $mail, $question, $qanswer, $numtel, $address);
    }
} elseif (isset($_POST["search_recoverMail"])) {
    $recovMail = $_POST["recovMail"];

    $sql = "SELECT * FROM userdata WHERE mail='$recovMail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $recovQuestion = $row["question"];
        $recovQanswer = $row["qanswer"];
        $_SESSION["recov_isActive"] = true;
        $_SESSION["recov_recovMail"] = $recovMail;
        $_SESSION["recov_question"] = $recovQuestion;
        $_SESSION["recov_qanswer"] = $recovQanswer;
        header("location: ../recover.php");
    } else {
        setPopup("No se encontró un usuario con el correo introducido.", "../recover.php");
    }
} elseif (isset($_POST["input_modify"])) {
    $input_qanswer = $_POST["input_qanswer"];
    $input_newpass = $_POST["input_newpass"];
    $recovMail = $_SESSION["recov_recovMail"];

    $sql = "SELECT * FROM userdata WHERE mail='$recovMail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $trueQanswer = $row["qanswer"];
        if ($input_qanswer == $trueQanswer) {
            $sql = "UPDATE userdata SET pass='$input_newpass' WHERE mail='$recovMail'";
            $result = $conn->query($sql);

            unset($_SESSION["recov_isActive"]);
            unset($_SESSION["recov_recovMail"]);
            unset($_SESSION["recov_question"]);
            unset($_SESSION["recov_qanswer"]);

            setPopup("Tu contraseña fue cambiada exitosamente.", "../login.php");
        } else {
            setPopup("La respuesta de seguridad no es correcta.", "../recover.php");
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
