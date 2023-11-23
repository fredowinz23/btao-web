<?php
$ROOT_DIR="../";
$pageName = "Product Detail";
include $ROOT_DIR . "user-templates/header.php";

$Id = $_GET["Id"];

$item = item()->get("Id=$Id");

function get_current_stocks($Id, $qty){
    $cartQty = 0;
    $orderNumber = "";
    $checkCardExist = order_items()->count("itemId=$Id");
    if ($checkCardExist) {
      $item_list = order_items()->list("itemId=$Id");
      foreach ($item_list as $row) {
        $orderNumber = $row->orderNumber;
        $orderMain = order_main()->get("orderNumber='$orderNumber'");
        if ($orderMain->status=="Delivered") {
          $cartQty += $row->quantity;
        }
      }
    }
    return $qty - $cartQty;
}


$rating_list = ratings()->list("itemId=$Id");

$average_ratings = get_average_ratings($Id);

?>


<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-6">
        <img src="../media/<?=$item->image;?>" width="100%">
      </div>
      <div class="col-6">
        <h1 class="text-center"><?=$item->name;?></h1>
        <h3 class="price">P <?=format_money($item->price);?></h3>
        <i><?=$item->type?></i>
        <p><?=$item->description;?></p>
        <p class="text-center buttons">
          <?php if (isset($_SESSION["user_session"])): ?>
            <a href="process.php?action=add-to-cart&itemId=<?=$row->Id;?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
          <?php else: ?>
              <a href="#" data-toggle="modal" data-target="#login-modal" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
        <?php endif; ?>
         </p>



</div>

</div>

<div id="add-ratings-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header my-theme">
      <h5 class="modal-title">Add Ratings</h5>
      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
    </div>
    <div class="modal-body">
      <form action="process.php?action=add-ratings" method="post">
        <input type="hidden" name="itemId" value="<?=$Id;?>">
        <b>Ratings</b>
        <select class="form-control" name="ratings" required style="width:20%">
          <option value="">--Select Ratings--</option>
          <option>5</option>
          <option>4</option>
          <option>3</option>
          <option>2</option>
          <option>1</option>
          <option>0</option>
        </select>

        <b>Feed Back</b>
        <textarea name="feedback" rows="8" cols="80" class="form-control" required></textarea>

        <p class="text-center mt-3">
          <button class="btn btn-primary"></i>Add Ratings</button>
        </p>
      </form>
    </div>
  </div>
</div>
</div>
        </div>


      </div>
    </div>

  </div>
</div>



<?php include $ROOT_DIR . "user-templates/footer.php"; ?>
