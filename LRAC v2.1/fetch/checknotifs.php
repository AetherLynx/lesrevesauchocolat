<?php

include "../conns/conexion.php";
include "../phpfuncs/main.php";

$session_id = $_SESSION["user_id"];

$sql = "SELECT * FROM notifs WHERE user_id IN ($session_id, 0) ORDER BY `notifs`.`notif_id` DESC"; //id 0 == global notifications

$result = $conn->query($sql);

$notifications = [];

while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

echo json_encode($notifications);