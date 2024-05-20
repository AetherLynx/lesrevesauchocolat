<?php
include "../conns/conexion.php";
include "../phpfuncs/main.php";

$notif_id = $_POST['id'];

$sql = "DELETE FROM notifs WHERE notif_id = ? AND user_id != 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $notif_id);
$stmt->execute();

echo json_encode(['status' => 'success']);
