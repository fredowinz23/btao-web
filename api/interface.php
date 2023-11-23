<?php

function category_interface($row){
  $item = array();
  $item["id"] = $row->Id;
  $item["name"] = $row->name;
  $item["description"] = $row->description;
  return $item;
}


function user_interface($row){
  $item = array();
  $item["id"] = $row->Id;
  $item["firstName"] = $row->firstName;
  $item["lastName"] = $row->lastName;
  return $item;
}


function driver_interface($row){
  $item = array();
  $item["id"] = $row->Id;
  $item["firstName"] = $row->firstName;
  $item["lastName"] = $row->lastName;
  $item["middleInitial"] = $row->middleInitial;
  $item["address"] = $row->address;
  $item["birthday"] = $row->birthday;
  $item["licenseNumber"] = $row->licenseNumber;
  $item["plateNumber"] = $row->plateNumber;
  $item["color"] = $row->color;
  $item["brand"] = $row->brand;
  $item["model"] = $row->model;
  return $item;
}


function violation_interface($row){
  $item = array();
  $item["id"] = $row->Id;
  $item["name"] = $row->name;
  $item["amount"] = $row->amount;
  return $item;
}

function penalty_item_interface($row){
  $violation = violation()->get("Id=$row->violationId");
  $violationObj = violation_interface($violation);

  $item = array();
  $item["id"] = $row->Id;
  $item["violation"] = $violationObj;
  return $item;
}
?>
