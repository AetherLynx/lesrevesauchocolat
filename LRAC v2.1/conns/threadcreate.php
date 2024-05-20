<?php
include "conexion.php";
include "../phpfuncs/main.php";

$thread_header = $_POST["thread_header"];
$thread_content = $_POST["thread_content"];
$thread_link_product = $_POST["thread_link_product"];
$thread_link_user = $_POST["thread_link_user"];

if ($thread_link_product != "none" && $thread_link_user != "none") {
    setPopup("No puedes citar un usuario y un producto a la vez.", "../threads_create.php");
    die();
}

if ($thread_link_product == "none" && $thread_link_user == "none") {
    $thread_link = null;
    $thread_link_type = 69;
}

//pd 4 myself: only one condition will be triggered because it was checked beforehand if both had content, killing the script
if ($thread_link_product != "none") {
    $thread_link = $thread_link_product;
    $thread_link_type = 0;
}

if ($thread_link_user != "none") {
    $thread_link = $thread_link_user;
    $thread_link_type = 1;
}


$sql = "SHOW TABLE STATUS LIKE 'threads'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$ai = $row["Auto_increment"];

$sql = "INSERT INTO threads(thread_id, user_id, thread_header, thread_content, thread_link, thread_link_type) VALUES ('', '{$_SESSION["user_id"]}', '$thread_header', '$thread_content', '$thread_link', '$thread_link_type')";

if (!($conn->query($sql) === TRUE)) {
    $error = $conn->error;
    setPopup("Lo lamentamos, no pudimos crear tu post. :(", "../threads_create.php");
    die();
}

if ($thread_link_type == 1) {
    createNotification($conn, $thread_link, '4', "threadpost.php?postid=$ai");
}

setPopup("Creaste tu post exitosamente!", "../threadpost.php?postid=$ai");
die();
