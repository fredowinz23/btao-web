<?php
include "../templates/api-header.php";
include "interface.php";

$json = array();
$success = false;

  $success = true;

$zone_list = array();
foreach (zone()->list() as $row) {
  $item = zone_interface($row);
  array_push($zone_list, $item);
}

$json["zone_list"] = $zone_list;
$json["success"] = $success;

echo json_encode($json);
?>
