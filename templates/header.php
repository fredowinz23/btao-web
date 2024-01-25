<?php
session_start();
require_once '../config/database.php';
require_once '../config/Models.php';
$ROOT_DIR = "../";

$role = $_SESSION["user_session"]["role"];

?>
<style>
h2{
  color:#039935 !important;
}

</style>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>BTAO Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?=$ROOT_DIR;?>templates/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?=$ROOT_DIR;?>templates/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?=$ROOT_DIR;?>templates/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?=$ROOT_DIR;?>templates/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?=$ROOT_DIR;?>templates/css/style.css" rel="stylesheet">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->



        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="BTAO"> <img src="../icons/btaologo.png" alt="Dashboard Icon" class="icon me-2" height="30" width="30">BTAO</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="ms-3">
                        <h6 class="mb-0"><?=$_SESSION["user_session"]['firstName']?> <?=$_SESSION["user_session"]['lastName']?></h6>
                        <span><?=$role;?></span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                  <a href="index.php" class="nav-item nav-link">
                    <img src="../icons/dashboard.png" alt="Dashboard Icon" class="icon me-2" height="30" width="30">
                    Dashboard
                  </a>
                    <?php if ($role=="Admin"): ?>
                      <div class="nav-item dropdown">
                          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                             href="index.php" class="nav-item nav-link">
                              <img src="../icons/accounts.png" alt="Dashboard Icon" class="icon me-2" height="30" width="30">
                              Accounts
                            </a>
                          <div class="dropdown-menu bg-transparent border-0">
                              <a href="accounts.php?role=Admin" class="dropdown-item">
                                <img src="../icons/admin.png" alt="Dashboard Icon" class="icon me-2" height="22" width="22">Admins</a>
                              <a href="accounts.php?role=Staff" class="dropdown-item">
                                 <img src="../icons/staff.png" alt="Dashboard Icon" class="icon me-2" height="22" width="22">Staff</a>
                              <a href="accounts.php?role=Officer" class="dropdown-item">
                                <img src="../icons/enforcer.png" id="officer" alt="Dashboard Icon" class="icon me-2" height="20" width="20">Officers</a>
                          </div>
                      </div>
                      <div class="nav-item dropdown">
                          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                             href="index.php" class="nav-item nav-link">
                            <img src="../icons/records.png" alt="records Icon" class="icon me-2" height="30" width="30">
                            Records
                          </a>
                          <div class="dropdown-menu bg-transparent border-0">
                              <a href="drivers.php" class="dropdown-item">
                                <img src="../icons/driver.png" alt="Dashboard Icon" class="icon me-2" height="23" width="23">Drivers</a>
                              <a href="vehicles.php" class="dropdown-item">
                                 <img src="../icons/vehicle.png" id="vehicle1" alt="Dashboard Icon" class="icon me-2" height="25" width="25">Vehicles</a>
                          </div>
                      </div>
                      <div class="nav-item dropdown">
                          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                            href="index.php" class="nav-item nav-link">
                              <img src="../icons/payment.png" id="settlement" alt="payment Icon" class="icon me-2" height="30" width="30">
                              Settlement
                            </a>
                          <div class="dropdown-menu bg-transparent border-0">
                              <a href="settlement.php?type=Driver" class="dropdown-item">
                                <img src="../icons/driver.png" alt="Dashboard Icon" class="icon me-2" height="23" width="23">Drivers</a>
                              <a href="settlement.php?type=Vehicle" class="dropdown-item">
                                 <img src="../icons/vehicle.png" id="vehicle2" alt="Dashboard Icon" class="icon me-2" height="25" width="25">Vehicles</a>
                          </div>
                      </div>
                      <div class="nav-item dropdown">
                          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                           href="index.php" class="nav-item nav-link">
                            <img src="../icons/options.png" id="options" alt="options Icon" class="icon me-2" height="30" width="30">
                            Options
                          </a>
                          <div class="dropdown-menu bg-transparent border-0">
                              <a href="zone-list.php" class="dropdown-item">
                                 <img src="../icons/zone.png" alt="Dashboard Icon" class="icon me-2" height="23" width="23">Zone Options</a>
                              <a href="violation-list.php" class="dropdown-item">
                                <img src="../icons/violation.png" alt="Dashboard Icon" class="icon me-2" height="22" width="22">Violation Options</a>
                          </div>
                      </div>
                      <div class="nav-item dropdown">
                          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                            href="index.php" class="nav-item nav-link">
                            <img src="../icons/analytics.png" id="analytics" alt="analytics Icon" class="icon me-2" height="30" width="30">
                            Analytics
                          </a>
                          <div class="dropdown-menu bg-transparent border-0">
                              <a href="violation-per-category.php" class="dropdown-item">
                                 <img src="../icons/zone.png" alt="Dashboard Icon" class="icon me-2" height="23" width="23">Violation Per Category</a>
                              <a href="violation-per-zone.php" class="dropdown-item">
                                <img src="../icons/violation.png" alt="Dashboard Icon" class="icon me-2" height="22" width="22">Violation Per Zone</a>
                          </div>
                      </div>
                    <?php endif; ?>

                    <?php if ($role=="Staff"): ?>
                      <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                           href="index.php" class="nav-item nav-link">
                          <img src="../icons/records.png" alt="records Icon" class="icon me-2" height="30" width="30">
                          Records
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="drivers.php" class="dropdown-item">
                              <img src="../icons/driver.png" alt="Dashboard Icon" class="icon me-2" height="23" width="23">Drivers</a>
                            <a href="vehicles.php" class="dropdown-item">
                               <img src="../icons/vehicle.png" id="vehicle1" alt="Dashboard Icon" class="icon me-2" height="25" width="25">Vehicles</a>
                          </div>
                      </div>
                      <div class="nav-item dropdown">
                          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                            href="index.php" class="nav-item nav-link">
                              <img src="../icons/payment.png" id="settlement" alt="payment Icon" class="icon me-2" height="30" width="30">
                              Settlement
                            </a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="settlement.php?type=Driver" class="dropdown-item">
                                  <img src="../icons/driver.png" alt="Dashboard Icon" class="icon me-2" height="23" width="23">Drivers</a>
                                <a href="settlement.php?type=Vehicle" class="dropdown-item">
                                   <img src="../icons/vehicle.png" id="vehicle2" alt="Dashboard Icon" class="icon me-2" height="25" width="25">Vehicles</a>
                            </div>
                      </div>
                      <div class="nav-item dropdown">
                          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                            href="index.php" class="nav-item nav-link">
                            <img src="../icons/analytics.png" id="analytics" alt="analytics Icon" class="icon me-2" height="30" width="30">
                            Analytics
                          </a>
                          <div class="dropdown-menu bg-transparent border-0">
                              <a href="violation-per-category.php" class="dropdown-item">
                                 <img src="../icons/zone.png" alt="Dashboard Icon" class="icon me-2" height="23" width="23">Zone Options</a>
                              <a href="violation-per-zone.php" class="dropdown-item">
                                <img src="../icons/violation.png" alt="Dashboard Icon" class="icon me-2" height="22" width="22">Violation Options</a>
                          </div>
                      </div>
                    <?php endif; ?>

                    <?php if ($role=="Officer"): ?>
                      <a href="drivers.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>List of Drivers</a>
                      <a href="vehicles.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>List of Vehicles</a>
                      <a href="violation-list.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>List of violation</a>
                      <a href="penalties.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Penalties</a>
                    <?php endif; ?>

                    <a href="../auth/process.php?action=user-logout" class="nav-item nav-link"
                      href="index.php" class="nav-item nav-link">
                        <img src="../icons/logout.png" id="Logout" alt="Logout Icon" class="icon me-2" height="30" width="30">
                        Logout
                      </a>
                </div>
            </nav>
        </div>

        <style>
        #settlement,
        #options,
        #analytics,
        #logout{
          margin-left: 2px;
        }

        #vehicle1,
        #vehicle2{
          margin-left: -1px;
        }
        #officer{
          margin-left: 1px;
        }
        .BTAO{
          color:#039935;
        }
        </style>

        <div class="content" style="padding:50px">
