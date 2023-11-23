<?php
session_start();
require_once '../config/database.php';
require_once '../config/Models.php';

$action = $_GET['action'];

switch ($action) {

	case 'save-contact' :
		save_contact();
		break;




	default :
}
function save_contact(){
  $model = contact();
  $model->obj["firstName"]=$_POST["firstName"];
  $model->obj["lastName"]=$_POST["lastName"];
  $model->obj["age"]=$_POST["age"];
  $model->create();

  header('Location: test.php');
}
