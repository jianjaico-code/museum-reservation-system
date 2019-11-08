<?php 
  include('php/connection.php');
  include('php/function.php');
  session_start();

  $databaseCtrl = new DatabaseController();
  $sched = $databaseCtrl -> getTimeSched($conn);

  if(!isset($_SESSION['access'])){
    header("location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="img/logo.jpg"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>La Castilla Museum</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body id="home">
    <nav class="navbar navbar-expand-md navbar-light fixed-top ">
      <div class="container">
        <a href="index.php" class="navbar-brand">
          <img src="img/logo.jpg" width="50" height="50" alt="" id="logo"><h3 class="d-inline align-middle"></h3>
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="#home" class="nav-link ">HOME</a>
            </li>
            
            <li class="nav-item">
              <a href="#services" class="nav-link">SERVICES</a>
            </li>
            <li class="nav-item">
              <a href="#gallery" class="nav-link">GALLERY</a>
            </li>
            <!-- <li class="nav-item">
              <a href="contact_us.html" class="nav-link">CONTACT US</a>
            </li> -->
            <?php if(isset($_SESSION['access'])): ?>
            
            <?php if($_SESSION['access'] == 1): ?>
            <li class="nav-item">
              <a href="php/logout.php" class="nav-link ">LOGOUT</a>
            </li>
            <?php endif; ?>

            <?php else: ?>
            <li class="nav-item">
              <a href="login.php" class="nav-link ">LOGIN</a>
            </li>

            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
    <!-- SHOWCASE -->
    <header class="masthead">

      <div class="primary-overlay text-white">
        <div class="container">
         
          <div class="intro-text">
            <p  style="font-size: 35px"></p>
             
            <div class="intro-heading  display-1"><b>Thank you!</b></div>
            <p>You have successfully  reserved this schedule</p>
            
  
            <a href="index.php" name="reserve" class="btn btn-success btn-lg text-uppercase text-white">Back</a>

          </div>
        </div>
      </div>
    </header>

      <footer id="main-footer" class="py-5 footer text-white">
        <div class="container">
          <div class="row text-center">
            <div class="col-md-6 ml-auto">
              <!-- <p><a style="color: white;" id="company" href="https://bracketlogic.com/about-us" class="lead" style="font-size: 20px"> Powered by: Bracket Logic</a></p> -->
            </div>
            <div class="col-md-6 ml-auto">
              <p class="lead"><a style="color: white;" id="company" href="https://bracketlogic.com/about-us" class="lead" style="font-size: 20px">Copyright &copy; La Castilla Museum 2019</a></p>
            </div>
            
          </div>
        </div>
      </footer>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/navbar-fixed.js"></script>
      <script>
      $(document).ready(function() {
      $(window).on("scroll", function() {
      if ($(window).scrollTop() > 100) {
      $(".navbar").addClass("compressed");
      } else {
      $(".navbar").removeClass("compressed");
      }
      });
      });
      </script>
    </body>
  </html>