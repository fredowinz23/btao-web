<?php
include "../templates/api-header.php";
include "interface.php";

$json = array();
$success = false;
$response = "";
if (isset($_POST["driverPenaltyId"])) {
  $dpId = $_POST["driverPenaltyId"];
  $driverPenalty = driver_penalty()->get("Id=$dpId");
  if ($driverPenalty->type=="Driver") {
    $driver = driver()->get("Id=$driverPenalty->referenceId");
    $driverObj = driver_interface($driver);
    $json["driver"] = $driverObj;
  }
  if ($driverPenalty->type=="Vehicle") {
    $vehicle = vehicle()->get("Id=$driverPenalty->referenceId");
    $vehicleObj = vehicle_interface($vehicle);
    $json["vehicle"] = $vehicleObj;
  }
  $officer = account()->get("Id=$driverPenalty->officerId");
  $officerObj = user_interface($officer);

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

$totalViolation = driver_penalty()->count("referenceId=$driverPenalty->referenceId and type='$driverPenalty->type'");

$json["driverPenaltyId"] = $_POST["driverPenaltyId"];
$json["type"] = $driverPenalty->type;
$json["officer"] = $officer;
$json["totalViolation"] = $totalViolation;
$json["violation_list"] = $violation_list;
$json["penalty_item_list"] = $penalty_item_list;
$json["success"] = $success;


header('Content-Type: application/json; charset=utf-8');
echo json_encode($json);
?>
