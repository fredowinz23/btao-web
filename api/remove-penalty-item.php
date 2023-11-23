<?php
include "../templates/api-header.php";

$json = array();
$success = false;
$response = "";

$penaltyItemId = $_POST["penaltyItemId"];

penalty_item()->delete("Id=$penaltyItemId");

$success = true;

$json["penaltyItemId"] = $_POST["penaltyItemId"];
$json["success"] = $success;


header('Content-Type: application/json; charset=utf-8');
echo json_encode($json);
?>
