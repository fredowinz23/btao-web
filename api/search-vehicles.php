<?php
include "../templates/api-header.php";
include "interface.php";

$BASE_URL = "http://" . $_SERVER['SERVER_NAME'];
$json = array();
$success = false;
$rank = "";
$cart = 0;
if (isset($_POST["keyword"])) {
  $keyword = $_POST["keyword"];
  $success = true;

  $vehicle_list = array();

  if ($keyword!="") {

    foreach (vehicle()->list("plateNumber like '%$keyword%' or color like '%$keyword%' or brand like '%$keyword%' or model like '%$keyword%'") as $row) {
      $item = vehicle_interface($row);
      array_push($vehicle_list, $item);
    }
  }


}

$json["keyword"] = $_POST["keyword"];
$json["vehicle_list"] = $vehicle_list;
$json["success"] = $success;


echo json_encode($json);
?>
