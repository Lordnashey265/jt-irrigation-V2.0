<?php session_start();include './php/connect.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>JT Irrigation-Reset-Credentials</title>
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
	//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	//Include required phpMailer files
	require 'PHPMailer/PHPMailer.php';
	require 'PHPMailer/SMTP.php';
	require 'PHPMailer/Exception.php';
	
	if(isset($_POST['email']))
	{
		$to=mysqli_real_escape_string($conn,htmlentities($_POST['email']));
		$query="SELECT * FROM `users` WHERE `email`='$to'";
		if($query_run=mysqli_query($conn,$query))
		{
			if(mysqli_num_rows($query_run)==0)
			{
				?>
				<script type="text/javascript">
					document.addEventListener("DOMContentLoaded",function(event){
						swal("ERROR","Email Is Not registered","error");
					})
				</script>
				<?php
			}
			else if(mysqli_num_rows($query_run)>0)
			{
				while($row=mysqli_fetch_array($query_run))
				{
					
					$email=$to;
					$subject="JT Reset Login Credentials";
					$firstname=$row['firstname'];
					$surname=$row['surname'];
					$username=$row['username'];

                    $pm ="
                        <!DOCTYPE html>
                        <html lang=\"en\">
                        <head>
                            <meta charset=\"UTF-8\">
                            <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
                            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                        </head>
                        <body>
                            <div style=\"box-shadow:0 0 5px 1px rgba(0,0,0,0.3);\">
                                <div style=\"background-color:#10d120;color:#fff;text-align:center;font-size:18px;padding:8px;font-weight:bold;font-family:arial;\">
                                    <div class=\"text-center bg-dark text-white\">JT Irrigation Password Reset Request</div>
                                </div>
                                <h2>Dear $firstname $surname,</h2>
                                <p>We have received a request to reset the password for your JT-Irrigation account</p>
								<p>If you made this request, click the button below. If you didn't make the request, you can ignore this email
                                <ul>
                                    <li><b>Username:</b> $username</li>
                                </ul>
                                <p>Please click the button to activate your account.</p>
                                <center>
                                    <a style=\"text-decoration:none;color:#fff;text-align:center;padding:10px 15px;border-radius:15px;background-color:#10d120;\" href=\"https://localhost/jt-irrigation/reset-password.php?email=$email&user=$username\" target=\"_blank\">Reset Password</a>
                                </center>
                                <br><br>
                                <center>
                                    <div class=\"padding:5px;text-align:center;background-color:#10d120;\">
                                            JT Irrigation &copy; ".date('Y')."
                                    </div>
                                </center>
                            </div>
                        </body>
                        </html>
                        ";
				
					//Create instance of phpMailer
					$mail= new PHPMailer();

					//Enable verbose debug output
					//$mail->SMTPDebug = SMTP::DEBUG_SERVER; 

					//set mailer to use smtp
					$mail->isSMTP();
					//define smtp host
					$mail->Host= "smtp.gmail.com";
					//enable smtp authentification
					$mail->SMTPAuth="true";
					//set type of encryption (ssl/tls)	
					//TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
					$mail->SMTPSecure=PHPMailer::ENCRYPTION_STARTTLS;  
					//set port to connect smtp
					$mail->Port="587"; //465 for ssl
					//set gmail username
					$mail->Username="beatonndaba@gmail.com";
					//set gmail password
					$mail->Password="tsxngatucbssjwbm";

					//Set email format to HTML
					$mail->isHTML(true);
					//set email subject
					$mail->Subject=$subject;
					//set sender email
					$mail->setFrom('beatonndaba@gmail.com', "JT IRRIGATION RESET");
					//reply to
					// $mail->addReplyTo('owenmwenye90@gmail.com', 'KB WEAR');
					//Email body
					$mail->Body=$pm;
					//Add recipient
					$mail->addAddress($to);
					//Finally send email
					if($mail->Send())
					{
						?>
						<script type="text/javascript">
							document.addEventListener("DOMContentLoaded",function(event){
								swal("SUCCESS","Reset Was Link Sent Successfully. Check Your Email","success");
							})
						</script>
						<?php
					}
					else
					{
						?>
						<script type="text/javascript">
							document.addEventListener("DOMContentLoaded",function(event){
								swal("ERROR","<?php echo 'Message could not be sent. Mailer Error: {'.$mail->ErrorInfo.'}';?>","error");
							})
						</script>
						<?php
					}

					//Closing  smtp connection
					$mail->smtpClose();
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

				<form class="login100-form validate-form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
					
					<div class="login101-pic js-tilt" data-tilt>
						<center><img src="./img/jt-irrigation.png" alt="LOGO"></center>
					</div>
					
					<span class="login100-form-title">
						Recover Credentials
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="email" placeholder="Enter registered Email" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Reset
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