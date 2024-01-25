<?php
include "../templates/api-header.php";

$json = array();
$success = false;
$response = "";

$model = driver();
$model->obj["firstName"] = $_POST["firstName"];
$model->obj["middleInitial"] = $_POST["middleInitial"];
$model->obj["lastName"] = $_POST["lastName"];
$model->obj["address"] = $_POST["address"];
$model->obj["birthday"] = $_POST["birthday"];
$model->obj["licenseNumber"] = $_POST["licenseNumber"];
$model->create();

$success = true;


$json["success"] = $success;


header('Content-Type: application/json; charset=utf-8');
echo json_encode($json);
?>
