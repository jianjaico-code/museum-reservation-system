<?php 
    session_start();
    if(!isset($_SESSION['access'])){
        header("location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin - Panel</title>
    <link href="../fonts/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../css/admin.min.css" rel="stylesheet">
    <link href="../js/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  </head>
  <body id="page-top">
    <div id="wrapper">
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
          <div class="sidebar-brand-text mx-3">La Castilla <sup>Museum</sup></div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item <?php if($page == 'index'){echo 'active';}?>">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Schedules Today</span></a>
          </li>
          <hr class="sidebar-divider">
          <div class="sidebar-heading">
            Manage Schedule
          </div>
            
            <li class="nav-item <?php if($page == 'upcomming_sched'){echo 'active';}?>">
              <a class="nav-link" href="upcomming_sched.php">
                <i class="fas fa-fw fa-calendar"></i>
                <span>Upcomming Schedules</span></a>
              </li>
              <li class="nav-item <?php if($page == 'history'){echo 'active';}?>">
                <a class="nav-link" href="history.php">
                  <i class="fas fa-fw fa-history"></i>
                  <span>History</span></a>
                </li>
                <li class="nav-item <?php if($page == 'time'){echo 'active';}?>">
                  <a class="nav-link" href="time_schedule.php">
                    <i class="fas fa-fw fa fa-book"></i>
                    <span>Time Schedules</span></a>
                  </li>
                <li class="nav-item <?php if($page == 'inventory'){echo 'active';}?>">
                  <a class="nav-link" href="inventory.php">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Inventory</span></a>
                  </li>
                  <hr class="sidebar-divider d-none d-md-block">
                  <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                  </div>
                </ul>