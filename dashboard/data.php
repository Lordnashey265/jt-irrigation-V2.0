<?php
//selecting user data
include '../php/connect.php';
include '../php/core.php';
$user = $_SESSION['user_id'];

$query="SELECT `voltage`,`temperature`,`humidity`,`moisture` FROM `jt_data` WHERE `id`=1";
if($run=mysqli_query($conn,$query)){
    list($voltage,$temperature,$humidity,$moisture)=mysqli_fetch_array($run);
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

$query1 = "SELECT `firstname`,`surname` FROM `users` WHERE `uid`='$user'";
if ($run = mysqli_query($conn, $query1)) {
  list($first_name, $last_name) = mysqli_fetch_array($run);
} else {
  die(mysqli_error($conn));
}

?>
<!DOCTYPE html>
<html lang="zxx">


<!-- Added by Nashey--><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by Nashey -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>JT Home</title>

    <link rel="icon" href="../img/jt-logo.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- themefy CSS -->
    <link rel="stylesheet" href="vendors/themefy_icon/themify-icons.css" />
    <!-- select2 CSS -->
    <link rel="stylesheet" href="vendors/niceselect/css/nice-select.css" />
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="vendors/owl_carousel/css/owl.carousel.css" />
    <!-- gijgo css -->
    <link rel="stylesheet" href="vendors/gijgo/gijgo.min.css" />
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="vendors/font_awesome/css/all.min.css" />
    <link rel="stylesheet" href="vendors/tagsinput/tagsinput.css" />

    <!-- date picker -->
     <link rel="stylesheet" href="vendors/datepicker/date-picker.css" />

     <link rel="stylesheet" href="vendors/vectormap-home/vectormap-2.0.2.css" />
     
     <!-- scrollabe  -->
     <link rel="stylesheet" href="vendors/scroll/scrollable.css" />
    <!-- datatable CSS -->
    <link rel="stylesheet" href="vendors/datatable/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="vendors/datatable/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="vendors/datatable/css/buttons.dataTables.min.css" />
    <!-- text editor css -->
    <link rel="stylesheet" href="vendors/text_editor/summernote-bs4.css" />
    <!-- morris css -->
    <link rel="stylesheet" href="vendors/morris/morris.css">
    <!-- metarial icon css -->
    <link rel="stylesheet" href="vendors/material_icon/material-icons.css" />

    <!-- menu css  -->
    <link rel="stylesheet" href="css/metisMenu.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/colors/default.css" id="colorSkinCSS">
    <link rel="stylesheet" href="../css/style.css">
    

</head>
<body>

<!-- Begin Page Content -->
<div class="container-fluid">

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
                            <img src="../icons/voltage.png" alt="Voltage">
                        </div>
                        <div class="row ml-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $voltage;?> volts</div>
                        </div>
                    </div>
                    <!-- In % -->
                    <div class="col" style="float:right;">
                        <div class="row ml-2 mb-4">
                            <img src="../icons/<?php echo status(($voltage/9)*100);?>" alt="Voltage1">
                        </div>
                        <div class="row ml-4">
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo round(($voltage/9)*100,2);?>%</div>
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
                            <img src="../icons/voltage.png" alt="Voltage">
                        </div>
                        <div class="row ml-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $voltage;?> volts</div>
                        </div>
                    </div>
                    <!-- In % -->
                    <div class="col" style="float:right;">
                        <div class="row ml-2 mb-4">
                            <img src="../icons/<?php echo status(($voltage/13.7)*100);?>" alt="Voltage2">
                        </div>
                        <div class="row ml-4">
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo round(($voltage/13.7)*100,2);?>%</div>
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
                    <div class="col-sm-8 col-8">
                        <div class="row water align-items-center">
                            <div class="col-sm-8 col-8">
                                <div class="row mb-4">
                                    <img src="../icons/water.png" alt="Water">
                                </div>
                            </div>
                            <!-- In % -->
                            <div class="col-sm-3 col-4">
                                <div class="row">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo round((( ($voltage/13.7) + ($voltage/13.7) ))*100,2);?>%</div>
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

    <!-- soil moisture  -->
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
                        <img src="../icons/meter.png" alt="Temperature">
                    </div>
                    <div class="col ml-4 mt-4">
                        <div class="lead font-weight-bold"><?php echo $moisture;?>%</div>
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
                        <img src="../icons/thermometer.png" alt="Temperature">
                    </div>
                    <div class="col ml-4 mt-4">
                        <div class="lead font-weight-bold"><?php echo $temperature;?> &deg;C</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- humidity  -->
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
                        <img src="../icons/humidity.png" alt="Light">
                    </div>
                    <div class="col ml-4 mt-4">
                        <div class="lead font-weight-bold"><?php echo $humidity;?>%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row 3-->
<div class="row">
    <!-- soil moisture modified   -->
    <div class="col-lg-4 col-md-4 image">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary">Soil Moisture 2 </h5>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <div class="col ml-2">
                        <img src="../icons/ldr.png" alt="Temperature">
                    </div>
                    <div class="col ml-4 mt-4">
                        <div class="lead font-weight-bold"> 25.35%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Temperature  modified -->
    <div class="col-lg-4 col-md-4 image">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary">Temperature 2 </h5>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <div class="col ml-2">
                        <img src="../img/thermometer2.png" alt="Temperature">
                    </div>
                    <div class="col ml-4 mt-4">
                        <div class="lead font-weight-bold">32 &deg;C</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- humidity  modified -->
    <div class="col-lg-4 col-md-4 image">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary">Humidity 2</h5>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <div class="col ml-2">
                        <img src="../img/humidity2.png" alt="Light">
                    </div>
                    <div class="col ml-4 mt-4">
                        <div class="lead font-weight-bold">66%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</section>
<!-- main content part end -->

<!-- footer  -->
<script src="js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="js/popper.min.js"></script>
<!-- bootstarp js -->
<script src="js/bootstrap.min.js"></script>
<!-- sidebar menu  -->
<script src="js/metisMenu.js"></script>
<!-- waypoints js -->
<script src="vendors/count_up/jquery.waypoints.min.js"></script>
<!-- waypoints js -->
<script src="vendors/chartlist/Chart.min.js"></script>
<!-- counterup js -->
<script src="vendors/count_up/jquery.counterup.min.js"></script>

<!-- nice select -->
<script src="vendors/niceselect/js/jquery.nice-select.min.js"></script>
<!-- owl carousel -->
<script src="vendors/owl_carousel/js/owl.carousel.min.js"></script>

<!-- responsive table -->
<script src="vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="vendors/datatable/js/dataTables.responsive.min.js"></script>
<script src="vendors/datatable/js/dataTables.buttons.min.js"></script>
<script src="vendors/datatable/js/buttons.flash.min.js"></script>
<script src="vendors/datatable/js/jszip.min.js"></script>
<script src="vendors/datatable/js/pdfmake.min.js"></script>
<script src="vendors/datatable/js/vfs_fonts.js"></script>
<script src="vendors/datatable/js/buttons.html5.min.js"></script>
<script src="vendors/datatable/js/buttons.print.min.js"></script>

<!-- datepicker  -->
<script src="vendors/datepicker/datepicker.js"></script>
<script src="vendors/datepicker/datepicker.en.js"></script>
<script src="vendors/datepicker/datepicker.custom.js"></script>

<script src="js/chart.min.js"></script>
<script src="vendors/chartjs/roundedBar.min.js"></script>

<!-- progressbar js -->
<script src="vendors/progressbar/jquery.barfiller.js"></script>
<!-- tag input -->
<script src="vendors/tagsinput/tagsinput.js"></script>
<!-- text editor js -->
<script src="vendors/text_editor/summernote-bs4.js"></script>





<script src="js/custom.js"></script>
</body>


</html>
