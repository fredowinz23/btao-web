<?php
session_start();
require_once '../config/database.php';
require_once '../config/Models.php';

$action = $_GET['action'];

switch ($action) {

	case 'driver-violation-add' :
		driver_violation_add();
		break;

	case 'reset-password' :
		reset_password();
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

	case 'vehicle-save' :
		vehicle_save();
		break;

	case 'violation-save' :
		violation_save();
		break;

	case 'zone-delete' :
		zone_delete();
		break;

	case 'zone-save' :
		zone_save();
		break;

	case 'violation-delete' :
		violation_delete();
		break;

	case 'driver-penalty-delete' :
		driver_penalty_delete();
		break;

	case 'driver-delete' :
		driver_delete();
		break;

	case 'vehicle-delete' :
		vehicle_delete();
		break;

	case 'dv-violation-delete' :
		dv_violation_delete();
		break;


	default :
}

function dv_violation_delete(){
		$Id = $_GET["Id"];
		driver_penalty()->delete("Id=$Id");

		header('Location: driver-vehicle-violation.php?referenceId=' . $_GET["referenceId"] . '&type=' . $_GET["type"] .'&success=Deleted a violation');
}


function reset_password(){
	$Id = $_GET["accountId"];
	$role = $_GET["role"];

	$six_digit_random_number = random_int(100000, 999999);

	$model = account();
	$model->obj["status"] = "Inactive";
	$model->obj["password"] = $six_digit_random_number;
	$model->update("Id=$Id");

	header("Location: accounts.php?role=" . $role . "&success=You have reset the password");
}

function change_violation_status(){
	$pdId = $_GET["pdId"];
	$model = driver_penalty();
	$model->obj["status"] = $_GET["status"];
	$model->update("Id=$pdId");

	header('Location: violation-detail.php?pdId=' . $pdId . '&success=You have changed status');

}

function driver_violation_add(){
	$violation_list = $_POST['violation'];
	$referenceId = $_POST['referenceId'];
	$type = $_POST['type'];

	$model = driver_penalty();
	$model->obj["dateAdded"] = "NOW()";
	$model->obj["officerId"] = $_SESSION["user_session"]["Id"];
	$model->obj["referenceId"] = $referenceId;
	$model->obj["type"] = $type;
	$model->create();

	$getLastRecord = driver_penalty()->get("Id>0 order by Id desc limit 1");

	foreach ($violation_list as $vio) {
		$model = penalty_item();
		$model->obj["violationId"] = $vio;
		$model->obj["driverPenaltyId"] = $getLastRecord->Id;
		$model->create();
	}

	header('Location: driver-vehicle-violation.php?referenceId=' . $_POST["referenceId"] . '&type='. $_POST["type"] . '&success=Violation successfully added');

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
	$model->obj["officerBadge"] = $_POST["officerBadge"];
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
function driver_delete(){
	#Process to save to the database

	$Id = $_GET["Id"];
	driver()->delete("Id=$Id");

	header('Location: drivers.php?success=You have deleted a driver');
}
function vehicle_delete(){
	#Process to save to the database

	$Id = $_GET["Id"];
	vehicle()->delete("Id=$Id");

	header('Location: vehicles.php?success=You have deleted a vehicle');
}

// function driver_penalty_delete(){
// 	#Process to save to the database
//
// 	$dpId = $_GET["dpId"];
// 	driver_penalty()->delete("Id=$dpId");
//
// 	// if ($_GET["type"]=="Driver") {
// 	// 		header('Location: drivers.php');
// 	// }
// 	// if ($_GET["type"]=="Vehicle") {
// 	// 		header('Location: vehicles.php');
// 	// }
// 	print_r($_GET);
// }

function zone_delete(){
	#Process to save to the database

	$Id = $_GET["Id"];
	zone()->delete("Id=$Id");

	header('Location: zone-list.php?success=Zone has been deleted');
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

function vehicle_save(){
	#Process to save to the database

	$model = vehicle();
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

	header('Location: vehicles.php?success=' . $successMessage);
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

	header('Location: violation-list.php?success=' . $successMessage);
}


function zone_save(){
	#Process to save to the database

	$model = zone();
	$model->obj["name"] = $_POST["name"];

	if ($_POST["form-type"] == "add") {
		$model->create();
		$successMessage = "You have successfully added a new zone";
	}

	if ($_POST["form-type"] == "edit") {
		$Id = $_POST["Id"];
		$model->update("Id=$Id");
		$successMessage = "You have successfully modified a zone";
	}

	header('Location: zone-list.php?success=' . $successMessage);
}

function violation_delete(){
	#Process to save to the database

	$Id = $_GET["Id"];
	violation()->delete("Id=$Id");

	header('Location: violation-list.php?success=You have successfully deleted this violation');
}
