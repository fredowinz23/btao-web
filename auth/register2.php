<?php
$ROOT_DIR="../";
$pageName = "Register cont...";
include $ROOT_DIR . "user-templates/header.php";

?>

<div class="container">
  <center>
  <div class="card">
    <div class="card-header">
      <b>Enter User Information</b>
    </div>
      <form method="post" action="process.php?action=register-step-2">
      <div class="card-body">
        <div class="row text-left">
          <div class="col-lg-6">
            <b>First Name:</b>
            <input type="text" class="form-control" name="firstName" required>
          </div>
          <div class="col-lg-6">
            <b>Last Name:</b>
            <input type="text" class="form-control" name="lastName" required>
          </div>
         
          
          <div class="col-lg-4">
            <b>Phone Number</b>
            <input type="number" name="phone" value="09" class="form-control" required>
          </div>
          <div class="col-lg-12 mt-3 mb-2">
            <b>Address</b>
          </div>
          <div class="col-lg-3">
            <b>Street</b>
            <input type="text" name="street" class="form-control" required>
          </div>
          <div class="col-lg-3">
            <b>Brgy</b>
            <input type="text" name="brgy" class="form-control" required>
          </div>
          <div class="col-lg-3">
            <b>City</b>
            <input type="text" name="city" class="form-control" required>
          </div>
          <div class="col-lg-3">
            <b>Province</b>
            <input type="text" name="province" class="form-control" required>
          </div>
        </div>
        </div>
      </div>
      <div class="card-footer">
        <button class="btn btn-primary">Register</button>
      </div>
    </form>
  </div>
</center>
</div>


<?php include $ROOT_DIR . "user-templates/footer.php"; ?>
