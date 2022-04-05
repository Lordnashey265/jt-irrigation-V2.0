<?php
if(!isset($_SESSION))
{
	session_start();
}
function loggedin()
{
	if(isset($_SESSION['user_id']))
	{
		if(!empty($_SESSION['user_id']))
		{	
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>