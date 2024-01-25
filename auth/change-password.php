<?php
$ROOT_DIR="../";
include $ROOT_DIR . "templates/header-blank.php";

?>
<div class = "btaologo"> </div>
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-lg-5">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                  <div class="card-header"><h3 class="text-center font-weight-light my-4">Change Password for <?=$_SESSION["user_session"]["username"]?></h3></div>
                  <div class="card-body">
                    <span style="color:red;"><?=$error;?></span>
                      <form method="post" action="process.php?action=change-password">
                          <div class="form-floating mb-3">
                              <input class="form-control" id="inputUsername" name="password1" type="password" placeholder="New Password" />
                              <label for="inputUsername">New Password</label>
                          </div>
                          <div class="form-floating mb-3">
                              <input class="form-control" id="inputPassword" name="password2" type="password" placeholder="Retype Password" />
                              <label for="inputPassword">Retype Password</label>
                          </div>
                          <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                              <button type="submit" id="act" class="btn btn-primary">Activate</button>
                          </div>
                      </form>
                  </div>
                  <div class="card-footer text-center py-3">
                  </div>
              </div>
          </div>
      </div>
  </div>
<style>
@import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300;500&family=Sora:wght@500&display=swap');
*{
  font-family: 'Oswald', sans-serif;
}
body{
  background-color: #039935;
}
.btaologo {
     background-image: url(../icons/btaologo.png);
     height: 105px;
     width: 225px;
     position: relative;
     top: 50%;
     margin-left:30px;
     left: 50%;
     transform: translate(-50%, -50%);
     background-size: contain;
     background-repeat: no-repeat;
     margin-top: -210px;
     z-index: 1;
 }
 .col-lg-5{
   margin-top: 180px;
   margin-left:-100px;
 }
 .card{
   width: 500px;
   border-radius: 50px;

 }
 #act{
   background-color: #039935;
   border-color: black;
   width: 400px;
   margin-left: 30px;
 }
</style>
