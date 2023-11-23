<?php
session_start();
require_once '../config/database.php';
require_once '../config/Models.php';

$action = $_GET['action'];

switch ($action) {

	case 'driver-violation-add' :
		driver_violation_add();
		break;

	case 'account-save' :
		account_save();
		break;

	case 'change-violation-status' :
		change_violation_status();
		break;

	case 'account-delete' :
		account_delete();
		break;

	case 'driver-save' :
		driver_save();
		break;

	case 'violation-save' :
		violation_save();
		break;

	case 'violation-delete' :
		violation_delete();
		break;

	case 'driver-delete' :
		driver_delete();
		break;


	default :
}

function change_violation_status(){
	$pdId = $_GET["pdId"];
	$model = driver_penalty();
	$model->obj["status"] = $_GET["status"];
	$model->update("Id=$pdId");

	header('Location: driver-violation-detail.php?pdId=' . $pdId . '&success=You have changed status');

}

function driver_violation_add(){
	$violation_list = $_POST['violation'];
	$driverId = $_POST['driverId'];

	$model = driver_penalty();
	$model->obj["dateAdded"] = "NOW()";
	$model->obj["officerId"] = $_SESSION["user_session"]["Id"];
	$model->obj["driverId"] = $driverId;
	$model->create();

	$getLastRecord = driver_penalty()->get("Id>0 order by Id desc limit 1");

	foreach ($violation_list as $vio) {
		$model = penalty_item();
		$model->obj["violationId"] = $vio;
		$model->obj["driverPenaltyId"] = $getLastRecord->Id;
		$model->create();
	}


	header('Location: driver-violation.php?driverId=' . $_POST["driverId"] . "&success=Violation successfully added");

}


function user_add(){

	$username = $_POST["username"];
	$checkUser = user()->count("username='$username'");

	if ($checkUser>=1) {
		header('Location: user-add.php?role='.$_POST["role"].'&error=Username Already Exists');
	}
	else{
			$model = user();
			$model->obj["username"] = $_POST["username"];
			$model->obj["firstName"] = $_POST["firstName"];
			$model->obj["role"] = $_POST["role"];
			$model->obj["phone"] = $_POST["phone"];
			$model->obj["email"] = $_POST["email"];
			$model->obj["lastName"] = $_POST["lastName"];
			$model->obj["password"] = $_POST["password"];
			$model->obj["departmentId"] = $_POST["departmentId"];
			$model->obj["dateAdded"] = "NOW()";
			$model->create();
			header('Location: accounts.php?role=' . $_POST["role"]);
	}
}

function account_save(){
	#Process to save to the database

	$model = account();
	$model->obj["username"] = $_POST["username"];
	$model->obj["firstName"] = $_POST["firstName"];
	$model->obj["lastName"] = $_POST["lastName"];
	$model->obj["role"] = $_POST["role"];

	if ($_POST["form-type"] == "add") {
		$model->obj["password"] = $_POST["password"];
		$model->create();
	}

	if ($_POST["form-type"] == "edit") {
		$Id = $_POST["Id"];
		$model->update("Id=$Id");
	}

	header('Location: accounts.php?role=' . $_POST["role"]);
}

function account_delete(){
	#Process to save to the database

	$Id = $_GET["Id"];
	account()->delete("Id=$Id");

	header('Location: accounts.php?role=' . $_GET["role"]);
}



function driver_save(){
	#Process to save to the database

	$model = driver();
	$model->obj["firstName"] = $_POST["firstName"];
	$model->obj["lastName"] = $_POST["lastName"];
	$model->obj["middleInitial"] = $_POST["middleInitial"];
	$model->obj["address"] = $_POST["address"];
	$model->obj["birthday"] = $_POST["birthday"];
	$model->obj["licenseNumber"] = $_POST["licenseNumber"];
	$model->obj["plateNumber"] = $_POST["plateNumber"];
	$model->obj["color"] = $_POST["color"];
	$model->obj["brand"] = $_POST["brand"];
	$model->obj["model"] = $_POST["model"];

	if ($_POST["form-type"] == "add") {
		$model->create();
		$successMessage = "You have successfully added a new driver";
	}

	if ($_POST["form-type"] == "edit") {
		$Id = $_POST["Id"];
		$model->update("Id=$Id");
		$successMessage = "You have successfully modified a driver";
	}

	header('Location: drivers.php?success=' . $successMessage);
}


function violation_save(){
	#Process to save to the database

	$model = violation();
	$model->obj["name"] = $_POST["name"];
	$model->obj["amount"] = $_POST["amount"];

	if ($_POST["form-type"] == "add") {
		$model->create();
		$successMessage = "You have successfully added a new violation";
	}

	if ($_POST["form-type"] == "edit") {
		$Id = $_POST["Id"];
		$model->update("Id=$Id");
		$successMessage = "You have successfully modified a violation";
	}

	header('Location: penalties.php?success=' . $successMessage);
}

function violation_delete(){
	#Process to save to the database

	$Id = $_GET["Id"];
	violation()->delete("Id=$Id");

	header('Location: violation-list.php?success=You have successfully deleted this violation');
}

function driver_delete(){
	#Process to save to the database

	$Id = $_GET["Id"];
	driver()->delete("Id=$Id");

	header('Location: drivers.php?success=You have successfully deleted this driver');
}



function symptom_save(){
	#Process to save to the database

	$model = symptom();
	$model->obj["name"] = $_POST["name"];

	if ($_POST["form-type"] == "add") {
		$model->create();
	}

	if ($_POST["form-type"] == "edit") {
		$Id = $_POST["Id"];
		$model->update("Id=$Id");
	}

	header('Location: symptoms.php');
}

function symptom_delete(){
	#Process to save to the database

	$Id = $_GET["Id"];
	symptom()->delete("Id=$Id");

	header('Location: symptoms.php');
}

function specialty_save(){
	#Process to save to the database

	$model = specialty();
	$model->obj["name"] = $_POST["name"];

	if ($_POST["form-type"] == "add") {
		$model->create();
	}

	if ($_POST["form-type"] == "edit") {
		$Id = $_POST["Id"];
		$model->update("Id=$Id");
	}

	header('Location: specialty.php');
}

function specialty_delete(){
	#Process to save to the database

	$Id = $_GET["Id"];
	specialty()->delete("Id=$Id");

	header('Location: specialty.php');
}
