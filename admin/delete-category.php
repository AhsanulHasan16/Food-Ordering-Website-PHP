<?php
	
	include('../config/constants.php');		// Will need constants for redirecting later. 

	// Checking whether id and image_name is set or not. 

	if(isset($_GET['id']) AND isset($_GET['image_name'])){

		// Get the value and delete.
		$id = $_GET['id'];
		$image_name = $_GET['image_name'];

		if($image_name != ""){

			// Meaning image is available for delete. 
			$path = "..//images/category/".$image_name;

			$delete_image = unlink($path);			// Deleting the image with unlink. 

			// If deletion of image failed then display error message and stop the process. 

			if($delete_image == false){

				$_SESSION['delete_image'] = "<div class = 'error'> Failed To Delete Category Image! </div>";

				// Redirecting after the error message.
				header('location:'.HOMEURL.'admin/category-management.php');

				// Stopping the process. 
				die(); 
			}
		}

		$sql = "DELETE FROM tbl_category WHERE id = '$id'";		// SQL Query to delete data from database. 

		$res = mysqli_query($conn, $sql);		// Executing the query. 

		if($res == true){

			// Set success message and redirect.
			$_SESSION['delete_category'] = "<div class='success'>Successfully Deleted The Category!</div>";

			header('location:'.HOMEURL.'admin/category-management.php');

		} else {

			// Set error message and redirect. 
			$_SESSION['delete_category'] = "<div class='error'> Failed To Delete Category!</div>";

			header('location:'.HOMEURL.'admin/category-management.php');

		}

	} else {

		// Redirect to Manage Category page. 
		header('location:'.HOMEURL.'admin/category-management.php');

	}

?>