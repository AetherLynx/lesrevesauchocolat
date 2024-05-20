<?php
include("conexion.php");
include("../phpfuncs/main.php");

adminconnChecker();

if (isset($_GET["deleteUser"])) {
    $query = $_GET["query"];
    $sql = "SELECT pfp FROM userdata WHERE userid='$query'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $actualPfp = $row["pfp"] ?? null;

    $actualPfp = ($actualPfp == "default.png") ? null : $actualPfp; //it will delete nothing lmao

    $sql = "DELETE FROM orders WHERE order_user='$query'";
    send($sql, $conn);
    $sql = "DELETE FROM posts WHERE userid='$query'";
    send($sql, $conn);
    $sql = "DELETE FROM productdata WHERE product_creator='$query'";
    send($sql, $conn);
    $sql = "DELETE FROM scdata WHERE user_id='$query'";
    send($sql, $conn);
    $sql = "DELETE FROM threads WHERE user_id='$query'";
    send($sql, $conn);
    $sql = "DELETE FROM userdata WHERE userid='$query'";
    send($sql, $conn);

    ($actualPfp != null) ? unlink("../files/userpfp/$actualPfp") : null;
    setPopup("Se ha eliminado al usuario exitosamente.", "../adminusers.php");
    die();
}

if (isset($_GET["removePfp"])) {
    $query = $_GET["query"];
    $sql = "SELECT pfp FROM userdata WHERE userid='$query'";
    $result = $conn->query($sql);

    if (!$result->num_rows == 1) {
        setPopup("No se encontró el usuario, no se pudo borrar la foto de perfil.", "../adminusers.php");
        die();
    }

    $row = $result->fetch_assoc();
    $pfp = $row["pfp"];

    if ($pfp == "default.png") {
        setPopup("El usuario no tiene foto de perfil establecida.", "../adminusers.php");
        die();
    }

    $path = "../files/userpfp/$pfp";

    if (!file_exists($path)) {
        setPopup("No se encontró la foto de perfil.", "../adminusers.php");
        die();
    }

    if (!unlink($path)) {
        setPopup("No se pudo eliminar la foto de los archivos.", "../adminusers.php");
        die();
    }

    $sql = "UPDATE userdata SET pfp='default.png' WHERE userid='$query'";
    if (!$conn->query($sql) === TRUE) {
        setPopup("No se pudo actualizar la información en la base de datos.", "../adminusers.php");
        die();
    }

    createNotification($conn, $query, '6', 'userconfig.php');
    setPopup("Se ha borrado la foto de perfil exitosamente.", "../adminusers.php");
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $pass = $_POST["pass"];
    $numtel = $_POST["numtel"];
    $userRole = $_POST["userRole"];
    $address = $_POST["address"];
    $prefColor = $_POST["prefColor"];
    $bio = $_POST["bio"];
    $query = $_GET["query"];

    if (!isset($_POST["userRole"])) {
        $userRole = "admin";
    }

    $sql = "UPDATE userdata SET name='$name', pass='$pass', numtel='$numtel', userRole='$userRole', address='$address', prefColor='$prefColor', bio='$bio' WHERE userid='$query'";
    if (!$conn->query($sql) === TRUE) {
        $error = $conn->error;
        setPopup("No se pudo actualizar la informacion de $name.<br>ERROR: $error", "../adminusers.php");
        die();
    }

    createNotification($conn, $query, '7', 'userconfig.php');
    setPopup("Se ha actualizado la informacion del usuario exitosamente.", "../adminusers.php");
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
