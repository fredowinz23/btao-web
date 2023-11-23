<?php
$ROOT_DIR="../";
$pageName = "Checkout";
include $ROOT_DIR . "user-templates/header.php";

$username = $_SESSION["user_session"]["username"];
$user = user()->get("username='$username'");

$city_list = city()->list("isDeleted=0");
?>

<div class="row">
  <div class="col-lg-12">
<div class="box"style="border: solid; border-color: CF0A0A;">
    <form action="process.php?action=place-order" enctype="multipart/form-data" method="post">
      <h1>Checkout</h1>
      <div class="content py-3">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>First Name *</label>
              <input type="text" value="<?=$user->firstName;?>" class="form-control" style="border-color: CF0A0A;" disabled>
              <input type="hidden" name="firstName" value="<?=$user->firstName;?>" class="form-control" style="border-color: CF0A0A;" required>
              <input type="hidden" name="userId" value="<?=$user->Id;?>" class="form-control" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Last Name *</label>
              <input type="text" value="<?=$user->lastName;?>" class="form-control" style="border-color: CF0A0A;" disabled>
              <input type="hidden" name="lastName" value="<?=$user->lastName;?>" class="form-control" style="border-color: CF0A0A;" required>
            </div>
          </div>



          <div class="col-md-12">
            <div class="form-group">
              <label>Address *</label>
              <input type="text" value="<?=$user->address;?>" class="form-control" style="border-color: CF0A0A;" disabled>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Phone Number *</label>
              <input type="text" name="phone" value="<?=$user->phone;?>" id="phone_number" class="form-control" style="border-color: CF0A0A;" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Email <i>(Optional)</i></label>
              <input type="text" name="email"  value="<?=$user->email;?>" class="form-control" style="border-color: CF0A0A;">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Method *</label>
              <select name="method" class="form-control" required style="border-color: CF0A0A;">
                <option value="">--Select--</option>
                <option>Delivery</option>
                <option>Pick Up</option>
              </select>
            </div>
          </div>
        </div>

        <!-- /.row-->
      </div>
      <div class="box-footer d-flex justify-content-between">
        <a href="cart.php" class="btn btn-outline-secondary" style="visibility:none;"><i class="fa fa-chevron-left"></i>Back to Cart</a>


        <?php if ($cartTotal>0): ?>
            <button type="submit" class="btn btn-danger">Place Order<i class="fa fa-chevron-right"></i></button>
          <?php else: ?>

            <button type="button" class="btn btn-danger"  onclick="alert('Cart must not be empty')">Place Order<i class="fa fa-chevron-right"></i></button>
            <?php endif; ?>

      </div>
    </form>

    </div>
  </div>
</div>

<script>
var phone = document.getElementById("phone_number");
var re = /^(09|\+639)\d{9}$/;

function validatePhone(){
  if(!re.test(phone.value)) {
    phone.setCustomValidity("Invalid Phone Number");
  } else {
    phone.setCustomValidity('');
  }
}

phone.onchange = validatePhone;
phone.onkeyup = validatePhone;

function check_baranggay(){
  var brgySelect = document.getElementById("barangay-select");
  var cityForm = document.getElementById("city-form");
  $.ajax({
      type: "GET",
      url: "api-checkout-barangay-by-city.php?cityId=" + cityForm.value,
      success: function(data){
        const obj = JSON.parse(data);
        var txt = "<option value=''>-- Select --</option>";
        for (x in obj.brgy_list) {
          txt += "<option value='"+ obj.brgy_list[x].id +"'>" + obj.brgy_list[x].name + "</option>";
        }
        $('#barangay-select').html(txt);
      }
    });
}

</script>

<?php include $ROOT_DIR . "user-templates/footer.php"; ?>
