<!-- This Will Be The Very First File In This Project That Goes Upto 300 Lines! Yes, This Line Was Also Used For That Purpose! -->

<?php 

	include('Reusables/menu.php');

?>

<?php
	
	// Checking whether id is set or not. 
	if(isset($_GET['id'])){

		// Get the details. 
		$id = $_GET['id'];

		$sql2 = "SELECT * FROM tbl_food WHERE id = '$id'"; 		// Query to get the details of that id.

		// Execution of the query. 
		$res2 = mysqli_query($conn, $sql2);

		// Get the values based on the query executed.
		$rows2 = mysqli_fetch_assoc($res2);

		// Getting the individual values for the selected item. 
		$title = $rows2['title'];
		$description = $rows2['description'];
		$price = $rows2['price'];
		$current_image = $rows2['image_name'];
		$current_category = $rows2['category_id'];
		$featured = $rows2['featured'];
		$active = $rows2['active'];

	} else {

		// Redirection time. 
		header('location:'.HOMEURL.'admin/food-management.php');
	}
?>


<div class = "main-content"> 
	<div class = "wrapper">
		<h1>Update Food</h1>
		<br /> <br />

		<form action="" method="POST" enctype="multipart/form-data">
			
			<table class="tbl-30">
				
				<tr>
					<td>Title: </td>
					<td>
						<input type="text" name="title" value="<?php echo $title; ?>">
					</td>

				</tr>

				<tr>
					<td>Description: </td>
					<td>
						<textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
					</td>
					
				</tr>

				<tr>
					<td>Price: </td>
					<td>
						<input type="number" name="price"value="<?php echo $price; ?>">
					</td>

				</tr>

				<tr>
					<td>Current Image: </td>
					<td>
						<?php

							if($current_image == ""){

								// Image Not Available!
								echo "</div class = 'error'>No Image Available!</div>";

							} else {

								// Image Not Available!
								?>
								<img src="<?php echo HOMEURL; ?>images/food/<?php echo $current_image; ?>" width = "250px">
								<?php

							}
						?>
					</td>

				</tr>

				<tr>
					<td>Select New Image: </td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>

				<tr>
					<td>Category: </td>
					<td>
						<select name="category">

							<?php

								// First, let's get all the categories from the database. 
								// Query to get all the active categories.

								$sql = "SELECT * FROM tbl_category WHERE active='Yes'";

								// Executing the query.
								$res = mysqli_query($conn, $sql);

								// Counting rows as always. 
								$count = mysqli_num_rows($res);

								if($count > 0){

									// Category available. 
									while($rows = mysqli_fetch_assoc($res)){

										$category_title = $rows['title'];
										$category_id = $rows['id'];

										?>
										<option <?php if($current_category==$category_id){echo "selected"; } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
										<?php
									}

								} else {

									// Category Not available.
									echo "<option value='0'>Category Not Available!</option>";

								}

							?>

						</select>

					</td>

				</tr>

				<tr>
					<td>Featured: </td>
					<td>
						<input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
						<input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
					</td>

				</tr>

				<tr>
					<td>Active: </td>
					<td>
						<input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
						<input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
					</td>

				</tr>

				<tr>
					<td>
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

						<input type="submit" name="submit" value="Update Food" class="btn-secondary">
					</td>

				</tr>

			</table>

		</form>

		<?php

			if(isset($_POST['submit'])){

				// Get the details from the form. 
				$id = $_POST['id'];
				$title = $_POST['title'];
				$description = $_POST['description'];
				$price = $_POST['price'];
				$current_image = $_POST['current_image'];
				$category = $_POST['category'];
				$featured = $_POST['featured'];
				$active = $_POST['active'];

				// Upload the image if any was selected. 

				if(isset($_FILES['image']['name'])){

					// Upload button was clicked!
					$image_name = $_FILES['image']['name']; 	// New image name. 

					if($image_name != ""){

						// Image available.
						$ext = end(explode('.', $image_name));
						$image_name = "Food-Name-".rand(0000,9999).'.'.$ext;		// Process of renaming the image file. 

						$source = $_FILES['image']['tmp_name'];
						$destination = "../images/food/".$image_name;				// Source and destination paths. 

						$upload = move_uploaded_file($source, $destination);		// Uploading the image. 

						if($upload == false){

							// Failed to upload. 
							$_SESSION['upload'] = "<div class = 'error'> Failed To Upload The Image! </div>";
							header('location:'.HOMEURL.'admin/food-management.php');
							
							die();			// Redirecting and stopping the process after failure as always.

							// $_SESSION['upload'] is alredy in the management file so no need to add it again. 
						}

						// Removing the current image if any available. 
						if($current_image != ""){

							// Current image is available. 
							// So removing process starts. 
							$remove_path = "../images/food/".$current_image;

							$remove = unlink($remove_path);

							// Now to check whether remove was successful or not. 

							if($remove == false){

								// Failed to remove current image. 
								$_SESSION['remove-failed'] = "<div class = 'error'> Failed To Remove Current Image! </div>";
								header('location:'.HOMEURL.'admin/food-management.php');
								die();

							}
						}

					} else {

						$image_name = $current_image;			// Current image when no image is selected. 

					}

				} else {

					// Upload was not clicked!
					$image_name = $current_image;
				}

				// Finally time to Update the food item in the database. 

				$sql3 = "UPDATE tbl_food SET 
					title = '$title',
					description = '$description',
					price = $price,
					image_name = '$image_name',
					category_id = '$category',
					featured = '$featured',
					active = '$active'
					WHERE id = $id
				";

				$res3 = mysqli_query($conn, $sql3);   			// Executing the query as always.

				if($res3 == true){

					// Query Executed and food item updated in the database. 
					$_SESSION['update'] = "<div class = 'success'> Food Item Updated Successfully! </div>";
					header('location:'.HOMEURL.'admin/food-management.php');

				} else {

					// Query Failed to Execute. 
					$_SESSION['update'] = "<div class = 'error'> Failed To Update The Item! </div>";
					header('location:'.HOMEURL.'admin/food-management.php');

				}


			} 

		?>


	</div>


</div>


<?php 

	include('Reusables/footer.php');

?>