<?php
$ROOT_DIR="../";
include $ROOT_DIR . "templates/customer-header.php";

$sessionNumber = $_SESSION["session_number"];
$cart_list = cart()->list("sessionNumber='$sessionNumber'");

?>
<br><br><br>

<div class="container">
  <ul class="list-group">
    <li class="list-group-item"><center><h3>Cart</h3></center>
      <p style="color:red"><?=$error;?></p>
    </li>
    <li class="list-group-item">
      <div class="row">
        <div class="col">
          Imange
        </div>
        <div class="col">
          Name
        </div>
        <div class="col">
          Price
        </div>
        <div class="col">
          QTY
        </div>
        <div class="col">
          Action
        </div>
      </div>
    </li>
    <?php
    $total = 0;
     foreach ($cart_list as $row):
      $item = item()->get("Id=$row->itemId");
      $total += ($item->price*$row->quantity);
       ?>

      <li class="list-group-item">
        <div class="row">
          <div class="col">
            <img src="../media/<?=$item->image;?>" alt="" height="50">
          </div>
          <div class="col">
            <?=$item->name;?>
          </div>
          <div class="col">
            ₱ <?=money_format($item->price);?>
          </div>
          <div class="col">
              <?=$row->quantity;?>
          </div>
          <div class="col">
            <a href="process.php?action=delete-cart-item&itemId=<?=$row->Id?>" class="btn btn-danger">Delete</a>
          </div>

        </div>
      </li>
    <?php endforeach; ?>


    <li class="list-group-item">
      <div class="row">
        <div class="col">
        </div>
        <div class="col">
          Total
        </div>
        <div class="col">
          ₱ <?=money_format($total);?>
        </div>
        <div class="col">
        </div>
        <div class="col">
        </div>
      </div>
    </li>

      <li class="list-group-item" align="right">
        <a href="checkout.php" class="btn btn-primary">Checkout</a>
      </li>
  </ul>
</div>


<br><br>


<!-- <?php include $ROOT_DIR . "templates/footer.php"; ?> -->
