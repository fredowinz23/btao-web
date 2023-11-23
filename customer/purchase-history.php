<?php
$ROOT_DIR="../";
$pageName = "Purchase History";
include $ROOT_DIR . "user-templates/header.php";

$userId = $_SESSION["user_session"]["Id"];
$status = (isset($_GET['status']) && $_GET['status'] != '') ? $_GET['status'] : 'Pending';
$order_list = order_main()->list("status='$status' and userId='$userId'");

$pendingActive = "";
$readyActive = "";
$deliveredActive = "";
$receivedActive = "";
$canceledActive = "";
if ($status=="Pending") {
  $pendingActive = "active";
}
if ($status=="Ready") {
  $readyActive = "active";
}
if ($status=="Delivered") {
  $deliveredActive = "active";
}
if ($status=="Received") {
  $receivedActive = "active";
}
if ($status=="Canceled") {
  $canceledActive = "active";
}

?>
<div class="row">
  <div class="col-lg-12">
<div class="box">
      <h1>Purchase History</h1>

      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link <?=$pendingActive?>" href="?status=Pending">Pending</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=$readyActive?>" href="?status=Ready">Ready</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=$deliveredActive?>" href="?status=Delivered">Delivered</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=$receivedActive?>" href="?status=Received">Received</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=$canceledActive?>" href="?status=Canceled">Canceled</a>
        </li>
      </ul>

      <table class="table">
        <tr>
          <th>#</th>
          <th>Order #</th>
          <th>Ordered By</th>
          <th>Ordered Date</th>
          <th>Status</th>
          <th>Method</th>
          <th>Action</th>
        </tr>

      <?php foreach ($order_list as $row):
        $user = user()->get("Id=$row->userId");
        ?>
        <tr>
          <td>1</td>
          <td><?=$row->orderNumber;?></td>
          <td><?=$user->firstName;?> <?=$user->lastName;?></td>
          <td><?=$row->date;?></td>
          <td><?=$row->status;?></td>
          <td><?=$row->method;?></td>
          <td><a href="order-detail.php?Id=<?=$row->Id;?>" class="btn btn-primary btn-sm">View</a></td>
          </td>
        </tr>

      <?php endforeach; ?>



      </table>

    </div>
  </div>
</div>

<?php include $ROOT_DIR . "user-templates/footer.php"; ?>
