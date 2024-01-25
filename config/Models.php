<?php
include "CRUD.php";
include "functions.php";

function account() {
	$crud = new CRUD;
	$crud->table = "account";
	return $crud;
}

function driver() {
	$crud = new CRUD;
	$crud->table = "driver";
	return $crud;
}

function vehicle() {
	$crud = new CRUD;
	$crud->table = "vehicle";
	return $crud;
}

function violation() {
	$crud = new CRUD;
	$crud->table = "violation";
	return $crud;
}

function driver_penalty() {
	$crud = new CRUD;
	$crud->table = "driver_penalty";
	return $crud;
}

function penalty_item() {
	$crud = new CRUD;
	$crud->table = "penalty_item";
	return $crud;
}
//TEstt
function zone() {
	$crud = new CRUD;
	$crud->table = "zone";
	return $crud;
}

?>
