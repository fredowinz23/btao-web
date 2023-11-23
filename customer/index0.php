<?php
$ROOT_DIR="../";
include $ROOT_DIR . "user-templates/header.php";

$category = get_query_string('category', '');

if ($category=="") {
  $item_list = item()->list();
}
else{
  $item_list = item()->list("categoryId=$category");
}


function get_current_stocks($Id, $qty){
    $cartQty = 0;
    $checkCardExist = order_items()->count("itemId=$Id");
    if ($checkCardExist) {
      $item_list = order_items()->list("itemId=$Id");
      foreach ($item_list as $row) {
        $cartQty += $row->quantity;
      }
    }
    return $qty - $cartQty;
}

function get_temp_qty($Id, $qty){
    $sessionNumber = $_SESSION["session_number"];
    $cartQty = 0;
    $checkCardExist = cart()->count("sessionNumber='$sessionNumber' and itemId=$Id");
    if ($checkCardExist) {
      $cart = cart()->get("sessionNumber='$sessionNumber' and itemId=$Id");
      $cartQty = $cart->quantity;
    }
    return $qty - $cartQty;
}
?>

<div class="bg-image hover-zoom">
  <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/053.webp" class="w-100" />
</div>

<div class="row products">
  <?php foreach ($item_list as $row): ?>
    <div class="col-lg-3 col-md-6">
      <div class="product">
        <div class="flip-container">
          <div class="flipper">
            <div class="front"><a href="item-detail.php?Id=<?=$row->Id;?>"><img src="../media/<?=$row->image;?>" alt="" class="img-fluid"></a></div>
            <div class="back"><a href="item-detail.php?Id=<?=$row->Id;?>"><img src="../media/<?=$row->image;?>" alt="" class="img-fluid"></a></div>
          </div>
        </div><a href="item-detail.php?Id=<?=$row->Id;?>" class="invisible"><img src="../media/<?=$row->image;?>" alt="" class="img-fluid"></a>
        <div class="text">
          <h3><a href="item-detail.php?Id=<?=$row->Id;?>"><?=$row->name;?></a></h3>
          <p class="price">
            <del></del>P <?=money_format($row->price);?>
          </p>
          <p style="color:gray;">Stocks: <?=get_temp_qty($row->Id, get_current_stocks($row->Id, $row->quantity));?></p>
          <p class="buttons"><a href="item-detail.php?Id=<?=$row->Id;?>" class="btn btn-outline-secondary">View detail</a>
            <?php if (get_temp_qty($row->Id, $row->quantity)==0): ?>
                <i style="color:red;">Out Of Stocks</i>
              <?php else: ?>
                <a href="process.php?action=add-to-cart&itemId=<?=$row->Id;?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a></p>
            <?php endif; ?>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<?php include $ROOT_DIR . "user-templates/footer.php"; ?>
