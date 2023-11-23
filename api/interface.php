<?php

function category_interface($row){
  $item = array();
  $item["id"] = $row->Id;
  $item["name"] = $row->name;
  $item["description"] = $row->description;
  return $item;
}

function program_interface($row){

  $category = category()->get("Id=$row->categoryId");
  $categoryObj = category_interface($category);

  $item = array();
  $item["id"] = $row->Id;
  $item["title"] = $row->title;
  $item["date"] = $row->date;
  $item["time"] = $row->time;
  $item["description"] = $row->description;
  $item["category"] = $categoryObj;
  $item["address"] = $row->address;
  $item["notes"] = $row->notes;
  $item["maxVolunteer"] = $row->maxVolunteer;
  $item["amountSpent"] = $row->amountSpent;
  $item["status"] = $row->status;
  return $item;
}

function joiner_interface($row){

  $program = program()->get("Id=$row->programId");
  $programObj = program_interface($program);

  $item = array();
  $item["id"] = $row->Id;
  $item["program"] = $programObj;
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
?>
