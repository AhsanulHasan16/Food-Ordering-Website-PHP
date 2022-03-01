<?php
	include('Reusables/menu.php');
?>

	<div class="main-content">
		<div class="wrapper">
			<h1>Update Admin</h1>
			<br><br>

			<?php 
				$id = $_GET['id'];                       // Like delete, getting the id first.

				$sql = "SELECT * FROM tbl_admin WHERE id = $id";		 // Sql query to get the details.	

				$res = mysqli_query($conn, $sql);      	 // Executing the query.

				if($res == true){

					$count = mysqli_num_rows($res);
					if($count == 1){
						//echo "Admin Available";
						$row = mysqli_fetch_assoc($res);

						$full_name = $row['full_name'];
						$username = $row['username'];


					} else {
						header('location:'.HOMEURL.'admin/admin-management.php');      // For security against unwanted errors!
					}
				}

			?>

			<form action="" method="POST">
				
				<table class="tbl-30">
					<tr>
						<td>Full Name: </td>
						<td>
							<input type="text" name="full_name" value="<?php echo $full_name; ?>">
						</td>
					</tr>

					<tr>
						<td>Username:</td>
						<td>
							<input type="text" name="username" value="<?php echo $username; ?>">
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<input type="submit" name="submit" value="Update Admin" class="btn-secondary">
						</td>
					</tr>
					
				</table>	
			
			</form>
		</div>
	</div>


<?php 
	
	if(isset($_POST['submit'])){

		//echo "Button Clicked!"; Used just to check if the submit button was clicked or not. 

		// Getting all the value from the update form. 
		$id = $_POST['id'];
		$full_name = $_POST['full_name'];
		$username = $_POST['username'];						// POST because we got the values through the form. 


		$sql = "UPDATE tbl_admin SET 
		full_name = '$full_name',
		username = '$username' 
		WHERE id = '$id'
		"; 

		$res = mysqli_query($conn, $sql);

		if($res == true){

			$_SESSION['update'] = "<div class = 'success'>Admin Updated Successfully!</div>";
			header('location:'.HOMEURL.'admin/admin-management.php');
		} else {

			$_SESSION['update'] = "<div class = 'error'>Failed to Update Admin Successfully!</div>";
			header('location:'.HOMEURL.'admin/admin-management.php');
		}
	}
?>


<?php
	include('Reusables/footer.php');
?>