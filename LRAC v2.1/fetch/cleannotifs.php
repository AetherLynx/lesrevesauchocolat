<?php
include "../conns/conexion.php";
include "../phpfuncs/main.php";

$sql = "DELETE FROM notifs WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION["user_id"]);
$stmt->execute();

echo json_encode(['status' => 'success']);
