<?php
session_start();
require_once '../config/database.php';
require_once '../config/Models.php';
$ROOT_DIR = "../";

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
    <!-- <link href="<?=$ROOT_DIR;?>templates/css/owl.carousel.min.css" rel="stylesheet">
    <link href="<?=$ROOT_DIR;?>templates/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" /> -->

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?=$ROOT_DIR;?>templates/css/bs.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?=$ROOT_DIR;?>templates/css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
