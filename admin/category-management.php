<?php include('Reusables/menu.php')
?>

<div class = "main-content"> 
	<div class = "wrapper">
		<h1>Manage Category</h1>
		
		<br /> <br />

		<?php           												// This php section will display the successfully added message. 

			if(isset($_SESSION['add'])){
				
				echo $_SESSION['add'];
				unset($_SESSION['add']);

			}

			if(isset($_SESSION['delete_image'])){				 // This part is used to display the error message of image not deleting.  
				
				echo $_SESSION['delete_image'];
				unset($_SESSION['delete_image']);

			}


			if(isset($_SESSION['delete_category'])){			 // This part is used to display the message of delete category.  
				
				echo $_SESSION['delete_category'];
				unset($_SESSION['delete_category']);

			}

			if(isset($_SESSION['category-id-invalid'])){			 // This is the error message of invalid update category.  
				
				echo $_SESSION['category-id-invalid'];
				unset($_SESSION['category-id-invalid']);

			}

			if(isset($_SESSION['update'])){			 // This is the  message after pressing the update category.  
				
				echo $_SESSION['update'];
				unset($_SESSION['update']);

			}

			if(isset($_SESSION['upload'])){			 // This is the  message after uploading the new image in update category.  
				
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);

			}

			if(isset($_SESSION['failed-to-remove'])){			 // This is the  message after uploading the new image in update category.  
				
				echo $_SESSION['failed-to-remove'];
				unset($_SESSION['failed-to-remove']);

			}


		?>

		<br><br>


			<!-- Add button -->

			<a href="<?php echo HOMEURL; ?>admin/add-category.php" class = "btn-primary">Add Category</a>
			
			<br /> <br /> <br />

			<table class = "tbl-full">
				<tr>
					<th>Serial Number</th>
					<th>Title</th>
					<th>Image</th>
					<th>Featured</th>
					<th>Active</th>
					<th>Actions</th>
				</tr>

				<?php

					$sql = "SELECT * FROM tbl_category";		// Query to get all categoies from the database.

					$res = mysqli_query($conn, $sql);		// Executing the query. 

					$count = mysqli_num_rows($res);

					// Creating serial number value and assigning it 1. 
					$sn = 1;   		

					// Checking whether we have data in the database or not. 

					if($count>0){
						// We do have data in database. So let's get it and display it. 

						while ($row = mysqli_fetch_assoc($res)) {
							
							$id = $row['id'];
							$title = $row['title'];
							$image_name = $row['image_name'];
							$featured = $row['featured'];
							$active = $row['active'];

							?>

								<tr>
									<td><?php echo $sn++;?></td>
									<td><?php echo $title;?></td>

									<td>
										<?php 	

											// Checking whether image name is available. 
											if($image_name != ""){
												// Display the image.
												?>

												<img src="<?php echo HOMEURL; ?>images/category/<?php echo $image_name; ?>" width = "120px">

												<?php


											} else {
												// Display no image message. 

												echo "<div class = 'error'>Image Not Added!</div>";
											}

										?>
										
									</td>

									<td><?php echo $featured;?></td>
									<td><?php echo $active;?></td>
									<td>
										<a href="<?php echo HOMEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class = "btn-secondary">Update Category</a>
										<a href="<?php echo HOMEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class = "btn-danger">Delete Category</a>
									</td>
								</tr>

							<?php
						}

					} else {
						// We do not have data in database. 
						// We'll display the message inside the table.

						?>
						<!-- Breaking php because we have to write some html lines. -->

						<tr>
							<td colspan="6"><div class="error">No Category Added!</div></td>
						</tr>

						<?php
					}

				?>

				

			</table>
	</div>
</div>


<?php include('Reusables/footer.php')
?>