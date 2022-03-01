<?php 

	include('Reusables/menu.php')

?>


<div class = "main-content"> 
	<div class = "wrapper">
		<h1>Update Category</h1>

		<br><br>

		<?php

			// Check if the id is set or not. 

			if(isset($_GET['id'])){

				// Get the id and all the details.

				$id = $_GET['id'];

				$sql = "SELECT * FROM tbl_category WHERE id = $id";

				$res = mysqli_query($conn, $sql);

				$count = mysqli_num_rows($res);		// Count the rows to check if the id is valid or not. 

				if($count == 1){

					// Id valid so getting all the data. 
					$row = mysqli_fetch_assoc($res);
					$title = $row['title'];
					$current_image = $row['image_name'];
					$featured = $row['featured'];
					$active = $row['active'];
					

				} else {

					// Redirect to manage category with error message. 

					$_SESSION['category-id-invalid'] = "<div class = 'error'>Category Not Found! </div>";
					header('location:'.HOMEURL.'admin/category-management.php');
				}

			} else {

				// Redirect to manage category. 
				header('location:'.HOMEURL.'admin/category-management.php');
			}

		?>


		<form action="" method="POST" enctype="multipart/form-data">			<!-- enctype needed to upload image -->
			<table class="tbl-30">
				<tr>
					<td>Title: </td>
					<td>
						<input type="text" name="title" value="<?php echo $title; ?>">
					</td>
				</tr>

				<tr>
					<td>Current Image: </td>
					<td>
						<?php

							if($current_image != ""){

								//Display the image. 
								?>
								<img src="<?php echo HOMEURL; ?>images/category/<?php echo $current_image; ?>" width = "160px">

								<?php

							} else {

								echo "<div class = 'error'> No Image Was Added! </div>";
							}

						?>

					</td>
				</tr>

				<tr>
					<td>New Image: </td>
					<td>
						<input type="file" name="image" value="">
					</td>
				</tr>

				<tr>
					<td>Featured: </td>
					<td>
						<input <?php if($featured == "Yes"){echo "checked"; } ?> type="radio" name="featured" value="Yes"> Yes

						<input <?php if($featured == "no"){echo "checked"; } ?> type="radio" name="featured" value="No"> No
					</td>
				</tr>

				<tr>
					<td>Active: </td>
					<td>
						<input <?php if($active == "Yes"){echo "checked"; } ?> type="radio" name="active" value="Yes"> Yes

						<input <?php if($active == "no"){echo "checked"; } ?> type="radio" name="active" value="No"> No
					</td>
				</tr>	

				<tr>
					<td>
						<!-- Passing the id and current image hidden when submit is pressed! -->

						<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="submit" name="submit" value="Update Category" class="btn-secondary"> 
					</td>
				</tr>
		
			</table>
	
		</form>

		<?php

			if(isset($_POST['submit'])){
				// If the submit button was pressed or not. 
				// Getting all the values from the form. 

				$id = $_POST['id'];
				$title = $_POST['title'];
				$current_image = $_POST['current_image'];
				$featured = $_POST['featured'];
				$active = $_POST['active'];

				// Updating new image if any was selected!

				// First check whether an image is selected or not. 

				if(isset($_FILES['image']['name'])){

					$image_name = $_FILES['image']['name'];

					if($image_name != ""){

						// Image available and ready to upload. 
						// 1. Upload the new image. 


						// [THIS PART IS TAKEN FROM ADD CATEGORY.]
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
							header('location:'.HOMEURL.'admin/category-management.php');
							// Stopping the process. We don't want to insert the data to the database if the image ain't uploaded.
							die();
						}


						// 2. Also have to remove the current image if it is available. 
						if($current_image != ""){

							$remove_path = "../images/category/".$current_image;

							$remove = unlink($remove_path);

							// Checking whether the image was removed or not. 
							if($remove == false){

								// Failed to remove image. 
								$_SESSION['failed-to-remove'] = "<div class = 'error'> Failed To Remove The Current Image! </div>";
								header('location:'.HOMEURL.'admin/category-management.php');
								die(); 	  // Stopping the process. 
							}

						}

						

					} else {

						$image_name = $current_image;

					}

				} else {

					$image_name = $current_image;
				}



				// Update these in the database. 

				$sql2 = "UPDATE tbl_category SET 
					title = '$title',
					image_name = '$image_name',
					featured = '$featured',
					active = '$active'
					WHERE id = $id
				";

				// Executing the query. 

				$res2 = mysqli_query($conn, $sql2);

				// Check whether res2 executed properly or not. 

				if($res2 == true){

					$_SESSION['update'] = "<div class = 'success'> Category Updated Successfully! </div>";
					header('location:'.HOMEURL.'admin/category-management.php');

				} else {

					$_SESSION['update'] = "<div class = 'error'> Failed To Update Category! </div>";
					header('location:'.HOMEURL.'admin/category-management.php');

				}



			}

		?>
	

	</div>
</div>

<?php 

	include('Reusables/footer.php')

?>