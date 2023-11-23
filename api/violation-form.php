<?php
include "../templates/api-header.php";
include "interface.php";

$json = array();
$success = false;
$response = "";
if (isset($_POST["driverPenaltyId"])) {
  $dpId = $_POST["driverPenaltyId"];
  $driverPenalty = driver_penalty()->get("Id=$dpId");
  $driver = driver()->get("Id=$driverPenalty->driverId");
  $driverObj = driver_interface($driver);

  $violation_list = array();
  foreach (violation()->list() as $row) {
    $item = violation_interface($row);
    array_push($violation_list, $item);
  }

  $penalty_item_list = array();
  foreach (penalty_item()->list("driverPenaltyId=$dpId") as $row) {
    $item = penalty_item_interface($row);
    array_push($penalty_item_list, $item);
  }
}

$json["driverPenaltyId"] = $_POST["driverPenaltyId"];
$json["driver"] = $driverObj;
$json["violation_list"] = $violation_list;
$json["penalty_item_list"] = $penalty_item_list;
$json["success"] = $success;


header('Content-Type: application/json; charset=utf-8');
echo json_encode($json);
?>
