<?php
$ROOT_DIR="../";
include $ROOT_DIR . "templates/header-blank.php";

?>
    <div class = "btaologo" ></div>
  <div class="container">
      <div class="row justify-content-center">

          <div class="col-lg-5">

              <div class="card shadow-lg border-0 rounded-lg mt-5">
                  <div class="card-header"><h3 class="text-center font-weight-light my-4" id="logtxt">Login</h3></div>
                  <div class="card-body" >
                    <span id="error" style="color:red;"><?=$error;?></span>
                      <form method="post" action="process.php?action=user-login">
                          <div class="form-floating mb-3">
                              <input class="form-control" id="inputUsername" name="username" type="text" placeholder="User Name" />
                              <label for="inputUsername" id="inputUsername">User Name</label>
                          </div>
                          <div class="form-floating mb-3">
                              <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" />
                              <label for="inputPassword" id="inputPassword">Password</label>
                          </div>
                          <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                              <button type="submit"id="logbtn" class="btn btn-primary">Login</button>
                          </div>
                          <br>
                      </form>
                  </div>
                  <div class="card-footer text-center py-3"><h1 id="teambes">TEAM BES. ALL RIGHTS RESERVE 2024</h1>
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
         background-image: url(../icons/loginbg.jpg);
         background-repeat: no-repeat;
         background-size:cover;

    }
    .btaologo {
         background-image: url(../icons/btaologo.png);
         height: 105px;
         width: 225px;
         position: relative;
         top: 50%;
         margin-left: 55px;
         left: 50%;
         transform: translate(-50%, -50%);
         background-size: contain;
         background-repeat: no-repeat;
         margin-top: -210px;
         z-index: 1;
     }
     .col-lg-5{
       margin-top: 170px;
       margin-left:0px;
     }
     .card{
       width: 400px;
       margin-left: 25px;
       border-top-left-radius: 50px;
       border-top-right-radius: 50px;
         border-bottom-right-radius: 10px;
          border-bottom-left-radius: 10px;
     }
     #logbtn{
       width: 225px;
      background-color:  #039935;
      border-color: black;
      margin-left: 75px;
     }

     #error{
       margin-left: 0px;
     }
     .card-body{
       height: 259px;
     }

     @keyframes moveText {
         0% {
             transform: translateX(-100%);
             color: #039935; /* Initial text color */
         }
         25% {
             color: #FF0000; /* Change to the desired color at 25% of the animation */
         }
         50% {
             color: #FFFF00; /* Change to the desired color at 50% of the animation */
         }
         75% {
             color: #0000FF; /* Change to the desired color at 75% of the animation */
         }
         100% {
             transform: translateX(100%);
             color: #039935; /* Return to the initial color at the end of the animation */
         }
     }

.card-footer {
    position: relative;
    overflow: hidden;

}
#teambes{
  font-size: 15px;
  position: absolute;
  animation: moveText 20s linear infinite;
  margin-top: -8px;
  color: #039935;
}

  </style>
