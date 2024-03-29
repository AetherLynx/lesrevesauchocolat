<?php
include("../conns/conexion.php");
include("../phpfuncs/main.php");

if (!isset($_GET["where"]) && !isset($_GET["query"])) {
    setPopup("No puedes estar aquí.", "../main.php");
    die();
}

if (!isset($_POST["createcomment"])) {
    setPopup("No puedes estar aquí.", "../main.php");
    die();
}

$category = $_GET["category"];
$query = $_GET["query"];
$userid = $_SESSION["user_id"];
date_default_timezone_set("America/Bogota");
$date = date("Y/m/d");

switch ($category) {
    case 'viewproduct':
        $url = "viewproduct.php?id=$query&sc=0";
        break;
    case 'userprofile':
        $url = "userprofile.php?user=$query";
        break;
}

$content = $_POST["content"];

$sql = "INSERT INTO posts (userid, content, postid, postwhere, postdate, postcategory) VALUES ('$userid', '$content', null, '$query', '$date', '$category')";
if (!$conn->query($sql) === TRUE) {
    setPopup("Hubo un error creando el comentario.", "../$url");
    die();
}

setPopup("Se publicó el comentario!", "../$url");
die();