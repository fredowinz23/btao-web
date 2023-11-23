<?php
$ROOT_DIR="../";
include $ROOT_DIR . "user-templates/header.php";

$item_list = item()->list();

$course_list = course()->list();


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

<style>

.zoom {
  transition: transform .5s;
  width: 150px;
  height: 150px;
  object-fit: cover;
  object-position: 25% 25%;
}

.zoom-in {
  -ms-transform: scale(1.5); /* IE 9 */
  -webkit-transform: scale(1.5); /* Safari 3-8 */
  transform: scale(1.5);
  position: absolute;
  z-index: 2;
}

.cursor-option{
  cursor:pointer;
}
.cursor-option:hover{
  background: #ededed;
}
</style>

<b>Courses:</b>
<div class="row mb-5">

<?php foreach ($course_list as $row): ?>
  <div class="col-6">
    <div class="card cursor-option" onclick="location.href='course-detail.php?Id=<?=$row->Id;?>'">
      <div class="card-body">
        <h4><?=$row->name;?></h4>
        <i><?=$row->description;?></i>
      </div>
    </div>
  </div>
<?php endforeach; ?>

</div>

<b>Products:</b>
<div class="row products">
  <?php foreach ($item_list as $row): ?>
    <div class="col-lg-3 col-md-6">
      <div class="product">
        <div class="bg-image">
          <img src="../media/<?=$row->image;?>" style="width:100%" />
        </div>
        <div class="text">
          <h3><a href="item-detail.php?Id=<?=$row->Id;?>"><?=$row->name;?></a></h3>
          <p class="price">
            <del></del>P <?=format_money($row->price);?>
          </p>
          <p style="color:gray;">Stocks: <?=get_temp_qty($row->Id, get_current_stocks($row->Id, $row->quantity));?></p>
          <p class="buttons"><a href="item-detail.php?Id=<?=$row->Id;?>" class="btn btn-outline-secondary">View detail</a>
            <?php if (get_temp_qty($row->Id, $row->quantity)==0): ?>
                <i style="color:red;">Out Of Stocks</i>
              <?php else: ?>
                <?php if (isset($_SESSION["user_session"])): ?>
                  <a href="process.php?action=add-to-cart&itemId=<?=$row->Id;?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                <?php else: ?>
                    <a href="#" data-toggle="modal" data-target="#login-modal" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
              <?php endif; ?>
            <?php endif; ?>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>


<?php include $ROOT_DIR . "user-templates/footer.php"; ?>
