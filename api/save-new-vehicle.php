<?php
include "../templates/api-header.php";

$json = array();
$success = false;
$response = "";

$model = vehicle();
$model->obj["plateNumber"] = $_POST["plateNumber"];
$model->obj["color"] = $_POST["color"];
$model->obj["brand"] = $_POST["brand"];
$model->obj["model"] = $_POST["model"];
$model->create();

$success = true;


$json["success"] = $success;


header('Content-Type: application/json; charset=utf-8');
echo json_encode($json);
?>
