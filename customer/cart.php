<?php
$ROOT_DIR="../";
$pageName = "Cart";
include $ROOT_DIR . "user-templates/header.php";

$sessionNumber = $_SESSION["session_number"];
$cart_list = cart()->list("sessionNumber='$sessionNumber'");

?>

<div class="row">
  <div class="col-lg-12">
<div class="box">
        <form method="post" action="checkout1.html">
          <h1>Shopping cart</h1>
          <p class="text-muted">You currently have <?=$cartTotal;?> item(s) in your cart.</p>
          <p style="color:red;"><?=$error;?></p>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th colspan="2">Product</th>
                  <th>Quantity</th>
                  <th>Unit price</th>
                  <th colspan="2">Total</th>
                </tr>
              </thead>
              <tbody>


                <?php
                $total = 0;
                 foreach ($cart_list as $row):
                  $item = item()->get("Id=$row->itemId");
                  $total += ($item->price*$row->quantity);
                  $subTotal = $item->price*$row->quantity;
                   ?>


                <tr>
                  <td><a href="#"><img src="../media/<?=$item->image;?>" height="100px" alt="White Blouse Armani"></a></td>
                  <td><a href="#"><?=$item->name;?></a></td>
                  <td>
                    <a href="process.php?action=cart-add-quantity&cartId=<?=$row->Id;?>&value=-1" class="btn btn-primary btn-sm">-</a>
                    <a href="" class="btn btn-primary btn-sm"><?=$row->quantity;?></a>
                    <a href="process.php?action=cart-add-quantity&cartId=<?=$row->Id;?>&value=1" class="btn btn-primary btn-sm">+</a>
                  </td>
                  <td>P<?=format_money($item->price);?></td>
                  <td>P<?=format_money($subTotal);?></td>
                  <td><a href="process.php?action=delete-cart-item&itemId=<?=$row->Id?>"><i class="fa fa-trash-o"></i></a></td>
                </tr>

              <?php endforeach; ?>



              </tbody>
              <tfoot>
                <tr>
                  <th colspan="4">Total</th>
                  <th>USD<?=format_money($total);?>
                    <br>
                   </th>
                   <th>&nbsp</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.table-responsive-->
          <div class="box-footer d-flex justify-content-between flex-column flex-lg-row">
            <div class="left"><a href="../customer" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> Continue shopping</a></div>
            <div class="right">

              <?php if (isset($_SESSION["user_session"])): ?>
                  <?php if ($total>=300): ?>
                    <a href="checkout.php" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i></a>
                    <?php else: ?>
                    <a href="?error=You have not reached minimum purchase limit" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i></a>
                  <?php endif; ?>
                <?php else: ?>
                    <a href="#" data-toggle="modal" data-target="#login-modal" class="btn btn-primary">Login first to proceed to checkout <i class="fa fa-chevron-right"></i></a>
              <?php endif; ?>
            </div>
          </div>
        </form>
      </div>

    </div>


<?php include $ROOT_DIR . "user-templates/footer.php"; ?>
