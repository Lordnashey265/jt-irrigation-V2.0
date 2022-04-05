<?php session_start();include './php/connect.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>JT IOT IRRIGATION-Login</title>
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
	if(isset($_POST['username'],$_POST['password']))
	{
		$username=mysqli_real_escape_string($conn,htmlentities($_POST['username']));
		$password=mysqli_real_escape_string($conn,htmlentities($_POST['password']));
		//ecnrypting the password to md5
		$pword_hash=md5($password);
		//query to check if username is available in the DB
		$query="SELECT `password`,`uid` FROM `users` WHERE `username`='$username'";
		//if query runs successfully
		if($query_run=mysqli_query($conn,$query))
		{
			//if username is not available
			if(mysqli_num_rows($query_run)==0)
			{
				?>
				<script type="text/javascript">
					document.addEventListener("DOMContentLoaded",function(event){
						swal("ERROR","Incorrect Username","error");
					})
				</script>
				<?php
			}
			//if username is found
			else if(mysqli_num_rows($query_run)>0)
			{
				while($row=mysqli_fetch_array($query_run))
				{
					$db_username=$row['password'];
					$db_password=$row['password'];
					/*if encrypted password written by the user corresponds to the encrypted password found in the DB
					  of the available username
					*/
					if($pword_hash==$db_password)
					{
						//creating a session "user_id"
						$_SESSION['user_id']=$row['uid'];
						?>
						<script type="text/javascript">
							document.addEventListener("DOMContentLoaded",function(event){
								swal("LOGIN SUCCESS","Redirecting...","success");
								setTimeout(function(){window.location='dashboard/home'},2000);
							});
						</script>
						<?php
					}
					else
					{
						?>
						<script type="text/javascript">
							document.addEventListener("DOMContentLoaded",function(event){
								swal("ERROR","Incorrect Password","error");
							});
						</script>
						<?php
					}
				}
			}
		}
		else
		{
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

				<form class="login100-form validate-form" action="login.php" method="POST">
					
					<div class="login101-pic js-tilt" data-tilt>
						<center><img src="./img/jt-irrigation.png" alt="LOGO"></center>
					</div>
					
					<span class="login100-form-title">
						JT Irrigation  Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="username" placeholder="Username" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="reset-credentials">
							Username / Password?
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