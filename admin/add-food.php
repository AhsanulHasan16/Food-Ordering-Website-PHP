<?php
	
	include('Reusables/menu.php');

?>

<div class="main-content">
	<div class="wrapper">
		
		<h1>Add Food Items</h1>

		<br><br><br>

		<?php

			if(isset($_SESSION['upload-food-image'])){			// Displaying the error message of failing to upload the image. 

				echo $_SESSION['upload-food-image'];
				unset($_SESSION['upload-food-image']);
			}

		?>

		<form action="" method="POST" enctype="multipart/form-data">

			<table class="tbl-30">
				
				<tr>
					<td>Title: </td>
					<td>
						<input type="text" name="title" placeholder="Enter Title Of The Food">
					</td>

				</tr>

				<tr>
					<td>Description: </td>
					<td>
						<textarea name="description" cols="30" rows="5" placeholder="Descibe The Food"></textarea>
					</td>
					
				</tr>

				<tr>
					<td>Price: </td>
					<td>
						<input type="number" name="price">
					</td>

				</tr>

				<tr>
					<td>Select Image: </td>
					<td>
						<input type="file" name="image">
					</td>

				</tr>

				<tr>
					<td>Category: </td>
					<td>
						<select name="category">

							<?php

								// This PHP code section will display categories from the database.
								// Create SQL query to get all the active categories from the database.
								$sql = "SELECT * FROM tbl_category WHERE active='Yes'";

								// Executing the sql query. 
								$res = mysqli_query($conn, $sql);
								// Counting rows to check whether we have categories or not.
								$count = mysqli_num_rows($res);

								if($count > 0){

									// We have categories.
									while($row = mysqli_fetch_assoc($res)){

										$id = $row['id'];				// Getting details from the database. 
										$title = $row['title'];

										?>

										<option value="<?php echo $id; ?>"><?php echo $title; ?></option>

										<?php
									}

								} else {

									// We do not have categories. 
									?>

									<option value="0">No Category Found!</option>

									<?php
								}

							?>
						
						</select>
					</td>

				</tr>

				<tr>
					<td>Featured: </td>
					<td>
						<input type="radio" name="featured" value="Yes"> Yes
						<input type="radio" name="featured" value="No"> No
					</td>

				</tr>

				<tr>
					<td>Active: </td>
					<td>
						<input type="radio" name="active" value="Yes"> Yes
						<input type="radio" name="active" value="No"> No
					</td>

				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Food" class="btn-secondary">
					</td>
				</tr>



			</table>
			

		</form>


		<?php

			// Checking if the submit button was clicked or not.

			if(isset($_POST['submit'])){

				// Add this data in the database. 
				// Getting data from the form.

				$title = $_POST['title'];
				$description = $_POST['description'];
				$price = $_POST['price'];
				$category = $_POST['category'];

				// Check whether button for featured and active checked or not.
				if(isset($_POST['featured'])){

					$featured = $_POST['featured']; 

				} else {

					$featured = "No"; 		// Set default value to No if button not checked. 

				}

				if(isset($_POST['active'])){

					$active = $_POST['active']; 

				} else {

					$active = "No"; 		// Set default value to No if button not checked. 
					
				}

				// Now time to upload the image if any was selected. 

				if(isset($_FILES['image']['name'])){

					$image_name = $_FILES['image']['name'];

					// Now to check if the image was selected or not. 
					if($image_name != ""){

						// Image is selected. 

						$ext = end(explode('.', $image_name));		// Getting extension of the image. 

						// Renaming the food item randomly. 

						$image_name = "Food-Name-".rand(0000,9999).".".$ext;

						// Now to upload the image. 

						$src = $_FILES['image']['tmp_name'];		// Source path of the selected image. 

						$dest = "../images/food/".$image_name;		// Destination path of the uploaded image. 

						$upload = move_uploaded_file($src, $dest);		// Uploading the image at last.

						// Checking whether image is uploaded or not. 

						if($upload == false){

							// Failed to upload image. 
							$_SESSION['upload-food-image'] = "<div class = 'error'> Failed To Upload Image! </div>";
							header('location:'.HOMEURL.'admin/add-food.php');
							die(); 		// Stopping the process as always. 
						} 

					}

				} else {

					$image_name = "";		// Setting default value of nothing. 
				
				}

				// SQL query to save or add food in the database. 

				$sql2 = "INSERT INTO tbl_food SET
					title = '$title',
					description = '$description',
					price = $price,					
					image_name = '$image_name',
					category_id = $category, 
					featured = '$featured',
					active = '$active'
				";							// For numerical values we don't need the '' quotes. Only needed for strings.


				// Executing the query. 
				
				$res2 = mysqli_query($conn, $sql2);


				// Checking whether data inserted or not. 
				if($res2 == true){

					// Data inserted successfully. 
					$_SESSION['add-food'] = "<div class = 'success'>Food Added Successfully! </div>";
					header('location:'.HOMEURL.'admin/food-management.php');

				} else {

					// Failed to insert data. 
					$_SESSION['add-food'] = "<div class = 'error'>Failed To Add Food Item! </div>";
					header('location:'.HOMEURL.'admin/food-management.php');

				}

			}

		?>




	</div>

</div>




<?php
	
	include('Reusables/footer.php');

?>
