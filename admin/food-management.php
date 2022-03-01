<?php 

	include('Reusables/menu.php');

?>

<div class = "main-content"> 
	<div class = "wrapper">
		<h1>Manage Food</h1>
		<br /> <br />

			<!-- Add button -->

			<a href="<?php echo HOMEURL; ?>admin/add-food.php" class = "btn-primary">Add Food</a>
			
			<br /> <br /> <br />

			<?php

				if(isset($_SESSION['add-food'])){						// Displaying message after adding a food item. 

					echo $_SESSION['add-food'];
					unset($_SESSION['add-food']);

				}

				if(isset($_SESSION['invalid'])){							// Displaying error message. No id or image name selected!

					echo $_SESSION['invalid'];
					unset($_SESSION['invalid']);

				}

				if(isset($_SESSION['delete'])){							// Displaying message of deleting a food item. 

					echo $_SESSION['delete'];
					unset($_SESSION['delete']);

				}

				if(isset($_SESSION['upload'])){							// Displaying error message of deleting an image. 

					echo $_SESSION['upload'];
					unset($_SESSION['upload']);

				}

				if(isset($_SESSION['update'])){							// Displaying the message of updating an item. 

					echo $_SESSION['update'];
					unset($_SESSION['update']);

				}

			?>

			<table class = "tbl-full">
				<tr>
					<th>Serial Number</th>
					<th>Title</th>
					<th>Price</th>
					<th>Image</th>
					<th>Featured</th>
					<th>Active</th>
					<th>Actions</th>
				</tr>

				<?php

					// SQL query to get all the food items. 
					$sql = "SELECT * FROM tbl_food";

					// Executing the query. 
					$res = mysqli_query($conn, $sql);

					// Counting rows to check whether we have the food items or not. 
					$count = mysqli_num_rows($res);

					$sn = 1;

					if($count>0){

						// We have item in database. 
						while($row=mysqli_fetch_assoc($res)){

							$id = $row['id'];
							$title = $row['title'];
							$price = $row['price'];
							$image_name = $row['image_name'];
							$featured = $row['featured'];
							$active = $row['active'];
							?>	

							<tr>
								<td><?php echo $sn++; ?></td>
								<td><?php echo $title; ?></td>
								<td>$<?php echo $price; ?></td>
								<td>
									<?php 

										if($image_name == ""){

											// We do not have any image. 
											echo "<div class = 'error'> No Image Added! </div>";

										} else {

											// We have image to display. 

											?>
										
											<img src="<?php echo HOMEURL; ?>images/food/<?php echo $image_name; ?>" width = "150px"> 
											<?php
										
										}

									?>

								</td>
								<td><?php echo $featured; ?></td>
								<td><?php echo $active; ?></td>
								<td>
									<a href="<?php echo HOMEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class = "btn-secondary">Update Food Item</a>
									<a href="<?php echo HOMEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class = "btn-danger">Delete Food Item</a>
								</td>
							</tr>

							<?php
						}

					} else {

						// No items in database.
						echo "<tr><td colspan='7' class = 'error'> Food Not Added Yet! </td></tr>";
					}

				?>

				

			</table>
	</div>
	
</div>


<?php 

	include('Reusables/footer.php');

?>