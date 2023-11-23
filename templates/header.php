<?php
session_start();
require_once '../config/database.php';
require_once '../config/Models.php';
$ROOT_DIR = "../";

$role = $_SESSION["user_session"]["role"];

?>
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
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet"> -->

    <!-- Libraries Stylesheet -->
    <!-- <link href="<?=$ROOT_DIR;?>templates/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?=$ROOT_DIR;?>templates/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" /> -->

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?=$ROOT_DIR;?>templates/css/bs.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?=$ROOT_DIR;?>templates/css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>BTAO</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="ms-3">
                        <h6 class="mb-0"><?=$_SESSION["user_session"]['firstName']?> <?=$_SESSION["user_session"]['lastName']?></h6>
                        <span><?=$role;?></span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <?php if ($role=="Admin"): ?>
                      <div class="nav-item dropdown">
                          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Accounts</a>
                          <div class="dropdown-menu bg-transparent border-0">
                              <a href="accounts.php?role=Admin" class="dropdown-item">Admins</a>
                              <a href="accounts.php?role=Staff" class="dropdown-item">Staffs</a>
                              <a href="accounts.php?role=Officer" class="dropdown-item">Officers</a>
                          </div>
                      </div>
                      <a href="drivers.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Drivers</a>
                      <a href="drivers.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>List of violation</a>
                      <a href="penalties.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Penalties</a>
                    <?php endif; ?>

                    <?php if ($role=="Staff"): ?>
                      <a href="drivers.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Drivers</a>
                      <a href="violation-list.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>List of violation</a>
                      <a href="penalties.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Penalties</a>
                    <?php endif; ?>

                    <?php if ($role=="Officer"): ?>
                      <a href="drivers.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Drivers</a>
                      <a href="drivers.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>List of violation</a>
                      <a href="penalties.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Penalties</a>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="d-none d-lg-inline-flex"><?=$_SESSION["user_session"]['firstName']?> <?=$_SESSION["user_session"]['lastName']?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="../auth/process.php?action=user-logout" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-light rounded mx-0" style="padding:20px;">
