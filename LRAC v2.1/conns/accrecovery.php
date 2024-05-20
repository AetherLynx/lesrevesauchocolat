<?php
include "conexion.php";
include "../phpfuncs/main.php";

if (isset($_POST["search_recoveraccount"])) {
    //ternary operators godddddddd
    $recovMail = $_POST["recovMail"] ?? null;
    $recovNumber = $_POST["recovNumber"] ?? null;
    $query = ($recovMail === null) ? "numtel='$recovNumber'" : "mail='$recovMail'";
    $queryName = ($recovMail === null) ? "número de teléfono" : "correo";

    $sql = "SELECT userid, mail, numtel, name, question FROM userdata WHERE $query";
    $result = $conn->query($sql);

    if (!$result->num_rows > 0) {
        setPopup("No se encontró un usuario con ese $queryName, por favor vuelve a intentarlo.", "../recover.php");
        die();
    }

    $row = $result->fetch_assoc();

    $recovery_Username = $row["name"];
    $recovery_Question = $row["question"];

    $_SESSION["recov_isActive"] = true;

    $_SESSION["recov_recovData"] = ($recovMail === null) ? $recovNumber : $recovMail;
    $_SESSION["recov_id"] = $row["userid"];
    $_SESSION["recov_username"] = $recovery_Username;
    $_SESSION["recov_question"] = $recovery_Question;

    setPopup("Encontramos la cuenta de $recovery_Username registrado con ese $queryName.", "../recover.php");
} elseif (isset($_POST["send_recoveraccount"])) {
    //.
    $currentUser = $_SESSION["recov_id"];
    $answer_sent = $_POST["input_qanswer"];
    $new_password = $_POST["input_newpass"];

    $sql = "SELECT pass FROM userdata WHERE userid='$currentUser' AND qanswer='$answer_sent'";

    $result = $conn->query($sql);

    if ($result->num_rows != 1) {
        setPopup("La respuesta que enviaste no es correcta, no pudimos restablecer tu contraseña.", "../recover.php");
        die();
    }

    unset($_SESSION["recov_isActive"]);
    unset($_SESSION["recov_recovData"]);
    unset($_SESSION["recov_id"]);
    unset($_SESSION["recov_question"]);
    unset($_SESSION["recov_username"]);

    $sql = "UPDATE userdata SET pass='$new_password' WHERE userid='$currentUser'";

    if (!$conn->query($sql) === TRUE) {
        setPopup("Hubo un error con tu solicitud, por favor intentalo más tarde.", "../recover.php");
        die();
    }

    setPopup("Actualizamos la contraseña de tu cuenta exitosamente!<br>Por favor inicia sesión para continuar.", "../login.php");
}
