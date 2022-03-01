<?php
	include('Reusables/menu.php');
?>

<div class = "main-content"> 
		<div class = "wrapper">
			<h1>Add Admin</h1>

			<br> <br>

			<?php
				if(isset($_SESSION['add'])){
					
					echo $_SESSION['add'];
					unset($_SESSION['add']);   // This is used to display the failed insertion message in the add admin page. 

				}
			?>

			<form action = "" method="POST">
				<table class="tbl-30">
					<tr>
						<td>Full Name: </td>
						<td><input type="text" name = "full_name" placeholder = "Enter Your Name"></td>
					</tr>

					<tr>
						<td>Username: </td>
						<td><input type="text" name = "username" placeholder = "Enter Your Username"></td>
					</tr>

					<tr>
						<td>Password: </td>
						<td><input type="password" name = "password" placeholder = "Enter Your Password"></td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Add Admin" class="btn-secondary">
						</td>
					</tr>

				</table>
			</form>
		</div>
	</div>





<?php
	include('Reusables/footer.php');
?>

<?php
	//getting all the data if it is submitted.

	if(isset($_POST['submit'])){
		$full_name = $_POST['full_name'];
		$username = $_POST['username'];
		$password = md5($_POST['password']); //md5 used to encrypt the password. 

		//sql query to save them into DB.

		$sql = "INSERT INTO tbl_admin SET
			full_name = '$full_name',
			username = '$username',
			password = '$password'
		";


		// Executing the query and saving data into DB.
		$res = mysqli_query($conn, $sql) or die(mysqli_error());				// res stands for resolved. 

		if($res == TRUE){
			//echo "Data Inserted!"; will not be using echo in this case. 
			
			$_SESSION['add'] = "<div class = 'success'>Admin Added Successfully!</div>";     // Instead of echo using session to display inserted message. 
			// Inserted message will dissapear if the page is refreshed. 

			header("location:".HOMEURL.'admin/admin-management.php');  // After insertion this will redirect admin to manage admin page.						
		} else {
			//echo "Data Not Inserted!";

			$_SESSION['add'] = "<div class = 'error'>Failed To Add Admin Successfully!</div>";
			header("location:".HOMEURL.'admin/add-admin.php');   // If insertion ain't successful then returned back to add admin page. 

		}
	}
?>