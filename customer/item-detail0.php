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

?>

              <div id="productMain" class="row">
                <div class="col-md-6">
                  <div data-slider-id="1" class="owl-carousel shop-detail-carousel">
                    <div class="item"> <img src="../media/<?=$item->image;?>" alt="" class="img-fluid"></div>
                    <div class="item"> <img src="../media/<?=$item->image;?>" alt="" class="img-fluid"></div>
                    <div class="item"> <img src="../media/<?=$item->image;?>" alt="" class="img-fluid"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="box">
                    <h1 class="text-center"><?=$item->name;?></h1>
                    <p class="goToDescription"><a href="#details" class="scroll-to">Scroll to product details</a></p>
                    <p class="price">P <?=format_money($item->price);?></p>
                    <p class="text-center buttons"><a href="process.php?action=add-to-cart&itemId=<?=$item->Id;?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</a> </p>
                  </div>
                </div>
              </div>
              <div id="details" class="box">
                <p></p>
                <h4>Product details</h4>
                <p><?=$item->description;?></p>


                  </div>

                  <!-- /.product-->
                </div>
              </div>

<?php include $ROOT_DIR . "user-templates/footer.php"; ?>
