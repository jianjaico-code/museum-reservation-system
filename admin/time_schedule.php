<?php $page='time'; 
  include('include/header.php'); 
  include('../php/function.php');
  include('../php/connection.php');
  ?>

<?php 
   $databaseCtrl = new DatabaseController();
    $result = $databaseCtrl -> getTimeSched($conn);

    if(isset($_POST['Save'])){
        $func = $databaseCtrl -> addTimeSched($conn, $_POST);
    }

    if(isset($_POST['Inactive'])){
      $databaseCtrl -> inactiveTime($conn, $_POST);
    }
    if(isset($_POST['Active'])){
        $databaseCtrl -> activeTime($conn, $_POST);
    }

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
            
            <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
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
        <button type="button" class="btn btn-lg float-right btn-primary" data-toggle="modal" data-target="#myModal" style="margin-right: 30px;">Add New Schedule</button>
          <h4 class="mt-3 font-weight-bold text-primary">Reports</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Time ID</th>
                  <th>From</th>
                  <th>To</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php  while ($row = $result -> fetch_object()): 
                       $key = $row->time_id;
                  ?>
                      <tr>
                        <td><?php echo  $row->time_id;?></td>
                        <td><?php echo $row-> time_from ?></td>
                        <td><?php echo $row-> time_to ?></td>
                        <td class="text-center">
                            <?php if($row->status==1) echo "<form method='post'><input type='hidden' name='data' value='$key'><button type='submit' name='Inactive' class='btn btn-success'>Active</button></form>";?>
                            <?php if($row->status==2) echo "<form method='post'><input type='hidden' name='data' value='$key'><button type='submit' name='Active' class='btn btn-danger'>Inactive</button></form>";?>
                        </td>
                      </tr>
                      <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include("modal/modal_schedule.php"); ?>

  <?php include('include/footer.php') ?>