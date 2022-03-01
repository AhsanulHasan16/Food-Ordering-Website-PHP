<?php
	

	// Need to include the config file. 
	include('../config/constants.php');

	//echo "This is for deleting food items!";

	// Checking if we got the id and the image_name. 
	if(isset($_GET['id']) && isset($_GET['image_name'])){

		// Deletion begins. 
		
		$id = $_GET['id'];
		$image_name = $_GET['image_name'];				// First getting the id and the image name.

		// Checking whether the image is available or not. 
		if($image_name != ""){

			$path = "../images/food/".$image_name;		// Getting the path of the image to delete.

			$remove = unlink($path); 		// Removing image from the folder. 

			if($remove == false){

				// Failed to remove image. So displaying error message. redirecting and stopping the process. 

				$_SESSION['upload'] = "<div class = 'error'> Failed To Delete Image! </div>";
				header('location:'.HOMEURL.'admin/food-management.php');
				die();
			}  
		}

		// Sql query to delete food from database. 

		$sql = "DELETE FROM tbl_food WHERE id = $id";

		$res = mysqli_query($conn, $sql);			// Executing the query. 

		if($res == true){

			// Food deleted!
			$_SESSION['delete'] = "<div class = 'success'> Food Item Deleted Successfully!</div>";
			header('location:'.HOMEURL.'admin/food-management.php');

		} else {

			// Failed to delete!
			$_SESSION['delete'] = "<div class = 'error'> Failed To Delete The Food Item!</div>";
			header('location:'.HOMEURL.'admin/food-management.php');

		}


	} else {

		// Redirection to management page. 
		
		$_SESSION['invalid'] = "<div class = 'error'> Please Choose Appropriate Items!</div>";
		header('location:'.HOMEURL.'admin/food-management.php');


	}

?>