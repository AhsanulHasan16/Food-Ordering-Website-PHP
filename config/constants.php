<?php
	
	// Starting session (need it for inserted message!) Wellllll, now we need it for a lot of things!!!

	session_start();
	// Creating constants to store non repeating values. 
	
	define('HOMEURL', 'http://localhost/order_food/');  	// Need it for redirection after the inserted message. 
	define('LOCALHOST', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'order_food');


	//now will be executing query and save into the DB.

	$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());  // connecting to the DB.
	$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());   // selecting DB. 


?>