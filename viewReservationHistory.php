<?php 
    include('php/connection.php');
    include('php/function.php');
    session_start();

    $databaseCtrl = new DatabaseController();
    $groupedBatch = $databaseCtrl -> getGroupedBatch($conn);
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link href="js/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  </head>
  <body id="home">
    <nav class="navbar navbar-expand-md navbar-light fixed-top ">
      <div class="container">
        <a href="index.php" class="navbar-brand">
          <img src="#" width="50" height="50" alt="" id="logo"><h3 class="d-inline align-middle text-white">La Castilla Online Reservation</h3>
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="index.php" class="nav-link text-white">HOME</a>
            </li>
            
            <li class="nav-item">
              <a href="index.php" class="nav-link text-white">SERVICES</a>
            </li>
            <li class="nav-item">
              <a href="index.php" class="nav-link text-white">GALLERY</a>
            </li>
            <li class="nav-item">
              <a href="viewReservationHistory.php" class="nav-link text-white">VIEW RESERVATION HISTORY</a>
            </li>
            
            <li class="nav-item">
              <a href="php/logout.php" class="nav-link  text-white">LOGOUT</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <header id="page-header" style="height: 484px !important;">
      <div class="primary-overlay text-white">
        <div class="home-inner">
          <div class="container">
            <div class="intro-text">
             
            </div>
          </div>
        </div>
      </div>
    </header>
    <section >
    <div class="container-fluid">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="index.php" class="btn btn-warning">Back</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Date</th>
                  <th>Time In</th>
                  <th>Time Out</th>
                  <th>No. Of People</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php $count = 1; while($res = $groupedBatch -> fetch_object()): if($res->user_id == $_SESSION['userID'] ){ ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $res->reservation_date; ?></td>
                        <td><?php echo $res->time_from; ?></td>
                        <td><?php echo $res->time_to; ?></td>
                        <td><?php echo $res->counter; ?></td>
                        <td>
                          <?php if($res->status == 1) echo "Approved"; ?>
                          <?php if($res->status == 2) echo "Pending For Approval"; ?>
                        </td>
                    </tr>
                <?php }endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
    </section>

    <section id="newsletter" class="bg-light py-5 "> 
      <div class="container">
        <div class="row">
          <!-- <div class="col-lg-5 col-md-6 col-sm-6">
            <div class="single-footer-widget">
              <h5><b>About Us</b></h5>
              <p class="lead saying">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmlore magna aliqua.
              </p>
              <p class="footer-text lead saying">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi amet quae repellend.
              </p>
            </div>
          </div> -->
          <div class="col-lg-5  col-md-6 col-sm-6">
            <div class="single-footer-widget">
              <h5><b>Newsletter</b></h5>
              <p>Stay update with our latest</p>
              <div class="" id="mc_embed_signup">
                <form class="form-inline ">
                  <label class="sr-only" for="email">Email</label>
                  <input type="email" style="background-color: #bebebe;"  class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Enter Email">
                  <button class="btn btn-success" type="submit">Submit</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-6 col-sm-6 social-widget">
            <div class="single-footer-widget">
              <h6>Follow Us</h6>
              <p>Let us be social</p>
              <div class="footer-social d-flex align-items-center">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-github"></i></a>
                <a href="#"><i class="fa fa-code"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <footer  class="py-5 footer text-white">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-6 ml-auto">
            <p><a style="color: white;" id="company" href="https://bracketlogic.com/about-us" class="lead" style="font-size: 20px"> Powered by: Bracket Logic</a></p>
          </div>
          <div class="col-md-6 ml-auto">
            <p class="lead">Copyright &copy; Art Muesum 2019</p>
          </div>
          
        </div>
      </div>
    </footer>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/navbar-fixed.js"></script>
    <script src="js/index.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
     <!-- <script src="js/datatable.min.js"></script> -->
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <script src="js/datatables-demo.js"></script>

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