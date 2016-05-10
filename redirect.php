<?php
session_start();
	if (!isset($_SESSION))
	{
		$_SESSION = $_POST['userEmail'];
	}
	else
	{
		print_r($_SESSION);
	}
?>
	
