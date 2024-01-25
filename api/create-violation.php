<?php
include "../templates/api-header.php";

$json = array();
$success = false;
$response = "";
if (isset($_POST["username"])) {
  $username = $_POST["username"];
  $type = $_POST["type"];
  $zoneId = $_POST["zoneId"];
  $user = account()->get("username='$username'");

  $model = driver_penalty();
  $model->obj["officerId"] = $user->Id;
  $model->obj["referenceId"] = $_POST["referenceId"];
  $model->obj["type"] = $_POST["type"];
  $model->obj["zoneId"] = $zoneId;
  $model->obj["dateAdded"] = "NOW()";
  $model->create();

	$getLastRecord = driver_penalty()->get("Id>0 order by Id desc limit 1");
}

$json["username"] = $_POST["username"];
$json["type"] = $_POST["type"];
$json["referenceId"] = $_POST["referenceId"];
$json["zoneId"] = $_POST["zoneId"];
$json["driverPenaltyId"] = $getLastRecord->Id;
$json["success"] = $success;


header('Content-Type: application/json; charset=utf-8');
echo json_encode($json);
?>
