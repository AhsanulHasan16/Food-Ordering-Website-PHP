<?php
	
	// In logout, we just need to destroy the session and redirect to the login page. 
	
	include('../config/constants.php');										// Need to include constants to use HOMEURL. 

	session_destroy();														// Destroying the current session. 

	header('location:'.HOMEURL.'admin/login.php'); 							// Redirecting to the login page. 

?>