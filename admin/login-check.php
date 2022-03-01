<?php
	
	// This is the authorization part. 
	// Checking whether the user is logged in or not. 

	if(!isset($_SESSION['user'])){								// If the user session is not set. Meaning login was not successful.

		$_SESSION['not_loggedin_message'] = "<div class = 'error text-center'>Please Log In To Access Admin Panel!</div>";
		
		header('location:'.HOMEURL.'admin/login.php');				// Redirecting to login page after displaying the not logged in message.
	
	}


?>