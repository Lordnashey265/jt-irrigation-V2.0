<?php
    include "php/connect.php";
    $query="SELECT `v1`,`v2`,`current` FROM `pv` WHERE `id`=1";
    if($run=mysqli_query($conn,$query)){
        list($voltage1,$voltage2,$current)=mysqli_fetch_array($run);
    }
    else{
        die(mysqli_error($conn));
    }
    
    function status($percent){
      if($percent>=95 && $percent<=100){
        $icon="battery-status-full.png";
      }
      else if($percent>=80 && $percent<=94.5){
        $icon="battery-status-80.png";
      }
      else if($percent>=60 && $percent<=79.9){
        $icon="battery-status-60.png";
      }
      else if($percent>=40 && $percent<=59.9){
        $icon="battery-status-40.png";
      }
      else if($percent>=20 && $percent<=39.9){
        $icon="battery-status-20.png";
      }
      else if($percent>=0 && $percent<=19.9){
        $icon="battery-status-0.png";
      }
      return $icon;
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
  <title>JT Irrigation - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="./css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="./css/style.css">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar General -->
        <nav class="navbar navbar-expand navbar-light on-top bg-white shadow">
          <!-- Topbar Navbar -->
         	 <ul class="navbar-nav mr-auto">
         	 	<div class="brand"><span style="color: #47def3" class="fa-2x"><b>JT</b></span>  Irrigation Monitoring System</div>
          	</ul>
        </nav>
        <!-- End of Topbar Cover-->

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white  mb-4">
          <!-- Topbar Navbar -->
         	 <ul class="navbar-nav mr-auto">
         	 	<div class="brand"><span style="color: #47def3" class="fa-2x"><b>PV</b></span> Irrigation Monitoring System</div>
          	</ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <!-- Content Row 1-->
          <div class="row">

            <!-- Battery 1 -->
            <div class="col-lg-4 col-md-6 mb-4 image">
              <div class="card border-left-primary shadow py-2">
                <!-- Card Header-->
                <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Battery 1</h6>
                </div>
                <div class="card-body">
                  <!-- In Volts -->
                  <div class="row no-gutters align-items-center">
                    <div class="col">
                      <div class="row ml-2 mb-4">
                        <img src="./icons/voltage.png" alt="Voltage">
                      </div>
                      <div class="row ml-2">
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $voltage1;?> volts</div>
                      </div>
                    </div>
                    <!-- In % -->
                    <div class="col" style="float:right;">
                      <div class="row ml-2 mb-4">
                        <img src="./icons/<?php echo status(($voltage1/9)*100);?>" alt="Voltage1">
                      </div>
                      <div class="row ml-4">
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo round(($voltage1/9)*100,2);?>%</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Battery 2 -->
            <div class="col-lg-4 col-md-6 mb-4 image">
              <div class="card border-left-success shadow py-2">
                <!-- Card Header-->
                <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-success">Battery 2</h6>
                </div>
                <div class="card-body">
                  <!-- In Volts -->
                  <div class="row no-gutters align-items-center">
                    <div class="col">
                      <div class="row ml-2 mb-4">
                        <img src="./icons/voltage.png" alt="Voltage">
                      </div>
                      <div class="row ml-2">
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $voltage2;?> volts</div>
                      </div>
                    </div>
                    <!-- In % -->
                    <div class="col" style="float:right;">
                      <div class="row ml-2 mb-4">
                        <img src="./icons/<?php echo status(($voltage2/13.7)*100);?>" alt="Voltage2">
                      </div>
                      <div class="row ml-4">
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo round(($voltage2/13.7)*100,2);?>%</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Overall Voltage -->
            <div class="col-lg-4 col-md-6 mb-4 image">
              <div class="card border-left-dark shadow py-2">
                <!-- Card Header-->
                <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-dark">Water Content</h6>
                </div>
                <div class="card-body">
                  <!-- In Volts -->
                  <div class="row d-flex justify-content-center">
                    <div class="col-sm-8">
                      <div class="row water align-items-center">
                        <div class="col-sm-8">
                            <div class="row mb-4">
                              <img src="./icons/water.png" alt="Water">
                            </div>
                        </div>
                        <!-- In % -->
                        <div class="col-sm-4">
                          <div class="row">
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo round((( ($voltage1/13.7) + ($voltage2/13.7) ))*100,2);?>%</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row 2-->
           <div class="row">

            <!-- Current -->
            <div class="col-lg-4 col-md-4 image">
              <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
                  <h5 class="m-0 font-weight-bold text-primary">Soil Moisture</h5>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col ml-2">
                      <img src="./icons/meter.png" alt="Temperature">
                    </div>
                    <div class="col ml-4 mt-4">
                      <div class="lead font-weight-bold"><?php echo $current;?> %</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Temperature -->
            <div class="col-lg-4 col-md-4 image">
              <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
                  <h5 class="m-0 font-weight-bold text-primary">Temperature</h5>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col ml-2">
                      <img src="./icons/thermometer.png" alt="Temperature">
                    </div>
                    <div class="col ml-4 mt-4">
                      <div class="lead font-weight-bold">25 &deg;C</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Light Concentration -->
            <div class="col-lg-4 col-md-4 image">
              <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
                  <h5 class="m-0 font-weight-bold text-primary">Humidity</h5>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col ml-2">
                      <img src="./icons/humidity.png" alt="Light">
                    </div>
                    <div class="col ml-4 mt-4">
                      <div class="lead font-weight-bold">1023</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row 3-->
          <div class="row">

            <!-- Alert -->
            <div class="col-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Dust</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                	<center>
                		<i class="fa-10x fa fa-bell text-success"></i>
                		<p class="message">You are safe</p>
                	</center>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Safe
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-warning"></i> Shade
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-danger"></i> Dust
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
       
          <!-- Content Row -->
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Photo Voltaic Monitoring</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="js/jQuery.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/chart-area.js"></script>
  <script src="js/alert.js"></script>
  <script src="./js/chart-data.js"></script>
  <script src="./js/chart.min.js"></script>
  <script src="./js/easypiechart-data.js"></script>
  <script src="./js/easypiechart.js"></script>

</body>

</html>
