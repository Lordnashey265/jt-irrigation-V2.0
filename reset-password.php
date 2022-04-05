<?php 
    session_start();include './php/connect.php';

    if(isset($_GET['email'],$_GET['user'])){
        $email=$_GET['email'];
        $user=$_GET['user'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>JT Irrigation-Reset-Password</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" href="./img/jt-logo.ico">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./css/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="./css/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./css/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./css/util.css">
	<link rel="stylesheet" type="text/css" href="./css/login.css">
<!--===============================================================================================-->
	<script type="text/javascript" src="js/all.min.js"></script>
<!--===============================================================================================-->
</head>
<body>
    <?php
    if(isset($_POST['submit'])){
        $password=$_POST['password'];
        $hashed=md5($password);
        $user=$_POST['user'];
        $email=$_POST['email'];
        
        $query="UPDATE `users` SET `password`='$hashed' WHERE `email`='$email' AND `username`='$user'";
        if(mysqli_query($conn,$query)){
            ?>
            <script type="text/javascript">
                document.addEventListener("DOMContentLoaded",function(event){
                    swal("SUCCESS","Password was successfully updated","success");
                })
            </script>
            <?php
        } else {
            die(mysqli_error($conn));
        }
    }
    ?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="./img/jt-irrigation.png" alt="LOGO">
				</div>

				<form class="login100-form validate-form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
					
					<div class="login101-pic js-tilt" data-tilt>
						<center><img src="./img/jt-irrigation.png" alt="LOGO"></center>
					</div>
					
					<span class="login100-form-title">
						Recover Password
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="password" name="password" placeholder="Enter New Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<input type="hidden" name="email" value="<?php echo $email;?>">
					<input type="hidden" name="user" value="<?php echo $user;?>">

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="submit">
							Update
						</button>
					</div>

                    <div class="text-center p-t-12">
						<span class="txt1">
							Back
						</span>
						<a class="txt2" href="login">
							Login
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="./js/jquery-1.12.4.min.js"></script>
<!--===============================================================================================-->
	<script src="./js/popper.js"></script>
<!--===============================================================================================-->
	<script src="./js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="./js/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="./js/sweetalert.min.js"></script>
<!--===============================================================================================-->
	<script src="./js/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->


</body>
</html>