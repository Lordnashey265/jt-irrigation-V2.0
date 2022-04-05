<?php
//selecting user data
include '../php/connect.php';
include '../php/core.php';

if(!loggedin()){
    header("location:../login");
}



$user = $_SESSION['user_id'];
$query1 = "SELECT `uid`,`firstname`,`surname`,`username`,`mobile`,`email`,`type` FROM `users` WHERE `uid`='$user'";
if ($run = mysqli_query($conn, $query1)) {
  list($uid, $first_name, $last_name, $username, $mobile, $email, $user_type) = mysqli_fetch_array($run);
} else {
  die(mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="zxx">


<!-- defining character set content type -->
<!-- Added by Nashey --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by Nashey -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>JT Settings</title>

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
    <!-- Sweet Alert JS -->
    <script src="../js/sweetalert.min.js"></script>
</head>
<body class="crm_body_bg">
    


<!-- main content part here -->
 
 <!-- sidebar  -->
<?php include './side-bar.php'; ?>
 <!--/ sidebar  -->

<section class="main_content dashboard_part large_header_bg">
        <!-- menu  -->
    <div class="container-fluid no-gutters">
        <div class="row">
            <div class="col-lg-12 p-0 ">
                <div class="header_iner d-flex justify-content-between align-items-center">
                    <div class="sidebar_icon d-lg-none">
                        <i class="ti-menu"></i>
                    </div>
                    <div class="line_icon open_miniSide d-none d-lg-block">
                        <img src="img/line_img.png" alt="">
                    </div>
                    <div class="serach_field-area d-flex align-items-center">
                        <div class="search_inner">
                            <form action="#">
                                <div class="search_field">
                                    <input type="text" placeholder="Search">
                                </div>
                                <button type="submit"> <img src="img/icon/icon_search.svg" alt=""> </button>
                            </form>
                        </div>
                    </div>
                    <!-- User Profile -->
                    <div class="header_right d-flex justify-content-between align-items-center">
                        <div class="profile_info">
                            <img src="img/client_img.png" alt="#">
                            <div class="profile_info_iner">
                                <div class="profile_author_name">
                                    <h5><?php echo "$first_name $last_name";?></h5>
                                </div>
                                <div class="profile_info_details">
                                    <a href="#">My Profile </a>
                                    <a href="settings.php">Settings</a>
                                    <a href="logout.php">Log Out </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ menu  -->
    <div class="main_content_iner overly_inner ">
        <div class="container-fluid p-0 ">
            <!-- page title  -->
            <div class="row">
                <div class="col-12">
                    <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                        <div class="page_title_left d-flex align-items-center">
                            <h3 class="f_s_25 f_w_700 dark_text mr_30" >Dashboard</h3>
                            <ol class="breadcrumb page_bradcam mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Settings</li>
                            </ol>
                        </div>
                        <div class="page_title_right">
                            <div class="page_date_button d-flex align-items-center"> 
                                <img src="img/icon/calender_icon.svg" alt="">
                                <?php echo date('F d, Y');?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Settings</h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <?php
                            if (isset($_POST['submit'])) {
                                $uname = mysqli_real_escape_string($conn, htmlentities($_POST['uname']));
                                $fname = mysqli_real_escape_string($conn, htmlentities($_POST['firstname']));
                                $sname = mysqli_real_escape_string($conn, htmlentities($_POST['surname']));
                                $user_mobile = mysqli_real_escape_string($conn, htmlentities($_POST['user_mobile']));
                                $user_email = mysqli_real_escape_string($conn, htmlentities($_POST['user_email']));
                                $password = mysqli_real_escape_string($conn, htmlentities($_POST['password']));
                                $password_hash = md5($password);

                                if (empty($password)) {
                                    //query
                                    $query2 = "UPDATE `users` SET `firstname`='$fname',`surname`='$sname',`username`='$uname', `email`='$email', `mobile`='$mobile' WHERE `uid`='$uid'";
                                    if ($run2 = mysqli_query($conn, $query2)) {
                                    ?>
                                        <script type="text/javascript">
                                            document.addEventListener("DOMContentLoaded", function(event) {
                                                swal("SUCCESS", "Details Were Successfully Updated", "success");
                                                setTimeout(function() {
                                                    window.location = 'settings.php'
                                                }, 2000);
                                            });
                                        </script>
                                        <?php
                                    } else {
                                        die(mysqli_error($conn));
                                    }
                                } else {
                                    //query
                                    $query2 = "UPDATE `users` SET `firstname`='$fname',`surname`='$sname',`username`='$uname', `email`='$email', `mobile`='$mobile', `password`='$password_hash' WHERE `uid`='$uid'";

                                    if ($run2 = mysqli_query($conn, $query2)) {
                                    ?>
                                        <script type="text/javascript">
                                            document.addEventListener("DOMContentLoaded", function(event) {
                                                swal("SUCCESS", "Settings Were Successfully Updated", "success");
                                                setTimeout(function() {
                                                    window.location = 'settings.php';
                                                }, 2000);
                                            });
                                        </script>
                                    <?php
                                    } else {
                                        die(mysqli_error($conn));
                                    }
                                }
                            }
                            ?>
                            <form class="row" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>" >
                                <div class="col-lg-6">
                                    <div class="common_input input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-light" type="button" id="button-addon1">Username</button>
                                        </div>
                                        <input type="text" class="form-control" name="uname" value="<?php echo $username;?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="common_input input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-light" type="button" id="button-addon1">Firstname</button>
                                        </div>
                                        <input type="text" class="form-control" name="firstname" value="<?php echo $first_name;?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="common_input input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-light" type="button" id="button-addon1">Surname</button>
                                        </div>
                                        <input type="text" class="form-control" name="surname" value="<?php echo $last_name;?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                     <div class="common_input input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-light" type="button" id="button-addon1">Email</button>
                                        </div>
                                        <input type="text" class="form-control" name="user_email" value="<?php echo $email;?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="common_input input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-light" type="button" id="button-addon1">Mobile</button>
                                        </div>
                                        <input type="text" class="form-control" name="user_mobile" value="<?php echo $mobile;?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="common_input input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-light" type="button" id="button-addon1">Password</button>
                                        </div>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="create_report_btn mt_30">
                                        <button class="btn_1 radius_btn d-block text-center" style="width:100%;" type="submit" name="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- footer part -->
<?php include './footer.php'; ?>

</section>
<!-- main content part end -->

<div id="back-top" style="display: none;">
    <a title="Go to Top" href="#">
        <i class="ti-angle-up"></i>
    </a>
</div>

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
