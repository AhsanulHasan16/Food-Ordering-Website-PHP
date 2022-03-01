<?php
	
	include('Reusables/menu.php');

?>

<div class="main-content">
	<div class="wrapper">
		
		<h1>Add Category</h1>

		<br><br><br>

		<?php 												// This php section is used to display the failed to add message. As always!

			if(isset($_SESSION['add'])){
				
				echo $_SESSION['add'];
				unset($_SESSION['add']);

			}

			if(isset($_SESSION['upload'])){				// And also to display the failed to upload image message. 
				
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);

			}

		?>

		<br><br>

		<form action="" method="POST" enctype="multipart/form-data">		<!-- This entype is used so that we can upload the image -->
			
			<table class="tbl-30">
				
				<tr>
					<td>Title: </td>
					<td>
						<input type="text" name="title" placeholder="Category Title">
					</td>
				</tr>

				<tr>
					<td>Select Image: </td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>

				<tr>
					<td>Featured: </td>
					<td>
						<input type="radio" name="featured" value="yes"> Yes
						<input type="radio" name="featured" value="no"> No
					</td>
				</tr>

				<tr>
					<td>Active: </td>
					<td>
						<input type="radio" name="active" value="yes"> Yes
						<input type="radio" name="active" value="no"> No
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Category" class="btn-secondary">
					</td>
				</tr>

			</table>

		</form>


		<?php

			if(isset($_POST['submit'])){

				// If the submit button is pressed then we get the values from the form. 

				$title = $_POST['title'];

				// For radio type input, need to check whether the button is selected or not. 

				if(isset($_POST['featured'])){
					$featured = $_POST['featured'];
				} else {					

					// If not selected then we put the default value of No. 

					$featured = "No";
				}

				// Same for the other radio type input active. 

				if(isset($_POST['active'])){

					$active = $_POST['active'];

				} else {

					$active = "No";

				}

				// Let's check whether an image was uploaded or not. 

				//print_r($_FILES['image']);	 // Just checking if image or file was selected. print_r can display array info echo can't.
				//die(); 		// Breaking the code here 


				if(isset($_FILES['image']['name'])){			// The image also has a name property/value, so ['image']['name']. 
					// Upload the image

					// To upload image we need image name, source path and destination path. 

					$image_name = $_FILES['image']['name'];

					// Upload the image only if the image is selected. 
					// Image name not null means that an image was selected. [Bug fixing part! Wouldn't add category without image]
					
					if($image_name != ""){


						// If the image name is same then the image in images/category will be replaced. 
						// Need to do something about it.
						// Auto rename the image.
						// Get the extention of our image. (.jpg .png etc)
						// Seperate image name by . example food.jpg. 

						$ext = end(explode('.', $image_name));		// Extention is at the very last of the name so used end. 

						// Renaming the image with random function. 

						$image_name = "Food_Category_".rand(000, 999).'.'.$ext;		// e.g. "Food_Category_420.jpg"
						// Will add datetime later with the name so that the name will be unique forever. 

						$source = $_FILES['image']['tmp_name'];   	// tmp_name of the image has the source path value.

						$destination = "../images/category/".$image_name;  	// Concatanating image_name in the category folder of the images.

						$upload = move_uploaded_file($source, $destination);	 // Uploading the image using this.  

						// Checking whether the image is uploaded.
						// If image not uploaded then stop the process and redirect with the error message. 

						if($upload == false){

							$_SESSION['upload'] = "<div class = 'error'> Failed To Upload Image! </div>";
							header('location:'.HOMEURL.'admin/add-category.php');
							// Stopping the process. We don't want to insert the data to the database if the image ain't uploaded.
							die();
						}
					}

				} else {

					// Don't upload the image and set image name to blank.
					$image_name = "";
				}

				// Sql query to insert the data into database.

				$sql = "INSERT INTO tbl_category SET
					title = '$title',
					image_name = '$image_name',
					featured = '$featured',
					active = '$active'
				";

				// Executing the query to save in the database. 

				$res = mysqli_query($conn, $sql);

				if($res == true){
					$_SESSION['add'] = "<div class = 'success'>Successfully Added New Category!</div>";
					header("location:".HOMEURL.'admin/category-management.php');
				} else {
					$_SESSION['add'] = "<div class = 'error'>Failed To Add New Category!</div>";
					header("location:".HOMEURL.'admin/add-category.php');
				}
			}

		?>
	</div>
	
</div>






<?php
	
	include('Reusables/footer.php');

?>