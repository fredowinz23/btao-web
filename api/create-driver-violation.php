<?php
include "../templates/api-header.php";

$json = array();
$success = false;
$response = "";
if (isset($_POST["username"])) {
  $username = $_POST["username"];
  $driverId = $_POST["driverId"];
  $user = account()->get("username='$username'");

  $model = driver_penalty();
  $model->obj["officerId"] = $user->Id;
  $model->obj["driverId"] = $driverId;
  $model->obj["dateAdded"] = "NOW()";
  $model->create();

	$getLastRecord = driver_penalty()->get("Id>0 order by Id desc limit 1");
}

$json["username"] = $_POST["username"];
$json["driverId"] = $_POST["driverId"];
$json["driverPenaltyId"] = $getLastRecord->Id;
$json["success"] = $success;


header('Content-Type: application/json; charset=utf-8');
echo json_encode($json);
?>
