<?php
include 'connect.php';

	$voltage=$_GET["voltage"];
	$temperature=$_GET["temperature"];
	$humidity=$_GET["humidity"];
	$moisture=$_GET["moisture"];

	$time=date('h:i:s',time());
	$query="UPDATE `jt_data` SET `voltage`='$voltage',`temperature`='$temperature',`humidity`='$humidity', `moisture`='$moisture' WHERE `id`=1";
	$query2="INSERT INTO `jt_temp`(`data`,`stamp`) VALUES('$temperature','$time')";
	$query3="INSERT INTO `jt_hum`(`data`,`stamp`) VALUES('$humidity','$time')";
	$query4="INSERT INTO `jt_moisture`(`data`,`stamp`) VALUES('$moisture','$time')";
	if(mysqli_query($conn,$query)) {
		if(mysqli_query($conn,$query2)) {
			if(mysqli_query($conn,$query3)){
				if(mysqli_query($conn,$query4)){
					echo 'data was sent successfully';
				} else {
					die(mysqli_error($conn));
				}
			} else {
				die(mysqli_error($conn));
			}
		} else {
			die(mysqli_error($conn));
		}
	} else {
		die(mysqli_error($conn));
	}

?>