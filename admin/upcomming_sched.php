<?php $page='upcomming_sched'; 
  include('include/header.php');
  include('../php/function.php');
  include('../php/connection.php');
 $databaseCtrl = new DatabaseController();

 $data = $databaseCtrl -> getAllReservation($conn);
 ?>
<div id="content-wrapper" class="d-flex flex-column">
  <div id="content">
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
      </button>
      <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">SETTINGS</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <div class="container-fluid">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h4 class="mt-3 font-weight-bold text-primary">Reports</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Reservation Date</th>
                    <th>Time</th>
                    <th>Name</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    date_default_timezone_set('Asia/Manila');
                    $dToday = date("Y-m-d");
                    $dToday = date('Y-m-d', strtotime($dToday));

                    while($res = $data -> fetch_object()):
                      $key = $res->reservation_id;
                      $reservedDate = $res->reservation_date;
                      $reservedDate = date('Y-m-d', strtotime($reservedDate));

                      if($dToday < $reservedDate){ 
                  ?>
                  <tr>
                    <td><?php echo $res->reservation_date;?></td>
                    <td><?php echo $res->time_from." - ".$res->time_to?></td>
                    <td><?php echo $res->user_firstname." ".$res->user_lastname?></td>
                  </tr>
                <?php }endwhile; ?>
                </tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('include/footer.php') ?>