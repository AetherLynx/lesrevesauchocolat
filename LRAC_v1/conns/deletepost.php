<?php
include("conexion.php");
include("../phpfuncs/main.php");

if (!isset($_GET["post"])) {
    setPopup("No puedes estar aquí.", "../main.php");
    die();
}

$post = $_GET["post"];
$category = $_GET["category"];
$query = $_GET["query"];
$actualuser = $_SESSION["user_id"];

switch ($category) {
    case 'viewproduct':
        $url = "viewproduct.php?id=$query&sc=0";
        break;
    case 'userprofile':
        $url = "userprofile.php?user=$query";
        break;
    case 'usercomments':
        $url = "usercomments.php?user=$query";
        break;
}

$sql = "SELECT userid FROM posts WHERE postid='$post'";
$result = $conn->query($sql);

if (!$result->num_rows > 0) {
    setPopup("No se encontró el comentario.", "../$url");
    die();
}

$row = $result->fetch_assoc();

$op = $row["userid"];

if ($actualuser != $op) {
    setPopup("No se puede borrar un comentario que no es tuyo.", "../$url");
    die();
}

$sql = "DELETE FROM posts WHERE postid='$post'";

if (!$conn->query($sql) === TRUE) {
    setPopup("No se pudo borrar tu comentario.", "../$url");
    die();
}

setPopup("Se ha borrado tu comentario exitosamente!", "../$url");
die();