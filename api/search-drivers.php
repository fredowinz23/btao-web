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

  $driver_list = array();

  if ($keyword!="") {

    foreach (driver()->list("firstName like '%$keyword%' or lastName like '%$keyword%' or address like '%$keyword%' or licenseNumber like '%$keyword%' or plateNumber like '%$keyword%'") as $row) {
      $item = driver_interface($row);
      array_push($driver_list, $item);
    }
  }


}

$json["keyword"] = $_POST["keyword"];
$json["driver_list"] = $driver_list;
$json["success"] = $success;


echo json_encode($json);
?>
