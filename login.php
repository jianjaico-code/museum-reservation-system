<?php
  include('php/connection.php');
  include('php/function.php');

  $databaseCtrl = new DatabaseController();
  if(isset($_POST['proceed'])){
    session_start();
    $func = $databaseCtrl -> login($conn, $_POST);
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>La Castilla Museum</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/login_style.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
  </head>
  
  <body id="home">
    <nav class="navbar navbar-expand-md navbar-light fixed-top ">
      <div class="container">
        <a href="index.php" class="navbar-brand">
          <img src="#" width="50" height="50" alt="" id="logo"><h4 class="d-inline align-middle text-white">La Castilla Online Reservation</h4>
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="signup.php" class="nav-link text-white">SIGN UP</a>
            </li>
            
            <li class="nav-item">
              <a href="forgot_pass.php" class="nav-link  text-white">FORGOT PASSWORD</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <section>
      <!-- /map -->
      <div class="container">
        <div class="row">
          <div class="col-md-6 mx-auto">
            <div class="card ">
              <div class="card-header bg-white ">
                <h4 class="text-center">Sign in</h4>
              </div>
              
              <div class="card-body bg-light">
                <div class="alert alert-danger collapse hide  ">
                  <strong>Invalid username/password! </strong>Email administrator to recover it.
                </div>
                <div class="alert alert-warning collapse hide ">
                  This account is <strong>no longer valid</strong>. Thank you!
                </div>
                <form method="post">
                  <div class="input-group mb-4">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user bigicon"></i></span>
                    </div>
                    <input id="fname" name="email" type="email" placeholder="Username" class="form-control" required="">
                  </div>
                  <div class="input-group " >
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input id="fname" name="password" type="password" placeholder="***************" class="form-control " required="" >
                  </div>
                </div>
                <div class="card-footer bg-transparent text-center">
                  <input type="submit" class="btn btn-success text-white btn-block" value="Login" name="proceed" >
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <footer id="main-footer" class="py-5 footer text-black">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-6 ml-auto">
            <p><a style="color: black;" id="company" href="https://bracketlogic.com/about-us" class="lead" style="font-size: 20px"> Powered by: Bracket Logic</a></p>
          </div>
          <div class="col-md-6 ml-auto">
            <p class="lead">Copyright &copy; Art Muesum 2019</p>
          </div>
          
        </div>
      </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/navbar-fixed.js"></script>
    <script src="js/index.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  </body>
</html>