<?php
session_start();
require_once '../config/database.php';
require_once '../config/Models.php';

$action = $_GET['action'];

switch ($action) {

	case 'add-to-cart' :
		add_to_cart();
		break;

	case 'join-course' :
		join_course();
		break;

	case 'cart-add-quantity' :
		cart_add_quantity();
		break;

	case 'delete-cart-item' :
		delete_cart_item();
		break;

	case 'place-order' :
		place_order();
		break;

	case 'change-order-status' :
		change_order_status();
		break;

	case 'add-ratings' :
		add_ratings();
		break;

	default :
}

function cart_add_quantity(){

	$cartId = $_GET["cartId"];
	$cart = cart()->get("Id=$cartId");
	$newQuantity = $cart->quantity + $_GET['value'];

	if ($newQuantity>0) {
		$model = cart();
		$model->obj["quantity"] = $newQuantity;
		$model->update("Id=$cartId");
	}

	header('Location: cart.php');
}

function join_course(){

		$model = course_student();
		$model->obj["courseId"] = $_GET["courseId"];
		$model->obj["studentId"] = $_GET["studentId"];
		$model->create();

		header('Location: course-detail.php?Id=' . $_GET["courseId"]);
}

function change_order_status(){

	$newStatus = $_GET["newStatus"];
	$orderMainId = $_GET["orderMainId"];
	$model = order_main();
	$model->obj["status"] = $newStatus;
	$model->update("Id=$orderMainId");

	header('Location: order-detail.php?Id=' . $orderMainId);
}

function add_to_cart(){

	$itemId = $_GET["itemId"];
	$sessionNumber = $_SESSION["session_number"];

	$cartExist = cart()->count("sessionNumber='$sessionNumber' and itemId='$itemId'");

	if ($cartExist>0) {
		$cart = cart()->get("sessionNumber='$sessionNumber' and itemId='$itemId'");
			$model = cart();
			$model->obj["quantity"] = $cart->quantity + 1;
			$model->update("Id=$cart->Id");
	}
	else{
		$item = item()->get("Id=$itemId");
		$model = cart();
		$model->obj["sessionNumber"] = $_SESSION["session_number"];
		$model->obj["itemId"] = $_GET["itemId"];
		$model->obj["storeId"] = $item->storeId;
		$model->obj["quantity"] = 1;
		$model->obj["dateAdded"] = "NOW()";
		$model->create();
	}

	header('Location: ../customer/');
}

function delete_cart_item(){
	$itemId = $_GET['itemId'];

	$model = cart();
	$model->delete("Id=$itemId");

	header('Location: ../customer/cart.php?error=You have deleted an item');
}

function place_order(){
	$itemId = $_GET['itemId'];
	$orderNumber = round(microtime(true));

	$sessionNumber = $_SESSION["session_number"];

	$firstNumber = cart()->get("sessionNumber='$sessionNumber' order by storeId limit 1");

  $storeNumber = $firstNumber->storeId;
  $orderNumber = 0;
  $isFirst = true;

  $my_cart_list = cart()->list("sessionNumber='$sessionNumber' order by storeId");
  foreach ($my_cart_list as $row) {
    if ($isFirst) {
      $orderNumber = round(microtime(true)) . $row->storeId;
      $model = order_main();
			$model->obj["orderNumber"] = $orderNumber;
			$model->obj["date"] = "NOW()";
			$model->obj["userId"] = $_POST["userId"];
			$model->obj["method"] = $_POST["method"];
			$model->obj["firstName"] = $_POST["firstName"];
			$model->obj["lastName"] = $_POST["lastName"];
			$model->obj["phone"] = $_POST["phone"];
			$model->obj["email"] = $_POST["email"];
      $model->create();

      $model = order_items();
  		$model->obj["orderNumber"] = $orderNumber;
  		$model->obj["itemId"] = $row->itemId;
  		$model->obj["quantity"] = $row->quantity;
  		$model->create();

  		$model = cart();
  		$model->delete("Id=$row->Id");
      $isFirst = false;
    }
    else{
      if ($storeNumber==$row->storeId) {
        $model = order_items();
    		$model->obj["orderNumber"] = $orderNumber;
    		$model->obj["itemId"] = $row->itemId;
    		$model->obj["quantity"] = $row->quantity;
    		$model->create();

    		$model = cart();
    		$model->delete("Id=$row->Id");
      }
      else{
        $orderNumber = round(microtime(true)) . $row->storeId;
        $model = order_main();
				$model->obj["orderNumber"] = $orderNumber;
				$model->obj["date"] = "NOW()";
				$model->obj["userId"] = $_POST["userId"];
				$model->obj["method"] = $_POST["method"];
				$model->obj["firstName"] = $_POST["firstName"];
				$model->obj["lastName"] = $_POST["lastName"];
				$model->obj["phone"] = $_POST["phone"];
				$model->obj["email"] = $_POST["email"];
        $model->create();

        $model = order_items();
        $model->obj["orderNumber"] = $orderNumber;
        $model->obj["itemId"] = $row->itemId;
        $model->obj["quantity"] = $row->quantity;
        $model->create();

        $model = cart();
        $model->delete("Id=$row->Id");
        $storeNumber = $row->storeId;
      }
    }
  }

	header('Location: order-success.php');
}
