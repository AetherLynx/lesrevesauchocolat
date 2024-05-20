<?php
include("../conns/conexion.php");
include("../phpfuncs/main.php");

//QUERY: ID DEL PADRE
//WHERE: 

if (!isset($_GET["where"]) && !isset($_GET["query"])) {
    setPopup("No puedes estar aquí.", "../index.php");
    die();
}

if (!isset($_POST["createcomment"])) {
    setPopup("No puedes estar aquí.", "../index.php");
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
        createNotification($conn, $query, '2', $url);
        break;
    case 'userprofile':
        $url = "userprofile.php?user=$query";
        createNotification($conn, $query, '1', $url);
        break;
    case 'threadpost':
        $url = "threadpost.php?postid=$query";
        createNotification($conn, $query, '3', $url);
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
