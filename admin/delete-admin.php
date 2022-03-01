<?php
	
	include('../config/constants.php');       // Need to include constants for $conn. 

	// Getting the id of the admin to be deleted. 
	$id = $_GET['id'];    // admin-management line 61. Passing value through url is get method. $id is a get variable. 

	$sql = "DELETE FROM tbl_admin WHERE id = $id";    // Sql query to delete the admin from the table.

	$res = mysqli_query($conn, $sql);       // As always this line is needed for executing the query.  

	if($res == true){
		//echo "Admin Deleted Successfully!";

		$_SESSION['delete'] = "<div class = 'success'>Admin Deleted Successfully!</div>";
		header('location:' .HOMEURL. 'admin/admin-management.php');

	} else {
		//echo "Failed to Delete Admin!";

		$_SESSION['delete'] = "<div class = 'error'>Failed to Delete Admin!</div>";
		header('location:' .HOMEURL. 'admin/admin-management.php');

	}
?>