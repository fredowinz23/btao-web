<?php
include "../templates/api-header.php";

$json = array();
$success = false;
$response = "";

$violationId = $_POST["violationId"];
$driverPenaltyId = $_POST["driverPenaltyId"];

$model = penalty_item();
$model->obj["violationId"] = $violationId;
$model->obj["driverPenaltyId"] = $driverPenaltyId;
$model->create();

$success = true;


$json["violationId"] = $_POST["violationId"];
$json["driverPenaltyId"] = $_POST["driverPenaltyId"];
$json["success"] = $success;


header('Content-Type: application/json; charset=utf-8');
echo json_encode($json);
?>
