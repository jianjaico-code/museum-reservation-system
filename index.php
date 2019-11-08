<?php 
  include('php/connection.php');
  include('php/function.php');
  session_start();

  $databaseCtrl = new DatabaseController();
  $sched = $databaseCtrl -> getTimeSched($conn);
  $reservation = $databaseCtrl -> getAllReservation($conn);
  $reservationUser = true;
  if(isset($_POST['reserve'])){
    if(!isset($_SESSION['access'])){
      $usercheck = false;
      $func = null;
    }
    else{
      $usercheck = true;
      $func = $databaseCtrl -> addReservation($conn, $_POST, $_SESSION['userID']);
    }
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
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
<style>
  .buttonRes{
    margin-top: 80px;
  }
</style>
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
              <a href="#home" class="nav-link text-white">HOME</a>
            </li>
            
            <li class="nav-item">
              <a href="#services" class="nav-link text-white">SERVICES</a>
            </li>
            <li class="nav-item">
              <a href="#gallery" class="nav-link text-white">GALLERY</a>
            </li>
            <!-- <li class="nav-item">
              <a href="contact_us.html" class="nav-link">CONTACT US</a>
            </li> -->
            <?php if(isset($_SESSION['access'])): ?>

            <?php

            ?>
            
            <?php if($_SESSION['access'] == 1): ?>
            <li class="nav-item">
              <a href="viewReservationHistory.php" class="nav-link text-white">VIEW RESERVATION HISTORY</a>
            </li>

            <li class="nav-item">
              <a href="php/logout.php" class="nav-link text-white">LOGOUT</a>
            </li>
            <?php endif; ?>

            <?php else: ?>
            <li class="nav-item">
              <a href="login.php" class="nav-link text-white">LOGIN</a>
            </li>

            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
    <!-- SHOWCASE -->
  
<header class="masthead">
	<div class="primary-overlay text-white">
		<div class="home-inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 d-none d-sm-block ">
						<div class="intro-text">
							<p  style="font-size: 35px"></p>
							<div class="intro-heading  display-1"><b>La Castilla Museum</b></div>
							<p>La Castilla is the residence of Atty. Rodolfo N. Pelaez and his wife Mrs. Elsa Pelaez-Pelaez, founder of what was then simply as Liceo de Cagayan, and of vignettes in their lives that revolved around La Castilla.</p>
							<!-- <a class="btn btn-success btn-lg text-uppercase text-white"  href="#services">GET STARTED</a> -->
						</div>
					</div>
					<div class="col-lg-4 form">
						<div class="card  text-center card-form">
            <?php if(!isset($_SESSION['access'])): ?>
							<div class="card-body">
                <h3>Check for Availability</h3><br>
                <?php if(isset($_POST['reserve'])): ?>
            
                <?php if(!$usercheck): ?>
                <div class="alert alert-danger collapse show">
                  You must <strong>Login</strong> or <strong>Signup</strong> first. Thank you!
                </div>
                <?php endif; ?>

                <?php else: ?>
                <div class="alert alert-danger collapse hide">
                  You must <strong>Login</strong> or <strong>Signup</strong> first. Thank you!
                </div>

                <?php endif; ?>

                <?php if(isset($_POST['reserve'])): ?>
                  <?php if($func != null){ ?>
                    <?php if($func == 2): ?>
                      <div class="alert alert-danger collapse show">
                        This schedule is <strong>Already</strong> taken.
                      </div>
                      <?php elseif($func == 3):?>
                      <div class="alert alert-danger collapse show">
                        Invalid Date
                      </div>
                      <?php else:?>
                      <div class="alert alert-success collapse show">
                        Thank you! You have successfully  reserved this schedule
                      </div>
                      <?php endif;?>
                    <?php }?>
                <?php endif;?>
								<form method="post">
									
									<div class="form-group">
										<input type="date" name="date" class="form-control" placeholder="Password">
									</div>
									<div class="form-group try">
									<select name="time" class="form-control wide">
                    <?php while($time = $sched -> fetch_object()):?>
                        <?php if($time->status == 1): ?>
                          <option value="<?php echo $time->time_id?>"><?php echo $time->time_from?> - <?php echo $time->time_to?></option>
                        <?php endif; ?>
                    <?php endwhile; ?>
                  </select>
                    
									</div>
									<button type="submit" name="reserve" class="btn  btn btn-outline-light btn-block btn-success text-white buttonRes">Reserve</button>
								</form>
							</div>
            <?php else: ?>
              <?php 
                date_default_timezone_set('Asia/Manila');
                $dToday = date("Y-m-d");
                $dToday = date('Y-m-d', strtotime($dToday));

                while($result = $reservation -> fetch_object()){
                  if($_SESSION['userID'] == $result->user_id){
                    $reservedDate = $result->reservation_date;
                    $reservedDate = date('Y-m-d', strtotime($reservedDate));
                    
                    if($dToday == $reservedDate){ ?>
                      <h3>You have a reservation today</h3>
                      <p>Please fill out the form to continue</p>
                      <a href="filloutForm.php?id=<?php echo $result->resu; ?>" class="btn btn-success m-2 btn-sm text-uppercase text-white">Fill Out</a>
                    <?php $reservationUser = false;}
                    else{
                      $reservationUser = true;
                    }
                  }
                ?>
              <?php } ?>
              <?php 
                if($reservationUser){ ?>
                    <div class="card-body">
                    <h3>Check for Availability</h3><br>
                    <?php if(isset($_POST['reserve'])): ?>
                
                    <?php if(!$usercheck): ?>
                    <div class="alert alert-danger collapse show">
                      You must <strong>Login</strong> or <strong>Signup</strong> first. Thank you!
                    </div>
                    <?php endif; ?>

                    <?php else: ?>
                    <div class="alert alert-danger collapse hide">
                      You must <strong>Login</strong> or <strong>Signup</strong> first. Thank you!
                    </div>

                    <?php endif; ?>

                    <?php if(isset($_POST['reserve'])): ?>
                      <?php if($func != null){ ?>
                        <?php if($func == 2): ?>
                          <div class="alert alert-danger collapse show">
                            This schedule is <strong>Already</strong> taken.
                          </div>
                          <?php elseif($func == 3):?>
                          <div class="alert alert-danger collapse show">
                            Invalid Date
                          </div>
                          <?php else:?>
                          <div class="alert alert-success collapse show">
                            Thank you! You have successfully  reserved this schedule
                          </div>
                          <?php endif;?>
                        <?php }?>
                    <?php endif;?>
                    <form method="post">
                      
                      <div class="form-group">
                        <input type="date" name="date" class="form-control" placeholder="Password">
                      </div>
                      <div class="form-group try">
                      <select name="time" class="form-control wide">
                        <?php while($time = $sched -> fetch_object()):?>
                            <?php if($time->status == 1): ?>
                              <option value="<?php echo $time->time_id?>"><?php echo $time->time_from?> - <?php echo $time->time_to?></option>
                            <?php endif; ?>
                        <?php endwhile; ?>
                        </select>
                        
                      </div>
                      <button type="submit" name="reserve" class="btn btn-success btn-lg text-uppercase text-white">Reserve</button>
                    </form>
                  </div>
                <?php }
              ?>
            <?php endif; ?>
            </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
    <section id="services" class="text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="info-header mb-5">
              <h1 class="text-dark pb-3 section-heading">
              
              </h1>
              <p class="lead pb-3">
              La Castilla was christened by the lady of the house, Mrs. Pelaez. Its grounds used to be part of a six-hectare property belonging to the Pelaez family, originally planted with corn and coconut along what was once a two-lane dirt country road that was known as Kauswagan Road. This thoroughfare provided the only access to Kauswagan and the fishing port of Bonbon. In 1976, with the construction of the Marcos Bridge, part of the property was expropriated by the government to give way to the inexorable march of progress. Today, an abbreviated portion of the original grounds of La Castilla is all that remains of its landscaped gardens.
In 1968, six years after Atty. Pelaez transferred the campus of Liceo de Cagayan from its original site fronting Gaston Park across the St. Augustine Cathedral in down town Cagayan de Oro to its present location at the junction of Patag and Kauswagan Road (now Rodolfo N. Pelaez Blvd.), La Castilla was built. It was originally meant to be a summer residence- and doubled up as a guest house - until the magnitude six earthquake that shook Mindanao, Cagayan de Oro included, in July, 1976 which precipitated the founders’ decision to take up residence in La Castilla from the third floor of what has always been their residence in Rizal Street in the poblacion. La Castilla then served as their home until the demise of Atty. Pelaez on August 10, 1980.


              </p>

              <p class="lead pb-3">
              La Castilla museum accommodates guest for painting exhibits, photo exhibits, public relations events, intimate tea parties, book launching and photo-shoots.
              </p>
              
            </div>
            <!-- <div class="row text-center ">
              <div class="col-md-4">
                <span class="fa-stack fa-4x">
                  <i class="fa fa-circle fa-stack-2x text-success"></i>
                  <i class="fa fa fa-commenting-o fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="service-heading">Opening hours</h4>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto eligendi, cum esse accusantium eius ve..</p>
              </div>
              <div class="col-md-4">
                <span class="fa-stack fa-4x">
                  <i class="fa fa-circle fa-stack-2x text-success"></i>
                  <i class="fa fa-line-chart fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="service-heading">Ongoing Exhibition</h4>
                <p class="text-muted">>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto eligendi, cum esse accusantium eius ve..</p>
              </div>
              <div class="col-md-4">
                <span class="fa-stack fa-4x">
                  <i class="fa fa-circle fa-stack-2x text-success"></i>
                  <i class="fa fa fa fa-trophy fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="service-heading">Opening Event</h4>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiibusdam nulla aspernatur quaerat ad ea autem assumenda impedit.</p>
              </div>
            </div> -->
          </div>
        </div>
      </section>

     <section id="gallery" class="py-5 bg-light" >
    <div class="container">
      <h1 class="text-center">Our Exhibition Gallery</h1>
      <p class="text-center">Check out our photos.</p>
      <div class="row mb-4" >
        <div class="col-md-4" >
          
          <a class="view" href="img/bg_1.jpg" data-effect="mfp-zoom-in" >
            <img src="img/bg_1.jpg"  class="img-fluid">
          </a>
        </div>
        <div class="col-md-4">
          <a class="view" href="img/bg_2.jpg" data-effect="mfp-zoom-in">
            <img src="img/bg_2.jpg" alt="" class="img-fluid">
          </a>
        </div>
        <div class="col-md-4">
          <a class="view" href="img/bg_3.jpg" data-effect="mfp-zoom-in">
            <img src="img/bg_3.jpg" alt="" class="img-fluid">
          </a>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-md-4">
          <a class="view" href="img/bg_4.jpg" data-effect="mfp-zoom-in">
            <img src="img/bg_4.jpg" alt="" class="img-fluid">
          </a>
        </div>
        <div class="col-md-4">
          <a class="view" href="img/bg_5.jpg" data-effect="mfp-zoom-in">
            <img src="img/bg_5.jpg" alt="" class="img-fluid">
          </a>
        </div>
        <div class="col-md-4">
          <a class="view" href="img/bg_1.jpg" data-effect="mfp-zoom-in">
            <img src="img/bg_1.jpg" alt="" class="img-fluid">
          </a>
        </div>
      </div>
    </div>
  </section>
<section id="contact" class="py-5 ">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <h3>Get In Touch</h3>
        <p class="lead">Newsletter</p>
        <form>
          <div class="form-group">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control" placeholder="Name" required>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
              </div>
              <input type="email" class="form-control" placeholder="Email" required>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-pencil"></i></span>
              </div>
              <textarea class="form-control" placeholder="Message" rows="5" required></textarea>
            </div>
          </div>
          <input type="submit" value="Submit" class="btn btn-success btn-xl btn-block text-uppercase text-white">
        </form>
      </div>
      <div class="col-lg-4 align-self-center contact-page-area">
        <div class="single-contact-address d-flex flex-row">
          <div class="icon">
            <span class="lnr lnr-home"></span>
          </div>
          <div class="contact-details">
            <p>Rodolfo N. Pelaez Blvd, Cagayan de Oro, 9000 Misamis Oriental</p>
          </div>
        </div>
        <div class="single-contact-address d-flex flex-row">
          <div class="icon">
            <span class="lnr lnr-phone-handset"></span>
          </div>
          <div class="contact-details">
            <p>858-4090 local 188</p>
          </div>
        </div>
        <div class="single-contact-address d-flex flex-row">
          <div class="icon">
            <span class="lnr lnr-clock"></span>
          </div>
          <div class="contact-details">
            <p>Tue to Fri 8am to 5pm</p>
            <p>Sat 8am to 12nn</p>
            <p>Sun to Fri 8am to 5pm</p>
            <p>Mon Closed</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

      <footer id="main-footer" class="py-5 footer text-white">
        <div class="container">
          <div class="row text-center">
            <div class="col-md-6 ml-auto">
              <!-- <p><a style="color: white;" id="company" href="https://bracketlogic.com/about-us" class="lead" style="font-size: 20px"> Powered by: Bracket Logic</a></p> -->
            </div>
            <div class="col-md-6 ml-auto">
              <p class="lead"><a style="color: white;" id="company" href="https://www.facebook.com/La-Castilla-Museum-811055358912080/" class="lead" style="font-size: 20px">Copyright &copy; La Castilla Museum 2019</a></p>
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