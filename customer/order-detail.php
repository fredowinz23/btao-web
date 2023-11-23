<?php
$ROOT_DIR="../";
$pageName = "Order Detail";
include $ROOT_DIR . "user-templates/header.php";


$Id = $_GET["Id"];
$order_main = order_main()->get("Id=$Id");
$customer = user()->get("Id=$order_main->userId");
$order_item_list = order_items()->list("orderNumber='$order_main->orderNumber'");

?>
<div class="row">
  <div class="col-lg-12">
<div class="box">
      <h1>Order Detail</h1>
      <div class="card">
        <div class="card-header">
          <b>Order Detail</b>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-4">
              <b>Order #</b>
              <input type="number"class="form-control" value="<?=$order_main->orderNumber;?>" disabled>
            </div>
            <div class="col-lg-4">
              <b>Ordered By</b>
              <input type="text"class="form-control" value="<?=$customer->firstName;?> <?=$customer->lastName;?>" disabled>
            </div>
            <div class="col-lg-4">
              <b>Ordered Date</b>
              <input type="date" name="date" value="<?=$order_main->date;?>" class="form-control" disabled>
            </div>
            <div class="col-lg-4">
              <b>Order Status</b>
              <input type="text" name="date" value="<?=$order_main->status;?>" class="form-control" disabled>
            </div>

            <div class="col-lg-4 mt-4">
                <?php if ($order_main->status=='Pending'): ?>
                  <a href="process.php?action=change-order-status&newStatus=Canceled&orderMainId=<?=$Id?>" class="btn btn-danger">Cancel</a>
                <?php endif; ?>
                <?php if ($order_main->status=='Delivered'): ?>
                  <a href="process.php?action=change-order-status&newStatus=Received&orderMainId=<?=$Id?>" class="btn btn-info">Order Receive</a>
                <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="card-footer">
        </div>
      </div>

      <table class="table">
        <tr>
          <th>#</th>
          <th>Image</th>
          <th>Item</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Subtotal</th>
        </tr>


          <?php
          $count = 0;
          $total = 0;
           foreach ($order_item_list as $row):
             $item = item()->get("Id=$row->itemId");
             $count += 1;
             $subTotal = $item->price * $row->quantity;
             $total += $subTotal;
             ?>
            <tr>
              <td><?=$count;?></td>
              <td><img src="../media/<?=$item->image;?>" alt="" height="50"></td>
              <td><?=$item->name;?></td>
              <td>₱ <?=format_money($item->price);?></td>
              <td><?=$row->quantity;?></td>
              <td>₱ <?=format_money($subTotal);?></td>
            </tr>
          <?php endforeach; ?>


            <tr>
              <th>&nbsp;</th>
                <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>Total:</th>
              <th>₱ <?=format_money($total);?></th>
            </tr>

        </table>

    </div>
  </div>
</div>

<?php include $ROOT_DIR . "user-templates/footer.php"; ?>
