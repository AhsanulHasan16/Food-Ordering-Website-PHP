<?php include('Reusables/menu.php')
?>

	<!-- Main Content section starts -->
	<div class = "main-content"> 
		<div class = "wrapper">
			<h1>Manage Admin</h1>
			<br /> 

			<?php
				if(isset($_SESSION['add'])){

					echo $_SESSION['add'];   	  // Displaying insertion message.
					unset($_SESSION['add']);  	  // Used to remove the insertion message after page has be refreshed.
				
				}

				if(isset($_SESSION['delete'])){

					echo $_SESSION['delete'];
					unset($_SESSION['delete']);

				}

				if(isset($_SESSION['update'])){	

					echo $_SESSION['update'];
					unset($_SESSION['update']);

				}


				if(isset($_SESSION['user_not_found'])){	

					echo $_SESSION['user_not_found'];
					unset($_SESSION['user_not_found']);

				}
				

				if(isset($_SESSION['pass_not_matched'])){	

					echo $_SESSION['pass_not_matched'];
					unset($_SESSION['pass_not_matched']);	

				}
				

				if(isset($_SESSION['change_pass'])){	

					echo $_SESSION['change_pass'];
					unset($_SESSION['change_pass']);	

				}
								

			?>
			
			<br><br><br>

			<!-- Add button -->

			<a href="add-admin.php" class = "btn-primary">Add Admin</a>
			
			<br /> <br /> <br />

			<table class = "tbl-full">
				<tr>
					<th>Serial Number</th>
					<th>Full Name</th>
					<th>Username</th>
					<th>Actions</th>
				</tr>

				<?php
					$sql = "SELECT * FROM tbl_admin";   // Query to get all admin.
					$res = mysqli_query($conn, $sql);   // Executing the query. 

					if($res == TRUE){

						$rows_count = mysqli_num_rows($res);  // Function to get all the rows in the DB.

						$serial_number = 1;    // Used it in the echo id instead so that the id number looks good unlike in the DB.


						if($rows_count > 0){

							while($rows=mysqli_fetch_assoc($res)){       // If used to check if there are data in DB or not. 

								$id = $rows['id'];
								$full_name = $rows['full_name'];
								$username = $rows['username'];

								?>

								<tr>
									<td><?php echo $serial_number++ ?></td> 
									<td><?php echo $full_name?></td>   
									<td><?php echo $username?></td>     <!-- These td are used to show every row from the DB to the page.-->
									<td>
										<a href="<?php echo HOMEURL; ?>admin/change-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
										<a href="<?php echo HOMEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class = "btn-secondary">Update Admin</a>
										<a href="<?php echo HOMEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class = "btn-danger">Delete Admin</a> 
									</td>
								</tr>

								<?php
							} 
						}
					}
				?>

				
			</table>
		</div>
	</div>
	<!-- Main Content section ends -->

<?php include('Reusables/footer.php')
?>

</body>
</html>