<?php
include "conexion.php";
include "../phpfuncs/main.php";

$query = $_GET["id"];
if (isset($_GET["asUser"])) {
    $sql = "SELECT * FROM threads WHERE thread_id='$query'";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    if ($row["user_id"] != $_SESSION["user_id"]) {
        setPopup("No puedes borrar un post de foro que no es tuyo.", "../threadpost.php?postid=$query");
        die();
    }

    $sql = "DELETE FROM threads WHERE thread_id='$query'";

    if (!$conn->query($sql) === TRUE) {
        setPopup("No pudimos borrar este post. :(", "../threadpost.php?postid=$query");
        die();
    }

    setPopup("Eliminaste tu post del foro.", "../threads.php");
    die();
} elseif (isset($_GET["asAdmin"])) {
    if ($_SESSION["data_isAdmin"] != true) {
        setPopup("No eres administrador, no puedes hacer esto. :P", "../threadpost.php?postid=$query");
        die();
    }

    $sql = "DELETE FROM threads WHERE thread_id='$query'";
    createNotification($conn, $query, '10', 'threads.php');

    if (!$conn->query($sql) === TRUE) {
        setPopup("No pudimos borrar este post. :(", "../threadpost.php?postid=$query");
        die();
    }

    setPopup("Eliminaste el post del foro, como administrador.", "../threads.php");
    die();
}
